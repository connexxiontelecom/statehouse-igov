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
						<li class="breadcrumb-item active">Manage Vehicle</li>
					</ol>
				</div>
				<h4 class="page-title">Manage Vehicle</h4>
			</div>
		</div>
	</div>
	<!-- end page title -->
	<div class="row">
		<div class="col-12">
			<div class="card-box">
				<div class="row">
					<div class="col-lg-8">
						<h4 class="header-title">Manage Vehicles</h4>
						<p class="text-muted font-13">
							Below are the details of the Vehicle.
						</p>
					</div>
					<div class="col-lg-4">
						<div class="dropdown">
							<a class="btn btn-light dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Actions <i class="mdi mdi-chevron-down"></i>
							</a>
							
							<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
								<a class="dropdown-item" href="#">New Renewal</a>
								<a class="dropdown-item" href="#">New Maintenance Schedule</a>
								<a class="dropdown-item" href="#">Assign Vehicle</a>
								<a class="dropdown-item" href="#">Assignment Logs</a>
								<a class="dropdown-item" href="#">Edit Vehicle</a>
							
							</div>
						</div>
					</div><!-- end col-->
				</div> <!-- end row -->
				<div class="row">
					<div class="card-box">
						<div class="row">
							<div class="col-sm-5">
								
								<div class="tab-content pt-0">
									
									<div class="tab-pane active show" id="product-1-item">
										<img src="/uploads/fleets/<?=$vehicle['fv_vehicle_image'] ?>" alt="" class="img-fluid mx-auto d-block rounded">
									</div>
									
								</div>
								
