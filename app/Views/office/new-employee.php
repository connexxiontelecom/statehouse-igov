<?=
	$this->extend('layouts/admin')
?>


<?=$this->section('extra-styles'); ?>

<link href="/assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/dropify/css/dropify.min.css" rel="stylesheet" type="text/css" />

<?=$this->endSection() ?>

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
					
					<?php if(session()->has('action')): ?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<i class="mdi mdi-check-all mr-2"></i><strong>Action Successful !</strong>
						</div>
					<?php endif; ?>
					
					<?php if(session()->has('errors')):
						$errors = session()->get('errors');
						foreach ($errors as $error):
						?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<i class="mdi mdi-check-all mr-2"></i><strong><?php print_r($error); ?> !</strong>
						</div>
					<?php endforeach; endif; ?>
					
					<form id="new-employee-form" method="post" class="needs-validation" novalidate>
						<div id="newemployeewizard">
							
							<ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-3">
								<li class="nav-item">
									<a href="#personalInformation" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
										<i class="mdi mdi-account-circle mr-1"></i>
										<span class="d-none d-sm-inline">Personal Information</span>
									</a>
								</li>
								<li class="nav-item">
									<a href="#contactInformation" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
										<i class="mdi mdi-checkbox-marked-circle-outline mr-1"></i>
										<span class="d-none d-sm-inline">Contact Information</span>
									</a>
								</li>
								<li class="nav-item">
									<a href="#workInformation" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
										<i class="mdi mdi-face-profile mr-1"></i>
										<span class="d-none d-sm-inline">Work Information</span>
									</a>
								</li>
								
								<li class="nav-item">
									<a href="#accountInformation" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
										<i class="mdi mdi-face-profile mr-1"></i>
										<span class="d-none d-sm-inline">Account Information</span>
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
												<label class="col-md-3 col-form-label" for="lastName">Surname</label>
												<div class="col-md-9">
													<input type="text" class="form-control" id="lastName" name="employee_l_name" required>
													<div class="valid-feedback">
														Looks good!
													</div>
												</div>
											</div>
											
											
											<div class="form-group row mb-3">
												<label class="col-md-3 col-form-label" for="otherName">Other Name</label>
												<div class="col-md-9">
													<input type="text" class="form-control" id="otherName" name="employee_o_name" >
													<div class="valid-feedback">
														Looks good!
													</div>
												</div>
											</div>
											
											<div class="form-group row mb-3">
												<label class="col-md-3 col-form-label" for="dob">Date of Birth</label>
												<div class="col-md-9">
													<input type="date" class="form-control" id="dob" name="employee_dob" required>
													<div class="valid-feedback">
														Looks good!
													</div>
												</div>
											</div>
											
										
										
										</div> <!-- end col -->
										
										<div class="col-6">
											<div class="form-group row mb-3">
												<label class="col-md-3 col-form-label" for="firstName">First Name</label>
												<div class="col-md-9">
													<input type="text" class="form-control" id="firstName" name="employee_f_name" required>
													<div class="valid-feedback">
														Looks good!
													</div>
												</div>
											
											</div>
											
											
											
											<div class="form-group row mb-3">
												<label class="col-md-3 col-form-label" for="sex">Sex</label>
												<div class="col-md-9">
													<select class="form-control" name="employee_sex" id="sex" required>
														<option disabled selected></option>
														<option>Male</option>
														<option>Female</option>
													
													</select>
													<div class="valid-feedback">
														Looks good!
													</div>
												</div>
											</div>
											
										
										
										</div> <!-- end col -->
									</div> <!-- end row -->
								</div>
								
								<div class="tab-pane" id="contactInformation">
									<div class="row">
										<div class="col-12">
											
											<div class="form-group mb-3">
												
												<label class="col-form-label" for="address"> Address</label>
												<textarea class="col-md-12 form-control" id="address" rows="5" name="employee_address" required>
												
												</textarea>
												<div class="valid-feedback">
													Looks good!
												</div>
											</div>
										</div>
									
									
									
									</div> <!-- end col -->
									
									<div class="row">
										<div class="col-6">
											
											<div class="form-group row mb-3">
												<label class="col-md-3 col-form-label" for="phone"> Phone Number</label>
												<div class="col-md-9">
													<input type="text" id="phone" class="form-control" name="employee_phone" placeholder="000-0000-0000" data-toggle="input-mask" data-mask-format="000-0000-0000" required>
												</div>
												<div class="valid-feedback">
													Looks good!
												</div>
											</div>
										
										
										
										
										</div> <!-- end col -->
										<div class="col-6">
											
											<div class="form-group row mb-3">
												<label class="col-md-3 col-form-label" for="e-mail"> E-Mail</label>
												<div class="col-md-9">
													<input type="email" class="form-control" id="e-mail" name="employee_mail" required>
												</div>
												<div class="valid-feedback">
													Looks good!
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
													<select class="form-control" name="employee_department_id" id="department" onchange="get_positions()" required>
														<option disabled selected> </option>
														<?php foreach ($departments as $department): ?>
															<option value="<?=$department['dpt_id'] ?>"> <?=$department['dpt_name']; ?></option>
														<?php endforeach; ?>
													
													
													</select>
													<div class="valid-feedback">
														Looks good!
													</div>
												</div>
											</div>
											<div class="form-group row mb-3">
												<label class="col-md-3 col-form-label" for="level"> Grade Level</label>
												<div class="col-md-9">
													<select class="form-control" name="employee_level" id="level" required>
														<?php for($i = 1; $i <= 17; $i++): ?>
															<option value="<?='Level '.$i; ?>"> <?='Level '.$i; ?></option>
														<?php  endfor;?>
													
													</select>
													<div class="valid-feedback">
														Looks good!
													</div>
												</div>
											</div>
										
										
										</div> <!-- end col -->
										
										<div class="col-6">
											
											<div class="form-group row mb-3">
												<label class="col-md-3 col-form-label" for="surname1"> Position/Title</label>
												<div class="col-md-9">
													<select class="form-control" name="employee_position_id" id="position" required>
													
													
													
													</select>
													<div class="valid-feedback">
														Looks good!
													</div>
												</div>
											</div>
											
											<div class="form-group row mb-3">
												<label class="col-md-3 col-form-label" for="step"> Step</label>
												<div class="col-md-9">
													<input id="step" type="number" min="1" max="15" class="form-control" name="employee_step" required>
												</div>
												<div class="valid-feedback">
													Looks good!
												</div>
											</div>
										
										
										</div> <!-- end col -->
									</div> <!-- end row --><!-- end row -->
									
									<div class="row">
										
										
										<div class="col-lg-12">
											<div id="myId" class="dropzone">
												<div class="dz-message needsclick">
													<i class="hi text-muted dripicons-cloud-upload"></i>
													<h3>Drop all other relevant attachments here...</h3>
												</div>
											</div>
										</div>
									
									
									</div>
								</div>
								
								<div class="tab-pane" id="accountInformation">
									<div class="row">
										<div class="col-6">
											<div class="form-group row mb-3">
												<label class="col-md-3 col-form-label" for="username"> Username:</label>
												<div class="col-md-9">
													<input type="text" id="user_username" onkeyup="checkUsername()" class="form-control" name="user_username" placeholder="Unique Username" required>
													
													<div class="valid-feedback">
														Looks good!
													</div>
													<div class="alert alert-danger bg-danger text-white border-0" role="alert" style="margin-top: 10px" id="usernameError">
														<i class="mdi mdi-block-helper mr-2"></i>
														<strong>Error </strong> Username Already Exists/Less than 5 alphabets
													</div>
													
												</div>
												
											</div>
											
											<div class="form-group row mb-3">
												<label class="col-md-3 col-form-label" for="usertype"> User Type</label>
												<div class="col-md-9">
													<select class="form-control" name="user_type" id="user_type" onchange="togglePermission()"  required>
														<option value="2"> Employee </option>
														<option value="3"> Moderator </option>
													
													</select>
													<div class="valid-feedback">
														Looks good!
													</div>
												</div>
											</div>
											
										
										
										</div> <!-- end col -->
										
										<div class="col-6" id="permission">
											
											<h4 class="header-title mt-3 mt-md-0">Permissions</h4>
											<div class="checkbox checkbox-circle mb-2 form-check-inline">
												<input id="checkbox7" type="checkbox">
												<label for="checkbox7">
													Internal Circular
												</label>
											</div>
											
											<div class="checkbox checkbox-info checkbox-circle mb-2 form-check-inline">
												<input id="checkbox8" type="checkbox" checked>
												<label for="checkbox8">
													External Circular
												</label>
											</div>
											<div class="checkbox checkbox-primary checkbox-circle mb-2 form-check-inline">
												<input id="checkbox-9" type="checkbox">
												<label for="checkbox-9">
													Internal Memo
												</label>
											</div>
											<div class="checkbox checkbox-success checkbox-circle mb-2 form-check-inline">
												<input id="checkbox-10" type="checkbox" checked>
												<label for="checkbox-10">
													External Memo
												</label>
											</div>
											<div class="checkbox checkbox-warning checkbox-circle mb-2 form-check-inline">
												<input id="checkbox-11" type="checkbox">
												<label for="checkbox-11">
													Warning
												</label>
											</div>
											<div class="checkbox checkbox-danger checkbox-circle mb-2 form-check-inline">
												<input id="checkbox-12" type="checkbox" checked>
												<label for="checkbox-12">
													Danger
												</label>
											</div>
											
											<div class="checkbox checkbox-blue checkbox-circle mb-2 form-check-inline">
												<input id="checkbox-13" type="checkbox" checked>
												<label for="checkbox-13">
													Blue
												</label>
											</div>
											
											<div class="checkbox checkbox-pink checkbox-circle mb-2 form-check-inline">
												<input id="checkbox-14" type="checkbox">
												<label for="checkbox-14">
													Pink
												</label>
											</div>
											
											<div class="checkbox checkbox-dark checkbox-circle mb-2 form-check-inline">
												<input id="checkbox-15" type="checkbox">
												<label for="checkbox-15">
													Dark
												</label>
											</div>
									
										
										
										</div> <!-- end col -->
										
										
									</div> <!-- end row --><!-- end row -->
									
									
									
									
								</div>
								
								
								
								<ul class="list-inline mb-0 wizard">
									<li class="previous list-inline-item">
										<a href="javascript: void(0);" class="btn btn-secondary">Previous</a>
									</li>
									<li class="next list-inline-item float-right" id="next">
										<a href="javascript: void(0);" class="btn btn-secondary">Next</a>
									</li>
									<li class="next last list-inline-item float-right" id="last" style="display:none;">
										<button type="submit" class="btn btn-secondary"> Submit </button>
