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
              <a href="<?=site_url('/central-registry')?>" type="button" class="btn btn-danger waves-effect waves-light mr-2">Transfer Mail</a>
              <a href="javascript:void(0)" type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#standard-modal-3">File Mail</a>
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
            <div class="badge badge-secondary mb-3">Incoming</div>
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
              <em>Front Desk</em>
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
            <h5 class="card-title mb-3">Progress</h5>
            <div class="mt-3 chartjs-chart" style="height: 320px;">
              <canvas id="line-chart-example"></canvas>
            </div>
          </div>
        </div>
        <!-- end card-->

        <div class="card">
          <div class="card-body">
            <h5 class="card-title mb-3">Files</h5>

            <div class="card mb-1 shadow-none border">
              <div class="p-2">
                <div class="row align-items-center">
                  <div class="col-auto">
                    <div class="avatar-sm">
                                                            <span class="avatar-title badge-soft-primary text-primary rounded">
                                                                ZIP
                                                            </span>
                    </div>
                  </div>
                  <div class="col pl-0">
                    <a href="javascript:void(0);" class="text-muted font-weight-bold">Ubold-sketch-design.zip</a>
                    <p class="mb-0">2.3 MB</p>
                  </div>
                  <div class="col-auto">
                    <!-- Button -->
                    <a href="javascript:void(0);" class="btn btn-link btn-lg text-muted">
                      <i class="dripicons-download"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>

            <div class="card mb-1 shadow-none border">
              <div class="p-2">
                <div class="row align-items-center">
                  <div class="col-auto">
                    <div class="avatar-sm">
                                                            <span class="avatar-title badge-soft-primary text-primary rounded">
                                                                JPG
                                                            </span>
                    </div>
                  </div>
                  <div class="col pl-0">
                    <a href="javascript:void(0);" class="text-muted font-weight-bold">Dashboard-design.jpg</a>
                    <p class="mb-0">3.25 MB</p>
                  </div>
                  <div class="col-auto">
                    <!-- Button -->
                    <a href="javascript:void(0);" class="btn btn-link btn-lg text-muted">
                      <i class="dripicons-download"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>

            <div class="card mb-0 shadow-none border">
              <div class="p-2">
                <div class="row align-items-center">
                  <div class="col-auto">
                    <div class="avatar-sm">
                                                            <span class="avatar-title badge-soft-primary text-primary rounded">
                                                                MP4
                                                            </span>
                    </div>
                  </div>
                  <div class="col pl-0">
                    <a href="javascript:void(0);" class="text-muted font-weight-bold">Admin-bug-report.mp4</a>
                    <p class="mb-0">7.05 MB</p>
                  </div>
                  <div class="col-auto">
                    <!-- Button -->
                    <a href="javascript:void(0);" class="btn btn-link btn-lg text-muted">
                      <i class="dripicons-download"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    <div id="standard-modal-3" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <form id="mail-filing-form" class="needs-validation" novalidate>
            <div class="modal-header">
              <h4 class="modal-title" id="standard-modalLabel">File Mail</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="ver-code">File Cabinet Number</label>
                    <input type="text" class="form-control" name="m_file_ref_no" id="file-ref-no" required/>
                    <div class="invalid-feedback">
                      Please enter a file cabinet number.
                    </div>
                    <span class="help-block">
                      <small>Please enter the file cabinet number used to store this mail physically.</small>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
              <button type="button" onclick="fileMail()" class="btn btn-primary" id="save-btn">Submit</button>
            </div>
            <input type="hidden" id="mail-id" value="<?=$mail['m_id']?>">
          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
	</div>
<?= $this->endSection(); ?>
<?= $this->section('extra-scripts'); ?>
<?=view('pages/central-registry/_central-registry-scripts.php')?>
<?= $this->endSection(); ?>
