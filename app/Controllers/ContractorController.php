<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Contractor;
use App\Models\Employee;
use App\Models\UserModel;

class ContractorController extends BaseController
{
    public function __construct()
    {
        if (session()->get('type') == 1): //employee
            echo view('auth/access_denied');
            exit;
        endif;
        $this->user = new UserModel();
        $this->employee = new Employee();
        $this->contractor = new Contractor();

    }
	public function manageContractors()
	{
        $data = [
            'firstTime'=>$this->session->firstTime,
            'username'=>$this->session->username,
            'contractors'=>$this->contractor->getAllContractors()
        ];
        return view('pages/project/contractors',$data);
	}

	public function showNewContractorForm(){
        $data = [
            'firstTime'=>$this->session->firstTime,
            'username'=>$this->session->username
        ];
        return view('pages/project/add-new-contractor', $data);
    }
    public function addNewContractor(){
        $inputs = $this->validate([
            'contractor_name' => ['rules'=> 'required', 'label'=>'Contractor Name','errors' => [
                'required' => 'Enter contractor name']],
            'email' => ['rules'=> 'required', 'errors'=>['required'=>'Enter valid email address']],
            'mobile_no' => ['rules'=> 'required', 'errors'=>['required'=>'Enter a functional mobile number']],
            'address' => ['rules'=>'required', 'errors'=>['Enter contractor office address']]
        ]);
        if (!$inputs) {
            return view('pages/project/add-new-contractor', [
                'validation' => $this->validator,
                'firstTime'=>$this->session->firstTime,
                'username'=>$this->session->username,
            ]);
        }else{
            $data = [
              'contractor_name'=>$this->request->getPost('contractor_name'),
              'contractor_email'=>$this->request->getPost('email'),
              'contractor_mobile_no'=>$this->request->getPost('mobile_no'),
              'contractor_website'=>$this->request->getPost('website'),
              'about_contractor'=>$this->request->getPost('about_contractor'),
              'contractor_address'=>$this->request->getPost('address')
            ];

            $this->contractor->save($data);
            return redirect()->back()->with("success", "<strong>Success!</strong> New contractor added");
        }
    }
}
