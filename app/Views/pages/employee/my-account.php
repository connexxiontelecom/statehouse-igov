<?=$this->extend('layouts/master');?>

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
            <a href="javascript: void(0);" class="btn- btn-xs btn-secondary">Edit</a>
          </div>
        </div>

        <h5 class="mb-3 mt-4 text-uppercase bg-light p-2"><i class="mdi mdi-account-circle mr-1"></i> Information</h5>
        <div class="">
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
          <a href="#" class="dropdown-toggle arrow-none text-muted"
             data-toggle="dropdown" aria-expanded="false">
            <i class='mdi mdi-dots-horizontal font-18'></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item">
              <i class='mdi mdi-attachment mr-1'></i>Create
            </a>
            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item">
              <i class='mdi mdi-pencil-outline mr-1'></i>Edit
            </a>
            <div class="dropdown-divider"></div>
            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item text-danger">
              <i class='mdi mdi-delete-outline mr-1'></i>Delete
            </a>
          </div> <!-- end dropdown menu-->
        </div> <!-- end dropdown-->
        <h5 class="card-title font-16 mb-3">E-Signature</h5>
        <div class="card mb-1 shadow-none border">
          <div class="p-2 text-center">
            No E-Signature Set Up
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?=$this->endSection();?>