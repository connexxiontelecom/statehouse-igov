<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Employee;
use App\Models\Product;
use App\Models\UserModel;
use App\Models\Vendor;

class ProcurementController extends BaseController
{
    public function __construct()
    {
        if (session()->get('type') == 1): //employee
            echo view('auth/access_denied');
            exit;
        endif;
        $this->user = new UserModel();
        $this->employee = new Employee();
        $this->vendor = new Vendor();
        $this->product = new Product();

    }
    public function manageVendors()
    {
        $data = [
            'firstTime'=>$this->session->firstTime,
            'username'=>$this->session->username,
            'vendors'=>$this->vendor->getAllVendors()
        ];
        return view('pages/procurement/vendors',$data);
    }

    public function showNewVendorForm(){
        $data = [
            'firstTime'=>$this->session->firstTime,
            'username'=>$this->session->username
        ];
        return view('pages/procurement/add-new-vendor', $data);
    }
    public function addNewVendor(){
        $inputs = $this->validate([
            'vendor_name' => ['rules'=> 'required', 'label'=>'Vendor Name','errors' => [
                'required' => 'Enter vendor name']],
            'email' => ['rules'=> 'required', 'errors'=>['required'=>'Enter valid email address']],
            'mobile_no' => ['rules'=> 'required', 'errors'=>['required'=>'Enter a functional mobile number']],
            'address' => ['rules'=>'required', 'errors'=>['Enter contractor office address']]
        ]);
        if (!$inputs) {
            return view('pages/procurement/add-new-vendor', [
                'validation' => $this->validator,
                'firstTime'=>$this->session->firstTime,
                'username'=>$this->session->username,
            ]);
        }else{
            $data = [
                'vendor_name'=>$this->request->getPost('vendor_name'),
                'vendor_email'=>$this->request->getPost('email'),
                'vendor_mobile_no'=>$this->request->getPost('mobile_no'),
                'vendor_website'=>$this->request->getPost('website'),
                'about_vendor'=>$this->request->getPost('about_vendor'),
                'vendor_address'=>$this->request->getPost('address')
            ];

            $this->vendor->save($data);
            return redirect()->back()->with("success", "<strong>Success!</strong> New contractor added");
        }
    }

    public function updateVendor(){
        $inputs = $this->validate([
            'vendor_name' => ['rules'=> 'required', 'label'=>'Vendor Name','errors' => [
                'required' => 'Enter vendor name']],
            'email' => ['rules'=> 'required', 'errors'=>['required'=>'Enter valid email address']],
            'mobile_no' => ['rules'=> 'required', 'errors'=>['required'=>'Enter a functional mobile number']],
            'vendor_key' => ['rules'=> 'required', 'errors'=>['required'=>'Vendor key is missing']],
            'address' => ['rules'=>'required', 'errors'=>['Enter contractor office address']]
        ]);
        if (!$inputs) {
            return view('pages/procurement/add-new-vendor', [
                'validation' => $this->validator,
                'firstTime'=>$this->session->firstTime,
                'username'=>$this->session->username,
            ]);
        }else{
            $data = [
                'vendor_name'=>$this->request->getPost('vendor_name'),
                'vendor_email'=>$this->request->getPost('email'),
                'vendor_mobile_no'=>$this->request->getPost('mobile_no'),
                'vendor_website'=>$this->request->getPost('website'),
                'about_vendor'=>$this->request->getPost('about_vendor'),
                'vendor_address'=>$this->request->getPost('address')
            ];

            $this->vendor->update($this->request->getPost('vendor_key') ,$data);
            return redirect()->back()->with("success", "<strong>Success!</strong> Your changes were saved.");
        }
    }

    public function manageProducts()
    {
        $data = [
            'firstTime'=>$this->session->firstTime,
            'username'=>$this->session->username,
            'products'=>$this->product->getAllProducts()
        ];
        return view('pages/procurement/products',$data);
    }

    public function showNewProductForm(){
        $data = [
            'firstTime'=>$this->session->firstTime,
            'username'=>$this->session->username,
            'vendors'=>$this->vendor->getAllVendors()
        ];
        return view('pages/procurement/add-new-product', $data);
    }
    public function addNewProduct(){
        $inputs = $this->validate([
            'product_name' => ['rules'=> 'required', 'label'=>'Product Name','errors' => [
                'required' => 'Enter product name']],
            'cost_price' => ['rules'=> 'required', 'errors'=>['required'=>'Enter cost price']],
            'quantity' => ['rules'=> 'required', 'errors'=>['required'=>'Enter quantity']],
            'vendor' => ['rules'=>'required', 'errors'=>['Select vendor from the list of vendors']]
        ]);
        if (!$inputs) {
            return view('pages/procurement/add-new-product', [
                'validation' => $this->validator,
                'firstTime'=>$this->session->firstTime,
                'username'=>$this->session->username,
                'vendors'=>$this->vendor->getAllVendors()
            ]);
        }else{
            $data = [
                'product_name'=>$this->request->getPost('product_name'),
                'cost_price'=>$this->request->getPost('cost_price'),
                'selling_price'=>$this->request->getPost('selling_price'),
                'quantity'=>$this->request->getPost('quantity'),
                'vendor_id'=>$this->request->getPost('vendor'),
                'added_by'=>$this->session->user_employee_id,
                'in_stock'=>$this->request->getPost('quantity')
            ];

            $this->product->save($data);
            return redirect()->back()->with("success", "<strong>Success!</strong> New product added");
        }
    }

}
