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
		<div class="col-xl-12">
			<div class="card">
				<div class="card-body">
					
					<div class="row mt-4">
						<div class="col">
							<span class="text-dark" data-toggle="collapse" href="#todayTasks"
							   aria-expanded="false" aria-controls="todayTasks">
								<h5 class="mb-0"> <?=$budget['budget_title'] ?> - <?=$budget['budget_year'] ?> <span class="text-muted font-14">(<?=count($budget_headers) ?>)</span></h5>
							</span>
							
							<div class="collapse show" id="todayTasks">
								<div class="card mb-0 shadow-none">
									<div class="card-body pb-0" id="task-list-one">
										<!-- task -->
										<?php if($budget_headers): $total = 0; foreach ($budget_headers as $budget_header): ?>
										<div class="row justify-content-sm-between task-item">
											<div class="col-lg-6 mb-2">
												<div class="custom-control custom-checkbox">
													<input type="checkbox"
														   class="custom-control-input"  checked readonly>
													<label class="custom-control-label"
														   for="task1">
														<?=$budget_header['bh_title'] ?>
													</label>
												</div> <!-- end checkbox -->
											</div> <!-- end col -->
											<div class="col-lg-6">
												<div class="d-sm-flex">
													
													<div class="mt-3 mt-sm-0">
														<ul class="list-inline font-13 text-sm-right">
														
															<li class="list-inline-item pr-1">
																<i class='mdi mdi-briefcase font-16 mr-1'></i>
																<?=$budget_header['dpt_name'] ?>
															</li>
															<li class="list-inline-item pr-2">
																<i class='mdi mdi-cash-multiple font-16 mr-1'></i>
																<?=number_format($budget_header['bh_amount'], 2) ?>
															</li>
															
														</ul>
													</div>
												</div> <!-- end .d-flex-->
											</div> <!-- end col -->
										</div>
										<?php $total+= $budget_header['bh_amount'];  endforeach; endif;?>
										<!-- end task -->
										<div class="row justify-content-sm-between task-item">
											<div class="col-lg-6 mb-2">
												<div class="custom-control custom-checkbox">
												
												</div> <!-- end checkbox -->
											</div> <!-- end col -->
											<div class="col-lg-6">
												<div class="d-sm-flex">
													
													<div class="mt-3 mt-sm-0">
														<ul class="list-inline font-13 text-sm-right">
															
															<li class="list-inline-item pr-1">
																
																Total
															</li>
															<li class="list-inline-item pr-2">
																<i class='mdi mdi-cash-multiple font-16 mr-1'></i>
																<?=number_format($total, 2) ?>
															</li>
														
														</ul>
													</div>
												</div> <!-- end .d-flex-->
											</div> <!-- end col -->
										</div>
										<!-- end task -->
									</div> <!-- end card-body-->
								</div> <!-- end card -->
							</div> <!-- end .collapse-->
							
						
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
