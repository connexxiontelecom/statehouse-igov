<?= $this->extend('layouts/master'); ?>
<?=$this->section('extra-styles'); ?>
<?=$this->endSection() ?>
<?= $this->section('content'); ?>
	<div class="container-fluid">
		<!-- start page title -->
		<div class="row">
			<div class="col-12">
				<div class="page-title-box">
					<div class="page-title-right">
						<ol class="breadcrumb m-0">
							<li class="breadcrumb-item"><a href="<?= site_url('/') ?>">iGov</a></li>
							<li class="breadcrumb-item"><a href="<?= site_url('/central-registry')?>">Central Registry</a></li>
							<li class="breadcrumb-item active">Manage Mail</li>
						</ol>
					</div>
					<h4 class="page-title">Manage Mail</h4>
				</div>
			</div>
		</div>
		<!-- end page title -->
    <div class="row">
      <div class="col-12">
        <div class="card-box">
          <div class="row">
            <div class="col-lg-8">
              <h5>Manage <?=$mail['m_direction'] == 1 ? 'Incoming' : 'Outgoing' ?> Mail</h5>
            </div>
            <div class="col-lg-4">
              <div class="text-lg-right mt-3 mt-lg-0">
                <a href="<?=site_url('/central-registry')?>" type="button" class="btn btn-success waves-effect waves-light">Go Back</a>
              </div>
            </div><!-- end col-->
          </div> <!-- end row -->
        </div> <!-- end card-box -->
      </div><!-- end col-->
    </div>
    <div class="row">
      <div class="col-xl-8 col-lg-6">
        <!-- project card -->
        <div class="card d-block">
          <div class="card-body">
            <!-- project title-->
            <h3 class="mt-0 font-20">
							<?=$mail['m_subject']?>
            </h3>
            <div class="badge badge-success mb-3">
	            <?php
	            if ($mail['m_status'] == 0) echo 'Registered';
              elseif ($mail['m_status'] == 1) echo 'Filed';
              elseif ($mail['m_status'] == 2) echo 'Activated';
              elseif ($mail['m_status'] == 3) echo 'Deactivated';
              elseif ($mail['m_status'] == 4) echo 'Rejected';
	            ?>
            </div>
            <h5>Reference No</h5>
            <p class="text-muted mb-2">
		          <?=$mail['m_ref_no']?>
            </p>
            <h5>File Cabinet Number</h5>
            <p class="text-muted mb-2">
              <?php if ($mail['m_file_ref_no']):?>
	              <?=$mail['m_file_ref_no']?>
              <?php else:?>
                <em>Not yet filed</em>
              <?php endif;?>
            </p>
            <h5>Current Desk</h5>
            <p class="text-muted mb-2">
	            <?php if ($mail['holder']):?>
		            <?=$mail['holder']['user_name']?>
	            <?php else:?>
                <em>No holder assigned</em>
	            <?php endif;?>
            </p>
            <h5>Sender</h5>
            <p class="text-muted mb-2">
              <?=$mail['m_sender']?>
            </p>
            <div class="mb-4">
              <h5>Notes</h5>
              <p class="text-muted mb-2">
		            <?=$mail['m_notes']?>
              </p>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="mb-4">
                  <h5>Date of Correspondence</h5>
                  <p>
	                  <?php $date = date_create($mail['m_date_correspondence']);
	                  echo date_format($date,"d F Y");
	                  ?>
                  </p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-4">
                  <h5>Date Received</h5>
                  <p>
	                  <?php $date = date_create($mail['m_date_received']);
	                  echo date_format($date,"d F Y");
	                  ?>
                  </p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-4">
                  <h5>Stamped At</h5>
                  <p>
			              <?php $date = date_create($mail['created_at']);
			              echo date_format($date,"d F Y H:i a");
			              ?>
                  </p>
                </div>
              </div>
            </div>
          </div> <!-- end card-body-->
        </div> <!-- end card-->
      </div> <!-- end col -->
      <div class="col-lg-6 col-xl-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title mb-3">Actions</h5>
            <form id="mail-filing-form" class="needs-validation" novalidate onsubmit="fileMail(); return false;">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="file-ref-no">File <?=$mail['m_direction'] == 1 ? 'Incoming' : 'Outgoing' ?> Mail</label>
                    <input type="text" class="form-control" name="m_file_ref_no" id="file-ref-no" required/>
                    <div class="invalid-feedback">
                      Please enter a file cabinet number.
                    </div>
                    <span class="help-block">
                      <small>Please enter the new file cabinet number used to store this mail physically.</small>
                    </span>
                  </div>
                </div>
              </div>
              <input type="hidden" id="mail-id" value="<?=$mail['m_id']?>">
            </form>
            <form id="mail-transfer-form" class="needs-validation mt-3" novalidate>
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="mh-holder-id">Transfer <?=$mail['m_direction'] == 1 ? 'Incoming' : 'Outgoing' ?> Mail</label>
                    <select class="form-control input-lg" data-toggle="select2" id="mh-holder-id" onchange="transferMail()">
                      <option value="" selected disabled>Select</option>
                      <?php foreach ($mail['recipients'] as $recipient): if ($recipient['user_id'] != session()->user_id):?>
                        <option value="<?=$recipient['user_id']?>"><?=$recipient['user_name']?></option>
                      <?php endif; endforeach;?>
                    </select>
                    <div class="invalid-feedback">
                      Please select a new mail recipient.
                    </div>
                    <span class="help-block">
                      <small>Please select the new recipient to transfer the mail.</small>
                    </span>
                  </div>
                </div>
              </div>
              <input type="hidden" id="mail-id" value="<?=$mail['m_id']?>">
            </form>
          </div>
        </div>
        <!-- end card-->
        <div class="card">
          <div class="card-body">
            <h5 class="card-title mb-3">Attachments</h5>
	          <?php if(!empty($mail['attachments'])):
            foreach ($mail['attachments'] as $attachment):?>
              <div class="card mb-1 shadow-none border">
                <div class="p-2">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <div class="avatar-sm">
                      <span class="avatar-title badge-soft-primary text-primary rounded">
                         <?php echo strtoupper(substr($attachment['ma_link'], strpos($attachment['ma_link'], ".") + 1)); ?>
                      </span>
                      </div>
                    </div>
                    <div class="col pl-0">
                      <p class="mb-0 font-12"><?php
                        $filename = 'uploads/mails/'.$attachment['ma_link'];
                        $size = round(filesize($filename)/(1024 * 1024), 2);
                        echo $attachment['ma_link'] .'<br>';
                        echo $size."MB";
                        ?>
                      </p>
                    </div>
                    <div class="col-auto">
                      <!-- Button -->
                      <a href="<?='/uploads/mails/'.$attachment['ma_link']; ?>" download="<?=$attachment['ma_link']; ?>" target="_blank" class="btn btn-link font-16 text-muted">
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
<?=view('pages/central-registry/_central-registry-scripts.php')?>
<?= $this->endSection(); ?>
