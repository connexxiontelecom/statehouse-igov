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
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-8">
              <h4 class="header-title">All Mails</h4>
              <p class="text-muted font-13">
                Below are the registered correspondence that can be managed here.
              </p>
            </div>
            <div class="col-lg-4">
              <div class="text-lg-right mt-lg-0">
                <div class="btn-group mr-2">
                  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-plus-circle mr-1"></i> New Correspondence</button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?=site_url('incoming-mail')?>">New Incoming Mail</a>
                    <a class="dropdown-item" href="<?= site_url('outgoing-mail')?>">New Outgoing Mail</a>
                  </div>
                </div>
                <div class="btn-group">
                  <button type="button" class="btn btn-primary">All</button>
                </div>
                <div class="btn-group">
                  <button type="button" class="btn btn-light">Incoming</button>
                  <button type="button" class="btn btn-light">Outgoing</button>
                </div>
              </div>
            </div><!-- end col-->
          </div> <!-- end row -->
          <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap w-100">
            <thead>
            <tr>
              <th class="text-center" style="width: 5%">S/n</th>
              <th>Ref No.</th>
              <th>Subject</th>
              <th>Sender</th>
              <th>Received</th>
              <th>Status</th>
              <th class="text-center" style="width: 10%">Actions</th>
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
                <td>
		              <?php
		              if ($mail['m_status'] == 0) echo 'Registered';
                  elseif ($mail['m_status'] == 1) echo 'Filed';
                  elseif ($mail['m_status'] == 2) echo 'Activated';
                  elseif ($mail['m_status'] == 3) echo 'Deactivated';
                  elseif ($mail['m_status'] == 4) echo 'Rejected';
		              ?>
                </td>
                <td class="text-center">
                  <a href="<?=site_url('manage-mail/').$mail['m_id']?>">Manage</a>
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
