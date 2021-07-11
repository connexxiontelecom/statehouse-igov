<?=
	$this->extend('layouts/admin')
?>


<?=$this->section('extra-styles'); ?>
<link href="/assetsa/libs/dropify/css/dropify.min.css" rel="stylesheet" type="text/css" />
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
						<li class="breadcrumb-item"><a href="javascript: void(0);">General Settings</a></li>
						<li class="breadcrumb-item active">Organizational Profile</li>
					</ol>
				</div>
				<h4 class="page-title">Organizational Profile</h4>
			</div>
		</div>
	</div>
	<!-- end page title -->

	
	<div class="row">
			<div class="col-xl-6">
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
					<?php if(empty($organization)): ?>
					
					<form method="post" action="" enctype="multipart/form-data">
						<div class="row g-3 align-center">
							<div class="col-lg-5">
								<div class="form-group">
									<label class="form-label" for="site-name">Organization's Name</label>
									<span class="form-note">Enter Your Organization Name</span>
								</div>
							</div>
							<div class="col-lg-7">
								<div class="form-group">
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="org_name" required>
									</div>
								</div>
							</div>
						</div>
						<div class="row g-3 align-center">
							<div class="col-lg-5">
								<div class="form-group">
									<label class="form-label">Organization's Address</label>
									<span class="form-note">Enter Your Organization's Address</span>
								</div>
							</div>
							<div class="col-lg-7">
								<div class="form-group">
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="org_address" required>
									</div>
								</div>
							</div>
						</div>
						<div class="row g-3 align-center">
							<div class="col-lg-5">
								<div class="form-group">
									<label class="form-label">Contact Phone Number</label>
									<span class="form-note">Enter Contact Phone Number</span>
								</div>
							</div>
							<div class="col-lg-7">
								<div class="form-group">
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="org_c_phone" required>
									</div>
								</div>
							</div>
						</div>
						
						
						<div class="row g-3 align-center">
							<div class="col-lg-5">
								<div class="form-group">
									<label class="form-label">Contact E-Mail</label>
									<span class="form-note">Enter Contact E-Mail Address</span>
								</div>
							</div>
							<div class="col-lg-7">
								<div class="form-group">
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="org_c_email" required>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row g-3 align-center">
							<div class="col-lg-5">
								<div class="form-group">
									<label class="form-label">Organization's Website</label>
									<span class="form-note">Enter Organization's Website</span>
								</div>
							</div>
							<div class="col-lg-7">
								<div class="form-group">
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="org_web" required>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row g-3 align-center">
							<div class="col-lg-5">
								<div class="form-group">
									<label class="form-label">Organization's Logo</label>
									<span class="form-note">Upload Organization's Logo</span>
								</div>
							</div>
							<div class="col-lg-7">
								<div class="form-group">
									<div class="form-control-wrap">
										<input type="file" data-plugins="dropify" name="file" data-default-file="../assets/images/small/img-2.jpg"  />
									</div>
								</div>
							</div>
						</div>
						
						
					
						<div class="row g-3">
							<div class="col-lg-7 offset-lg-5">
								<div class="form-group mt-2">
									<button type="submit" class="ladda-button ladda-button-demo btn btn-primary btn-block" dir="ltr" data-style="zoom-in"">Submit</button>
								</div>
							</div>
						</div>
					</form>
				
					<?php else: ?>
						
						<form method="post" action="" enctype="multipart/form-data">
							<div class="row g-3 align-center">
								<div class="col-lg-5">
									<div class="form-group">
										<label class="form-label" for="site-name">Organization's Name</label>
										<span class="form-note">Enter Your Organization Name</span>
									</div>
								</div>
								<div class="col-lg-7">
									<div class="form-group">
										<div class="form-control-wrap">
											<input type="text" class="form-control" name="org_name" value="<?=$organization['org_name'] ?>" required>
										</div>
									</div>
								</div>
							</div>
							<div class="row g-3 align-center">
								<div class="col-lg-5">
									<div class="form-group">
										<label class="form-label">Organization's Address</label>
										<span class="form-note">Enter Your Organization's Address</span>
									</div>
								</div>
								<div class="col-lg-7">
									<div class="form-group">
										<div class="form-control-wrap">
											<input type="text" class="form-control" name="org_address" value="<?=$organization['org_address'] ?>" required>
										</div>
									</div>
								</div>
							</div>
							<div class="row g-3 align-center">
								<div class="col-lg-5">
									<div class="form-group">
										<label class="form-label">Contact Phone Number</label>
										<span class="form-note">Enter Contact Phone Number</span>
									</div>
								</div>
								<div class="col-lg-7">
									<div class="form-group">
										<div class="form-control-wrap">
											<input type="text" class="form-control" name="org_c_phone" value="<?=$organization['org_c_phone'] ?>" required>
										</div>
									</div>
								</div>
							</div>
							
							
							<div class="row g-3 align-center">
								<div class="col-lg-5">
									<div class="form-group">
										<label class="form-label">Contact E-Mail</label>
										<span class="form-note">Enter Contact E-Mail Address</span>
									</div>
								</div>
								<div class="col-lg-7">
									<div class="form-group">
										<div class="form-control-wrap">
											<input type="text" class="form-control" name="org_c_email" value="<?=$organization['org_c_email']; ?>" required>
										</div>
									</div>
								</div>
							</div>
							
							<div class="row g-3 align-center">
								<div class="col-lg-5">
									<div class="form-group">
										<label class="form-label">Organization's Website</label>
										<span class="form-note">Enter Organization's Website</span>
									</div>
								</div>
								<div class="col-lg-7">
									<div class="form-group">
										<div class="form-control-wrap">
											<input type="text" class="form-control" name="org_web" value="<?=$organization['org_web'] ?>" required>
										</div>
									</div>
								</div>
							</div>
							
							<div class="row g-3 align-center">
								<div class="col-lg-5">
									<div class="form-group">
										<label class="form-label">Organization's Logo</label>
										<span class="form-note">Upload Organization's Logo</span>
									</div>
								</div>
								<div class="col-lg-7">
									<div class="form-group">
										<div class="form-control-wrap">
											<input type="file" data-plugins="dropify" name="file" data-default-file="/uploads/organization/<?=$organization['org_logo'] ?>"  />
										</div>
									</div>
								</div>
							</div>
							
							<input type="hidden" name="org_id" value="<?=$organization['org_id'] ?>">
							
							<div class="row g-3">
								<div class="col-lg-7 offset-lg-5">
									<div class="form-group mt-2">
										<button type="submit" class="ladda-button ladda-button-demo btn btn-primary btn-block" dir="ltr" data-style="zoom-in"">Update</button>
									</div>
								</div>
							</div>
						</form>
					
					<?php endif; ?>
				</div> <!-- end card-body -->
			</div> <!-- end card-->
		</div> <!-- end col -->
	
	</div>
	<!-- end row -->
	


</div> <!-- container -->


<?= $this->endSection() ?>

<?=$this->section('extra-scripts'); ?>
<script src="/assetsa/libs/dropzone/min/dropzone.min.js"></script>
<script src="/assetsa/libs/dropify/js/dropify.min.js"></script>

<!-- Init js-->
<script src="/assetsa/js/pages/form-fileuploads.init.js"></script>
<?= $this->endSection() ?>
