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
						<li class="breadcrumb-item active">Budget Profiles</li>
					</ol>
				</div>
				<h4 class="page-title">Budget Profiles</h4>
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
						<button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#new-bp" style="float: right"> <i class="mdi mdi-plus mr-2"></i>New Budget Profile</button>
					</div>
					<table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
						<thead>
						<tr>
							<th>S/N</th>
							<th>Budget Title</th>
							<th>Year</th>
							<th> Status</th>
							
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
									<td> <?php if($budget['budget_status'] == 1): echo 'Active'; endif; if($budget['budget_status'] == 0): echo 'InActive'; endif; ?></td>
									<td><button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit-bp<?=$budget['budget_id'] ?>" > <i class="mdi mdi-pen-lock mr-2"></i></button>
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


<!-- Long Content Scroll Modal -->
<div class="modal fade" id="new-bp" tabindex="-1" role="dialog"
	 aria-labelledby="scrollableModalTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="scrollableModalTitle">New Budget Profile</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="">
					<div class="row g-3 align-center">
						<div class="col-lg-12">
							<div class="form-group">
								<label class="form-label" for="site-name">Budget Profile</label>
								<span class="form-note">Enter Profile Name</span>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="form-control-wrap">
									<input type="text" class="form-control" name="budget_title" required>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row g-3 align-center">
						<div class="col-lg-12">
							<div class="form-group">
								<label class="form-label" for="site-name">Budget Year</label>
								<span class="form-note">Enter Budget Year</span>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="form-control-wrap">
									<input type="text" class="form-control" name="budget_year" value="<?=date('Y') ?>" placeholder="<?=date('Y') ?>" required>
								
								</div>
							</div>
						</div>
					</div>
					
					
					
					<div class="row g-3 align-center">
						<div class="col-lg-12">
							<div class="form-group">
								<label class="form-label" for="budget_status">Budget Status</label>
								<span class="form-note">Select Budget Status</span>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="form-control-wrap">
									<select class="form-control" name="budget_status" id="budget_status"  required>
										<option selected disabled value="">Choose...</option>
										<option value="1">Active</option>
										<option value="0">InActive</option>
										
									
									</select>
								</div>
							</div>
						</div>
					</div>
					
					
					<div class="row g-3">
						<div class="col-lg-12 offset-lg-12">
							<div class="form-group mt-2">
								<button type="submit" class="ladda-button ladda-button-demo btn btn-primary btn-block" dir="ltr" data-style="zoom-in"">Submit</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Long Content Scroll Modal -->
<?php foreach ($budgets as $budget): ?>
	<div class="modal fade" id="edit-bp<?=$budget['budget_id'] ?>" tabindex="-1" role="dialog"
		 aria-labelledby="scrollableModalTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="scrollableModalTitle">Update Budget Category</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="post" action="">
						<div class="row g-3 align-center">
							<div class="col-lg-12">
								<div class="form-group">
									<label class="form-label" for="site-name">Budget Profile</label>
									<span class="form-note">Enter Profile Name</span>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<div class="form-control-wrap">
										<input type="text" class="form-control" value="<?=$budget['budget_title'] ?>" name="budget_title" required>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row g-3 align-center">
							<div class="col-lg-12">
								<div class="form-group">
									<label class="form-label" for="site-name">Budget Year</label>
									<span class="form-note">Enter Budget Year</span>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<div class="form-control-wrap">
										<input type="text" class="form-control" name="budget_year" value="<?=$budget['budget_year'] ?>" placeholder="<?=date('Y') ?>" required>
									
									</div>
								</div>
							</div>
						</div>
						
						
						
						<div class="row g-3 align-center">
							<div class="col-lg-12">
								<div class="form-group">
									<label class="form-label" for="budget_status">Budget Status</label>
									<span class="form-note">Select Budget Status</span>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<div class="form-control-wrap">
										<select class="form-control" name="budget_status" id="budget_status"  required>
											
											<option value="1" <?php if($budget['budget_status'] == 1): echo "selected"; endif; ?> >Active</option>
											<option value="0" <?php if($budget['budget_status'] == 0): echo "selected"; endif; ?>>InActive</option>
										
										
										</select>
									</div>
								</div>
							</div>
						</div>
						<input type="hidden" name="budget_id" value="<?=$budget['budget_id']; ?>">
						
						<div class="row g-3">
							<div class="col-lg-12 offset-lg-12">
								<div class="form-group mt-2">
									<button type="submit" class="ladda-button ladda-button-demo btn btn-primary btn-block" dir="ltr" data-style="zoom-in"">Submit</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
<?php endforeach; ?>

<?= $this->endSection() ?>
