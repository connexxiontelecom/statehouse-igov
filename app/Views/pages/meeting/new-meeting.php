<link href="/assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
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
						<li class="breadcrumb-item"><a href="<?= site_url('/tasks')?>">Tasks</a></li>
						<li class="breadcrumb-item active">New Task</li>
					</ol>
				</div>
				<h4 class="page-title">New Task</h4>
			</div>
		</div>
	</div>
	<!-- end page title -->
	<div class="row">
		<div class="col-12">
			<div class="card-box">
				<div class="row">
					<div class="col-lg-8">
						<h5 style="text-transform: capitalize">Create New Meeting</h5>
					</div>
					<div class="col-lg-4">
						<div class="text-lg-right mt-3 mt-lg-0">
							<a href="<?=site_url('/meetings')?>" type="button" class="btn btn-success waves-effect waves-light">Go Back</a>
						</div>
					</div><!-- end col-->
				</div> <!-- end row -->
			</div> <!-- end card-box -->
		</div><!-- end col-->
	</div>
	<form class="needs-validation" id="new-meeting-form" novalidate>
<!--	<form class="needs-validation" method="post" novalidate>-->
	<div class="row">
			<div class="col-lg-7">
				<div class="card-box">
					<h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Meeting Details</h5>
					<div class="form-group">
						<label for="subject">Title</label><span style="color: red"> *</span>
						<input type="text" id="meeting_name" class="form-control" name="meeting_name" required>
						<div class="invalid-feedback">
							Please enter a Title.
						</div>
					</div>
					
					<div class="form-group">
						<label for="due-date">Start Date</label><span style="color: red"> *</span>
						<input type="text" id="meeting_start" name="meeting_start" class="form-control datetime-datepicker" placeholder="Date and Time">
						<div class="invalid-feedback">
							Please select a due date.
						</div>
					</div>
					
					<div class="form-group">
						<label for="due-date">End Date</label><span style="color: red"> *</span>
						<input type="text" id="meeting_end" class="form-control datetime-datepicker" name="meeting_end" placeholder="Date and Time">
						<div class="invalid-feedback">
							Please select a due date.
						</div>
					</div>
					
				</div>
			</div>
			<div class="col-lg-5">
				<div class="card-box">
					<h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Meeting Members</h5>
					<div class="custom-control custom-checkbox float-left">
						<input type="checkbox" class="custom-control-input" id="select-all">
						<label class="custom-control-label" for="select-all">
							Select all Employees
						</label>
					</div>
					<div class="mt-5" style="height: 300px; overflow: auto">
						<?php foreach ($department_employees as $department => $employees): ?>
							<?php if(!empty($employees)):?>
								<h5 class="mb-2 font-size-16"><?=$department?></h5>
								<?php foreach ($employees as $employee):?>
									<div class="custom-control custom-checkbox mt-1">
										<input type="checkbox" class="custom-control-input user" id="<?=$employee['employee_id']?>"
										       value="<?=$employee['employee_id']?>" name="meeting_employees[]">
										<label class="custom-control-label strikethrough" for="<?=$employee['employee_id']?>">
											<?=$employee['position']['pos_name'].' ('.$employee['user']['user_name'].')'?>
										</label>
									</div>
								<?php endforeach;?>
							<?php endif;?>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="text-center mb-3">
					<a href="<?=site_url('meetings')?>" type="button" class="btn w-sm btn-danger waves-effect">Cancel</a>
					<button type="submit" class="btn w-sm btn-success waves-effect waves-light">Save</button>
				</div>
			</div>
		</div>
	</form>
</div>
<?= $this->endSection(); ?>
<?= $this->section('extra-scripts') ?>

<script src="/assets/libs/flatpickr/flatpickr.min.js"></script>
<script src="/assets/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="/assets/libs/clockpicker/bootstrap-clockpicker.min.js"></script>
<script src="/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="/assets/js/pages/form-pickers.init.js"></script>
<script>
    $('#select-all').click(e => {
        let selectAll = $('#select-all')[0]
        let allUserCheckboxes = $('.user')
        allUserCheckboxes.each(function () {
            this.checked = selectAll.checked
        })
    })
</script>
<?=view('pages/meeting/_meeting-scripts.php')?>
<?= $this->endSection() ?>
