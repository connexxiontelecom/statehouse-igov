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
              <h4 class="header-title mt-2 mb-4">Edit Notice Form</h4>
            </div>
            <div class="col-lg-4">
              <a href="<?=site_url('/my-notices')?>" type="button" class="btn btn-sm btn-primary float-right"> <i class="mdi mdi-arrow-left mr-2"></i>Go Back</a>
            </div>
          </div>
					<form class="needs-validation" id="edit-notice-form" novalidate>
						<div class="row">
							<div class="col-lg-8">
								<div class="form-group">
									<label for="subject">Subject</label>
									<input type="text" id="subject" class="form-control" name="subject" required value="<?=$notice['n_subject']?>">
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
											<option value="<?=$user['user_id']?>" <?=$notice['n_signed_by'] == $user['user_id'] ? 'selected': ''?>>
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
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label for="snow-editor">Body</label>
									<div id="snow-editor" class="form-control body" style="height: 500px;"><?=$notice['n_body']?></div> <!-- end Snow-editor-->
								</div>
							</div>
						</div>
						<div class="row g-3">
							<div class="col-lg-12 offset-lg-12">
								<div class="form-group mt-2">
									<button type="submit" class="ladda-button ladda-button-demo btn btn-primary btn-block" dir="ltr" data-style="zoom-in"">Submit</button>
								</div>
							</div>
						</div>
            <input type="hidden" value="<?=$notice['n_id']?>" name="n_id">
          </form>
				</div>
			</div>
		</div>
	</div>
</div>
<?= $this->endSection(); ?>

