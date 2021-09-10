<?= $this->extend('layouts/master'); ?>
<?= $this->section('extra-styles'); ?>
<link href="/assetsa/libs/@fullcalendar/core/main.min.css" rel="stylesheet" type="text/css" />
<link href="/assetsa/libs/@fullcalendar/daygrid/main.min.css" rel="stylesheet" type="text/css" />
<link href="/assetsa/libs/@fullcalendar/bootstrap/main.min.css" rel="stylesheet" type="text/css" />
<link href="/assetsa/libs/@fullcalendar/timegrid/main.min.css" rel="stylesheet" type="text/css" />
<link href="/assetsa/libs/@fullcalendar/list/main.min.css" rel="stylesheet" type="text/css" /><?= $this->endSection(); ?>

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
				<h4 class="page-title">Renewal Schedules Calendar</h4>
			</div>
		</div>
	</div>
	<!-- end page title -->
	<div class="row">
		<div class="col-12">
			<div class="card-box">
				<div class="row">
					<div class="col-lg-8">
						<h4 class="header-title">Renewal Schedules Calendar</h4>
						<p class="text-muted font-13">
							Below are all Renewal Schedules Calendar.
						</p>
					</div>
					<div class="col-lg-4">
						<div class="text-lg-right mt-3 mt-lg-0">
							<a href="<?=site_url('/renewal-schedules')?>" type="button" class="btn btn-success waves-effect waves-light"><i class="mdi mdi-plus-circle mr-1"></i> List View</a>
						</div>
					</div><!-- end col-->
				</div> <!-- end row -->
				<div class="row">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-lg-3">
									<button class="btn btn-lg font-16 btn-primary btn-block" id="btn-new-event"><i class="mdi mdi-plus-circle-outline"></i> Create New Event</button>
									<div id="external-events" class="m-t-20">
										<br>
										<p class="text-muted">Drag and drop your event or click in the calendar</p>
										<div class="external-event bg-success" data-class="bg-success">
											<i class="mdi mdi-checkbox-blank-circle mr-2 vertical-middle"></i>New Theme Release
										</div>
										<div class="external-event bg-info" data-class="bg-info">
											<i class="mdi mdi-checkbox-blank-circle mr-2 vertical-middle"></i>My Event
										</div>
										<div class="external-event bg-warning" data-class="bg-warning">
											<i class="mdi mdi-checkbox-blank-circle mr-2 vertical-middle"></i>Meet manager
										</div>
										<div class="external-event bg-danger" data-class="bg-danger">
											<i class="mdi mdi-checkbox-blank-circle mr-2 vertical-middle"></i>Create New theme
										</div>
									</div>
									
									
									<div class="mt-5 d-none d-xl-block">
										<h5 class="text-center">How It Works ?</h5>
										
										<ul class="pl-3">
											<li class="text-muted mb-3">
												It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
											</li>
											<li class="text-muted mb-3">
												Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage.
											</li>
											<li class="text-muted mb-3">
												It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
											</li>
										</ul>
									</div>
								
								</div> <!-- end col-->
								
								<div class="col-lg-9">
									<div id="calendar"></div>
								</div> <!-- end col -->
							
							</div>  <!-- end row -->
						</div> <!-- end card body-->
					</div> <!-- end card -->
					
					<!-- Add New Event MODAL -->
					<div class="modal fade" id="event-modal" tabindex="-1">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header py-3 px-4 border-bottom-0 d-block">
									<button type="button" class="close" data-dismiss="modal"
											aria-hidden="true">&times;</button>
									<h5 class="modal-title" id="modal-title">Event</h5>
								</div>
								<div class="modal-body p-4">
									<form class="needs-validation" name="event-form" id="form-event" novalidate>
										<div class="row">
											<div class="col-12">
												<div class="form-group">
													<label class="control-label">Event Name</label>
													<input class="form-control" placeholder="Insert Event Name"
														   type="text" name="title" id="event-title" required />
													<div class="invalid-feedback">Please provide a valid event name</div>
												</div>
											</div>
											<div class="col-12">
												<div class="form-group">
													<label class="control-label">Category</label>
													<select class="form-control custom-select" name="category"
															id="event-category" required>
														<option value="bg-danger" selected>Danger</option>
														<option value="bg-success">Success</option>
														<option value="bg-primary">Primary</option>
														<option value="bg-info">Info</option>
														<option value="bg-dark">Dark</option>
														<option value="bg-warning">Warning</option>
													</select>
													<div class="invalid-feedback">Please select a valid event category</div>
												</div>
											</div>
										</div>
										<div class="row mt-2">
											<div class="col-6">
												<button type="button" class="btn btn-danger" id="btn-delete-event">Delete</button>
											</div>
											<div class="col-6 text-right">
												<button type="button" class="btn btn-light mr-1" data-dismiss="modal">Close</button>
												<button type="submit" class="btn btn-success" id="btn-save-event">Save</button>
											</div>
										</div>
									</form>
								</div>
							</div> <!-- end modal-content-->
						</div> <!-- end modal dialog-->
					</div>
					<!-- end modal-->
				</div>
			</div>
		</div>
	</div>
</div>


<?= $this->endSection(); ?>
<?= $this->section('extra-scripts'); ?>
<script src="/assetsa/libs/moment/min/moment.min.js"></script>
<script src="/assetsa/libs/@fullcalendar/core/main.min.js"></script>
<script src="/assetsa/libs/@fullcalendar/bootstrap/main.min.js"></script>
<script src="/assetsa/libs/@fullcalendar/daygrid/main.min.js"></script>
<script src="/assetsa/libs/@fullcalendar/timegrid/main.min.js"></script>
<script src="/assetsa/libs/@fullcalendar/list/main.min.js"></script>
<script src="/assetsa/libs/@fullcalendar/interaction/main.min.js"></script>

<!-- Calendar init -->
<script src="/assetsa/js/pages/calendar.init.js"></script>
<?= $this->endSection(); ?>
