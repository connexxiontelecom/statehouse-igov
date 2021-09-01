<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FleetMaintenanceType;
use App\Models\FleetRenewalType;
use App\Models\FleetVehicle;
use App\Models\FleetVehicleType;

class FleetController extends BaseController
{
	public function __construct() {
		if (session()->get('type') == 1):
			echo view('auth/access_denied');
			exit;
		endif;
		$this->fleet_vehicle = new FleetVehicle();
		$this->fleet_vehicle_type = new FleetVehicleType();
		$this->fleet_maintenance_type = new FleetMaintenanceType();
		$this->fleet_renewal_type = new FleetRenewalType();
	}

	public function active_vehicles() {
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		$data['active_vehicles'] = $this->_get_vehicles(1);
		return view('/pages/fleet/active-vehicles', $data);
	}

	public function new_vehicle() {
		if($this->request->getMethod() == 'get'):
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			$data['vehicle_types'] = $this->fleet_vehicle_type->findAll();
			return view('/pages/fleet/new-vehicle', $data);
		endif;
		$_POST['fv_status'] = 1;
		$file = $this->request->getFile('file');
		if (!empty($file)) {
			if ($file->isValid() && !$file->hasMoved()) {
				$file_name = time().'_'.$file->getClientName();
				$file->move('uploads/fleets', $file_name);
				$_POST['fv_vehicle_image'] = $file_name;
			}
		}
		$fleet_vehicle = $this->fleet_vehicle->insert($_POST);
		if ($fleet_vehicle) {
			$response['success'] = true;
			$response['message'] = 'Successfully added the new vehicle';
		} else {
			$response['success'] = false;
			$response['message'] = 'There was an error while creating the new vehicle';
		}
		return $this->response->setJSON($response);
	}

	private function _get_vehicles($status) {
		$vehicles = $this->fleet_vehicle->where('fv_status', $status)->findAll();
		foreach ($vehicles as $key => $vehicle) {
			$vehicles[$key]['vehicle_type'] = $this->fleet_vehicle_type->find($vehicle['fv_fvt_id']);
		}
		return $vehicles;
	}
}
