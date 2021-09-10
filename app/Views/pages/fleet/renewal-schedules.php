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
						<li class="breadcrumb-item active">Renewal Schedules</li>
					</ol>
				</div>
				<h4 class="page-title">Renewal Schedules</h4>
			</div>
		</div>
	</div>
	<!-- end page title -->
	<div class="row">
		<div class="col-12">
			<div class="card-box">
				<div class="row">
					<div class="col-lg-8">
						<h4 class="header-title">Renewal Schedules</h4>
						<p class="text-muted font-13">
							Below are all Renewal Schedules.
						</p>
					</div>
					<div class="col-lg-4">
						<div class="text-lg-right mt-3 mt-lg-0">
							<a href="<?=site_url('/renewal-schedule-calendar')?>" type="button" class="btn btn-success waves-effect waves-light"><i class="mdi mdi-plus-circle mr-1"></i> Calendar View</a>
						</div>
					</div><!-- end col-->
				</div> <!-- end row -->
				<div class="row">
					<div class="card-box">
						
						
						<div class="col-sm-12">
							<h4 class="mb-4">Renewal Schedule </h4>
							<div class="table-responsive">
								<table class="table table-bordered table-centered mb-0">
									<thead class="thead-light">
									<tr>
										<th>#</th>
										<th>Renewal Type</th>
										<th> Vehicle</th>
										<th>Renew Date</th>
										<th>Due Date</th>
										<th>Responsible Employee</th>
										<th>Status</th>
										<th> Action </th>
									</tr>
									</thead>
									<tbody>
									<?php $sn=1; foreach($v_rs as $v_r): ?>
										<tr <?php if($v_r['rs_due_date'] < date('Y-m-d')): ?> style="background-color: lightcoral" <?php endif; ?>>
											<td> <?=$sn++; ?></td>
											<td><?=$v_r['frt_name'] ?></td>
											<td> <?=$v_r['fv_brand'].'-'.$v_r['fv_maker'].'-'.$v_r['fv_year'].'-'.$v_r['fv_color']?></td>
											<td><?=date('d F, Y', strtotime($v_r['rs_renew_date']))?></td>
											<td>
												<?=date('d F, Y', strtotime($v_r['rs_due_date']))?>
											</td>
											<td><?=$v_r['employee_f_name'].' '.$v_r['employee_l_name'] ?></td>
											<td>
												<?php if($v_r['rs_due_date'] > date('Y-m-d')): echo 'Not Due'; else: echo 'Due for Renewal'; endif; ?>
											</td>
											<td>
												<a href="<?=site_url('manage-vehicle')."/".$v_r['fv_id']; ?>" data-toggle="tooltip" data-placement="left" title data-original-title="Manage Vehicle">
													<i data-feather="edit-3" class="icon-dual"></i>.
												</a>
											</td>
										</tr>
									<?php endforeach; ?>
									
									</tbody>
								</table>
							</div>
						</div> <!-- end col -->
						
		
					
					</div> <!-- end card-->
				</div>
			</div>
		</div>
	</div>
</div>


<?= $this->endSection(); ?>
<?= $this->section('extra-scripts'); ?>
<script>

	



</script>

<?= $this->endSection(); ?>
