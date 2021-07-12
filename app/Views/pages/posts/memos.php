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
						<li class="breadcrumb-item active">All Memos</li>
					</ol>
				</div>
				<h4 class="page-title">All Memos</h4>
			</div>
		</div>
	</div>
	<!-- end page title -->
  <div class="row">
    <div class="col-12">
      <div class="card-box">
        <div class="row">
          <div class="col-lg-8">
            <form class="form-inline" method="get">
              <div class="form-group">
                <label for="inputPassword2" class="sr-only">Search</label>
                <input type="search" class="form-control" id="inputPassword2" placeholder="Search..." name="search_params">
              </div>
              <div class="form-group mx-sm-3">
                <label for="status-select" class="mr-2">Sort By</label>
                <select class="custom-select" id="status-select">
                  <option selected="">All</option>
                  <option value="1">Internal Memos</option>
                  <option value="2">External Memos</option>
                </select>
              </div>
            </form>
          </div>
          <div class="col-lg-4">
            <div class="text-lg-right mt-3 mt-lg-0">
              <a href="<?=site_url('/my-memos')?>" type="button" class="btn btn-success waves-effect waves-light mr-1">My Memos</a>
              <div class="btn-group">
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-plus-circle mr-1"></i> Add New</button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="#">New Internal Memo</a>
                  <a class="dropdown-item" href="#">New External Memo</a>
                </div>
              </div>
            </div>
          </div><!-- end col-->
        </div> <!-- end row -->
      </div> <!-- end card-box -->
    </div><!-- end col-->
  </div>
  <div class="row">
    <?php if (empty($memos)):?>

    <?php else: foreach ($memos as $memo):?>
      <div class="col-lg-4">
        <div class="card-box project-box">
          <div class="dropdown float-right">
            <a href="#" class="dropdown-toggle card-drop arrow-none" data-toggle="dropdown" aria-expanded="false">
              <i class="mdi mdi-dots-horizontal m-0 text-muted h3"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="#">Edit</a>
              <a class="dropdown-item" href="#">Delete</a>
              <a class="dropdown-item" href="#">Add Members</a>
              <a class="dropdown-item" href="#">Add Due Date</a>
            </div>
          </div> <!-- end dropdown -->
          <!-- Title-->
          <h4 class="mt-0"><a href="project-detail.html" class="text-dark"><?=word_limiter($memo['p_subject'], 8) ?></a></h4>
          <p class="text-muted text-uppercase"><i class="mdi mdi-account-circle"></i> <small>Moondust Softwares</small></p>
          <div class="badge bg-soft-secondary text-secondary mb-3">Ongoing</div>
          <!-- Desc-->
<!--          <p class="text-muted font-13 mb-3 sp-line-2">A handful of model sentence structures, to generate Lorem Ipsum which looks reasonable...<a href="javascript:void(0);" class="font-weight-bold text-muted">view more</a></p>-->
          <!-- Task info-->
          <p class="mb-1">
            <span class="pr-2 text-nowrap mb-2 d-inline-block">
              Signed By: <br>
              <?=$memo['user_name']?>
            </span>
            <span class="text-nowrap mb-2 d-inline-block">
                                            <i class="mdi mdi-comment-multiple-outline text-muted"></i>
                                            <b>103</b> Comments
                                        </span>
          </p>
        </div> <!-- end card box-->

      </div>
    <?php endforeach; endif;?>
  </div>
	
	<div class="row">
		<div class="col-12">
			<div class="card-box">
				<div class="row">
					<div class="col-lg-5">
						<h4 class="header-title mt-2 mb-4">All Memos</h4>
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
						
						<a href="<?=site_url('/my-memos')?>" type="button" class="btn btn-primary btn-sm btn-block float-right">My memos</a>
					
					</div>
					<div class="col-lg-2">
						
						
						<a href="<?=site_url('/new-memo')?>" type="button" class="btn btn-primary btn-sm btn-block float-right"> <i class="mdi mdi-plus mr-2"></i>New memo</a>
					
					</div>
				</div>
				<div class="row mt-2">
					<?php if(empty($memos)):?>
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
										<h3 class="mt-3 mb-2">No memo Found</h3>
										<a href="/" class="btn btn-success waves-effect waves-light">Back to Home</a>
									</div>
								</div> <!-- end card-body -->
							</div>
							<!-- end card -->
						</div> <!-- end col -->
					<?php else: ?>
						<?php foreach ($memos as $memo): ?>
							<div class="col-lg-4" style="padding-bottom: 5px; max-height: 100%" >
								<div class="card-box project-box mb-n5" style=" <?php if($memo['p_status'] == 3): ?>background-color: lavenderblush; <?php endif; ?>;" >
									<!-- Title-->
									<h4 class="mt-0"><a href="#" data-toggle="modal" data-target="#view-memo<?=$memo['p_id'] ?>" class="text-dark"><?=$memo['p_subject'] ?></a></h4>
									<!-- Desc-->
									<p class="text-muted font-13 mb-3 sp-line-2">
										<?=word_limiter($memo['p_body'], 70) ?>
									</p>
									<p class="text-muted font-13 mb-3 sp-line-2">
										<a href="#" data-toggle="modal" data-target="#view-memo<?=$memo['p_id'] ?>" class="font-weight-bold text-muted">view more</a></p>
									<!-- Task info-->
									<!-- Team-->
									<div class="avatar-group mb-1">
										<a href="javascript: void(0);" class="avatar-group-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?=$memo['user_name'] ?>">
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
														<?=$memo['user_name']?>
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
															$date = date_create($memo['p_date']);
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

