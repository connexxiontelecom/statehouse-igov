<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FleetDriver;
use App\Models\FleetMaintenanceType;
use App\Models\FleetRenewalType;
use App\Models\FleetVehicle;
use App\Models\FleetVehicleType;
use App\Models\UserModel;
use App\Models\Employee;
use App\Models\MaintenanceSchedules;
use App\Models\Department;
use App\Models\Position;
use App\Models\RenewalSchedule;
use App\Models\AssignmentLogs;

use CodeIgniter\Exceptions\PageNotFoundException;

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
		$this->fleet_driver = new FleetDriver();
		$this->user = new UserModel();
		$this->employee = new Employee();
		$this->ms = new MaintenanceSchedules();
		$this->department = new Department();
		$this->user = new UserModel();
		$this->position = new Position();
		$this->rs = new RenewalSchedule();
		$this->al = new AssignmentLogs();
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
			$response['message'] = 'There was an error while adding the new vehicle';
		}
		return $this->response->setJSON($response);
	}

	public function drivers() {
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		$data['drivers'] = $this->_get_drivers();
		return view('/pages/fleet/drivers', $data);
	}

	public function new_driver() {
		if($this->request->getMethod() == 'get'):
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			$data['employees'] = $this->employee->findAll();
			return view('/pages/fleet/new-driver', $data);
		endif;
		$_POST['fd_status'] = 1;
		$file = $this->request->getFile('file');
		if (!empty($file)) {
			if ($file->isValid() && !$file->hasMoved()) {
				$file_name = time().'_'.$file->getClientName();
				$file->move('uploads/fleets', $file_name);
				$_POST['fd_moi_attachment'] = $file_name;
			}
		}
		if ($this->fleet_driver->save($_POST)) {
			$response['success'] = true;
			$response['message'] = 'Successfully added the new driver';
		} else {
			$response['success'] = false;
			$response['message'] = 'There was an error while adding the new driver';
		}
		return $this->response->setJSON($response);
	}

	private function _get_drivers() {
		$drivers = $this->fleet_driver->where('fd_status', 1)->findAll();
		foreach ($drivers as $key => $driver) {
			$drivers[$key]['employee'] = $this->employee->find($driver['fd_user_id']);
		}
		return $drivers;
	}

	private function _get_vehicles($status) {
		$vehicles = $this->fleet_vehicle->where('fv_status', $status)->findAll();
		foreach ($vehicles as $key => $vehicle) {
			$vehicles[$key]['vehicle_type'] = $this->fleet_vehicle_type->find($vehicle['fv_fvt_id']);
		}
		return $vehicles;
	}
	
	public function renewal_schedule(){
	
	
	
	}
	
	public function manage_vehicle($fv_id){
		
		if($this->request->getMethod() == 'get'):
		
		
		$data['firstTime'] = $this->session->firstTime;
		$data['username'] = $this->session->user_username;
		$data['vehicle'] = $vehicle = $this->fleet_vehicle->where('fv_id', $fv_id)
			->join('fleet_vehicle_types', 'fleet_vehicles.fv_fvt_id = fleet_vehicle_types.fvt_id')
			->first();
		
		if(!empty($vehicle)):
		$data['fmts'] = $this->fleet_maintenance_type->findAll();
		$data['frs'] = $this->fleet_renewal_type->findAll();
		$data['department_employees'] = $this->_get_department_employees();
		$data['v_rs'] = $this->rs->where('rs_fv_id', $fv_id)
								->join('fleet_renewal_types', 'renewal_schedules.rs_frt_id = fleet_renewal_types.frt_id')
								->join('employees', 'renewal_schedules.rs_employee_id = employees.employee_id')
								->findAll();
		$data['v_mts'] = $this->ms->where('ms_fv_id', $fv_id)
									->join('fleet_maintenance_types', 'maintenance_schedules.ms_fmt_id = fleet_maintenance_types.fmt_id')
									->join('employees', 'maintenance_schedules.ms_employee_id = employees.employee_id')
									->findAll();
		$data['drivers'] = $this->_get_drivers();
		 $als = $this->al->where('al_fv_id', $fv_id)
											->join('employees', 'assignment_logs.al_employee_id = employees.employee_id')
											->findAll();
		
		 $i = 0;
		$new_al = array();
		foreach ($als as $al):
			$al['by'] = $this->employee->where('employee_id', $al['al_by'])->first();
			$al['driver'] = $this->fleet_driver->where('fd_id', $al['al_fd_id'])
												->join('employees', 'fleet_drivers.fd_user_id = employees.employee_id')
												->first();
			$new_al[$i] = $al;
			$i++;
			
			endforeach;
			
			$data['assignment_logs'] = $new_al;
			//print_r($new_al);
		return view('/pages/fleet/manage-vehicle', $data);
		
		else:
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
			
		endif;
	endif;
		
		
		if($this->request->getMethod() == 'post'):
			
			$request_type = $_POST['type'];
		
			if($request_type == 1):
			
				$ms_fv_id = $_POST['ms_fv_id'];
				$ms_fmt_id = $_POST['ms_fmt_id'];
				$date = date_create_from_format('d/m/Y', $_POST['ms_schedule_due_date']);
				$date = date_format($date, 'Y-m-d');
				$check = $this->ms->where('ms_fv_id', $ms_fv_id)->where('ms_fmt_id', $ms_fmt_id)->first();
				
				if(empty($check)):
					
					$ms_array = array(
						'ms_fv_id' => $ms_fv_id,
						'ms_fmt_id' => $ms_fmt_id,
						'ms_schedule_date' => $_POST['ms_schedule_date'],
						'ms_schedule_due_date' => $date,
						'ms_employee_id' => $_POST['ms_employee_id'],
					);
					
					
					else:
						$ms_array = array(
							'ms_id'=> $check['ms_id'],
							'ms_fv_id' => $ms_fv_id,
							'ms_fmt_id' => $ms_fmt_id,
							'ms_schedule_date' => $_POST['ms_schedule_date'],
							'ms_schedule_due_date' => $date,
							'ms_employee_id' => $_POST['ms_employee_id'],
						);
				
					endif;
			
			$this->ms->save($ms_array);
				session()->setFlashData("action","action successful");
				$url = base_url('manage-vehicle').'/'.$fv_id;
				return redirect()->to($url);
			
			endif;
			
			if($request_type == 2):
				
				$rs_fv_id = $_POST['rs_fv_id'];
				$rs_frt_id = $_POST['rs_frt_id'];
				$rs_renew_date = $_POST['rs_renew_date'];
				$rs_due_date = $_POST['rs_due_date'];
				$rs_employee_id = $_POST['rs_employee_id'];
				
				$check = $this->rs->where('rs_fv_id', $rs_fv_id)->where('rs_frt_id', $rs_frt_id)->first();
				
				if(empty($check)):
					
					$ms_array = array(
						'rs_fv_id' => $rs_fv_id,
						'rs_frt_id' => $rs_frt_id,
						'rs_renew_date' => $rs_renew_date,
						'rs_due_date' => $rs_due_date,
						'rs_employee_id' => $rs_employee_id,
					);
				
				
				else:
					$ms_array = array(
						'rs_id' => $check['rs_id'],
						'rs_fv_id' => $rs_fv_id,
						'rs_frt_id' => $rs_frt_id,
						'rs_renew_date' => $rs_renew_date,
						'rs_due_date' => $rs_due_date,
						'rs_employee_id' => $rs_employee_id,
					);
				
				endif;
				
				$this->rs->save($ms_array);
				session()->setFlashData("action","action successful");
				$url = base_url('manage-vehicle').'/'.$fv_id;
				return redirect()->to($url);
			
			endif;
			
			if($request_type == 3):
				$al_array = array(
					'al_fd_id' => $_POST['al_fd_id'],
					'al_employee_id' => $_POST['al_employee_id'],
					'al_fv_id' => $_POST['al_fv_id'],
					'al_due_date' => $_POST['al_due_date'],
					'al_purpose' => $_POST['al_purpose'],
					'al_by' => $this->session->user_employee_id,
				);
			
				$this->al->save($al_array);
				session()->setFlashData("action","action successful");
				$url = base_url('manage-vehicle').'/'.$fv_id;
				return redirect()->to($url);
			
			endif;
			
			
		
		
		endif;
		
	}
	
	
	public function renewal_schedules(){
		if($this->request->getMethod() == 'get'):
			
			
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			$data['v_rs'] = $this->rs->join('fleet_renewal_types', 'renewal_schedules.rs_frt_id = fleet_renewal_types.frt_id')
									->join('employees', 'renewal_schedules.rs_employee_id = employees.employee_id')
									->join('fleet_vehicles', 'renewal_schedules.rs_fv_id = fleet_vehicles.fv_id')
									->findAll();
			return view('/pages/fleet/renewal-schedules', $data);
		endif;
		
	}
	
	public function renewal_schedule_calendar(){
		if($this->request->getMethod() == 'get'):
			
			
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			$v_rs = $this->rs->join('fleet_renewal_types', 'renewal_schedules.rs_frt_id = fleet_renewal_types.frt_id')
				->join('employees', 'renewal_schedules.rs_employee_id = employees.employee_id')
				->join('fleet_vehicles', 'renewal_schedules.rs_fv_id = fleet_vehicles.fv_id')
				->findAll();
			
			$new_rs = array();
			$i = 0;
			foreach ($v_rs as $v_r):
				$new_rs[$i] = array(
					
					'title' => $v_r['frt_name']." (".$v_r['fv_brand'].'-'.$v_r['fv_maker'].'-'.$v_r['fv_year'].'-'.$v_r['fv_color'].")",
					'start' => $v_r['rs_renew_date'],
					'end'=> $v_r['rs_renew_date'],
					'className'=> "bg-primary"
				);
				$i++;
			endforeach;
			
			$data['data'] =  json_encode($new_rs);
			return view('/pages/fleet/renewal-schedule-calendar', $data);
		endif;
		
	}
	
	public function renewal_schedule_data(){
		if($this->request->getMethod() == 'get'):
			
			
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			$v_rs = $this->rs->join('fleet_renewal_types', 'renewal_schedules.rs_frt_id = fleet_renewal_types.frt_id')
				->join('employees', 'renewal_schedules.rs_employee_id = employees.employee_id')
				->join('fleet_vehicles', 'renewal_schedules.rs_fv_id = fleet_vehicles.fv_id')
				->findAll();
			
			$new_rs = array();
			$i = 0;
			foreach ($v_rs as $v_r):
				$new_rs[$i] = array(
					
					'title' => $v_r['frt_name']." (".$v_r['fv_brand'].'-'.$v_r['fv_maker'].'-'.$v_r['fv_year'].'-'.$v_r['fv_color'].")",
					'start' => $v_r['rs_renew_date'],
					'end'=> $v_r['rs_renew_date'],
					'className'=> "bg-primary"
				);
				$i++;
			endforeach;
			
			return json_encode($new_rs);
			//return view('/pages/fleet/renewal-schedule-calendar', $data);
		endif;
		
	}
	
	public function maintenance_schedules(){
		if($this->request->getMethod() == 'get'):
			
			
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
		
			$data['v_mts'] = $this->ms->join('fleet_maintenance_types', 'maintenance_schedules.ms_fmt_id = fleet_maintenance_types.fmt_id')
				->join('fleet_vehicles', 'maintenance_schedules.ms_fv_id = fleet_vehicles.fv_id')
				->join('employees', 'maintenance_schedules.ms_employee_id = employees.employee_id')
				->findAll();
			return view('/pages/fleet/maintenance-schedules', $data);
		endif;
		
	}
	
	public function maintenance_schedule_calendar(){
		if($this->request->getMethod() == 'get'):
			
			
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			$v_mts = $this->ms->join('fleet_maintenance_types', 'maintenance_schedules.ms_fmt_id = fleet_maintenance_types.fmt_id')
				->join('fleet_vehicles', 'maintenance_schedules.ms_fv_id = fleet_vehicles.fv_id')
				->join('employees', 'maintenance_schedules.ms_employee_id = employees.employee_id')
				->findAll();
			
			$v_rs = $this->rs->join('fleet_renewal_types', 'renewal_schedules.rs_frt_id = fleet_renewal_types.frt_id')
				->join('employees', 'renewal_schedules.rs_employee_id = employees.employee_id')
				->join('fleet_vehicles', 'renewal_schedules.rs_fv_id = fleet_vehicles.fv_id')
				->findAll();
			
			$new_vmts = array();
			$i = 0;
			foreach ($v_mts as $v_mt):
				$new_vmts[$i] = array(
					
					'title' => $v_mt['fmt_name']." (".$v_mt['fv_brand'].'-'.$v_mt['fv_maker'].'-'.$v_mt['fv_year'].'-'.$v_mt['fv_color'].")",
					'start' => $v_mt['ms_schedule_due_date'],
					'end'=> $v_mt['ms_schedule_due_date'],
					'className'=> "bg-primary"
				);
				$i++;
			endforeach;
			$data['data'] = json_encode($new_vmts);
			return view('/pages/fleet/maintenance-schedule-calendar', $data);
		endif;
		
	}
	
	public function maintenance_schedule_data(){
		if($this->request->getMethod() == 'get'):
			
			
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			
			$v_mts = $this->ms->join('fleet_maintenance_types', 'maintenance_schedules.ms_fmt_id = fleet_maintenance_types.fmt_id')
				->join('fleet_vehicles', 'maintenance_schedules.ms_fv_id = fleet_vehicles.fv_id')
				->join('employees', 'maintenance_schedules.ms_employee_id = employees.employee_id')
				->findAll();
			
			$v_rs = $this->rs->join('fleet_renewal_types', 'renewal_schedules.rs_frt_id = fleet_renewal_types.frt_id')
				->join('employees', 'renewal_schedules.rs_employee_id = employees.employee_id')
				->join('fleet_vehicles', 'renewal_schedules.rs_fv_id = fleet_vehicles.fv_id')
				->findAll();
			
			$new_vmts = array();
			$i = 0;
			foreach ($v_mts as $v_mt):
				$new_vmts[$i] = array(
					
					'title' => $v_mt['fmt_name']." (".$v_mt['fv_brand'].'-'.$v_mt['fv_maker'].'-'.$v_mt['fv_year'].'-'.$v_mt['fv_color'].")",
					'start' => $v_mt['ms_schedule_due_date'],
					'end'=> $v_mt['ms_schedule_due_date'],
					'className'=> "bg-primary"
				);
				$i++;
			endforeach;
			
			return json_encode($new_vmts);
			//return view('/pages/fleet/renewal-schedule-calendar', $data);
		endif;
		
	}
	
	private function _get_department_employees() {
		$department_employees = [];
		$departments = $this->department->findAll();
		foreach ($departments as $department) {
			$department_employees[$department['dpt_name']] = [];
			$employees = $this->employee
				->where('employee_department_id', $department['dpt_id'])
				->findAll();
			foreach ($employees as $employee) {
				$user = $this->user->where('user_employee_id', $employee['employee_id'])->first();
				if ($user['user_status'] == 1 && ($user['user_type'] == 3 || $user['user_type'] == 2)) {
					$employee['user'] = $user;
					$employee['position'] = $this->position->find($employee['employee_position_id']);
					array_push($department_employees[$department['dpt_name']], $employee);
				}
			}
		}
		return $department_employees;
	}
	
}
