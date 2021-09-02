<?=$this->extend('layouts/master');?>
<?=$this->section('extra-styles'); ?>
<link href="/assets/libs/dropify/css/dropify.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/ladda/ladda-themeless.min.css" rel="stylesheet" type="text/css" />
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
	          <?php $date = date_create($user['employee']['employee_date']);
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
            <a href="javascript:void(0)" class="text-center" data-toggle="modal" data-target="#standard-modal">
              <img src="/uploads/signatures/<?=$user['employee']['employee_signature']?>" alt="image" class="img-fluid rounded p-1" width="200">
            </a>
          </div>
          <?php if ($user['signature_ver'] && $user['signature_ver']['ver_status'] == 0):?>
            <div class="alert alert-warning mt-3" role="alert">
              <i class="mdi mdi-alert-circle-outline mr-2"></i>
              A verification code has been sent to your email. Click <a href="javascript:void(0)" class="alert-link" data-toggle="modal" data-target="#standard-modal-2">here</a> to enter the code.
            </div>
          <?php else:?>
            <div class="alert alert-success mt-3" role="alert">
              <i class="mdi mdi-check-all mr-2"></i>
              Your E-Signature is verified.
            </div>
          <?php endif;?>
        <?php else:?>
          <div class="card mb-1 shadow-none border">
            <a href="javascript:void(0)" class="p-2 text-center" data-toggle="modal" data-target="#standard-modal">
              No E-Signature Set Up
            </a>
          </div>
        <?php endif;?>
      </div>
      <div class="card-box">
        <h5 class="card-title font-16 mb-3">Security Token</h5>
        <form id="manage-token-form" class="needs-validation" novalidate onsubmit="submitToken(); return false;">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="token-symbol">Token Symbol</label>
                <input type="text" class="form-control" name="token_symbol" id="token-symbol" required/>
                <div class="invalid-feedback">
                  Please enter a token symbol.
                </div>
                <span class="help-block">
                  <small>Please enter a security token you can use in place of the OTP verification code.</small>
                </span>
              </div>
            </div>
            <div class="col-12 mt-0">
              <button class="btn btn-success waves-effect waves-light btn-sm">Submit Token</button>
          </div>
<!--          <input type="hidden" id="mail-id" value="--><?//=$mail['m_id']?><!--">-->
        </form>
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
              <button type="submit" class="btn btn-primary" id="save-btn">Save Changes</button>
              <button type="submit" class="btn btn-primary" id="save-btn-loading" hidden disabled>
                <span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span> Please wait...
              </button>
            </div>
          </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <div id="standard-modal-2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form id="verify-signature-form" class="needs-validation" novalidate>
          <div class="modal-header">
            <h4 class="modal-title" id="standard-modalLabel">Verify E-Signature</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="ver-code">E-Signature Verification Code</label>
                  <input type="text" class="form-control" name="ver_code" id="ver-code" required/>
                  <div class="invalid-feedback">
                    Please enter an e-signature verification code.
                  </div>
                  <span class="help-block">
                    <small>You can also generate a new verification code <a href="javascript:void(0)">here</a>.</small>
                  </span>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="save-btn">Submit</button>
            <button type="submit" class="btn btn-primary" id="save-btn-loading" hidden disabled>
              <span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span> Please wait...
            </button>
          </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <div id="standard-modal-3" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form id="confirm-security-token-form" class="needs-validation" novalidate>
          <div class="modal-header">
            <h4 class="modal-title" id="standard-modalLabel">Confirm Security Token</h4>
<!--            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>-->
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="password">IGOV Password</label>
                  <input type="password" class="form-control" name="password" id="password" required/>
                  <div class="invalid-feedback">
                    Please enter your password.
                  </div>
                  <span class="help-block">
                    <small>Please enter your password to confirm it is you creating this token.</small>
                  </span>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer"
            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            <button type="button" onclick="confirmSecurityToken()" class="btn btn-primary" id="save-btn">Submit</button>
          </div>
          <input type="hidden" id="post-id">
          <input type="hidden" id="e-signature">
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

</div>

<?=$this->endSection();?>
<?= $this->section('extra-scripts'); ?>
<script src="/assets/libs/dropzone/min/dropzone.min.js"></script>
<script src="/assets/libs/dropify/js/dropify.min.js"></script>
  <!-- Loading buttons js -->
<script src="/assets/libs/ladda/spin.min.js"></script>
<script src="/assets/libs/ladda/ladda.min.js"></script>

  <!-- Buttons init js-->
<!-- Init js-->
<script src="/assets/js/pages/loading-btn.init.js"></script>
<script src="/assets/js/pages/form-fileuploads.init.js"></script>
<?=view('pages/employee/_employee-scripts.php')?>
<?= $this->endSection(); ?>
