<?= $this->extend('layouts/master'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
	<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box">
				<div class="page-title-right">
					<ol class="breadcrumb m-0">
						<li class="breadcrumb-item"><a href="<?= site_url('/') ?>">iGov</a></li>
						<li class="breadcrumb-item"><a href="javascript: void(0);">Messaging</a></li>
						<li class="breadcrumb-item active">circular Board</li>
					</ol>
				</div>
				<h4 class="page-title">circular Board</h4>
			</div>
		</div>
	</div>
	<!-- end page title -->
	
	<div class="row">
		<div class="col-12">
			<div class="card-box">
				<div class="row">
					<div class="col-lg-5">
						<h4 class="header-title mt-2 mb-4">All circulars</h4>
					</div>
					<div class="col-lg-3">
						<form method="get">
							<div class="form-group">
								<div class="input-group input-group-sm">
									<input type="text" class="form-control" name="search_params">
									<div class="input-group-append">
										<button class="btn btn-primary waves-effect waves-light" type="submit">Search</button>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="col-lg-2">
						
						<a href="<?=site_url('/my-circulars')?>" type="button" class="btn btn-primary btn-sm btn-block float-right">My circulars</a>
					
					</div>
					<div class="col-lg-2">
						
						
						<a href="<?=site_url('/new-circular')?>" type="button" class="btn btn-primary btn-sm btn-block float-right"> <i class="mdi mdi-plus mr-2"></i>New circular</a>
					
					</div>
				</div>
				<div class="row mt-2">
					<?php if(empty($circulars)):?>
						<div class="col-md-12 col-lg-12 col-xl-12">
							<div class="card bg-pattern">
								<div class="card-body p-4">
									<div class="auth-logo">
										<a href="/" class="logo logo-dark text-center">
                          <span class="logo-lg">
                            <img src="../assets/images/logo-sm.png" alt="" height="50">
                          </span>
										</a>
										<a href="/" class="logo logo-light text-center">
                          <span class="logo-lg">
                            <img src="../assets/images/logo-sm.png" alt="" height="50">
                          </span>
										</a>
									</div>
									<div class="text-center mt-4">
										<h3 class="mt-3 mb-2">No circular Found</h3>
										<a href="/" class="btn btn-success waves-effect waves-light">Back to Home</a>
									</div>
								</div> <!-- end card-body -->
							</div>
							<!-- end card -->
						</div> <!-- end col -->
					<?php else: ?>
						<?php foreach ($circulars as $circular): ?>
							<div class="col-lg-4" style="padding-bottom: 5px; max-height: 100%" >
								<div class="card-box project-box mb-n5" style=" <?php if($circular['p_status'] == 3): ?>background-color: lavenderblush; <?php endif; ?>;" >
									<!-- Title-->
									<h4 class="mt-0"><a href="#" data-toggle="modal" data-target="#view-circular<?=$circular['p_id'] ?>" class="text-dark"><?=$circular['p_subject'] ?></a></h4>
									<!-- Desc-->
									<p class="text-muted font-13 mb-3 sp-line-2">
										<?=word_limiter($circular['p_body'], 70) ?>
									</p>
									<p class="text-muted font-13 mb-3 sp-line-2">
										<a href="#" data-toggle="modal" data-target="#view-circular<?=$circular['p_id'] ?>" class="font-weight-bold text-muted">view more</a></p>
									<!-- Task info-->
									<!-- Team-->
									<div class="avatar-group mb-1">
										<a href="javascript: void(0);" class="avatar-group-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?=$circular['user_name'] ?>">
											<img src="/assetsa/images/user.png" class="rounded-circle avatar-sm" alt="friend" />
										</a>
									</div>
									<!-- Progress-->
									<div class="row">
										<div class="col-6">
											<div class="mb-5">
												<h5>Signed By:</h5>
												<p>
													<small class="text-muted">
														<?=$circular['user_name']?>
													</small>
												</p>
											</div>
										</div>
										<div class="col-6">
											<div class="mb-5">
												<h5> Date:</h5>
												<p>
													<small class="text-muted">
														<?php
															$date = date_create($circular['p_date']);
															echo date_format($date,"d M Y H:i a");
														?>
													</small>
												</p>
											</div>
										</div>
									</div>
								</div> <!-- end card box-->
							</div><!-- end col-->
						<?php endforeach; endif?>
				</div>
				<div class="mt-4 float-right">
					<?= $pager->links() ?>
				</div>
			</div> <!-- end card body-->
		
		</div><!-- end col-->
	</div>

</div>
<?= $this->endSection(); ?>

