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
            <li class="breadcrumb-item"><a href="<?= site_url('registries')?>">Registry</a></li>
            <li class="breadcrumb-item active">Mail Transfer Requests</li>
          </ol>
        </div>
        <h4 class="page-title">Mail Transfer Requests</h4>
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
              <h4 class="header-title">All My Mail Transfer Requests</h4>
              <p class="text-muted font-13">
                Below are the mails and correspondence that have been transferred to you. Please ensure you possess physical copies before confirming.
              </p>
            </div>
            <div class="col-lg-4">
              <div class="text-lg-right mt-3 mt-lg-0">
                <a href="<?=site_url('/correspondence')?>" type="button" class="btn btn-success waves-effect waves-light">Go Back</a>
              </div>
            </div><!-- end col-->
          </div> <!-- end row -->
          <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap w-100">
            <thead>
            <tr>
              <th class="text-center" style="width: 5%">S/n</th>
              <th>Mail Subject</th>
              <th>Mail Ref No.</th>
              <th>Mail Sender</th>
              <th>Mail Registry</th>
              <th style="width: 12%;">Transfer From</th>
              <th style="width: 10%;">Transferred At</th>
              <th class="text-center" style="width: 5%">Actions</th>
            </tr>
            </thead>
            <tbody>
						<?php $i=1; foreach ($transfer_requests as $transfer_request):?>
              <tr>
                <td><?=$i; $i++;?></td>
                <td><?=$transfer_request['mail']['m_subject']?></td>
                <td><?=$transfer_request['mail']['m_ref_no']?></td>
                <td><?=$transfer_request['mail']['m_sender']?></td>
                <td><?=$transfer_request['registry']['registry_name']?></td>
                <td><?=$transfer_request['transfer_from']['user_name']?></td>
                <td>
									<?php $date = date_create($transfer_request['created_at']);
									echo date_format($date,"d M Y H:i a");
									?>
                </td>
                <td class="text-center">
                  <a href="javascript:void(0)" onclick="confirmTransfer(<?=$transfer_request['mt_id']?>, <?=$transfer_request['registry']['registry_id']?>)" data-toggle="tooltip" data-placement="left" title data-original-title="Confirm Transfer">
                    <i data-feather="check-circle" class="icon-dual-success"></i>.
                  </a>
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