<!--										<a href="javascript: void(0);" class="btn btn-secondary">Submit</a>-->
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
	<script src="/assets/libs/dropzone/min/dropzone.min.js"></script>
	<script src="/assets/libs/dropify/js/dropify.min.js"></script>

	<script>
        $(document).ready(function() {
            $('#permission').hide()
            $("#usernameError").hide();

            $('#newemployeewizard').bootstrapWizard({
                onTabShow: function(tab, navigation, index) {
                    var $total = navigation.find('li').length;
                    var $current = index+1;
                    var $percent = ($current/$total) * 100;
                    $('#newemployeewizard .progress-bar').css({width:$percent+'%'});
                    if($current === $total){
                        $('#next').css({display: 'none'})
                        $('#last').css({display: 'block'})
                    } else{
                        $('#next').css({display: 'block'})
                        $('#last').css({display: 'none'})
                    }

                },

                // onLast: function(tab, navigation, index){
                // 	$('#new-employee-form').submit()
                // }
            });



            Dropzone.autoDiscover = false;
            let name = new Date().getTime();
            let myDropzone = this;
            $("div#myId").dropzone({
                renameFile: function(file) {
                    // console.log(name + '_' + file.name);
                    // return new Date().getTime() + '_' + file.upload.filename;
                    return name + '_' + file.name.replace(/\s/g, '');
                    //return name + '_' + file.name;
                    //return newName;
                },
                url: '<?=site_url('upload-post-attachments'); ?>',
                method: 'post',
                addRemoveLinks: 'true',
                dictRemoveFile: 'Remove',

                success: function(file, response) {

                    $('form').append('<input type="hidden" name="p_attachment[]" value="' + response + '">');

                    console.log(response);
                },

                error: function(file, response) {
                    console.log(response);
                },
                removedfile: function(file) {
                    file.previewElement.remove();
                    $('form').find('input[name="p_attachment[]"][value="' + name + '_' + file.name + '"]').remove()
                    let p_name = name + "_" + file.name;
                    $.ajax({
                        url: '<?=site_url('delete-post-attachments')?>',
                        type: 'GET',
                        data:  'files='+p_name,
                        dataType: 'json',
                        success: response => {
                            // console.log(response.message);
                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    });
                    //                    var name = '';
                    //                    if (typeof file.file_name !== 'undefined') {
                    //                        name = file.file_name
                    //                    } else {
                    //                        name = uploadedDocumentMap[file.name]
                    //                    }
                    // $('form').find('input[name="p_attachment[]"][value="' + name + '_' + file.name + '"]').remove()

                }
            });




        });
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
                    $("#position").append('<option selected disabled> </option>');
                    for (var i=0; i<response.length; i++) {
                        $("#position").append('<option value="' + response[i].pos_id + '">' + response[i].pos_name + '</option>');
                    }
                  }
            });

        }

        function checkUsername(){
            let username =  $("#user_username").val();
            $.ajax({
                url: '<?php echo site_url('check-username') ?>',
                type: 'post',
                data: {
                    'username': username,
                },
                dataType: 'json',
                success:function(response){
                   if(response.success && username.length > 5){
                       $("#usernameError").hide();
                       $('#last').css({display: 'block'})
				   } else{
                       $("#usernameError").show();
                       $('#last').css({display: 'none'})
				   }
                }
            });

        }
        
        function togglePermission(){
         
            let user_type = $("#user_type").val();
            if(user_type == 2){
                $('#permission').hide()
			}

            if(user_type == 3){
                $('#permission').show()
            }
            
		}
	
	</script>
	<script src="/assetsa/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>

	<script src="/assetsa/js/pages/form-wizard.init.js"></script>
	
<?= $this->endSection() ?>
