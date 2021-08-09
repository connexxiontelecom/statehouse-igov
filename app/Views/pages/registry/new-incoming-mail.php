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
						<li class="breadcrumb-item active">New Incoming Mail</li>
					</ol>
				</div>
				<h4 class="page-title">New Incoming Mail</h4>
			</div>
		</div>
	</div>
	<!-- end page title -->
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-lg-8">
                <h4 class="header-title mt-2 mb-4">Register Incoming Mail Form</h4>
              </div>
              <div class="col-lg-4">
                <a href="<?=site_url('/central-registry')?>" type="button" class="btn btn-success float-right">Go Back</a>
              </div>
            </div>
            <form class="needs-validation" id="new-incoming-mail-form" novalidate>
              <div class="row">
                <div class="col-xl-6">
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
                        <input type="date" class="form-control" id="date-received" name="m_date_received" required>
                        <div class="invalid-feedback">
                          Please select a date received.
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="m-registry-id">Mail Registry</label><span style="color: red"> *</span>
                    <select class="form-control input-lg" data-toggle="select2" id="m-registry-id" name="m_registry_id" required>
                      <option value="" selected disabled>Select</option>
		                  <?php foreach ($registries as $registry): ?>
                        <option value="<?=$registry['registry_id']?>">
				                  <?=$registry['registry_name']?>
                        </option>
		                  <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                      Please select the corresponding mail registry.
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="notes">Notes</label>
                    <textarea class="form-control" id="notes" rows="5" name="m_notes"></textarea>
                  </div>
                </div> <!-- end col-->
                <div class="col-xl-6">
                  <div class="form-group mt-3 mt-xl-0">
                    <label for="projectname" class="mb-0">Attachments</label>
                    <p class="text-muted font-14">You can scan and attach the contents of the mail here.</p>
                    <div id="myId" class="dropzone">
                      <div class="dz-message needsclick">
                        <i class="hi text-muted dripicons-cloud-upload"></i>
                        <h3>Drop scanned & other documents here...</h3>
                      </div>
                    </div>
                  </div>
                </div> <!-- end col-->
              </div>
              <div class="row mt-3">
                <div class="col-12 text-center">
                  <button class="btn btn-success waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> Register</button>
                  <a href="<?=site_url('registry')?>" type="button" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> Cancel</a>
                </div>
              </div>
            </form>
          </div> <!-- end card-body -->
        </div> <!-- end card-->
      </div> <!-- end col-->
    </div>
    <!-- end row-->

  </div> <!-- container -->

</div>
<?= $this->endSection(); ?>
<?= $this->section('extra-scripts'); ?>
<?=view('pages/registry/_registry-scripts.php')?>
<script src="/assets/libs/dropzone/min/dropzone.min.js"></script>
<?= $this->endSection(); ?>