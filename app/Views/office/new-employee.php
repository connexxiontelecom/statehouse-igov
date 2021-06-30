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
										<div class="col-6">
											<div class="form-group row mb-3">
												<label class="col-md-3 col-form-label" for="department"> Department</label>
												<div class="col-md-9">
													<select class="form-control" name="employee_department_id" id="department" onchange="get_positions()">
														<option disabled selected> --Select Department --</option>
														<?php foreach ($departments as $department): ?>
															<option value="<?=$department['dpt_id'] ?>"> <?=$department['dpt_name']; ?></option>
														<?php endforeach; ?>
													
													
													</select>
												</div>
											</div>
											<div class="form-group row mb-3">
												<label class="col-md-3 col-form-label" for="level"> Level</label>
												<div class="col-md-9">
													<select class="form-control" name="employee_level" id="level">
														<?php for($i = 1; $i <= 16; $i++): ?>
															<option value="<?='Level '.$i; ?>"> <?='Level '.$i; ?></option>
														<?php  endfor;?>
													
													</select>
												</div>
											</div>
										
										
										</div> <!-- end col -->
										
										<div class="col-6">
											
											<div class="form-group row mb-3">
												<label class="col-md-3 col-form-label" for="surname1"> Position/Title</label>
												<div class="col-md-9">
													<select class="form-control" name="employee_postion_id" id="position">
													
													
													
													</select>
												</div>
											</div>
											
											<div class="form-group row mb-3">
												<label class="col-md-3 col-form-label" for="step"> Step</label>
												<div class="col-md-9">
													<input id="step" type="number" min="1" class="form-control" name="employee_step">
												</div>
											</div>
										
										
										</div> <!-- end col -->
									</div> <!-- end row --><!-- end row -->
								</div>
								
								<div class="tab-pane" id="contactInformation">
									<div class="row">
										<div class="col-12">
										
											<div class="form-group mb-3">
												
												<label class="col-form-label" for="address"> Address</label>
												<textarea class="col-md-12 form-control" id="address" rows="5" name="employee_address">
												
												</textarea>
													</div>
											</div>
									
										
										
										</div> <!-- end col -->
									</div>
										<div class="row">
										<div class="col-6">
											
											<div class="form-group row mb-3">
												<label class="col-md-3 col-form-label" for="phone"> Phone Number</label>
												<div class="col-md-9">
													<input type="text" id="phone" class="form-control" name="employee_phone" placeholder="000-0000-0000" data-toggle="input-mask" data-mask-format="000-0000-0000" required>
												</div>
											</div>
											
										
										
										
										</div> <!-- end col -->
											<div class="col-6">
												
												<div class="form-group row mb-3">
													<label class="col-md-3 col-form-label" for="e-mail"> E-Mail</label>
													<div class="col-md-9">
														<input type="email" class="form-control" id="e-mail" name="employee_mail" required>
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
	<script>
        function get_positions(){
            let department_id =  $("#department").val();
           $.ajax({
                url: '<?php echo site_url('fetch-positions') ?>',
                type: 'post',
                data: {
                    'dpt_id': department_id,
                },
                dataType: 'json',
                success:function(response){
                    $("#position").empty();
                    $("#position").append('<option> -- Select Position --</option>');
                    for (var i=0; i<response.length; i++) {
                        $("#position").append('<option value="' + response[i].pos_id + '">' + response[i].pos_name + '</option>');
                    }
                  }
            });

        }
	
	</script>
	<script src="/assetsa/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
	<script src="/assetsa/js/pages/form-wizard.init.js"></script>
	
<?= $this->endSection() ?>
