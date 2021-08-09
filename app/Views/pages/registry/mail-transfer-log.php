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
            <li class="breadcrumb-item"><a href="<?= site_url('/registry')?>">Registry</a></li>
            <li class="breadcrumb-item"><a href="<?= site_url('/view-registry/').$mail['registry']['registry_id']?>">View Registry</a></li>
            <li class="breadcrumb-item active">Mail Transfer Log</li>
          </ol>
        </div>
        <h4 class="page-title">Mail Transfer Log</h4>
      </div>
    </div>
  </div>
  <!-- end page title -->
  <div class="row">
    <div class="col-12">
      <div class="card-box">
        <div class="row">
          <div class="col-lg-8">
            <h5><?=$mail['m_subject']?></h5>
          </div>
          <div class="col-lg-4">
            <div class="text-lg-right mt-3 mt-lg-0">
              <a href="<?=site_url('view-filing-log/').$mail['m_id']?>" type="button" class="btn btn-danger waves-effect waves-light mr-1">View Mail Filing Log</a>
              <a href="<?=site_url('/view-registry/').$mail['registry']['registry_id']?>" type="button" class="btn btn-success waves-effect waves-light">Go Back</a>
            </div>
          </div><!-- end col-->
        </div> <!-- end row -->
      </div> <!-- end card-box -->
    </div><!-- end col-->
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-8">
              <h4 class="header-title">All Mail Transfers</h4>
              <p class="text-muted font-13">
                Below is an audit log representing the transfer history of this mail in the organization.
              </p>
            </div>
            <div class="col-lg-4">
              <a href="<?=site_url('manage-mail/').$mail['m_id']?>" type="button" class="btn btn-success waves-effect waves-light float-right">Manage Mail</a>
            </div>
          </div> <!-- end row -->
          <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap w-100">
            <thead>
            <tr>
              <th class="text-center" style="width: 5%">S/n</th>
              <th>Transferred From</th>
              <th>Transferred To</th>
              <th style="width: 10%">Transferred At</th>
              <th style="width: 10%">Confirmed At</th>
              <th style="width: 5%">Status</th>
            </tr>
            </thead>
            <tbody>
						<?php $i=1; foreach ($transfer_logs as $transfer_log):?>
              <tr>
                <td><?=$i; $i++;?></td>
                <td><?=$transfer_log['transfer_from']['user_name']?></td>
                <td><?=$transfer_log['transfer_to']['user_name']?></td>
                <td>
	                <?php $date = date_create($transfer_log['created_at']);
	                echo date_format($date,"d M Y H:i a");
	                ?>
                </td>
                <td>
	                <?php
                    if (isset($transfer_log['mt_confirmed_at'])) {
	                    $date = date_create($transfer_log['mt_confirmed_at']);
	                    echo date_format($date,"d M Y H:i a");
                    }
	                ?></td>
                <td class="text-center">
		              <?php
		              if ($transfer_log['mt_status'] == 1) echo '<span class="badge badge-soft-success badge-pill">Confirmed</span>';
                  elseif ($transfer_log['mt_status'] == 0) echo '<span class="badge badge-soft-warning badge-pill">Unconfirmed</span>';
		              ?>
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
<?=view('pages/registry/_registry-scripts.php')?>

<?= $this->endSection(); ?>