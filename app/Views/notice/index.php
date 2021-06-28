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
    <div class="row">
      <div class="col-12">
        <div class="text-right">
          <a href="<?=site_url('/new_notice')?>" type="button" class="btn btn-primary" style="float: right"> <i class="mdi mdi-plus mr-2"></i>New Notice</a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
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

            <div class="row">
	            <?php foreach ($notices as $notice): ?>
                <div class="col-lg-4" style="padding-bottom: 5px; max-height: 100%" >
                  <div class="card-box project-box" style=" <?php if($notice['n_status'] == 3): ?>background-color: lavenderblush; <?php endif; ?>;" >
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
	            <?php endforeach;?>
            </div>
	          <?= $pager->links() ?>
          </div> <!-- end card body-->
        </div> <!-- end card -->
      </div><!-- end col-->
    </div>

	</div>
<?= $this->endSection(); ?>

