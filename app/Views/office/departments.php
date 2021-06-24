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
						<li class="breadcrumb-item"><a href="javascript: void(0);">General Settings</a></li>
						<li class="breadcrumb-item active">Departments</li>
					</ol>
				</div>
				<h4 class="page-title">Departments</h4>
			</div>
		</div>
	</div>
	<!-- end page title -->
	<div class="row">
		<div class="col-12">
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
						<button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#new-department" style="float: right"> <i class="mdi mdi-plus mr-2"></i>New Department</button>
					
					</div>
					<table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
						<thead>
						<tr>
							<th>S/N</th>
							<th>Department</th>
							<th>Action</th>
							
						</tr>
						</thead>
						
						
						<tbody>
						<?php if(!empty($departments)):
							$sn = 1;
							foreach ($departments as $department):
							?>
						<tr>
							<td><?=$sn++; ?></td>
							<td><?=$department['dpt_name'] ?></td>
							<td><button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit-department<?=$department['dpt_id'] ?>" > <i class="mdi mdi-pen-lock mr-2"></i></button>
							</td>
						
						</tr>
						<?php endforeach;
						endif; ?>
				
						</tbody>
					</table>
				
				</div> <!-- end card body-->
			</div> <!-- end card -->
		</div><!-- end col-->
	</div>
	
	<!-- end row -->
	


</div> <!-- container -->

<!-- Long Content Scroll Modal -->
<div class="modal fade" id="new-department" tabindex="-1" role="dialog"
	 aria-labelledby="scrollableModalTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="scrollableModalTitle">New Department</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="">
					<div class="row g-3 align-center">
						<div class="col-lg-12">
							<div class="form-group">
								<label class="form-label" for="site-name">Department's Name</label>
								<span class="form-note">Enter Department Name</span>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="form-control-wrap">
									<input type="text" class="form-control" name="dpt_name" required>
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
<?php foreach ($departments as $department): ?>
<div class="modal fade" id="edit-department<?=$department['dpt_id'] ?>" tabindex="-1" role="dialog"
	 aria-labelledby="scrollableModalTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="scrollableModalTitle">Update Department</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="">
					<div class="row g-3 align-center">
						<div class="col-lg-12">
							<div class="form-group">
								<label class="form-label" for="site-name">Department's Name</label>
								<span class="form-note">Enter Department Name</span>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="form-control-wrap">
									<input type="text" class="form-control" name="dpt_name" value="<?=$department['dpt_name'] ?>" required>
								</div>
							</div>
						</div>
					</div>
					
					<input type="hidden" value="<?=$department['dpt_id']; ?>" name="dpt_id">
					
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
