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
          <form method="post" action="">
            <div class="form-group">
              <label for="subject">Subject</label>
              <input type="text" id="subject" class="form-control">
            </div>
            <div id="snow-editor" style="height: 300px;">
            </div> <!-- end Snow-editor-->
            <div class="row g-3">
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

