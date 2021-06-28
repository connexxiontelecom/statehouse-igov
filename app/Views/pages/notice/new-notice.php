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
						<li class="breadcrumb-item"><a href="<?= site_url('/notices')?>">Notices</a></li>
						<li class="breadcrumb-item active">New Notice</li>
					</ol>
				</div>
				<h4 class="page-title">New Notice</h4>
			</div>
		</div>
	</div>
	<!-- end page title -->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <form class="needs-validation" method="post" id="new-notice-form" novalidate>
            <div class="row">
              <div class="col-lg-8">
                <div class="form-group">
                  <label for="subject">Subject</label>
                  <input type="text" id="subject" class="form-control" name="subject" required>
                  <div class="invalid-feedback">
                    Please enter a subject.
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label for="signed-by">Signed By</label>
                  <select class="form-control" id="signed-by" name="signed_by" required>
                    <option value="">Select user</option>
                    <?php foreach($signed_by as $user): ?>
                      <option value="<?=$user['user_id']?>">
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
            <div class="row mt-n4">
              <div class="col-12">
                <div class="form-group">
                  <label for="snow-editor">Body</label>
                  <textarea id="snow-editor" class="form-control body" style="height: 500px;" name="body" required></textarea> <!-- end Snow-editor-->
                  <div class="invalid-feedback">
                    Please enter a body.
                  </div>
                </div>
              </div>
            </div>
            <div class="row g-3 mt-n4 mb-n4">
              <div class="col-lg-12 offset-lg-12">
                <div class="form-group mt-2">
                  <button type="submit" class="ladda-button ladda-button-demo btn btn-primary btn-block" dir="ltr" data-style="zoom-in"">Submit</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>

