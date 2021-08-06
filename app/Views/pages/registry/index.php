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
						<li class="breadcrumb-item active"><a href="<?= site_url('registries')?>">Registry</a></li>
					</ol>
				</div>
				<h4 class="page-title">Registry</h4>
			</div>
		</div>
	</div>
	<!-- end page title -->
  <div class="row">
    <div class="col-12">
      <div class="card-box">
        <div class="row">
          <div class="col-lg-8">
            <h5>All Registries</h5>
          </div>
          <div class="col-lg-4">
            <div class="text-lg-right mt-3 mt-lg-0">
              <div class="btn-group mr-2">
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-plus-circle mr-1"></i> New Correspondence</button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="<?=site_url('incoming-mail')?>">New Incoming Mail</a>
                  <a class="dropdown-item" href="<?= site_url('outgoing-mail')?>">New Outgoing Mail</a>
                </div>
              </div>
              <a href="<?=site_url('/mail-transfer-requests')?>" type="button" class="btn btn-danger waves-effect waves-light">Transfer Requests</a>
            </div>
          </div><!-- end col-->
        </div> <!-- end row -->
      </div> <!-- end card-box -->
    </div><!-- end col-->
  </div>
  <div class="row">
	  <?php if (empty($registries)):?>
    <div class="col-12 mt-5">
      <div class="auth-logo">
        <a href="/" class="logo logo-dark text-center">
          <span class="logo-lg">
            <img src="/assets/images/logo-sm.png" alt="" height="200">
          </span>
        </a>
        <a href="/" class="logo logo-light text-center">
          <span class="logo-lg">
            <img src="/assets/images/logo-sm.png" alt="" height="200">
          </span>
        </a>
      </div>
      <div class="text-center mt-4">
        <h3 class="mt-3 mb-2">You Do Not Have Access To Any Registries</h3>
        <a href="/" class="btn btn-success waves-effect waves-light">Back to Home</a>
      </div>
    </div>
	  <?php else: foreach ($registries as $registry):?>
    <div class="col-lg-4">
      <div class="card-box bg-pattern">
        <div class="text-center">
          <h4 class="mb-1 font-20"><?=$registry['registry_name']?></h4>
          <p class="text-muted font-14">
            <?=$registry['manager']['user_name']?> <br>
            <?=$registry['position']['pos_name']?>, <?=$registry['department']['dpt_name']?>
          </p>
        </div>
        <p class="font-14 text-center text-muted">
          <?=$registry['registry_description']?>
        </p>
        <div class="text-center">
          <a href="<?=site_url('view-registry/').$registry['registry_id']?>" class="btn btn-sm btn-light">View Registry</a>
        </div>
      </div> <!-- end card-box -->
    </div><!-- end col -->
	  <?php endforeach; endif;?>
  </div>
  <!-- Warning Alert Modal -->
  <div id="warning-alert-modal-3" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
      <div class="modal-content">
        <div class="modal-body p-4">
          <div class="text-center">
            <i class="dripicons-warning h1 text-danger"></i>
            <h4 class="mt-2">Pending Transfer Requests</h4>
            <p class="mt-3">There are transfers still awaiting your confirmation. Please click on continue below to attend to these pending requests.</p>
            <a href="<?=site_url('/mail-transfer-requests')?>" type="button" class="btn btn-danger my-2">Continue</a>
          </div>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</div>
<?= $this->endSection(); ?>
<?= $this->section('extra-scripts'); ?>
<script>
  $(document).ready(() => {
		<?php if (session()->getFlashdata('transfer_requests')):?>
    jQuery.noConflict()
    $('#warning-alert-modal-3').modal('show');
		<?php endif;?>
  })
</script>
<?= $this->endSection(); ?>
