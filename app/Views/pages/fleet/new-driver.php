<?= $this->extend('layouts/master'); ?>
<?=$this->section('extra-styles'); ?>
	<link href="/assets/libs/dropify/css/dropify.min.css" rel="stylesheet" type="text/css" />
	<link href="/assets/libs/ladda/ladda-themeless.min.css" rel="stylesheet" type="text/css" />
<?=$this->endSection() ?>
<?= $this->section('content'); ?>
	<div class="container-fluid">
		<!-- start page title -->
		<div class="row">
			<div class="col-12">
				<div class="page-title-box">
					<div class="page-title-right">
						<ol class="breadcrumb m-0">
							<li class="breadcrumb-item"><a href="<?= site_url('/') ?>">iGov</a></li>
							<li class="breadcrumb-item"><a href="javascript:void(0)">Manage Fleet</a></li>
							<li class="breadcrumb-item"><a href="<?=site_url('drivers')?>">Drivers</a></li>
							<li class="breadcrumb-item active">New Driver</li>
						</ol>
					</div>
					<h4 class="page-title">New Driver</h4>
				</div>
			</div>
		</div>
		<!-- end page title -->
		<div class="row">
			<div class="col-12">
				<div class="card-box">
					<div class="row">
						<div class="col-lg-1"></div>
						<div class="col-lg-11">
							<div class="text-lg-right mt-3 mt-lg-0">
								<a href="<?=site_url('drivers')?>" type="button" class="btn btn-success waves-effect waves-light">Go Back</a>
							</div>
						</div><!-- end col-->
					</div> <!-- end row -->
				</div> <!-- end card-box -->
			</div><!-- end col-->
		</div>
		<form class="needs-validation" id="new-driver-form" novalidate>
			<div class="row">
				<div class="col-lg-7">
					<div class="card-box">
						<h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Details Details</h5>
            <div class="form-group">
              <label for="fd-user-id">Employee</label><span style="color: red"> *</span>
              <select class="form-control" data-toggle="select2" id="fd-user-id" name="fd_user_id" required>
                <option value="" selected disabled>Select</option>
								<?php foreach ($employees as $employee): ?>
                  <option value="<?=$employee['employee_id']?>">
										<?=$employee['employee_f_name'].' '.$employee['employee_l_name']?>
                  </option>
								<?php endforeach; ?>
              </select>
              <div class="invalid-feedback">
                Please select an employee.
              </div>
            </div>
            <div class="form-group">
              <label for="fd-moi">Means of Identification (MOI)</label><span style="color: red"> *</span>
              <select class="form-control" data-toggle="select2" id="fd-moi" name="fd_moi" required>
                <option value="" selected disabled>Select</option>
                <option value="1">Driver's License</option>
                <option value="2">International Passport</option>
                <option value="3">National ID Card</option>
                <option value="4">Others</option>
              </select>
              <div class="invalid-feedback">
                Please select a means of identification.
              </div>
            </div>
            <div class="form-group">
              <label for="fd-moi-expiry">MOI Expiry Date</label><span style="color: red"> *</span>
              <input type="date" class="form-control" id="fd-moi-expiry" name="fd_moi_expiry" required>
              <div class="invalid-feedback">
                Please select an expiry date.
              </div>
            </div>
            <div class="form-group">
              <label for="file">MOI Attachment</label><span style="color: red"> *</span>
              <div class="form-control-wrap">
                <input id="file" type="file" data-plugins="dropify" name="file" required/>
              </div>
              <div class="invalid-feedback">
                Please upload an moi attachment.
              </div>
            </div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12 text-center">
					<button class="btn btn-success waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> Register</button>
					<a href="<?=site_url('drivers')?>" type="button" class="btn btn-danger waves-effect waves-light m-1"><i class="fe-x mr-1"></i> Cancel</a>
				</div>
			</div>
		</form>
	</div>
<?= $this->endSection(); ?>
<?= $this->section('extra-scripts'); ?>
	<script src="/assets/libs/dropzone/min/dropzone.min.js"></script>
	<script src="/assets/libs/dropify/js/dropify.min.js"></script>
	<!-- Loading buttons js -->
	<script src="/assets/libs/ladda/spin.min.js"></script>
	<script src="/assets/libs/ladda/ladda.min.js"></script>

	<!-- Buttons init js-->
	<!-- Init js-->
	<script src="/assets/js/pages/loading-btn.init.js"></script>
	<script src="/assets/js/pages/form-fileuploads.init.js"></script>
<?=view('pages/fleet/_fleet-scripts.php')?>
<?= $this->endSection(); ?>