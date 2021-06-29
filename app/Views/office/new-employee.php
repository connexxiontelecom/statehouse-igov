<?=
	$this->extend('layouts/admin')
?>




<?= $this->section('content') ?>


<div class="container-fluid">
	
	<!-- start page title -->
	<div class="row">
		<div class="col-12">
			
			<div class="page-title-box">
			
				<div class="page-title-right">
					
					<ol class="breadcrumb m-0">
						<li class="breadcrumb-item"><a href="<?= site_url('office') ?>">iGov</a></li>
						<li class="breadcrumb-item"><a href="javascript: void(0);">Employees</a></li>
						<li class="breadcrumb-item active">New Employee</li>
					</ol>
					
				</div>
				<h4 class="page-title">New Employee</h4>
			</div>
		</div>
	</div>
	<!-- end page title -->

	<div class="row" style="margin-top: -50px">
		<div class="col-xl-12">
			<div class="card">
				<div class="card-body">
					
				
					
					<form>
						<div id="progressbarwizard">
							
							<ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-3">
								<li class="nav-item">
									<a href="#personalInformation" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
										<i class="mdi mdi-account-circle mr-1"></i>
										<span class="d-none d-sm-inline">Personal Information</span>
									</a>
								</li>
								<li class="nav-item">
									<a href="#workInformation" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
										<i class="mdi mdi-face-profile mr-1"></i>
										<span class="d-none d-sm-inline">Work Information</span>
									</a>
								</li>
								<li class="nav-item">
									<a href="#contactInformation" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
										<i class="mdi mdi-checkbox-marked-circle-outline mr-1"></i>
										<span class="d-none d-sm-inline">Contact Information</span>
									</a>
								</li>
							</ul>
							
							<div class="tab-content b-0 mb-0 pt-0">
								
								<div id="bar" class="progress mb-3" style="height: 7px;">
									<div class="bar progress-bar progress-bar-striped progress-bar-animated bg-success"></div>
								</div>
								
								<div class="tab-pane" id="personalInformation">
									<div class="row">
										<div class="col-6">
											<div class="form-group row mb-3">
												<label class="col-md-3 col-form-label" for="firstName">First Name</label>
												<div class="col-md-9">
													<input type="text" class="form-control" id="firstName" name="employee_f_name" required>
												</div>
											</div>
											
											
											<div class="form-group row mb-3">
												<label class="col-md-3 col-form-label" for="otherName">Other Name</label>
												<div class="col-md-9">
													<input type="text" class="form-control" id="otherName" name="employee_o_name" >
												</div>
											</div>
											
											<div class="form-group row mb-3">
												<label class="col-md-3 col-form-label" for="dob">Date of Birth</label>
												<div class="col-md-9">
													<input type="date" class="form-control" id="dob" name="employee_dob" >
												</div>
											</div>
											
										
										
										</div> <!-- end col -->
										
										<div class="col-6">
											<div class="form-group row mb-3">
												<label class="col-md-3 col-form-label" for="lastName">Surname</label>
												<div class="col-md-9">
													<input type="text" class="form-control" id="lastName" name="employee_l_name" >
												</div>
											</div>
											
											
											<div class="form-group row mb-3">
												<label class="col-md-3 col-form-label" for="sex">Sex</label>
												<div class="col-md-9">
													<select class="form-control" id="sex">
														<option disabled selected></option>
														<option>Male</option>
														<option>Female</option>
													
													</select>
												</div>
											</div>
											
										
										
										</div> <!-- end col -->
									</div> <!-- end row -->
								</div>
								
								<div class="tab-pane" id="workInformation">
									<div class="row">
										<div class="col-12">
											<div class="form-group row mb-3">
												<label class="col-md-3 col-form-label" for="name1"> Department</label>
												<div class="col-md-9">
													<input type="text" id="name1" name="name1" class="form-control" value="Francis">
												</div>
											</div>
											<div class="form-group row mb-3">
												<label class="col-md-3 col-form-label" for="surname1"> Last name</label>
												<div class="col-md-9">
													<input type="text" id="surname1" name="surname1" class="form-control" value="Brinkman">
												</div>
											</div>
											
											<div class="form-group row mb-3">
												<label class="col-md-3 col-form-label" for="email1">Email</label>
												<div class="col-md-9">
													<input type="email" id="email1" name="email1" class="form-control" value="cory1979@hotmail.com">
												</div>
											</div>
										</div> <!-- end col -->
									</div> <!-- end row -->
								</div>
								
								<div class="tab-pane" id="contactInformation">
									<div class="row">
										<div class="col-12">
											<div class="text-center">
												<h2 class="mt-0"><i class="mdi mdi-check-all"></i></h2>
												<h3 class="mt-0">Thank you !</h3>
												
												<p class="w-75 mb-2 mx-auto">Quisque nec turpis at urna dictum luctus. Suspendisse convallis dignissim eros at volutpat. In egestas mattis dui. Aliquam
													mattis dictum aliquet.</p>
												
												<div class="mb-3">
													<div class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input" id="customCheck3">
														<label class="custom-control-label" for="customCheck3">I agree with the Terms and Conditions</label>
													</div>
												</div>
											</div>
										</div> <!-- end col -->
									</div> <!-- end row -->
								</div>
								
								<ul class="list-inline mb-0 wizard">
									<li class="previous list-inline-item">
										<a href="javascript: void(0);" class="btn btn-secondary">Previous</a>
									</li>
									<li class="next list-inline-item float-right">
										<a href="javascript: void(0);" class="btn btn-secondary">Next</a>
									</li>
								</ul>
							
							</div> <!-- tab-content -->
						</div> <!-- end #progressbarwizard-->
					</form>
				
				</div> <!-- end card-body -->
			</div> <!-- end card-->
		</div> <!-- end col -->
		
	
	</div>
	
	
	
	
	
	
	
	<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>
	<script src="/assetsa/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
	<script src="/assetsa/js/pages/form-wizard.init.js"></script>
	
<?= $this->endSection() ?>
