<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
	<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box">
				<div class="page-title-right">
					<ol class="breadcrumb m-0">
						<li class="breadcrumb-item"><a href="<?= site_url('office') ?>">iGov</a></li>
						<li class="breadcrumb-item"><a href="javascript: void(0);">Fleet Settings</a></li>
						<li class="breadcrumb-item active">Renewal Types</li>
					</ol>
				</div>
				<h4 class="page-title">Renewal Types</h4>
			</div>
		</div>
	</div>
	<!-- end page title -->
	<div class="row" style="margin-top: -50px">
		<div class="col-xl-12">
			<div class="card">
				<div class="card-body">
					<?php if(session()->has('action')): ?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<i class="mdi mdi-check-all mr-2"></i><strong>Action Successful !</strong>
						</div>
					<?php endif; ?>
					<div>
						<a href="javascript:void(0)" type="button" class="btn btn-primary" data-toggle="modal" data-target="#new-renewal-type" style="float: right"> <i class="mdi mdi-plus mr-2"></i>New Renewal Type</a>
					</div>
					<table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
						<thead>
						<tr>
							<th>S/N</th>
							<th>Renewal Type Name</th>
							<th>Actions</th>
						</tr>
						</thead>
						<tbody>
						<?php if ($renewal_types):
							$i = 1;
							foreach ($renewal_types as $renewal_type):
								?>
                <tr>
                  <td><?=$i++;?></td>
                  <td><?=$renewal_type['frt_name']?></td>
                  <td>
                    <a href="javascript:void(0)" type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit-renewal-type-<?=$renewal_type['frt_id']?>"><i class="mdi mdi-pen-lock"></i></a>
                  </td>
                </tr>
							<?php endforeach; endif;?>
            </tbody>
					</table>
				</div> <!-- end card-body -->
			</div> <!-- end card-->
		</div> <!-- end col -->
	</div>
</div>
<!-- Long Content Scroll Modal -->
<div class="modal fade" id="new-renewal-type" tabindex="-1" role="dialog"
     aria-labelledby="scrollableModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="scrollableModalTitle">New Renewal Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="">
          <div class="row g-3 align-center">
            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-label" for="site-name">Renewal Type Name</label>
                <span class="form-note">Enter Renewal Type Name</span>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <div class="form-control-wrap">
                  <input type="text" class="form-control" id="site-name" name="frt_name" required>
                </div>
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
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php foreach ($renewal_types as $renewal_type):?>
  <div class="modal fade" id="edit-renewal-type-<?=$renewal_type['frt_id']?>" tabindex="-1" role="dialog"
       aria-labelledby="scrollableModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="scrollableModalTitle">Edit Renewal Type</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="">
            <div class="row g-3 align-center">
              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-label" for="site-name">Renewal Type Name</label>
                  <span class="form-note">Enter Renewal Type Name</span>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group">
                  <div class="form-control-wrap">
                    <input type="text" class="form-control" id="site-name" name="frt_name" value="<?=$renewal_type['frt_name']?>" required>
                    <input type="hidden" name="frt_id" value="<?=$renewal_type['frt_id']?>">
                  </div>
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
          </form>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<?php endforeach; ?>

<?= $this->endSection() ?>

