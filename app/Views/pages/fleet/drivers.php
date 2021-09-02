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
							<li class="breadcrumb-item"><a href="javascript:void(0)">Manage Fleet</a></li>
							<li class="breadcrumb-item active">Drivers</li>
						</ol>
					</div>
					<h4 class="page-title">Drivers</h4>
				</div>
			</div>
		</div>
		<!-- end page title -->
		<div class="row">
			<div class="col-12">
				<div class="card-box">
					<div class="row">
						<div class="col-lg-8">
							<h4 class="header-title">All Drivers</h4>
							<p class="text-muted font-13">
								Below are the employees registered as drivers on iGov.
							</p>
						</div>
						<div class="col-lg-4">
							<div class="text-lg-right mt-3 mt-lg-0">
								<a href="<?=site_url('/new-driver')?>" type="button" class="btn btn-success waves-effect waves-light"><i class="mdi mdi-plus-circle mr-1"></i> New Driver</a>
							</div>
						</div><!-- end col-->
					</div> <!-- end row -->
					<div class="row">
						<div class="col-12">
							<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap w-100">
								<thead>
								<tr>
									<th class="text-center" style="width: 5%">S/n</th>
									<th>Driver Name</th>
									<th>Email</th>
									<th style="width: 5%">Phone</th>
									<th style="width: 5%">License Expiry Date</th>
									<th class="text-center" style="width: 5%">Actions</th>
								</tr>
								</thead>
								<tbody>
								<?php $i=1; foreach ($drivers as $driver):?>
									<tr>
										<td><?=$i; $i++;?></td>
                    <td><?=$driver['employee']['employee_f_name'].' '.$driver['employee']['employee_l_name']?></td>
                    <td><?=$driver['employee']['employee_mail']?></td>
                    <td><?=$driver['employee']['employee_phone']?></td>
										<td>
											<?php $date = date_create($driver['fd_moi_expiry']);
											echo date_format($date,"d M Y");
											?>
										</td>
										<td class="text-center">
											<a href="javascript:void(0)" data-toggle="tooltip" data-placement="left" title data-original-title="Update Driver">
												<i data-feather="edit-3" class="icon-dual"></i>.
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
<?=view('pages/fleet/_fleet-scripts.php')?>
<?= $this->endSection(); ?>