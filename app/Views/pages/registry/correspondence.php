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
            <li class="breadcrumb-item"><a href="javascript:void(0)">e-Office</a></li>
            <li class="breadcrumb-item active">Correspondence</li>
					</ol>
				</div>
				<h4 class="page-title">Correspondence</h4>
			</div>
		</div>
	</div>
	<!-- end page title -->
  <div class="row">
    <div class="col-12">
      <div class="card-box">
        <div class="row">
          <div class="col-lg-8">
            <h4 class="header-title">All Mails</h4>
            <p class="text-muted font-13">
              Below are the registered correspondence currently at your desk or filed by you.
            </p>
          </div>
          <div class="col-lg-4">
            <div class="text-lg-right mt-3 mt-lg-0">
              <?php if (!empty($transfer_requests)):?>
                <a href="<?=site_url('/mail-transfer-requests')?>" type="button" class="btn btn-danger waves-effect waves-light">Transfer Requests</a>
              <?php endif?>
            </div>
          </div><!-- end col-->
        </div> <!-- end row -->

        <div class="row">
          <div class="col-12">
            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap w-100">
              <thead>
              <tr>
                <th class="text-center" style="width: 5%">S/n</th>
                <th>Ref No.</th>
                <th>Subject</th>
                <th>Sender</th>
                <th style="width: 10%">Received</th>
                <th class="text-center" style="width: 5%">Direction</th>
                <th class="text-center" style="width: 5%">Status</th>
                <th class="text-center" style="width: 5%">Actions</th>
              </tr>
              </thead>
              <tbody>
		          <?php $i=1; foreach ($mails as $mail):?>
                <tr>
                  <td><?=$i; $i++;?></td>
                  <td><?=$mail['m_ref_no']?></td>
                  <td><?=$mail['m_subject']?></td>
                  <td><?=$mail['m_sender']?></td>
                  <td>
					          <?php $date = date_create($mail['m_date_received']);
					          echo date_format($date,"d M Y");
					          ?>
                  </td>
                  <td class="text-center">
					          <?=
					          $mail['m_direction'] == 1
						          ? '<span class="badge badge-outline-blue badge-pill">Incoming</span>'
						          : '<span class="badge badge-outline-dark badge-pill">Outgoing</span>'
					          ?>
                  </td>
                  <td class="text-center">
					          <?php
					          if ($mail['m_status'] == 0) echo '<span class="badge badge-soft-primary badge-pill">Registered</span>';
                    elseif ($mail['m_status'] == 1) echo '<span class="badge badge-soft-secondary badge-pill">In Transit</span>';
                    elseif ($mail['m_status'] == 2) echo '<span class="badge badge-soft-warning badge-pill">Received</span>';
                    elseif ($mail['m_status'] == 3) echo '<span class="badge badge-soft-success badge-pill">Filed</span>';
                    elseif ($mail['m_status'] == 4) echo 'Rejected';
					          ?>
                  </td>
                  <td class="text-center">
                    <a href="<?=site_url('manage-mail/').$mail['m_id']?>" data-toggle="tooltip" data-placement="left" title data-original-title="Manage Mail">
                      <i data-feather="edit-3" class="icon-dual"></i>.
                    </a>
                    <a href="<?=site_url('view-transfer-log/').$mail['m_id']?>" data-toggle="tooltip" data-placement="left" title data-original-title="View Log">
                      <i data-feather="file-text" class="icon-dual"></i>.
                    </a>
                  </td>
                </tr>
		          <?php endforeach;?>
              </tbody>
            </table>
          </div> <!-- end card -->
        </div>
      </div>
    </div>
  </div>
  <div id="warning-alert-modal-3" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
      <div class="modal-content">
        <div class="modal-body p-4">
          <div class="text-center">
            <i class="dripicons-warning h1 text-danger"></i>
            <h4 class="mt-2">Pending Transfer Requests</h4>
            <p class="mt-3">There are transfers still awaiting your confirmation. Please click on continue below to attend to these pending requests.</p>
            <a href="<?=site_url('/mail-transfer-requests')?>" type="button" class="btn btn-danger my-2">Continue</a>
          </div>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
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
  <script>
    $(document).ready(() => {
    <?php if (session()->getFlashdata('transfer_requests')):?>
      jQuery.noConflict()
      $('#warning-alert-modal-3').modal('show');
			<?php endif;?>
    })
  </script>
<?=view('pages/registry/_registry-scripts.php')?>

<?= $this->endSection(); ?>