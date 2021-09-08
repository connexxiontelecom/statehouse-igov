<?= $this->extend('layouts/master'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid" xmlns="http://www.w3.org/1999/html">
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
								<a class="dropdown-item" data-toggle="modal" data-target="#assign-car">Assign Vehicle</a>
							
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
									<?php
									$count_logs = count($assignment_logs) - 1;
									$driver_name = $assignment_logs[$count_logs]['driver']['employee_f_name'].' '.$assignment_logs[$count_logs]['driver']['employee_l_name'];
									$assigned_by = $assignment_logs[$count_logs]['by']['employee_f_name']. ' '.$assignment_logs[$count_logs]['by']['employee_l_name']
									
									?>
									<h4 class="mb-4">Assigned To:  <b><?=$driver_name; ?></b></h4>
									<hr>
									<h4 class="mb-4">Assigned By:  <b><?=$assigned_by; ?></b></h4>
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
											<th>#</th>
											<th>Maintenance Type</th>
											<th>Last Activity Date</th>
											<th>Next Activity Date</th>
											<th>Responsible Employee</th>
											<th>Status</th>
										</tr>
										</thead>
										<tbody>
										<?php $sn=1; foreach($v_mts as $v_mt): ?>
										<tr <?php if($v_mt['ms_schedule_due_date'] < date('Y-m-d')): ?> style="background-color: lightcoral" <?php endif; ?>>
											<td> <?=$sn++; ?></td>
											<td><?=$v_mt['fmt_name'] ?></td>
											<td><?=date('d F, Y', strtotime($v_mt['ms_schedule_date']))?></td>
											<td>
												<?=date('d F, Y', strtotime($v_mt['ms_schedule_due_date']))?>
											</td>
											<td><?=$v_mt['employee_f_name'].' '.$v_mt['employee_l_name'] ?></td>
											<td>
												<?php if($v_mt['ms_schedule_due_date'] > date('Y-m-d')): echo 'Not Due'; else: echo 'Due for Maintenance'; endif; ?>
											</td>
										</tr>
										<?php endforeach; ?>
										
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
											<th>#</th>
											<th>Renewal Type</th>
											<th>Renew Date</th>
											<th>Due Date</th>
											<th>Responsible Employee</th>
											<th>Status</th>
										</tr>
										</thead>
										<tbody>
										<?php $sn=1; foreach($v_rs as $v_r): ?>
											<tr <?php if($v_r['rs_due_date'] < date('Y-m-d')): ?> style="background-color: lightcoral" <?php endif; ?>>
												<td> <?=$sn++; ?></td>
												<td><?=$v_r['frt_name'] ?></td>
												<td><?=date('d F, Y', strtotime($v_r['rs_renew_date']))?></td>
												<td>
													<?=date('d F, Y', strtotime($v_r['rs_due_date']))?>
												</td>
												<td><?=$v_r['employee_f_name'].' '.$v_r['employee_l_name'] ?></td>
												<td>
													<?php if($v_r['rs_due_date'] > date('Y-m-d')): echo 'Not Due'; else: echo 'Due for Renewal'; endif; ?>
												</td>
											</tr>
										<?php endforeach; ?>
										
										</tbody>
									</table>
								</div>
							</div> <!-- end col -->
						</div>
						
						<hr>
						
						<div class="row">
							
							<div class="col-sm-12">
								<h4 class="mb-4">Assignment Logs </h4>
								<div class="table-responsive mt-4">
									<table class="table table-bordered table-centered mb-0">
										<thead class="thead-light">
										<tr>
											<th>#</th>
											<th>Driver</th>
											<th>Employee</th>
											<th> Assigned BY</th>
											<th>Due Date</th>
											<th>Purpose</th>
											
										</tr>
										</thead>
										<tbody>
										<?php $sn=1; foreach($assignment_logs as $al): ?>
											<tr>
												<td> <?=$sn++; ?></td>
												<td><?=$al['driver']['employee_f_name'].' '.$al['driver']['employee_l_name'] ?></td>
												<td> <?=$al['employee_f_name']." ".$al['employee_l_name'] ?></td>
												<td><?=$al['by']['employee_f_name'].' '.$al['by']['employee_l_name'] ?> </td>
												<td><?=date('d F, Y', strtotime($al['al_due_date']))?></td>
												<td>
													<?=$al['al_purpose'];?>
												</td>
												
											</tr>
										<?php endforeach; ?>
										
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
				
				<form method="post" action="">
					
					
					
					<div class="row g-3 align-center">
						<div class="col-lg-12">
							<div class="form-group">
								
								<span class="form-note">Renewal Type</span>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="form-control-wrap">
									<select class="form-control" name="rs_frt_id" >
										<option disabled selected> select  </option>
										<?php foreach ($frs as $fr): ?>
											<option value="<?=$fr['frt_id'] ?>" > <?=$fr['frt_name']; ?>  </option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row g-3 align-center">
						<div class="col-lg-12">
							<div class="form-group">
								
								<span class="form-note">Select Employee</span>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="form-control-wrap">
									<select class="form-control"  name="rs_employee_id" data-toggle="select2"  required style="min-height: 38px">
										<?php foreach ($department_employees as $department => $employees): ?>
											<?php if(!empty($employees)):?>
												<optgroup label="<?=$department?>">
													<?php foreach ($employees as $employee):?>
														<option value="<?=$employee['employee_id']?>">
															<?=$employee['position']['pos_name'].' ('.$employee['user']['user_name'].')'?>
														</option>
													<?php endforeach;?>
												</optgroup>
											<?php endif;?>
										<?php endforeach; ?>
									</select>	</div>
							</div>
						</div>
					</div>
					
					<div class="row g-3 align-center">
						<div class="col-lg-12">
							<div class="form-group">
								
								<span class="form-note">Renew Date</span>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="form-control-wrap">
									<input type="date" class="form-control" name="rs_renew_date"  required>
								</div>
							</div>
						</div>
					</div>
					<div class="row g-3 align-center">
						<div class="col-lg-12">
							<div class="form-group">
								
								<span class="form-note">Due Date</span>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="form-control-wrap">
									<input type="date" class="form-control" name="rs_due_date"   required>
								</div>
							</div>
						</div>
					</div>
					
					
					
					<input type="hidden" name="rs_fv_id" value="<?=$vehicle['fv_id']; ?>">
					<input type="hidden" name="type" value="2">
					
					
					<div class="row g-3">
						<div class="col-lg-12 offset-lg-12">
							<div class="form-group mt-2">
							</div>
						</div>
					</div>
			
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" name="add" class="btn btn-primary" >Save</button>
			
			</div>
		</form>
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
				<form method="post" action="">
					<div class="row g-3 align-center">
						<div class="col-lg-12">
							<div class="form-group">
								
								<span class="form-note">Last Activity Date</span>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="form-control-wrap">
									<input type="date" class="form-control" name="ms_schedule_date" id="activity_date" required>
								</div>
							</div>
						</div>
					</div>
					
					
					<div class="row g-3 align-center">
						<div class="col-lg-12">
							<div class="form-group">
								
								<span class="form-note">Select Maintenance Type</span>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="form-control-wrap">
									<select class="form-control" name="ms_fmt_id" id="maintenance_id">
										<option disabled selected> select  </option>
										<?php foreach ($fmts as $fmt): ?>
										<option value="<?=$fmt['fmt_id'] ?>" data-foo="<?=$fmt['fmt_interval']; ?>"> <?=$fmt['fmt_name']; ?> (Every <?=$fmt['fmt_interval']; ?> month(s) </option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row g-3 align-center">
						<div class="col-lg-12">
							<div class="form-group">
								
								<span class="form-note">Next Activity Date</span>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="form-control-wrap">
									<input type="text" class="form-control" name="ms_schedule_due_date" id="next_activity_date" readonly required>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row g-3 align-center">
						<div class="col-lg-12">
							<div class="form-group">
								
								<span class="form-note">Select Employee</span>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="form-control-wrap">
									<select class="form-control" id="positions" name="ms_employee_id" data-toggle="select2"  required style="min-height: 38px">
										<?php foreach ($department_employees as $department => $employees): ?>
											<?php if(!empty($employees)):?>
												<optgroup label="<?=$department?>">
													<?php foreach ($employees as $employee):?>
														<option value="<?=$employee['employee_id']?>">
															<?=$employee['position']['pos_name'].' ('.$employee['user']['user_name'].')'?>
														</option>
													<?php endforeach;?>
												</optgroup>
											<?php endif;?>
										<?php endforeach; ?>
									</select>	</div>
							</div>
						</div>
					</div>
					
					<input type="hidden" name="ms_fv_id" value="<?=$vehicle['fv_id']; ?>">
					<input type="hidden" name="type" value="1">
					
					
					<div class="row g-3">
						<div class="col-lg-12 offset-lg-12">
							<div class="form-group mt-2">
							</div>
						</div>
					</div>
			
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" name="add" class="btn btn-primary" >Save</button>
			
			</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="assign-car" tabindex="-1" role="dialog"
	 aria-labelledby="scrollableModalTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="scrollableModalTitle">New Assign</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="">
					<div class="row g-3 align-center">
						<div class="col-lg-12">
							<div class="form-group">
								
								<span class="form-note">Select Employee</span>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="form-control-wrap">
									<select class="form-control" id="positions" name="al_employee_id" data-toggle="select2"  required style="min-height: 38px">
										<?php foreach ($department_employees as $department => $employees): ?>
											<?php if(!empty($employees)):?>
												<optgroup label="<?=$department?>">
													<?php foreach ($employees as $employee):?>
														<option value="<?=$employee['employee_id']?>">
															<?=$employee['position']['pos_name'].' ('.$employee['user']['user_name'].')'?>
														</option>
													<?php endforeach;?>
												</optgroup>
											<?php endif;?>
										<?php endforeach; ?>
									</select>	</div>
							</div>
						</div>
					</div>
					
					<div class="row g-3 align-center">
						<div class="col-lg-12">
							<div class="form-group">
								
								<span class="form-note">Select Driver</span>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="form-control-wrap">
									<select class="form-control"  name="al_fd_id" data-toggle="select2"  required style="min-height: 38px">
										<?php foreach ($drivers as $driver): ?>
											
											<option value="<?=$driver['fd_id'] ?>"> <?=$driver['employee']['employee_f_name'].' '.$driver['employee']['employee_l_name']; ?></option>
											
										<?php endforeach; ?>
									</select>	</div>
							</div>
						</div>
					</div>
					
					
					<div class="row g-3 align-center">
						<div class="col-lg-12">
							<div class="form-group">
								
								<span class="form-note">Purpose</span>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="form-control-wrap">
									<textarea class="form-control" name="al_purpose" required>
									
									</textarea>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row g-3 align-center">
						<div class="col-lg-12">
							<div class="form-group">
								
								<span class="form-note">Due Date</span>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="form-control-wrap">
									<input type="date" class="form-control" name="al_due_date"  required>
								</div>
							</div>
						</div>
					</div>
					
				
					
					<input type="hidden" name="al_fv_id" value="<?=$vehicle['fv_id']; ?>">
					<input type="hidden" name="type" value="3">
					
					
					<div class="row g-3">
						<div class="col-lg-12 offset-lg-12">
							<div class="form-group mt-2">
							</div>
						</div>
					</div>
			
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" name="add" class="btn btn-primary" >Save</button>
			
			</div>
			</form>
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
<script>
	$(document).ready(function() {
	
	})
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
	



</script>

<?= $this->endSection(); ?>
