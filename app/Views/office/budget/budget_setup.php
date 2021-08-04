<?= $this->extend('layouts/admin') ?>
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
				<h4 class="page-title">Budget Setup</h4>
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
					
					
					<div class="row">
						<div class="col-xl-6">
							
							<div class="row">
								<div class="col-lg-6">
									<!-- Date View -->
									<div class="form-group">
										<label>Budget Title</label>
										<input type="text" class="form-control"  placeholder="Budget Title" required>
									</div>
								</div>
								
								<div class="col-lg-6">
									<!-- Date View -->
									<div class="form-group">
										<label>Year</label>
										<input type="text" class="form-control" value="<?=date('Y') ?>" placeholder="<?=date('Y') ?>" required>
									</div>
								</div>
							</div>
							
						
						</div> <!-- end col-->
						
					
					</div>
					<!-- end row -->
					
					
					<div class="row mt-3">
						<div class="col-12 text-center">
							<button type="button" class="btn btn-success waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> Create</button>
							<button type="button" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> Cancel</button>
						</div>
					</div>
					
					
					
					
					
				
				</div> <!-- end card-body -->
			</div> <!-- end card-->
		</div> <!-- end col -->
	</div>
</div>
<!-- Long Content Scroll Modal -->

<?= $this->endSection() ?>


