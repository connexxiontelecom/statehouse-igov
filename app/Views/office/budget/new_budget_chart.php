<?= $this->extend('layouts/admin') ?>
<?= $this->section('extra-styles') ?>
	<link href="/assetsa/libs/quill/quill.core.css" rel="stylesheet" type="text/css" />
	<link href="/assetsa/libs/quill/quill.bubble.css" rel="stylesheet" type="text/css" />
<?= $this->endSection() ?>
<?= $this->section('content') ?>
	<div class="container-fluid">
		<!-- start page title -->
		<div class="row">
			<div class="col-12">
				<div class="page-title-box">
					<div class="page-title-right">
						<ol class="breadcrumb m-0">
							<li class="breadcrumb-item"><a href="<?= site_url('office') ?>">iGov</a></li>
							<li class="breadcrumb-item"><a href="<?=site_url('budget-setups') ?>">Budgets</a></li>
							<li class="breadcrumb-item active">Budget Setup</li>
						</ol>
					</div>
					<h4 class="page-title"> <?=$budget['budget_title'] ?> - <?=$budget['budget_year'] ?></h4>
				</div>
			</div>
		</div>
		<!-- end page title -->
		<div class="row" style="margin-top: -50px">
			<div class="col-xl-6">
				<div class="card">
					<div class="card-body">
						<h4 style="float: right" class="header-title">New Budget Chart</h4>
						<div class="row mt-4">
							<div class="col">
			
							
<!--								<p class="sub-header">-->
<!--									-->
<!--								</p>-->
								
								<form>
									
									<div class="form-group mb-3">
										<label for="account-type">Account Type</label>
										<select class="form-control" name="bh_acc_type" id="account-type">
											<option value="0">General</option>
											<option value="1">Detail</option>
										
										</select>
									
										
									<div class="form-group mb-3">
										<label for="category">Category: </label>
										<select class="form-control" name="bh_cat" id="category">
											<option value="0" selected >Choose Category</option>
											<?php foreach ($categories as $category): ?>
												<option value="<?=$category['bc_id'] ?>"> <?=$category['bc_name']; ?> </option>
											<?php endforeach; ?>
										
										</select>
									</div>
									
									<div class="form-group mb-3">
										<label for="account-type">Parent</label>
										<select class="form-control" name="bh_acc_type" id="account-type">
											<option value="0">None</option>
											<?php foreach ($parents as $parent): ?>
											<option value="<?=$parent['bh_code'] ?>"> <?=$parent['bh_title']; ?> </option>
											<?php endforeach; ?>
										</select>
									</div>
							
									
									<div class="form-group mb-3">
										<label for="example-input-normal">Account Code</label>
										<input type="text" id="example-input-normal" name="bh_code" class="form-control" placeholder="Normal">
									</div>
									
									<div class="form-group mb-3">
										<label for="example-input-normal">Narration: </label>
										<input type="text" id="example-input-normal" name="bh_title" class="form-control" placeholder="Normal">
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
										<select class="form-control" name="bh_project" id="project">
											<option value="0" selected >Choose Project Status</option>
											<option value="1">New </option>
											<option value="2">Ongoing</option>
										
										</select>
									</div>
									
								
								</form>
							</div> <!-- end col -->
						</div> <!-- end row -->
					
					
					</div> <!-- end card-body -->
				</div> <!-- end card-->
			</div> <!-- end col -->
		</div>
	</div>
	<!-- Long Content Scroll Modal -->

<?= $this->endSection() ?>
<?= $this->section('extra-scripts') ?>
	<!-- Vendor js -->
	<script src="/assetsa/js/vendor.min.js"></script>
	
	<!-- Dragula js -->
	<script src="/assetsa/libs/dragula/dragula.min.js"></script>
	<!-- Dragula init js-->
	<script src="/assetsa/js/pages/dragula.init.js"></script>
	
	<!-- Plugins js -->
	<script src="/assetsa/libs/quill/quill.min.js"></script>
	
	<!-- Init js-->
	<script src="/assetsa/js/pages/task.init.js"></script>


<?= $this->endSection() ?>
<?php
