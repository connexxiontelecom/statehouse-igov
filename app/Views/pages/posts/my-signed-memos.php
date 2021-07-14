<?=$this->extend('layouts/master'); ?>

<?= $this->section('content');?>
	<div class="container-fluid">
		<!-- start page title -->
		<div class="row">
			<div class="col-12">
				<div class="page-title-box">
					<div class="page-title-right">
						<ol class="breadcrumb m-0">
							<li class="breadcrumb-item"><a href="<?= site_url('/') ?>">iGov</a></li>
							<li class="breadcrumb-item"><a href="javascript: void(0);">Messaging</a></li>
							<li class="breadcrumb-item"><a href="<?=site_url('memos')?>">Memo Board</a></li>
							<li class="breadcrumb-item active">My Signed Memos</li>
						</ol>
					</div>
					<h4 class="page-title">My Signed Memos</h4>
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
								<h4 class="header-title">All My Signed Memos</h4>
                <p class="text-muted font-13">
                 	Below are the memos you have been assigned as signatory. You can review and sign them with your e-signature here.
                </p>
							</div>
							<div class="col-lg-4">
								<div class="text-lg-right mt-3 mt-lg-0">
									<a href="<?=site_url('/memos')?>" type="button" class="btn btn-success waves-effect waves-light">Go Back</a>
								</div>
							</div><!-- end col-->
						</div> <!-- end row -->
						<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap w-100">
							<thead>
							<tr>
								<th class="text-center" style="width: 5%">S/n</th>
								<th>Subject</th>
								<th>Written By</th>
								<th>Status</th>
								<th>Created</th>
								<th class="text-center" style="width: 10%">Actions</th>
							</tr>
							</thead>
							<tbody>
							<?php $i=1; foreach ($memos as $memo):?>
								<tr>
									<td><?=$i; $i++;?></td>
									<td><?=$memo['p_subject']?></td>
									<td><?=$memo['written_by']['user_name']?></td>
									<td>
										<?php
										if ($memo['p_status'] == 0) echo 'Pending';
										elseif ($memo['p_status'] == 1) echo 'Confirmed';
										elseif ($memo['p_status'] == 2) echo 'Activated';
										elseif ($memo['p_status'] == 3) echo 'Deactivated';
										elseif ($memo['p_status'] == 4) echo 'Rejected';
										?>
									</td>
									<td>
										<?php $date = date_create($memo['p_date']);
										echo date_format($date,"d M Y H:i a");
										?>
									</td>
									<td class="text-center">
										<a href="<?=site_url('view-memo/').$memo['p_id']?>" class="mr-2">View</a>
										<?php if($memo['p_status'] == 0 && $memo['p_by'] == session()->user_id):?>
											<a href="<?=site_url('edit-memo/').$memo['p_id']?>">Edit</a>
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