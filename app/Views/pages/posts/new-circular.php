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
						<li class="breadcrumb-item"><a href="<?= site_url('/circulars')?>">circular Board</a></li>
						<li class="breadcrumb-item"><a href="<?= site_url('/my-circulars')?>">My circulars</a></li>
						<li class="breadcrumb-item active">New circular</li>
					</ol>
				</div>
				<h4 class="page-title">New circular</h4>
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
              <h4 class="header-title mt-2 mb-4">Create circular Form</h4>
            </div>
            <div class="col-lg-4">
              <a href="<?=site_url('/my-circulars')?>" type="button" class="btn btn-sm btn-primary float-right"> <i class="mdi mdi-arrow-left mr-2"></i>Go Back</a>
            </div>
          </div>
         
			<div class="row">
				<div class="col-sm-6">
					<div class="card bg-pattern">
						
						<div class="card-body p-4">
							
							<div class="text-center w-75 m-auto">
								<div class="auth-logo">
									<a href="<?=site_url('internal-circular'); ?>" class="logo logo-dark text-center">
                                            <span class="logo-lg">
                                                <i data-feather="download"></i>
                                            </span>
									</a>
									
									<a href="<?=site_url('internal-circular'); ?>" class="logo logo-light text-center">
                                             <span class="logo-lg">
                                                <i data-feather="download"></i>
                                            </span>
									</a>
								</div>
								<p class="text-muted mb-4 mt-3"> Internal circular</p>
							
							
							</div>
						
						
						
						
						
						</div> <!-- end card-body -->
					</div>
				</div>
				
				<div class="col-sm-6">
					<div class="card bg-pattern">
						
						<div class="card-body p-4">
							
							<div class="text-center w-75 m-auto">
								<div class="auth-logo">
									<a href="<?=site_url('external-circular'); ?>" class="logo logo-dark text-center">
                                             <span class="logo-lg">
                                                <i data-feather="upload"></i>
                                            </span>
									</a>
									
									<a href="<?=site_url('external-circular'); ?>" class="logo logo-light text-center">
                                             <span class="logo-lg">
                                                <i data-feather="upload"></i>
                                            </span>
									</a>
								</div>
								<p class="text-muted mb-4 mt-3"> External circular</p>
							
							
							</div>
						
						
						
						
						
						</div> <!-- end card-body -->
					</div>
				</div>
				
			</div>
        
        
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('extra-scripts'); ?>

<?= $this->endSection(); ?>
