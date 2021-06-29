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
						<li class="breadcrumb-item active">My Notices</li>
					</ol>
				</div>
				<h4 class="page-title">My Notices</h4>
			</div>
		</div>
	</div>
	<!-- end page title -->
	<div class="row mb-2">
		<div class="col-lg-8"></div>
		<div class="col-lg-2">
      <a href="<?=site_url('/notices')?>" type="button" class="btn btn-dark btn-block"> <i class="mdi mdi-arrow-left mr-2"></i>Go Back</a>
    </div>
		<div class="col-lg-2">
			<a href="<?=site_url('/new-notice')?>" type="button" class="btn btn-dark btn-block"> <i class="mdi mdi-plus mr-2"></i>New Notice</a>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<?php if(session()->has('success')): ?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<i class="mdi mdi-check-all mr-2"></i>
							<strong>
								<?=session()->get('success')?>
							</strong>
						</div>
					<?php elseif (session()->has('error')): ?>
						<div class="alert alert-warning alert-dismissible fade show" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<i class="mdi mdi-check-all mr-2"></i>
							<strong>
								<?=session()->get('error')?>
							</strong>
						</div>
					<?php endif; ?>

          <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap w-100">
            <thead>
            <tr>
              <th>S/n</th>
              <th>Subject</th>
              <th>Signed By</th>
              <th>Status</th>
              <th>Created</th>
              <th class="text-center" style="width: 10%">Actions</th>
            </tr>
            </thead>
            <tbody>
              <?php $i=1; foreach ($notices as $notice):?>
                <tr>
                  <td><?=$i; $i++;?></td>
                  <td><?=$notice['n_subject']?></td>
                  <td><?=$notice['signed_by']['user_name']?></td>
                  <td>
                    <?php
                    if ($notice['n_status'] == 0) echo 'Pending';
                    elseif ($notice['n_status'] == 1) echo 'Confirmed';
                    elseif ($notice['n_status'] == 2) echo 'Activated';
                    elseif ($notice['n_status'] == 3) echo 'Deactivated';
                    elseif ($notice['n_status'] == 4) echo 'Rejected';
                    ?>
                  </td>
                  <td>
                    <?php $date = date_create($notice['created_at']);
                      echo date_format($date,"d M Y H:i a");
                    ?>
                  </td>
                  <td class="text-center">
                    <a href="" class="mr-2">View</a>
                    <?php if($notice['n_status'] == 0):?>
                      <a href="">Edit</a>
                    <?php endif;?>
                  </td>
                </tr>
              <?php endforeach;?>
            </tbody>
          </table>
        </div> <!-- end card body-->
			</div> <!-- end card -->
		</div><!-- end col-->
	</div>

</div>
<?= $this->endSection(); ?>

