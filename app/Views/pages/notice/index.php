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
							<li class="breadcrumb-item active">Notices</li>
						</ol>
					</div>
					<h4 class="page-title">Notices</h4>
				</div>
			</div>
		</div>
		<!-- end page title -->
    <div class="row mt-n4">
      <div class="col-lg-6">
        <form method="get">
          <div class="form-group">
            <div class="input-group">
              <input type="text" class="form-control" name="search_params">
              <div class="input-group-append">
                <button class="btn btn-dark waves-effect waves-light" type="submit">Search</button>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="col-lg-2">
        <div class="btn-group btn-block mb-2">
          <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filter Notices <i class="mdi mdi-filter-menu float-right"></i></button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="<?=site_url('/notices')?>">All Notices</a>
            <a class="dropdown-item" href="#">Pending Notices</a>
            <a class="dropdown-item" href="#">Confirmed Notices</a>
            <a class="dropdown-item" href="#">Activated Notices</a>
            <a class="dropdown-item text-danger" href="#">Deactivated Notices</a>
            <a class="dropdown-item text-danger" href="#">Rejected Notices</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Created Notices</a>
            <a class="dropdown-item" href="#">Signed Notices</a>
          </div>
        </div><!-- /btn-group -->
      </div>
      <div class="col-lg-2"></div>
      <div class="col-lg-2">
        <a href="<?=site_url('/new_notice')?>" type="button" class="btn btn-dark btn-block"> <i class="mdi mdi-plus mr-2"></i>New Notice</a>
      </div>
    </div>
    <div class="row mt-n4">
      <div class="col-12">
        <div class="card">
          <div class="card-body mb-n5">
						<?php if(session()->has('success')): ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <i class="mdi mdi-check-all mr-2"></i>
                <strong>
                  <?=session()->get('success')?>
                </strong>
              </div>
            <?php elseif (session()->has('error')): ?>
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <i class="mdi mdi-check-all mr-2"></i>
                <strong>
									<?=session()->get('error')?>
                </strong>
              </div>
						<?php endif; ?>

            <div class="row ">
              <?php if(empty($notices)):?>
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
                        <h3 class="mt-3 mb-2">No Notice Found</h3>
                        <a href="/" class="btn btn-success waves-effect waves-light">Back to Home</a>
                      </div>
                    </div> <!-- end card-body -->
                  </div>
                  <!-- end card -->
                </div> <!-- end col -->
              <?php else: ?>
	            <?php foreach ($notices as $notice): ?>
                <div class="col-lg-4" style="padding-bottom: 5px; max-height: 100%" >
                  <div class="card-box project-box mb-n5" style=" <?php if($notice['n_status'] == 3): ?>background-color: lavenderblush; <?php endif; ?>;" >
<!--                    <div class="dropdown float-right">-->
<!--                      <a href="#" class="dropdown-toggle card-drop arrow-none" data-toggle="dropdown" aria-expanded="false">-->
<!--                        <i class="mdi mdi-dots-horizontal m-0 text-muted h3"></i>-->
<!--                      </a>-->
<!--                      <div class="dropdown-menu dropdown-menu-right">-->
<!--						            --><?php //if($notice['n_status'] == 3): ?>
<!--                          <form action="" method="post">-->
<!--                            <input type="hidden" name="n_status" value="2">-->
<!--                            <input type="hidden" name="n_id" value="--><?//=$notice['n_id']; ?><!--">-->
<!--                            <button type="submit" class="dropdown-item">Activate</button>-->
<!--                          </form>-->
<!--						            --><?php //endif; ?>
<!--						            --><?php //if($notice['n_status'] == 2): ?>
<!--                          <form action="" method="post">-->
<!--                            <input type="hidden" name="n_status" value="3">-->
<!--                            <input type="hidden" name="n_id" value="--><?//=$notice['n_id']; ?><!--">-->
<!--                            <button type="submit" class="dropdown-item">Deactivate</button>-->
<!--                          </form>-->
<!--						            --><?php //endif; ?>
<!--                      </div>-->
<!--                    </div> -->
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
                    <div class="avatar-group mb-1">
                      <a href="javascript: void(0);" class="avatar-group-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="">
                        <img src="/assetsa/images/user.png" class="rounded-circle avatar-sm" alt="friend" />
                      </a>
                    </div>
                    <!-- Progress-->
                    <div class="row">
                      <div class="col-6">
                        <div class="mb-1">
                          <h5>Signed By:</h5>
                          <p>
                            <small class="text-muted">
                              <?=$notice['signed_by']['user_name']?>
                            </small>
                          </p>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="mb-1">
                          <h5> Date:</h5>
                          <p>
                            <small class="text-muted">
                              <?php
                                $date = date_create($notice['created_at']);
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
	          <?= $pager->links() ?>
          </div> <!-- end card body-->
        </div> <!-- end card -->
      </div><!-- end col-->
    </div>

	</div>
<?= $this->endSection(); ?>

