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
						<li class="breadcrumb-item"><a href="javascript: void(0);">Central Registry</a></li>
					</ol>
				</div>
				<h4 class="page-title">Central Registry</h4>
			</div>
		</div>
	</div>
	<!-- end page title -->
  <div class="row">
    <div class="col-12">
      <div class="card-box">
        <div class="row">
          <div class="col-lg-8">
            <form class="form-inline" method="get">
              <div class="form-group">
                <div class="input-group">
                  <label for="inputPassword2" class="sr-only">Search</label>
                  <input type="search" class="form-control" id="inputPassword2" placeholder="Search..." name="search_params">
                  <div class="input-group-append">
                    <button class="btn btn-success waves-effect waves-light" type="submit">Search</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="col-lg-4">
            <div class="text-lg-right mt-sm-2 mt-lg-0">
              <div class="btn-group mr-3">
                <button type="button" class="btn btn-primary">All</button>
                <button type="button" class="btn btn-light">Incoming</button>
                <button type="button" class="btn btn-light">Outgoing</button>
              </div>
              <div class="btn-group">
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-plus-circle mr-1"></i> New Correspondence</button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="<?=site_url('incoming-mail')?>">New Incoming Mail</a>
                  <a class="dropdown-item" href="<?= site_url('external-memo')?>">New Outgoing Mail</a>
                </div>
              </div>
            </div>
          </div><!-- end col-->
        </div> <!-- end row -->
      </div> <!-- end card-box -->
    </div><!-- end col-->
  </div>
  <!-- end row-->
</div>
<?= $this->endSection(); ?>
