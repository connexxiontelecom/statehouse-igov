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

	private function _get_vehicles($status) {
		$vehicles = $this->fleet_vehicle->where('fv_status', $status)->findAll();
		foreach ($vehicles as $key => $vehicle) {
			$vehicles[$key]['vehicle_type'] = $this->fleet_vehicle_type->find($vehicle['fv_fvt_id']);
		}
		return $vehicles;
	}
}
