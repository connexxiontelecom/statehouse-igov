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
							<li class="breadcrumb-item active">Notice Board</li>
						</ol>
					</div>
					<h4 class="page-title">Notice Board</h4>
				</div>
			</div>
		</div>
		<!-- end page title -->

    <div class="row">
      <div class="col-12">
        <div class="card-box">
          <div class="row">
            <div class="col-lg-6">
              <h4 class="header-title mt-2 mb-4">All Notices</h4>
            </div>
            <div class="col-lg-4">
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
              <a href="<?=site_url('/my-notices')?>" type="button" class="btn btn-primary btn-sm btn-block">My Notices</a>
            </div>
          </div>
          <div class="row mt-2">
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
                        <div class="mb-5">
                          <h5>Signed By:</h5>
                          <p>
                            <small class="text-muted">
												      <?=$notice['signed_by']['user_name']?>
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
          <div class="mt-4 float-right">
			      <?= $pager->links() ?>
          </div>
        </div> <!-- end card body-->

      </div><!-- end col-->
    </div>

	</div>
<?= $this->endSection(); ?>

