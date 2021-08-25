<?= $this->extend('layouts/master'); ?>
<?=$this->section('extra-styles'); ?>
<link href="/assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
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
						<li class="breadcrumb-item"><a href="<?= site_url('/registry')?>">Registry</a></li>
						<li class="breadcrumb-item active">Incoming Mail</li>
					</ol>
				</div>
				<h4 class="page-title">Incoming Mail</h4>
			</div>
		</div>
	</div>
	<!-- end page title -->
  <div class="row">
    <div class="col-12">
      <div class="card-box">
        <div class="row">
          <div class="col-lg-8">
            <h5 style="text-transform: capitalize">New <?=$registry['registry_name']?> Incoming Mail</h5>
          </div>
          <div class="col-lg-4">
            <div class="text-lg-right mt-3 mt-lg-0">
              <a href="<?=site_url('/view-registry/').$registry['registry_id']?>" type="button" class="btn btn-success waves-effect waves-light">Go Back</a>
            </div>
          </div><!-- end col-->
        </div> <!-- end row -->
      </div> <!-- end card-box -->
    </div><!-- end col-->
  </div>
  <form class="needs-validation" id="new-incoming-mail-form" novalidate>
    <div class="row">
      <div class="col-lg-6">
        <div class="card-box">
          <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Mail Details</h5>
          <div class="form-group">
            <label for="ref-no">Reference No</label><span style="color: red"> *</span>
            <input type="text" class="form-control" id="ref-no" name="m_ref_no" required>
            <div class="invalid-feedback">
              Please enter a reference number.
            </div>
          </div>
          <div class="form-group">
            <label for="subject">Subject</label><span style="color: red"> *</span>
            <input type="text" id="subject" class="form-control" name="m_subject" required>
            <div class="invalid-feedback">
              Please enter a subject.
            </div>
          </div>
          <div class="form-group">
            <label for="sender">Received From</label><span style="color: red"> *</span>
            <input type="text" id="sender" class="form-control" name="m_sender" required>
            <div class="invalid-feedback">
              Please enter a sender.
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <!-- Date View -->
              <div class="form-group">
                <label for="date-correspondence">Date of Correspondence</label><span style="color: red"> *</span>
                <input type="date" class="form-control" id="date-correspondence" name="m_date_correspondence" required>
                <div class="invalid-feedback">
                  Please select a date of correspondence.
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <!-- Date View -->
              <div class="form-group">
                <label for="date-received">Date Received</label><span style="color: red"> *</span>
                <input type="date" class="form-control" id="date-received" name="m_date_received" required value="<?=date('Y-m-d')?>">
                <div class="invalid-feedback">
                  Please select a date received.
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="notes">Notes</label>
            <textarea class="form-control" id="notes" rows="5" name="m_notes"></textarea>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card-box">
          <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">Attachments</h5>
          <p class="text-muted font-14">You can scan and attach the contents of the mail here.</p>
          <div id="myId" class="dropzone">
            <div class="dz-message needsclick">
              <i class="hi text-muted dripicons-cloud-upload"></i>
              <h3>Drop scanned & other documents here...</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
    <input type="hidden" value="<?=$registry['registry_id']?>" id="registry-id">
    <div class="row">
      <div class="col-12 text-center">
        <button class="btn btn-success waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> Register</button>
        <a href="<?=site_url('view-registry/').$registry['registry_id']?>" type="button" class="btn btn-danger waves-effect waves-light m-1"><i class="fe-x mr-1"></i> Cancel</a>
      </div>
    </div>
  </form>
</div>
<?= $this->endSection(); ?>
<?= $this->section('extra-scripts'); ?>
<?=view('pages/registry/_registry-scripts.php')?>
<script src="/assets/libs/dropzone/min/dropzone.min.js"></script>
<?= $this->endSection(); ?>