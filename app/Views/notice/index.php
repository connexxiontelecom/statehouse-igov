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
							<li class="breadcrumb-item active">Notices</li>
						</ol>
					</div>
					<h4 class="page-title">Notices</h4>
				</div>
			</div>
		</div>
		<!-- end page title -->
    <div class="row">
      <div class="col-12">
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
              <a href="<?=site_url('/new_notice')?>" type="button" class="btn btn-primary" style="float: right"> <i class="mdi mdi-plus mr-2"></i>New Notice</a>
            </div>
            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
              <thead>
              <tr>
                <th>S/N</th>
                <th>Subject</th>
                <th>Signed By</th>
                <th>Status</th>
                <th>Created</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
							<?php if(!empty($notices)):
								$sn = 1;
								foreach ($notices as $notice):
									?>
                  <tr>
                    <td><?=$sn++; ?></td>
                    <td><?=$notice['n_subject'] ?></td>
                    <td><?=$notice['n_signed_by'] ?></td>
                    <td><?=$notice['n_status'] ?></td>
                    <td><?=$notice['created_at'] ?></td>
                    <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit-department<?=$notice['n_id'] ?>" > <i class="mdi mdi-pen-lock mr-2"></i></button></td>
                  </tr>
								<?php endforeach;
							endif; ?>
              </tbody>
            </table>
          </div> <!-- end card body-->
        </div> <!-- end card -->
      </div><!-- end col-->
    </div>

	</div>
<?= $this->endSection(); ?>

