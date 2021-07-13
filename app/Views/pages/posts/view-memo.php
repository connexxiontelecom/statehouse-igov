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
						<li class="breadcrumb-item"><a href="<?= site_url('/memos')?>">All Memos</a></li>
						<li class="breadcrumb-item active">View Memo</li>
					</ol>
				</div>
				<h4 class="page-title">View Memo</h4>
			</div>
		</div>
	</div>
	<!-- end page title -->
  <div class="row">
    <div class="col-lg-8">
      <div class="card d-block">
        <div class="card-body">
          <div class="row d-print-none">
            <div class="col-lg-8">
            </div>
            <div class="col-lg-4">
              <div class="text-lg-right">
                <a href="javascript:window.print()" type="button" class="btn btn-success waves-effect waves-light mr-2"><i class="mdi mdi-printer"></i></a>
                <a href="<?=site_url('/memos')?>" type="button" class="btn btn-success">Go Back</a>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="auth-logo" style="margin: 0 auto">
              <div class="logo logo-dark">
                <span class="logo-lg">
                  <img class="float-right" src="/uploads/organization/<?=$memo['organization']['org_logo'] ?>" height="100">
                </span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="text-center" style="margin: 0 auto;">
              <h3 class="mt-1"><?=$memo['organization']['org_name'] ?></h3>
              <h5 class="mt-1"><?=$memo['organization']['org_address'] ?></h5>
            </div>
          </div>
          <div class="row">
            <div class="text-center" style="margin: 0 auto;">
              <h3 class="text-uppercase">
                <u>Memo</u>
              </h3>
            </div>
          </div>
          <div class="row mt-4">
            <div class="col-6">
              <div class="float-left">
                <h5 class="font-size-14">
			            Reference No: <?=$memo['p_ref_no'] ?>
                </h5>
              </div>
            </div>
            <div class="col-6">
              <div class="float-right" >
                <h5 class="font-size-14">
			            <?php
                    $date = date_create($memo['p_date']);
			              echo date_format($date,"d M Y");
			            ?>
                </h5>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="float-left">
                <?php foreach ($memo['recipients'] as $recipient): ?>
                  <?=$recipient['pos_name']?>
                <?php endforeach;?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <h3 class="title text-center text-uppercase"><u><?=$memo['p_subject']?></u></h3>
              <p>
                <?=$memo['p_body']?>
              </p>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4">
              <p class="mt-2 mb-1 text-muted">Created By</p>
              <h5 class="mt-1 font-size-14">
		            <?=$memo['written_by']['user_name'] ?>
              </h5>
            </div>
            <div class="col-lg-4">
              <p class="mt-2 mb-1 text-muted">Signed By</p>
              <h5 class="mt-1 font-size-14">
		            <?=$memo['signed_by']['user_name'] ?>
              </h5>
            </div>
            <div class="col-lg-4">
              <p class="mt-2 mb-1 text-muted">Date</p>
	            <?php
	            $date = date_create($memo['p_date']);
	            echo date_format($date,"d M Y H:i a");
	            ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4">

    </div>
  </div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('extra-scripts'); ?>
<?//=view('pages/posts/_circular-scripts.php')?>
<?= $this->endSection(); ?>

