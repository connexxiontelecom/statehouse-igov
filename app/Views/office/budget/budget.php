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
						<li class="breadcrumb-item"><a href="javascript: void(0);">General Settings</a></li>
						<li class="breadcrumb-item active">Budgets</li>
					</ol>
				</div>
				<h4 class="page-title">Budgets</h4>
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
					<div>
						<a href="<?=site_url('budget-setup') ?>" class="btn btn-primary"  style="float: right"> <i class="mdi mdi-plus mr-2"></i>New budget</a>
					</div>
					<table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
						<thead>
						<tr>
							<th>S/N</th>
							<th>Budget Title</th>
							<th>Year</th>
							
							<th>Actions</th>
						</tr>
						</thead>
						<tbody>
						<?php if ($budgets):
							$i = 1;
							foreach ($budgets as $budget):
								?>
								<tr>
									<td><?=$i++;?></td>
									<td><?=$budget['budget_title']?></td>
									<td><?=$budget['budget_year']?></td>
									
									<td>
										<a  href="<?=site_url('view-budget-setup/'.$budget['budget_id']) ?>" class="btn btn-primary" > <i class="mdi mdi-pen-lock mr-2"></i></a>
									</td>
								</tr>
							<?php endforeach; endif;?>
						</tbody>
					</table>
				</div> <!-- end card-body -->
			</div> <!-- end card-->
		</div> <!-- end col -->
	</div>
</div>
<!-- Long Content Scroll Modal -->

<?= $this->endSection() ?>

