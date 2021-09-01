<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FleetRenewalType;

class FleetSettingController extends BaseController
{
	public function __construct()
	{
		if (session()->get('type') == 2):
			echo view('auth/access_denieda');
			exit;
		endif;
		$this->fleet_renewal_type = new FleetRenewalType();
	}

	public function renewal_types() {
		if ($this->request->getMethod() == 'get'):
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			$data['renewal_types'] = $this->fleet_renewal_type->findAll();
			return view('office/fleet/renewal-type', $data);
		endif;
		$this->fleet_renewal_type->save($_POST);
		session()->setFlashData("action","action successful");
		return redirect()->to(base_url('/renewal-types'));
	}

	public function index()
	{
		//
	}
}