<!--								<ul class="nav nav-pills nav-justified">-->
<!--									<li class="nav-item">-->
<!--										<a href="#product-1-item" data-toggle="tab" aria-expanded="false" class="nav-link product-thumb active show">-->
<!--											<img src="/uploads/fleets/--><?//=$vehicle['fv_vehicle_image'] ?><!--"  alt="" class="img-fluid mx-auto d-block rounded">-->
<!--										</a>-->
<!--									</li>-->
<!--									-->
<!--								</ul>-->
							</div> <!-- end col -->
							<div class="col-sm-7">
								<div class="pl-xl-3 mt-3 mt-xl-0">
									
									<a href="#" class="text-primary"><?=$vehicle['fv_brand'].'-'.$vehicle['fv_maker'].'-'.$vehicle['fv_year'].'-'.$vehicle['fv_color']?></a>
									
									<h4 class="mb-4">Vehicle Type :  <b><?=$vehicle['fvt_name'] ?></b></h4>
									<hr>
									<h4 class="mb-4">Plate No :  <b><?=$vehicle['fv_plate_no']; ?></b></h4>
									<hr>
									<h4 class="mb-4">Color No :  <b><?=$vehicle['fv_color']; ?></b></h4>
									<hr>
									<h4 class="mb-4">Year :  <b><?=$vehicle['fv_year']; ?></b></h4>
									<hr>
									<h4 class="mb-4">Status :  <b><?php if($vehicle['fv_status'] == 1) { echo 'Active'; }else{
										echo 'Inactive';
											} ?></b></h4>
									
									
									<p class="text-muted mb-4">__________________________________________________________________________________________________________________
									</p>
								
								
									
								
								</div>
							</div> <!-- end col -->
						</div>
						<!-- end row -->
						
						
						
						<div class="row">
							<div class="col-sm-6">
								
								<div class="table-responsive mt-4">
									<table class="table table-bordered table-centered mb-0">
										<thead class="thead-light">
										<tr>
											<th>Outlets</th>
											<th>Price</th>
											<th>Stock</th>
											<th>Revenue</th>
										</tr>
										</thead>
										<tbody>
										<tr>
											<td>ASOS Ridley Outlet - NYC</td>
											<td>$139.58</td>
											<td>
												<div class="row align-items-center no-gutters">
													<div class="col-auto">
														<span class="mr-2">27%</span>
													</div>
													<div class="col">
														<div class="progress progress-sm">
															<div class="progress-bar bg-danger" role="progressbar" style="width: 27%" aria-valuenow="27" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
													</div>
												</div>
											</td>
											<td>$1,89,547</td>
										</tr>
										<tr>
											<td>Marco Outlet - SRT</td>
											<td>$149.99</td>
											<td>
												<div class="row align-items-center no-gutters">
													<div class="col-auto">
														<span class="mr-2">71%</span>
													</div>
													<div class="col">
														<div class="progress progress-sm">
															<div class="progress-bar bg-success" role="progressbar" style="width: 71%" aria-valuenow="71" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
													</div>
												</div>
											</td>
											<td>$87,245</td>
										</tr>
										<tr>
											<td>Chairtest Outlet - HY</td>
											<td>$135.87</td>
											<td>
												<div class="row align-items-center no-gutters">
													<div class="col-auto">
														<span class="mr-2">82%</span>
													</div>
													<div class="col">
														<div class="progress progress-sm">
															<div class="progress-bar bg-success" role="progressbar" style="width: 82%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
													</div>
												</div>
											</td>
											<td>$5,87,478</td>
										</tr>
										<tr>
											<td>Nworld Group - India</td>
											<td>$159.89</td>
											<td>
												<div class="row align-items-center no-gutters">
													<div class="col-auto">
														<span class="mr-2">42%</span>
													</div>
													<div class="col">
														<div class="progress progress-sm">
															<div class="progress-bar bg-warning" role="progressbar" style="width: 42%" aria-valuenow="42" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
													</div>
												</div>
											</td>
											<td>$55,781</td>
										</tr>
										</tbody>
									</table>
								</div>
							</div> <!-- end col -->
							<div class="col-sm-6">
								<div class="table-responsive mt-4">
									<table class="table table-bordered table-centered mb-0">
										<thead class="thead-light">
										<tr>
											<th>Outlets</th>
											<th>Price</th>
											<th>Stock</th>
											<th>Revenue</th>
										</tr>
										</thead>
										<tbody>
										<tr>
											<td>ASOS Ridley Outlet - NYC</td>
											<td>$139.58</td>
											<td>
												<div class="row align-items-center no-gutters">
													<div class="col-auto">
														<span class="mr-2">27%</span>
													</div>
													<div class="col">
														<div class="progress progress-sm">
															<div class="progress-bar bg-danger" role="progressbar" style="width: 27%" aria-valuenow="27" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
													</div>
												</div>
											</td>
											<td>$1,89,547</td>
										</tr>
										<tr>
											<td>Marco Outlet - SRT</td>
											<td>$149.99</td>
											<td>
												<div class="row align-items-center no-gutters">
													<div class="col-auto">
														<span class="mr-2">71%</span>
													</div>
													<div class="col">
														<div class="progress progress-sm">
															<div class="progress-bar bg-success" role="progressbar" style="width: 71%" aria-valuenow="71" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
													</div>
												</div>
											</td>
											<td>$87,245</td>
										</tr>
										<tr>
											<td>Chairtest Outlet - HY</td>
											<td>$135.87</td>
											<td>
												<div class="row align-items-center no-gutters">
													<div class="col-auto">
														<span class="mr-2">82%</span>
													</div>
													<div class="col">
														<div class="progress progress-sm">
															<div class="progress-bar bg-success" role="progressbar" style="width: 82%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
													</div>
												</div>
											</td>
											<td>$5,87,478</td>
										</tr>
										<tr>
											<td>Nworld Group - India</td>
											<td>$159.89</td>
											<td>
												<div class="row align-items-center no-gutters">
													<div class="col-auto">
														<span class="mr-2">42%</span>
													</div>
													<div class="col">
														<div class="progress progress-sm">
															<div class="progress-bar bg-warning" role="progressbar" style="width: 42%" aria-valuenow="42" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
													</div>
												</div>
											</td>
											<td>$55,781</td>
										</tr>
										</tbody>
									</table>
								</div>
							</div> <!-- end col -->
						</div>
						
					
					</div> <!-- end card-->
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
