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
							<a href="<?=site_url('new-budget-chart') ?>" class="btn btn-success waves-effect waves-light">New Chart</a>
							
							
							<?php if(!empty($bhs)): ?>
								
								
								<table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
									<thead>
									<tr>
										<th>S/N</th>
										<th>Code</th>
										<th>Item</th>
										<th> Project Status</th>
										<th> Responsible Office</th>
										<th>Amount</th>
									</tr>
									</thead>
									<tbody>
									<?php
										$i = 1;
										foreach ($bhs as $bh):
											?>
											<tr>
												<td><?=$i++;?></td>
												<td><?=$bh['bh_code']?></td>
												<td><?=$bh['bh_title']?></td>
												<td> <?=$bh['bh_project_status'] ?></td>
												<td> <?=$bh['bh_office'] ?></td>
												<td> <?=number_format($bh['bh_amount']) ?></td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							
							
							<?php else: ?>
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
												<h3 class="mt-3 mb-2">No Budget Chart Setup</h3>
												
												<a href="<?=site_url('new-budget-chart') ?>" class="btn btn-success waves-effect waves-light">New Chart</a>
											</div>
										
										</div> <!-- end card-body -->
									</div>
									<!-- end card -->
								
								</div> <!-- end col -->
							
							<?php endif; ?>
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
