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
						<li class="breadcrumb-item active"><a href="<?= site_url('meetings')?>">Meetings</a></li>
					</ol>
				</div>
				<h4 class="page-title">Meetings</h4>
			</div>
		</div>
	</div>
	<!-- end page title -->
	<div class="row">
		<div class="col-12">
			<div class="card-box">
				<div class="row">
					<div class="col-lg-8">
						<h4 class="header-title">All Meetings</h4>
						<p class="text-muted font-13">
							Below are Your Meetings.
						</p>
					</div>
					<div class="col-lg-4">
<!--						<div class="text-lg-right mt-3 mt-lg-0">-->
<!--							<a href="--><?//=site_url('/new-task')?><!--" type="button" class="btn btn-success waves-effect waves-light">New Task</a>-->
<!--						</div>-->
					</div><!-- end col-->
				</div> <!-- end row -->
				<div class="row">
					<div class="col-12">
						<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap w-100">
							<thead>
							<tr>
								<th class="text-center" style="width: 5%">S/n</th>
								<th>Title</th>
								<th>Start Time</th>
								<th>End Time</th>
							
								<th class="text-center" style="width: 5%">Actions</th>
							</tr>
							</thead>
							<tbody>
							<?php $i=1; foreach ($meetings as $meeting):?>
								<tr>
									<td><?=$i; $i++;?></td>
									<td><?=$meeting['meeting_name']?></td>
									<td><?=$meeting['meeting_start']?></td>
									<td><?=$meeting['meeting_end']?></td>
								
									<td class="text-center">
										
										<a href="<?=site_url('join-meeting/').$meeting['meeting_id']."/".$meeting['meeting_token']?>" data-toggle="tooltip" data-placement="left" title data-original-title="join meeting">
											<i data-feather="video" class="icon-dual"></i>.
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
<?= $this->endSection(); ?>
