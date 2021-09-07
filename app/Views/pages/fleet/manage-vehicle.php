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
								<a class="dropdown-item" data-toggle="modal" data-target="#new-renewal">New Renewal</a>
								<a class="dropdown-item" data-toggle="modal" data-target="#new-maintenance">New Maintenance Schedule</a>
								<a class="dropdown-item" href="#">Assign Vehicle</a>
								<a class="dropdown-item" href="#">Assignment Logs</a>
								<a class="dropdown-item" data-toggle="modal" data-target="#update-vehicle">Edit Vehicle</a>
							
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
						
						
						<hr>
						<div class="row">
							<div class="col-sm-6">
								<h4 class="mb-4">Maintenance Schedule </h4>
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
								<h4 class="mb-4">Renewal Schedule </h4>
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

<div class="modal fade" id="new-renewal" tabindex="-1" role="dialog"
	 aria-labelledby="scrollableModalTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="scrollableModalTitle">New Renewal</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="new-maintenance" tabindex="-1" role="dialog"
	 aria-labelledby="scrollableModalTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="scrollableModalTitle">New Maintenance</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="update-vehicle" tabindex="-1" role="dialog"
	 aria-labelledby="scrollableModalTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="scrollableModalTitle">Update Vehicle</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
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
	
	$(function(){
		$('#maintenance_id').change(function() {
			let activity_date = $('#activity_date').val();
			if (activity_date == null) {
				alert('Please Enter Last Activity Date')
			} else{
				var selected = $(this).find('option:selected');
				var maintenance_interval = selected.data('foo');
				
				activity_date = new Date(activity_date);
				let next_date = activity_date.setDate(activity_date.getDate() + (maintenance_interval * 30));
				next_date = new Date(next_date)
				$('#next_activity_date').val(next_date.toLocaleDateString())
			}
			
		});
	});
	
	// function changeDate(){
	// 	let maintenance_interval = document.getElementById('maintenance_id').data('foo');
	//
	//
	//
	// }
	$(document).ready(function(){
		
		$('#assignVehicle').parsley().on('field:validated', function() {
		
		}).on('form:submit', function() {
			var config = {
				onUploadProgress: function(progressEvent) {
					var percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
				}
			};
			var form_data = new FormData();
			form_data.append('driver',$('#assign_driver').val());
			form_data.append('vehicle',$('#vehicleId').val());
			form_data.append('reason', $('#reason').val());
			form_data.append('due_date', $('#due_date').val());
			form_data.append('assign_employee', $('#assign_employee').val());
			$('#assignVehicleBtn').text('Processing...');
			axios.post('/logistics/vehicle/assign',form_data, config)
					.then(response=>{
						$.notify(response.data.message, 'success');
						$('#assignVehicleBtn').text('Done');
						location.reload();
						$('#assignVehicleModal').modal('hide');
						setTimeout(function () {
							$("#assignVehicleBtn").text("Save");
							$("#simpletable").load(location.href + " #simpletable");
						}, 2000);
						
					})
					.catch(errors=>{
						var errs = Object.values(errors.response.data.error);
						$.notify(errs, "error");
						$('#assignVehicleBtn').text('Error!');
						setTimeout(function () {
							$("#assignVehicleBtn").text("Save");
						}, 2000);
					});
			return false;
		});
	});
</script>
<?=view('pages/fleet/_fleet-scripts.php')?>
<?= $this->endSection(); ?>
