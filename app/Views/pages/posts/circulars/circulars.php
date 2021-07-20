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
						<li class="breadcrumb-item active">Circular Board</li>
					</ol>
				</div>
				<h4 class="page-title">Circular Board</h4>
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
                  <a class="dropdown-item" href="<?=site_url('internal-memo')?>">New Internal Circular</a>
                  <a class="dropdown-item" href="<?= site_url('external-memo')?>">New External Circular</a>
                </div>
              </div>
              <a href="<?=site_url('/my-circulars')?>" type="button" class="btn btn-success waves-effect waves-light mr-1">My Circulars</a>
              <a href="<?=site_url('/memos/requests')?>" type="button" class="btn btn-danger waves-effect waves-light">Signature Requests</a>

            </div>
          </div><!-- end col-->
        </div> <!-- end row -->
      </div> <!-- end card-box -->
    </div><!-- end col-->
  </div>
  <div class="row">
	  <?php if(empty($circulars)):?>
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
          <h3 class="mt-3 mb-2">No Circulars Found</h3>
          <a href="/" class="btn btn-success waves-effect waves-light">Back to Home</a>
        </div>
      </div> <!-- end col -->
	  <?php else: foreach ($circulars as $circular): ?>
      <div class="col-lg-4">
        <div class="card-box project-box">
          <div class="dropdown float-right">
            <a href="#" class="dropdown-toggle card-drop arrow-none" data-toggle="dropdown" aria-expanded="false">
              <i class="mdi mdi-dots-horizontal m-0 text-muted h3"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="<?=site_url('view-circular/').$circular['p_id']?>">View</a>
            </div>
          </div> <!-- end dropdown -->
          <!-- Title-->
          <h4 class="mt-0"><a href="<?=site_url('view-circular')."/".$circular['p_id']; ?>"  class="text-dark"><?=word_limiter($circular['p_subject'], 8) ?></a></h4>
          <p class="text-muted text-uppercase"><i class="mdi mdi-account-circle"></i> <small><?=$circular['created_by']?></small></p>
          <p class="text-muted mt-n2"><small><?=$circular['p_ref_no']?></small></p>
          <div class="badge bg-soft-secondary text-<?=$circular['p_direction'] == 1 ? 'success' : 'secondary'?> mb-3"><?=$circular['p_direction'] == 1 ? 'Internal Circular' : 'External Circular'?></div>

          <!-- Desc-->
<!--            <p class="text-muted font-13 mb-3 sp-line-2">--><?//=word_limiter($circular['p_body'], 70) ?><!--</p>-->
<!--            <p class="text-muted font-13 mb-3 sp-line-2"><a href="--><?//=site_url('view-circular')."/".$circular['p_id']; ?><!--"  class="font-weight-bold text-muted">view more</a></p>-->
          <!-- Task info-->
          <p class="mb-1">
          <span class="pr-3 text-nowrap mb-2 d-inline-block">
            <strong>Signed By</strong> <br>
            <span class="text-muted"><?=$circular['user_name']?></span>
          </span>
            <span class="text-nowrap mb-2 d-inline-block">
            <strong>Date</strong> <br>
            <span class="text-muted">
              <?php $date = date_create($circular['p_date']);
              echo date_format($date,"d M Y H:i a");
              ?>
            </span>
          </span>
          </p>
          <strong>Recipients</strong>
          <div class="avatar-group">
            <?php foreach ($circular['recipients'] as $recipient):?>
              <div class="avatar-sm avatar-group-item">
                <span class="avatar-title bg-soft-secondary text-secondary font-20 rounded-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?=$recipient['dpt_name']?>">
                  <?=substr($recipient['dpt_name'], 0, 1)?>
                </span>
              </div>
            <?php endforeach;?>
          </div>
        </div> <!-- end card box-->
      </div><!-- end col-->
    <?php endforeach; endif?>
	</div>
  <div class="row">
    <div class="col-12">
      <div class="float-right">
	      <?php if (!empty($circulars)):?>
		      <?= $pager->links() ?>
	      <?php endif;?>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>

