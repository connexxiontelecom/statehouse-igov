<?php

namespace App\Controllers;

use App\Models\Notification;
use App\Models\Verification;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use CodeIgniter\RESTful\ResourceController;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

class BaseController extends ResourceController
{
	/**
	 * Instance of the main Request object.
	 *
	 * @var IncomingRequest|CLIRequest
	 */
	protected $request;

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];
	protected $email;
	protected $session;
	protected $notification;

	/**
	 * Constructor.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param LoggerInterface   $logger
	 */
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		$this->session = \Config\Services::session();
		$this->security = \Config\Services::security();
		$this->validator = \Config\Services::validation();
		$this->email = \Config\Services::email();
		$this->client = \Config\Services::curlrequest();
		$pager = \Config\Services::pager();
		helper('text');

		$this->notification = new Notification();
	}
	
	protected function send_mail($to, $subject, $message, $from) {
		$this->email->setTo($to);
		$this->email->setFrom($from['email'], $from['name']);
		$this->email->setSubject($subject);
		$this->email->setMessage($message);
		return $this->email->send(false);
	}

	protected function _get_verification_code($ver_type) {
		$verification = new Verification();
		$ver_code = bin2hex(random_bytes(4));
		$verification_data = [
			'ver_user_id' => session()->user_id,
			'ver_type' => $ver_type,
			'ver_code' => $ver_code,
			'ver_status' => 0,
		];
		$verified = $verification->where([
			'ver_user_id' => session()->user_id,
			'ver_type' => $ver_type
		])->first();
		if ($verified) {
			$verification_data['ver_id'] = $verified['ver_id'];
		}
		$verification->save($verification_data);
		return $ver_code;
	}

  protected function _get_notifications($type) {
    if ($type === 'unseen') {
      $notifications = $this->notification->where('notification_status', 0)->orderBy('created_at', 'DESC')->findAll();
    } else if ($type === 'all') {
      $notifications = $this->notification->orderBy('created_at', 'DESC')->findAll();
    }
    foreach ($notifications as $key => $notification) {
      if (
        $notification['initiator_id'] != $this->session->user_id &&
        !in_array($this->session->user_id, json_decode($notification['target_ids']))
      ) {
        // if neither initiator nor target unset
        unset($notifications[$key]);
      } else {
        $action = $notification['action'];
        switch ($action) {
          case 'new_internal_memo':
            $notifications[$key]['subject'] = 'New Internal Memo Created!';
            $notifications[$key]['has_link'] = true;
            $notifications[$key]['cta'] = 'Click to view memo';
            if ($notification['initiator_id'] == $this->session->user_id) {
              $notifications[$key]['body'] = 'You created a new internal memo';
            } else {
              $notifications[$key]['body'] = 'An internal memo was created, and you were assigned as signatory.';
            }
            break;
          case 'new_external_memo':
            $notifications[$key]['subject'] = 'New External Memo Created!';
            $notifications[$key]['has_link'] = true;
            $notifications[$key]['cta'] = 'Click to view memo';
            if ($notification['initiator_id'] == $this->session->user_id) {
              $notifications[$key]['body'] = 'You created a new external memo';
            } else {
              $notifications[$key]['body'] = 'An external memo was created, and you were assigned as signatory.';
            }
            break;
          case 'sign_memo':
            $notifications[$key]['subject'] = 'New Memo Signing';
            $notifications[$key]['has_link'] = true;
            $notifications[$key]['cta'] = 'Click to view memo';
            if ($notification['initiator_id'] == $this->session->user_id) {
              $notifications[$key]['body'] = 'You successfully signed a memo';
            } else {
              $notifications[$key]['body'] = 'A memo addressed to you was signed and approved.';
            }
            break;

        }
      }
    }
    if (count($notifications) <= 1) {
      $notifications = (array) $notifications;
    }
    return $notifications;
  }
}
