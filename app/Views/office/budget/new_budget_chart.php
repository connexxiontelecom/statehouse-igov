<?= $this->extend('layouts/admin') ?>
<?= $this->section('extra-styles') ?>
	<link href="/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

<?= $this->endSection() ?>
<?= $this->section('content') ?>
	<div class="container-fluid">
		<!-- start page title -->
<?php if(!empty($budget)): ?>
		<div class="row">
			<div class="col-12">
				<div class="page-title-box">
					<div class="page-title-right">
						<ol class="breadcrumb m-0">
							<li class="breadcrumb-item"><a href="<?= site_url('office') ?>">iGov</a></li>
							<li class="breadcrumb-item"><a href="<?=site_url('budget-charts') ?>">Budget Chart</a></li>
							<li class="breadcrumb-item active">Budget Setup</li>
						</ol>
					</div>
					<h4 class="page-title"> <?=$budget['budget_title'] ?> - <?=$budget['budget_year'] ?></h4>
				</div>
			</div>
		</div>
		<!-- end page title -->
		<div class="row" style="margin-top: -50px">
			<div class="col-sm-6">
				<div class="card">
					<div class="card-body">
						<h4 style="float: right" class="header-title">New Budget Header</h4>
						<div class="row mt-4">
							<div class="col">
								
								<?php if(session()->has('action')): ?>
									<div class="alert alert-success alert-dismissible fade show" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										<i class="mdi mdi-check-all mr-2"></i><strong>Action Successful !</strong>
									</div>
								<?php endif; ?>
								
								<?php if(session()->has('error')): ?>
									<div class="alert alert-danger alert-dismissible fade show" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										<i class="mdi mdi-check-all mr-2"></i><strong>An Error Occurred</strong>
									</div>
								<?php endif; ?>
								
								<form method="post">
									
									<div class="form-group mb-3">
										<label for="account-type">Account Type</label>
										<select class="form-control" name="bh_acc_type" id="account-type">
											<option value="0">General</option>
											<option value="1">Detail</option>
										
										</select>
									</div>
									
										
									<div class="form-group mb-3">
										<label for="category">Category: </label>
										<select class="form-control" name="bh_cat" onchange="get_parents()" id="category">
											<option value="0" selected >Choose Category</option>
											<?php foreach ($categories as $category): ?>
												<option value="<?=$category['bc_id'] ?>"> <?=$category['bc_name']; ?> </option>
											<?php endforeach; ?>
										
										</select>
									</div>
									
									<div class="form-group mb-3">
										<label for="account-type">Parent</label>
										<select class="form-control" name="bh_parent" id="parent">
											<option value="0">None</option>
											
										</select>
									</div>
							
									
									<div class="form-group mb-3">
										<label for="example-input-normal">Code</label>
										<input type="text" id="example-input-normal" name="bh_code" class="form-control" placeholder="Code" required>
									</div>
									
									<div class="form-group mb-3">
										<label for="example-input-normal">Narration: </label>
										<input type="text" id="example-input-normal" name="bh_title" class="form-control" placeholder="Narration" required>
									</div>
									
									
									
									<div class="form-group mb-3">
										<label for="example-input-normal">Project: </label>
										<select class="form-control" name="bh_project" id="project">
											<option value="0">No</option>
											<option value="1">Yes</option>
										
										</select>
									</div>
									
									<div class="form-group mb-3">
										<label for="project">Project Status: </label>
										<select class="form-control" name="bh_project_status" id="project">
											<option value="0" selected >Choose Project Status</option>
											<option value="1">New </option>
											<option value="2">Ongoing</option>
										
										</select>
									</div>
									
									<div class="form-group mb-3">
										<label for="category">Office: </label>
										<select class="form-control select2-multiple" id="positions" name="bh_office[]" data-toggle="select2" multiple="multiple" required style="min-height: 38px">
											<?php foreach ($department_employees as $department => $employees): ?>
												<?php if(!empty($employees)):?>
													<optgroup label="<?=$department?>">
														<?php foreach ($employees as $employee):?>
															<option value="<?=$employee['employee_id']?>">
																<?=$employee['position']['pos_name'].' ('.$employee['user']['user_name'].')'?>
															</option>
														<?php endforeach;?>
													</optgroup>
												<?php endif;?>
											<?php endforeach; ?>
										</select>
									</div>
									
									<input type="hidden" name="bh_budget_id" value="<?=$budget['budget_id'] ?>">
									<div class="form-group mb-3">
										<button type="submit" class="ladda-button ladda-button-demo btn btn-primary btn-block" dir="ltr" data-style="zoom-in"">Submit</button>
									
									</div>
									
								
								</form>
							</div> <!-- end col -->
						</div> <!-- end row -->
					
					
					</div> <!-- end card-body -->
				</div> <!-- end card-->
			</div> <!-- end col -->
		</div>
<?php else: ?>
	<div class="row">
		<div class="col-12">
			<div class="page-title-box">
				<div class="page-title-right">
					<ol class="breadcrumb m-0">
						<li class="breadcrumb-item"><a href="<?= site_url('office') ?>">iGov</a></li>
						<li class="breadcrumb-item"><a href="<?=site_url('budget-charts') ?>">Budget Chart</a></li>
						<li class="breadcrumb-item active">Budget Setup</li>
					</ol>
				</div>
				<h4 class="page-title"> No Active Budget</h4>
			</div>
		</div>
	</div>
	<!-- end page title -->
	<div class="row" style="margin-top: -50px">
		<div class="col-md-12 col-lg-12 col-xl-12">
			<div class="card bg-pattern">
				
				<div class="card-body p-4">
					
					<div class="auth-logo">
						<a href="/" class="logo logo-dark text-center">
                                        <span class="logo-lg">
                                            <img src="../assets/images/logo-sm.png" alt="" height="22">
                                        </span>
						</a>
						
						<a href="/" class="logo logo-light text-center">
                                        <span class="logo-lg">
                                            <img src="../assets/images/logo-sm.png" alt="" height="22">
                                        </span>
						</a>
					</div>
					
					<div class="text-center mt-4">
						<h1 class="text-error">Oops</h1>
						<h3 class="mt-3 mb-2">No Active Budget yet</h3>
					
					</div>
				
				</div> <!-- end card-body -->
			</div>
			<!-- end card -->
		
		</div> <!-- end col -->
	</div>
	
	<?php endif; ?>
	
	</div>
	<!-- Long Content Scroll Modal -->

<?= $this->endSection() ?>
<?= $this->section('extra-scripts') ?>
	<script src="/assets/libs/select2/js/select2.min.js"></script>
	<script>
        function get_parents(){
            let cat =  $("#category").val();
            let b_id = <?=@$budget['budget_id'] ?>;
            $.ajax({
                url: '<?php echo site_url('fetch-parent') ?>',
                type: 'post',
                data: { cat, b_id },
                dataType: 'json',
                success:function(response){
                    $("#parent").empty();
                    $("#parent").append('<option value="0">  None </option>');
                    for (let i=0; i<response.length; i++) {
                        $("#parent").append('<option value="' + response[i].bh_code + '">' + response[i].bh_title + ' - '+ response[i].bh_code + '</option>');
                    }
                    
                }
            });

        }
		
		</script>



<?= $this->endSection() ?>
<?php
