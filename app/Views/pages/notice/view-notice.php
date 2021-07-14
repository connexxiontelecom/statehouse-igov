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
						<li class="breadcrumb-item active">View Notice</li>
					</ol>
				</div>
				<h4 class="page-title">View Notice</h4>
			</div>
		</div>
	</div>
	<!-- end page title -->
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
          <div class="row d-print-none">
            <div class="col-lg-8">
              <h4 class="header-title mt-2 mb-4"></h4>
            </div>
            <div class="col-lg-4">
              <a href="<?=site_url('/my-notices')?>" type="button" class="btn btn-sm btn-primary float-right"> <i class="mdi mdi-arrow-left mr-2"></i>Go Back</a>
              <a href="javascript:window.print()" type="button" class="btn btn-primary btn-sm waves-effect waves-light float-right mr-2"><i class="mdi mdi-printer"></i></a>
            </div>
          </div>
          <div class="row">
            <div class="col-12 p-5">
              <h2 class="title text-center"><?=$notice['n_subject']?></h2>
	            <?=$notice['n_body']?>
              <div class="text-center">
                <p>Signed By:</p>
                <?=$notice['signed_by']['user_name']?>
              </div>
            </div>
          </div>
				</div>
			</div>
		</div>
	</div>
</div>
<?= $this->endSection(); ?>

