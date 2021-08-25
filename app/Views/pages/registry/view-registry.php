<?= $this->extend('layouts/master'); ?>
<?= $this->section('content');
  $uri = current_url(true);
?>
<div class="container-fluid">
	<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box">
				<div class="page-title-right">
					<ol class="breadcrumb m-0">
						<li class="breadcrumb-item"><a href="<?= site_url('/') ?>">iGov</a></li>
						<li class="breadcrumb-item"><a href="<?=site_url('/registry')?>">Registry</a></li>
						<li class="breadcrumb-item active"><a href="javascript: void(0);">View Registry</a></li>
					</ol>
				</div>
				<h4 class="page-title">View Registry</h4>
			</div>
		</div>
	</div>
	<!-- end page title -->
  <div class="row">
    <div class="col-12">
      <div class="card-box">
        <div class="row">
          <div class="col-lg-8">
            <h5><?=$registry['registry_name']?></h5>
          </div>
          <div class="col-lg-4">
            <div class="text-lg-right mt-3 mt-lg-0">
              <a href="<?=site_url('/incoming-mail/').$registry['registry_id']?>" type="button" class="btn btn-primary waves-effect waves-light mr-1"><i class="mdi mdi-plus-circle mr-1"></i> Incoming Mail</a>
              <a href="<?=site_url('/outgoing-mail/').$registry['registry_id']?>" type="button" class="btn btn-primary waves-effect waves-light mr-2"><i class="mdi mdi-plus-circle mr-1"></i> Outgoing Mail</a>
              <a href="<?=site_url('/registry')?>" type="button" class="btn btn-success waves-effect waves-light">Go Back</a>
            </div>
          </div><!-- end col-->
        </div> <!-- end row -->
      </div> <!-- end card-box -->
    </div><!-- end col-->
  </div>
  <div class="row">
    <div class="col-lg-6 col-xl-3">
      <div class="card-box bg-pattern">
        <div class="row">
          <div class="col-6">
          </div>
          <div class="col-6">
            <div class="text-right">
              <h5 class="text-dark my-1"><span data-plugin="counterup"><?=count($registry_users)?></span></h5>
              <p class="text-muted mb-0 text-truncate">Registry Access</p>
            </div>
          </div>
        </div>
      </div> <!-- end card-box-->
    </div> <!-- end col -->
    <div class="col-lg-6 col-xl-3">
      <div class="card-box bg-pattern">
        <div class="row">
          <div class="col-6">
          </div>
          <div class="col-6">
            <div class="text-right">
              <h5 class="text-dark my-1"><span data-plugin="counterup"><?=count($mails)?></span></h5>
              <p class="text-muted mb-0 text-truncate">All Mails</p>
            </div>
          </div>
        </div>
      </div> <!-- end card-box-->
    </div> <!-- end col -->
    <div class="col-lg-6 col-xl-3">
      <div class="card-box bg-pattern">
        <div class="row">
          <div class="col-6">
          </div>
          <div class="col-6">
            <div class="text-right">
              <h5 class="text-dark my-1"><span data-plugin="counterup"><?=count($unfiled_mails)?></span></h5>
              <p class="text-muted mb-0 text-truncate">Unfiled Mails</p>
            </div>
          </div>
        </div>
      </div> <!-- end card-box-->
    </div> <!-- end col -->
    <div class="col-lg-6 col-xl-3">
      <div class="card-box bg-pattern">
        <div class="row">
          <div class="col-6">
          </div>
          <div class="col-6">
            <div class="text-right">
              <h5 class="text-dark my-1"><span data-plugin="counterup"><?=count($in_transit)?></span></h5>
              <p class="text-muted mb-0 text-truncate">Mails In Transit</p>
            </div>
          </div>
        </div>
      </div> <!-- end card-box-->
    </div> <!-- end col -->
  </div>
  <div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-lg-8">
              <h4 class="header-title">All Mails</h4>
              <p class="text-muted font-13">
                Below are the registered correspondence currently managed by this registry.
              </p>
						</div>
					</div> <!-- end row -->
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
