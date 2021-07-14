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
    <div class="col-lg-7">
      <div class="card d-block">
        <div class="card-body">
          <div class="row d-print-none">
            <div class="col-lg-8">
            </div>
            <div class="col-lg-4">
              <div class="text-lg-right">
                <a href="javascript:window.print()" type="button" class="btn btn-success waves-effect waves-light mr-2"><i class="mdi mdi-printer"></i></a>
	              <?php if($memo['p_by'] == session()->user_id && $memo['p_status'] == 0):?>
                  <a href="<?=site_url('/edit-memo/').$memo['p_id']?>" type="button" class="btn btn-success">Edit</a>
	              <?php endif;?>
                <?php if($memo['p_signed_by'] == session()->user_id && $memo['p_status'] == 0):?>
                  <button onclick="signDocument()" type="button" class="btn btn-success">Sign</button>
	              <?php endif;?>
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
			              echo date_format($date,"d F Y");
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
    <div class="col-lg-5">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title font-16 mb-3">Attachments</h5>
			    <?php if(!empty($memo['attachments'])):
				    foreach ($memo['attachments'] as $attachment):?>
              <div class="card mb-1 shadow-none border">
                <div class="p-2">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <div class="avatar-sm">
                        <span class="avatar-title badge-soft-primary text-primary rounded">
                           <?php echo strtoupper(substr($attachment['pa_link'], strpos($attachment['pa_link'], ".") + 1)); ?>
                        </span>
                      </div>
                    </div>
                    <div class="col pl-0">
                      <p class="mb-0 font-12"><?php
										    $filename = 'uploads/posts/'.$attachment['pa_link'];
										    //											$handle = fopen($filename, "r");
										    //											$contents = fread($handle, filesize($filename));
										    //echo $filename;
										    $size = round(filesize($filename)/(1024 * 1024), 2);
										    echo $attachment['pa_link'] .'<br>';
										    echo $size."MB";
										    //											fclose($handle);

										    ?></p>
                    </div>
                    <div class="col-auto">
                      <!-- Button -->
                      <a href="<?='/uploads/posts/'.$attachment['pa_link']; ?>" download="<?=$attachment['pa_link']; ?>" target="_blank" class="btn btn-link font-16 text-muted">
                        <i class="dripicons-download"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
				    <?php endforeach; else: echo "No Attachments"; endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('extra-scripts'); ?>
<?=view('pages/posts/_memo-scripts.php')?>
<?= $this->endSection(); ?>

