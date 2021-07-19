<?= $this->extend('layouts/master'); ?>
<?=$this->section('extra-styles'); ?>
<link href="/assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/dropify/css/dropify.min.css" rel="stylesheet" type="text/css" />
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
						<li class="breadcrumb-item"><a href="javascript: void(0);">Messaging</a></li>
						<li class="breadcrumb-item"><a href="<?= site_url('/notices')?>">Notice Board</a></li>
						<li class="breadcrumb-item"><a href="<?= site_url('/my-notices')?>">My Notices</a></li>
						<li class="breadcrumb-item active">Edit Notice</li>
					</ol>
				</div>
				<h4 class="page-title">Edit Notice</h4>
			</div>
		</div>
	</div>
	<!-- end page title -->
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
          <div class="row">
            <div class="col-lg-8">
              <h4 class="header-title">Edit Notice Form</h4>
            </div>
            <div class="col-lg-4">
              <a href="<?=site_url('/my-notices')?>" type="button" class="btn btn-success float-right">Go Back</a>
            </div>
          </div>
					<form class="needs-validation" id="edit-notice-form" novalidate>
						<div class="row">
              <div class="col-lg-4">
                <div class="form-group">
                  <label for="ref-no">Reference No</label><span style="color: red"> *</span>
                  <input type="text" class="form-control" id="ref-no" name="p_ref_no" value="<?=$notice['p_ref_no']?>" required>
                  <div class="invalid-feedback">
                    Please enter a reference number.
                  </div>
                </div>
              </div>
							<div class="col-lg-8">
								<div class="form-group">
									<label for="subject">Subject</label><span style="color: red"> *</span>
									<input type="text" id="subject" class="form-control" name="p_subject" required value="<?=$notice['p_subject']?>">
									<div class="invalid-feedback">
										Please enter a subject.
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label for="snow-editor">Body</label><span style="color: red"> *</span>
									<div id="snow-editor" class="form-control body" style="height: 500px;"><?=$notice['p_body']?></div> <!-- end Snow-editor-->
								</div>
							</div>
						</div>
            <div class="row mb-2">
              <div class="col-lg-12">
                <div id="myId" class="dropzone">
                  <div class="dz-message needsclick">
                    <i class="hi text-muted dripicons-cloud-upload"></i>
                    <h3>Drop all other relevant attachments here...</h3>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-4">
                <div class="form-group">
                  <label for="signed-by">Signed By</label><span style="color: red"> *</span>
                  <select class="form-control" id="signed-by" name="p_signed_by" required>
                    <option value="">Select user</option>
				            <?php foreach($signed_by as $user): ?>
                      <option value="<?=$user['user_id']?>" <?=$notice['p_signed_by'] == $user['user_id'] ? 'selected': ''?>>
						            <?=$user['user_name'];?>
                      </option>
				            <?php endforeach;?>
                  </select>
                  <div class="invalid-feedback">
                    Please select the signer.
                  </div>
                </div>
              </div>
            </div>
						<div class="row g-3">
							<div class="col-lg-12 offset-lg-12">
								<div class="form-group mt-2">
									<button type="button" onclick="editNotice()" class="btn btn-primary btn-block">Submit</button>
								</div>
							</div>
						</div>
            <input type="hidden" value="<?=$notice['p_id']?>" name="notice_id">
          </form>
				</div>
			</div>
		</div>
	</div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('extra-scripts'); ?>
<?=view('pages/posts/notices/_notice-scripts.php')?>
<script src="/assets/libs/dropzone/min/dropzone.min.js"></script>
<script src="/assets/libs/dropify/js/dropify.min.js"></script>
<?= $this->endSection(); ?>
