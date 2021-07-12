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
						<li class="breadcrumb-item"><a href="<?=site_url('memos')?>">All Memos</a></li>
						<li class="breadcrumb-item active">My Memos</li>
					</ol>
				</div>
				<h4 class="page-title">My Memos</h4>
			</div>
		</div>
	</div>
	<!-- end page title -->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="row mb-4">
            <div class="col-lg-8">
              <h4 class="header-title mt-2">All My Memos</h4>
            </div>
            <div class="col-lg-4">
              <div class="text-lg-right mt-3 mt-lg-0">
                <div class="btn-group mr-1">
                  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-plus-circle mr-1"></i> Add New</button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">New Internal Memo</a>
                    <a class="dropdown-item" href="#">New External Memo</a>
                  </div>
                </div>
                <a href="<?=site_url('/memos')?>" type="button" class="btn btn-success waves-effect waves-light">Go Back</a>
              </div>
            </div><!-- end col-->
          </div> <!-- end row -->
          <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap w-100">
            <thead>
            <tr>
              <th>S/n</th>
              <th>Subject</th>
              <th>Signed By</th>
              <th>Status</th>
              <th>Created</th>
              <th class="text-center" style="width: 10%">Actions</th>
            </tr>
            </thead>
            <tbody>
						<?php $i=1; foreach ($memos as $memo):?>
              <tr>
                <td><?=$i; $i++;?></td>
                <td><?=$memo['p_subject']?></td>
                <td><?=$memo['signed_by']['user_name']?></td>
                <td>
									<?php
									if ($memo['p_status'] == 0) echo 'Pending';
                  elseif ($memo['p_status'] == 1) echo 'Confirmed';
                  elseif ($memo['p_status'] == 2) echo 'Activated';
                  elseif ($memo['p_status'] == 3) echo 'Deactivated';
                  elseif ($memo['p_status'] == 4) echo 'Rejected';
									?>
                </td>
                <td>
									<?php $date = date_create($memo['p_date']);
									echo date_format($date,"d M Y H:i a");
									?>
                </td>
                <td class="text-center">
                  <a href="<?=site_url('view-notice/').$memo['p_id']?>" class="mr-2">View</a>
									<?php if($memo['p_status'] == 0):?>
                    <a href="<?=site_url('edit-notice/').$memo['p_id']?>">Edit</a>
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


</div>
<?= $this->endSection(); ?>