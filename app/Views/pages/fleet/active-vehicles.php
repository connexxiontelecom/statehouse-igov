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
							<li class="breadcrumb-item active">Active Vehicles</li>
						</ol>
					</div>
					<h4 class="page-title">Active Vehicles</h4>
				</div>
			</div>
		</div>
		<!-- end page title -->
		<div class="row">
			<div class="col-12">
				<div class="card-box">
					<div class="row">
						<div class="col-lg-8">
							<h4 class="header-title">All Active Vehicles</h4>
							<p class="text-muted font-13">
								Below are the active vehicles registered on iGov.
							</p>
						</div>
						<div class="col-lg-4">
							<div class="text-lg-right mt-3 mt-lg-0">
								<a href="<?=site_url('/new-vehicle')?>" type="button" class="btn btn-success waves-effect waves-light"><i class="mdi mdi-plus-circle mr-1"></i> New Vehicle</a>
							</div>
						</div><!-- end col-->
					</div> <!-- end row -->
					<div class="row">
						<div class="col-12">
							<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap w-100">
								<thead>
								<tr>
									<th class="text-center" style="width: 5%">S/n</th>
									<th>Alias</th>
									<th>Chassis No.</th>
									<th style="width: 10%">Purchase Date</th>
									<th style="width: 10%">Plate No.</th>
									<th style="width: 10%">Vehicle Type</th>
									<th class="text-center" style="width: 5%">Actions</th>
								</tr>
								</thead>
								<tbody>
								<?php $i=1; foreach ($active_vehicles as $active_vehicle):?>
                  <tr>
                    <td><?=$i; $i++;?></td>
                    <td><?=$active_vehicle['fv_brand'].'-'.$active_vehicle['fv_maker'].'-'.$active_vehicle['fv_year'].'-'.$active_vehicle['fv_color']?></td>
                    <td><?=$active_vehicle['fv_chassis_no']?></td>
                    <td>
	                    <?php $date = date_create($active_vehicle['fv_purchase_date']);
	                      echo date_format($date,"d M Y");
	                    ?>
                    </td>
                    <td><?=$active_vehicle['fv_plate_no']?></td>
                    <td><?=$active_vehicle['vehicle_type']['fvt_name']?></td>
                    <td class="text-center">
                      <a href="<?=site_url('manage-vehicle')."/".$active_vehicle['fv_id']; ?>" data-toggle="tooltip" data-placement="left" title data-original-title="Manage Vehicle">
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
