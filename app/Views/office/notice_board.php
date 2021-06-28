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
						<li class="breadcrumb-item"><a href="javascript: void(0);">Messaging Settings</a></li>
						<li class="breadcrumb-item active">Notice Board</li>
					</ol>
					
				</div>
				<h4 class="page-title">Notice Board</h4>
			</div>
		</div>
	</div>
	<!-- end page title -->
	
	
	<div class="row" style="margin-top: -50px">
		
		<div class="col-12 order-xl-1 order-2">
			<div class="card mb-2" >
				<div class="card-body" style="padding-bottom: 0px; max-height: 20%">
					<div class="row">
						<div class="col-lg-3">
							<form class="form-inline" method="get">
								<div class="input-group input-group-sm">
									<input type="text" name="search_params" class="form-control border">
									<div class="input-group-append">
										<button type="submit"  class="input-group-text bg-blue border-blue text-white">
											<i class="mdi mdi-card-search"></i>
										</button>
									</div>
								
								</div>
							</form>
						
						</div>
						<div class="col-lg-3 offset-6">
							<div class="text-lg-right mt-3 mt-lg-0">
								<form id="filterForm" class="form-inline" method="get">
									<div class="form-group mx-sm-3">
									
										<select name="filter_params" class="custom-select" id="filter-select">
											<option selected disabled>Filter</option>
											<option value="a">All</option>
											<option value="2">Active Notices</option>
											<option value="3">Deactivated Notices</option>
											
										</select>
									</div>
								</form>
							</div>
						</div><!-- end col-->
					</div> <!-- end row -->
				</div> <!-- end card-body-->
			</div> <!-- end card-->
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
					
						<?php if(!empty($notices)): foreach ($notices as $notice):  ?>
						<div class="col-lg-4" style="padding-bottom: 5px; max-height: 100%" >
							<div class="card-box project-box" style=" <?php if($notice['n_status'] == 3): ?>background-color: lavenderblush; <?php endif; ?>;" >
								<div class="dropdown float-right">
									<a href="#" class="dropdown-toggle card-drop arrow-none" data-toggle="dropdown" aria-expanded="false">
										<i class="mdi mdi-dots-horizontal m-0 text-muted h3"></i>
									</a>
									
									<div class="dropdown-menu dropdown-menu-right">
										<?php if($notice['n_status'] == 3): ?>
											<form action="" method="post">
												
												<input type="hidden" name="n_status" value="2">
												<input type="hidden" name="n_id" value="<?=$notice['n_id']; ?>">
												<button type="submit" class="dropdown-item">Activate</button>
											
											</form>
										<?php endif; ?>
										<?php if($notice['n_status'] == 2): ?>
											<form action="" method="post">
											<input type="hidden" name="n_status" value="3">
												
												<input type="hidden" name="n_id" value="<?=$notice['n_id']; ?>">
												<button type="submit" class="dropdown-item">Deactivate</button>
											
											</form>
											
										
										<?php endif; ?>
									</div>
								</div> <!-- end dropdown -->
								<!-- Title-->
								<h4 class="mt-0"><a href="#" data-toggle="modal" data-target="#view-notice<?=$notice['n_id'] ?>" class="text-dark"><?=$notice['n_subject'] ?></a></h4>
								
								<!-- Desc-->
								<p class="text-muted font-13 mb-3 sp-line-2">
									<?=word_limiter($notice['n_body'], 70) ?>
								
								</p>
								<p class="text-muted font-13 mb-3 sp-line-2">
										<a href="#" data-toggle="modal" data-target="#view-notice<?=$notice['n_id'] ?>" class="font-weight-bold text-muted">view more</a></p>
								<!-- Task info-->
							
								<!-- Team-->
								<div class="avatar-group mb-3">
									<a href="javascript: void(0);" class="avatar-group-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?=$notice['user_name'] ?>">
										<img src="/assetsa/images/user.png" class="rounded-circle avatar-sm" alt="friend" />
									</a>
									
									
								</div>
								<!-- Progress-->
								
								<div class="row">
									<div class="col-6">
										<div class="mb-4">
											<h5>Created By</h5>
											<p> <small class="text-muted"><?=$notice['created_by']; ?></small></p>
										</div>
									</div>
									<div class="col-6">
										<div class="mb-4">
											<h5> Date:</h5>
											<p> <small class="text-muted"><?=$notice['created_at'] ?></small></p>
										</div>
									</div>
									
								</div>
							</div> <!-- end card box-->
						</div><!-- end col-->
						
						<?php endforeach;
						
						else: ?>
							
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
												<h3 class="mt-3 mb-2">No Notice Found</h3>
											
												<a href="/" class="btn btn-success waves-effect waves-light">Back to Home</a>
											</div>
										
										</div> <!-- end card-body -->
									</div>
									<!-- end card -->
								
								</div> <!-- end col -->
						
							
						<?php
						
						
						endif; ?>
						
						
					</div>
			
					<!-- end row -->
<!--					<div class="container">-->
<!--						-->
<!--						<ul class="pagination">-->
<!--							<li class="page-item"><a class="page-link" href="#">Previous</a></li>-->
<!--							<li class="page-item"><a class="page-link" href="#">1</a></li>-->
<!--							<li class="page-item"><a class="page-link" href="#">2</a></li>-->
<!--							<li class="page-item"><a class="page-link" href="#">3</a></li>-->
<!--							<li class="page-item"><a class="page-link" href="#">Next</a></li>-->
<!--						</ul>-->
<!--					</div>-->
					
					<?= $pager->links() ?>
					
					
				
				</div> <!-- end card body-->
			</div> <!-- end card -->
		</div><!-- end col-->
	</div>
	
	<!-- end row -->



</div> <!-- container -->
<!-- Long Content Scroll Modal -->
<!-- Long Content Scroll Modal -->
<?php foreach ($notices as $notice): ?>
<div class="modal fade" id="view-notice<?=$notice['n_id'] ?>" tabindex="-1" role="dialog"
	 aria-labelledby="scrollableModalTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="scrollableModalTitle"><?=$notice['n_subject'] ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?=$notice['n_body']; ?>
				
				
				<div class="row">
					<div class="col-md-4">
						<div class="mb-4">
							<h5>Created By</h5>
							<p> <small class="text-muted"><?=$notice['created_by']; ?></small></p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="mb-4">
							<h5>Signed By</h5>
							<p> <small class="text-muted"><?=$notice['user_name']; ?></small></p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="mb-4">
							<h5> Date:</h5>
							<p> <small class="text-muted"><?=$notice['created_at'] ?></small></p>
						</div>
					</div>
				
				</div>
			</div>
			
			
		
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endforeach; ?>



<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>
	<script>
        $(document).ready(function(){
            $('#filter-select').change(function(){
                $('#filterForm').submit();
            });

        });
	</script>
	
<?= $this->endSection() ?>
