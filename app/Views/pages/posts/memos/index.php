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
						<li class="breadcrumb-item active">Memo Board</li>
					</ol>
				</div>
				<h4 class="page-title">Memo Board</h4>
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
                <div class="input-group">
                  <label for="inputPassword2" class="sr-only">Search</label>
                  <input type="search" class="form-control" id="inputPassword2" placeholder="Search..." name="search_params">
                  <div class="input-group-append">
                    <button class="btn btn-success waves-effect waves-light" type="submit">Search</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="col-lg-4">
            <div class="text-lg-right mt-3 mt-lg-0">
              <div class="btn-group mr-1">
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-plus-circle mr-1"></i> Add New</button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="<?=site_url('internal-memo')?>">New Internal Memo</a>
                  <a class="dropdown-item" href="<?= site_url('external-memo')?>">New External Memo</a>
                </div>
              </div>
              <a href="<?=site_url('/my-memos')?>" type="button" class="btn btn-success waves-effect waves-light mr-1">My Memos</a>
              <a href="<?=site_url('/memos/requests')?>" type="button" class="btn btn-danger waves-effect waves-light">Signature Requests</a>

            </div>
          </div><!-- end col-->
        </div> <!-- end row -->
      </div> <!-- end card-box -->
    </div><!-- end col-->
  </div>
  <div class="row">
    <?php if (empty($memos)):?>
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
          <h3 class="mt-3 mb-2">No Memos Found</h3>
          <a href="/" class="btn btn-success waves-effect waves-light">Back to Home</a>
        </div>
      </div>
    <?php else: foreach ($memos as $memo):?>
      <div class="col-lg-4">
        <div class="card-box project-box">
          <div class="dropdown float-right">
            <a href="#" class="dropdown-toggle card-drop arrow-none" data-toggle="dropdown" aria-expanded="false">
              <i class="mdi mdi-dots-horizontal m-0 text-muted h3"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="<?=site_url('view-memo/').$memo['p_id']?>">View</a>
            </div>
          </div> <!-- end dropdown -->
          <!-- Title-->
          <h4 class="mt-0"><a href="<?=site_url('view-memo/').$memo['p_id']?>" class="text-dark"><?=word_limiter($memo['p_subject'], 8) ?></a></h4>
          <p class="text-muted text-uppercase"><i class="mdi mdi-account-circle"></i> <small><?=$memo['written_by']['user_name']?></small></p>
          <p class="text-muted mt-n2"><small><?=$memo['p_ref_no']?></small></p>
          <div class="badge bg-soft-secondary text-<?=$memo['p_direction'] == 1 ? 'success' : 'secondary'?> mb-3"><?=$memo['p_direction'] == 1 ? 'Internal Memo' : 'External Memo'?></div>
          <!-- Desc-->
<!--          <p class="text-muted font-13 mb-3 sp-line-2">A handful of model sentence structures, to generate Lorem Ipsum which looks reasonable...<a href="javascript:void(0);" class="font-weight-bold text-muted">view more</a></p>-->
          <!-- Task info-->
          <p class="mb-1">
            <span class="pr-3 text-nowrap mb-2 d-inline-block">
              <strong>Signed By</strong> <br>
              <span class="text-muted"><?=$memo['signed_by']['user_name']?></span>
            </span>
            <span class="text-nowrap mb-2 d-inline-block">
              <strong>Date</strong> <br>
              <span class="text-muted">
                <?php $date = date_create($memo['p_date']);
                echo date_format($date,"d M Y H:i a");
                ?>
              </span>
            </span>
          </p>
          <strong>Recipients</strong>
          <div class="avatar-group">
            <?php foreach ($memo['recipients'] as $recipient):?>
            <div class="avatar-sm avatar-group-item">
              <span class="avatar-title bg-soft-secondary text-secondary font-20 rounded-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?=$recipient['pos_name']?>">
                <?=substr($recipient['pos_name'], 0, 1)?>
              </span>
            </div>
            <?php endforeach;?>
          </div>
        </div> <!-- end card box-->
      </div>
    <?php endforeach; endif;?>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="float-right">
        <?php if (!empty($memos)):?>
  	      <?= $pager->links() ?>
        <?php endif;?>
      </div>
    </div>
  </div>
  <!-- Warning Alert Modal -->
  <div id="warning-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
      <div class="modal-content">
        <div class="modal-body p-4">
          <div class="text-center">
            <i class="dripicons-warning h1 text-danger"></i>
            <h4 class="mt-2">Pending Signature Requests</h4>
            <p class="mt-3">There are memos still awaiting your signature. Please click on continue below to attend to these pending requests.</p>
            <a href="<?=site_url('/memos/requests')?>" type="button" class="btn btn-danger my-2">Continue</a>
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
    <?php if (session()->getFlashdata('unsigned_memos')):?>
      jQuery.noConflict()
      $('#warning-alert-modal').modal('show');
    <?php endif;?>
  })
</script>
<?= $this->endSection(); ?>

