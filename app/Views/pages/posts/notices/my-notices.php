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
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
          <div class="row">
            <div class="col-lg-8">
              <h4 class="header-title">All My Notices</h4>
              <p class="text-muted font-13">
                Below are all the notices you have written including memos that are signed, unsigned, deactivated or rejected.
              </p>
            </div>
            <div class="col-lg-4">
              <div class="text-lg-right mt-lg-0">
                <a href="<?=site_url('/new-notice')?>" type="button" class="btn btn-success waves-effect waves-light mr-1"><i class="mdi mdi-plus-circle mr-1"></i> Add New</a>
                <a href="<?=site_url('/notices')?>" type="button" class="btn btn-success waves-effect waves-light">Go Back</a>
              </div>
            </div>
          </div>
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
                  <td><?=$notice['p_subject']?></td>
                  <td><?=$notice['signed_by']['user_name']?></td>
                  <td>
                    <?php
                    if ($notice['p_status'] == 0) echo 'Pending';
                    elseif ($notice['p_status'] == 1) echo 'Confirmed';
                    elseif ($notice['p_status'] == 2) echo 'Activated';
                    elseif ($notice['p_status'] == 3) echo 'Deactivated';
                    elseif ($notice['p_status'] == 4) echo 'Rejected';
                    ?>
                  </td>
                  <td>
                    <?php $date = date_create($notice['p_date']);
                      echo date_format($date,"d M Y H:i a");
                    ?>
                  </td>
                  <td class="text-center">
                    <a href="<?=site_url('view-notice/').$notice['p_id']?>" class="mr-2">View</a>
                    <?php if($notice['p_status'] == 0):?>
                      <a href="<?=site_url('edit-notice/').$notice['p_id']?>">Edit</a>
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
<?= $this->section('extra-scripts'); ?>
<!-- third party js -->
<script src="/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<script src="/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="/assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="/assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
<script src="/assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="/assets/libs/pdfmake/build/vfs_fonts.js"></script>
<!-- third party js ends -->

<!-- Datatables init -->
<script src="/assets/js/pages/datatables.init.js"></script>
<?= $this->endSection(); ?>
