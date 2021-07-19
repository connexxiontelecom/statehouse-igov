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
							<li class="breadcrumb-item"><a href="<?=site_url('notices')?>">Notice Board</a></li>
							<li class="breadcrumb-item active">Signature Requests</li>
						</ol>
					</div>
					<h4 class="page-title">Signature Requests</h4>
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
								<h4 class="header-title">All My Signature Requests</h4>
								<p class="text-muted font-13">
									Below are the notices you have been assigned as signatory. You can review, sign them with your e-signature, or decline to sign them here.
								</p>
							</div>
							<div class="col-lg-4">
								<div class="text-lg-right mt-3 mt-lg-0">
									<a href="<?=site_url('/notices')?>" type="button" class="btn btn-success waves-effect waves-light">Go Back</a>
								</div>
							</div><!-- end col-->
						</div> <!-- end row -->
						<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap w-100">
							<thead>
							<tr>
								<th class="text-center" style="width: 5%">S/n</th>
								<th>Ref No.</th>
								<th>Subject</th>
								<th>Written By</th>
								<th style="width: 12%;">Created</th>
								<th class="text-center" style="width: 10%">Actions</th>
							</tr>
							</thead>
							<tbody>
							<?php $i=1; foreach ($notices as $notice):?>
								<tr>
									<td><?=$i; $i++;?></td>
									<td><?=$notice['p_ref_no']?></td>
									<td><?=$notice['p_subject']?></td>
									<td><?=$notice['written_by']['user_name']?></td>
									<td>
										<?php $date = date_create($notice['p_date']);
										echo date_format($date,"d M Y H:i a");
										?>
									</td>
									<td class="text-center">
										<a href="<?=site_url('view-memo/').$notice['p_id']?>" class="mr-1">View</a>
										<?php if($notice['p_by'] == session()->user_id && $notice['p_status'] == 0):?>
											<a href="<?=site_url('/edit-memo/').$notice['p_id']?>">Edit</a>
										<?php endif;?>
										<?php if($notice['p_signed_by'] == session()->user_id && $notice['p_status'] == 0):?>
											<a href="javascript:void(0)" onclick="signDocument(<?=$notice['p_id']?>)" class="mr-1 text-success">Sign</a>
											<a href="javascript:void(0)" onclick="declineDocument(<?=$notice['p_id']?>)" class="text-danger">Decline</a>
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
		<!-- Warning Alert Modal -->
		<div id="loading-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-sm">
				<div class="modal-content">
					<div class="modal-body p-4">
						<div class="text-center">
							<i class="dripicons-information h1 text-info"></i>
							<h4 class="mt-2">Sending Verification Code</h4>
							<p class="mt-3">Please wait while we send you your document signing verification code.</p>
							<button type="submit" class="btn btn-info" disabled>
								<span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span> Please wait...
							</button>
						</div>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<div id="standard-modal-3" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<form id="verify-doc-signing-form" class="needs-validation" novalidate>
						<div class="modal-header">
							<h4 class="modal-title" id="standard-modalLabel">Verify Document Signing</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-12">
									<div class="form-group">
										<label for="ver-code">Document Signing Verification Code</label>
										<input type="text" class="form-control" name="ver_code" id="ver-code" required/>
										<div class="invalid-feedback">
											Please enter a document signing verification code.
										</div>
										<span class="help-block">
                      <small>Please enter the verification code that was sent to you to sign this document.</small>
                    </span>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
							<button type="button" onclick="verifyDocumentSigning()" class="btn btn-primary" id="save-btn">Submit</button>
							<button type="submit" class="btn btn-primary" id="save-btn-loading" hidden disabled>
								<span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span> Please wait...
							</button>
						</div>
						<input type="hidden" id="post-id">
						<input type="hidden" id="e-signature">
					</form>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
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
<?//=view('pages/posts/memos/_memo-scripts.php')?>

<?= $this->endSection(); ?>