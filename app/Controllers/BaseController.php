<?php

namespace App\Controllers;

use App\Models\Notification;
use App\Models\Organization;
use App\Models\UserModel;
use App\Models\Employee;
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

	protected function send_notification($subject, $body, $recipient, $link, $cta) {
		$userModel = new UserModel();
		$employeeModel = new Employee();
		$organizationModel = new Organization();
		$organization = $organizationModel->first();
		$user = $userModel->find($recipient);
		$employee = $employeeModel->find($user['user_employee_id']);
		$to = $employee['employee_mail'];
		$phone = $employee['employee_phone'];
		$phone = '234'.substr($phone, 1, strlen($phone));
		$from['name'] = 'IGOV by Connexxion Telecom';
		$from['email'] = 'support@connexxiontelecom.com';
		$data = [
			'subject' => $subject,
			'user' => $user['user_name'],
			'organization' => $organization['org_name'],
			'notification' => $body,
			'link' => $link
		];
		$message = view('email/notification', $data);

		$notification_data = [
			'subject' => $subject,
			'body' => $body,
			'recipient' => $recipient,
			'link' => $link,
			'cta' => $cta,
			'notification_status' => 0,
		];
		if ($this->notification->save($notification_data)) {
			$this->send_mail($to, $subject, $message, $from);
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => 'https://termii.com/api/sms/send',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POSTFIELDS =>' {
          "to": "'.$phone.'",
           "from": "N-Alert",
           "sms": '.$body.',
           "type": "plain",
           "channel": "dnd",
           "api_key": "TLfrtWYbF5uWb0GLWjwDigrMb722yJgAp2B3jDoYYRzYOSjIU3PHwRIpGSZlga"
                }',
				CURLOPT_HTTPHEADER => array(
					'Content-Type: application/json'
				),
			));
			$responses = curl_exec($curl);
//			print_r($responses);
			curl_close($curl);
		}
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
		$notifications = [];
    if ($type === 'unseen') {
      $notifications = $this->notification->where('notification_status', 0)->orderBy('created_at', 'DESC')->findAll();
    } else if ($type === 'all') {
      $notifications = $this->notification->orderBy('created_at', 'DESC')->findAll();
    }
    foreach ($notifications as $key => $notification) {
    	if ($notification['recipient'] != $this->session->user_id) {
		    unset($notifications[$key]);
	    }
    }
    if (count($notifications) <= 1) {
      $notifications = (array) $notifications;
    }
    return $notifications;
  }
}
