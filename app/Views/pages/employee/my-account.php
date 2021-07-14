<?=$this->extend('layouts/master');?>
<?=$this->section('extra-styles'); ?>
<link href="/assets/libs/dropify/css/dropify.min.css" rel="stylesheet" type="text/css" />
<?=$this->endSection() ?>
<?=$this->section('content');?>
<div class="container-fluid">
  <!-- start page title -->
  <div class="row">
    <div class="col-12">
      <div class="page-title-box">
        <div class="page-title-right">
          <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="<?= site_url('/') ?>">iGov</a></li>
            <li class="breadcrumb-item active">My Account</li>
          </ol>
        </div>
        <h4 class="page-title">My Account</h4>
      </div>
    </div>
  </div>
  <!-- end page title -->
  <div class="row">
    <div class="col-lg-7">
      <div class="card-box">
        <div class="media mb-3">
          <div class="avatar-lg mr-2">
            <span class="avatar-title bg-danger font-22 rounded">
              LG
            </span>
          </div>
          <div class="media-body">
            <h4 class="mt-0 mb-1"><?=$user['user_name']?></h4>
            <p class="text-muted"><?=$user['position']['pos_name']?></p>
            <p class="text-muted"><i class="mdi mdi-office-building"></i> <?=$user['department']['dpt_name']?></p>

<!--            <a href="javascript: void(0);" class="btn- btn-xs btn-info">Send Email</a>-->
<!--            <a href="javascript: void(0);" class="btn- btn-xs btn-secondary">Call</a>-->
            <!-- <a href="javascript: void(0);" class="btn- btn-xs btn-secondary">Edit</a> -->
          </div>
        </div>

        <h5 class="mb-3 mt-4 text-uppercase bg-light p-2"><i class="mdi mdi-account-circle mr-1"></i> Information</h5>
        <div class="">
          <h4 class="font-13 text-muted text-uppercase mb-1">Phone :</h4>
          <p class="mb-3"><?=$user['employee']['employee_phone']?></p>
          <h4 class="font-13 text-muted text-uppercase mb-1">Email :</h4>
          <p class="mb-3"><?=$user['employee']['employee_mail']?></p>
          <h4 class="font-13 text-muted text-uppercase mb-1">Address :</h4>
          <p class="mb-3"><?=$user['employee']['employee_address']?></p>
          <h4 class="font-13 text-muted text-uppercase mb-1">Date of Birth :</h4>
          <p class="mb-3">
	          <?php $date = date_create($user['employee']['employee_dob']);
	            echo date_format($date,"d F Y");
	          ?>
          </p>
          <h4 class="font-13 text-muted text-uppercase mb-1">Position :</h4>
          <p class="mb-3"><?=$user['position']['pos_name']?></p>
          <h4 class="font-13 text-muted text-uppercase mb-1">Department :</h4>
          <p class="mb-3"><?=$user['department']['dpt_name']?></p>
          <h4 class="font-13 text-muted text-uppercase mb-1">Organization :</h4>
          <p class="mb-3"><?=$user['organization']['org_name']?></p>
          <h4 class="font-13 text-muted text-uppercase mb-1">Added :</h4>
          <p class="mb-3">
	          <?php $date = date_create($user['created_at']);
	          echo date_format($date,"d F Y");
	          ?>
          </p>
        </div>
      </div> <!-- end card-box-->
    </div>
    <div class="col-lg-5">
      <div class="card-box">
        <div class="dropdown float-right">
          <a href="javascript:void(0)" class="dropdown-toggle arrow-none text-muted"
             data-toggle="dropdown" aria-expanded="false">
            <i class='mdi mdi-dots-horizontal font-18'></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item" data-toggle="modal" data-target="#standard-modal">
              <i class='mdi mdi-attachment mr-1'></i>Setup Signature
            </a>
            <div class="dropdown-divider"></div>
            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item text-danger">
              <i class='mdi mdi-delete-outline mr-1'></i>Delete Signature
            </a>
          </div> <!-- end dropdown menu-->
        </div> <!-- end dropdown-->
        <h5 class="card-title font-16 mb-3">E-Signature</h5>
        <?php if ($user['employee']['employee_signature']): ?>
          <div class="card mb-1 shadow-none border" >
            <img src="/uploads/signatures/<?=$user['employee']['employee_signature']?>" alt="image" class="img-fluid rounded p-1" width="200" style="margin: 0 auto;">
          </div>
        <?php else:?>
          <div class="card mb-1 shadow-none border">
            <a href="javascript:void(0)" class="p-2 text-center" data-toggle="modal" data-target="#standard-modal">
              No E-Signature Set Up
            </a>
          </div>
        <?php endif;?>
      </div>
    </div>
  </div>
  <!-- Standard modal content -->
  <div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <form id="upload-signature-form">
            <div class="modal-header">
              <h4 class="modal-title" id="standard-modalLabel">E-Signature Setup</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
              <h6>Signature Scan</h6>
              <p>To setup your digital signature, please upload a clear scan of your signature against a white plain background below.</p>
              <hr>
              <div class="row">
                <div class="col-12">
                <div class="form-group">
									<div class="form-control-wrap">
										<input id="file" type="file" data-plugins="dropify" name="file" accept=".tif,.tiff,.bmp,.jpg,.jpeg,.gif,.png"/>
									</div>
								</div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</div>

<?=$this->endSection();?>
<?= $this->section('extra-scripts'); ?>
<script src="/assets/libs/dropzone/min/dropzone.min.js"></script>
<script src="/assets/libs/dropify/js/dropify.min.js"></script>
<!-- Init js-->
<script src="/assets/js/pages/form-fileuploads.init.js"></script>
<?=view('pages/employee/_employee-scripts.php')?>
<?= $this->endSection(); ?>