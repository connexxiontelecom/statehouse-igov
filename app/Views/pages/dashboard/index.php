<?= $this->extend('layouts/master') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
	<!-- start page title -->

  <div class="row mt-2">
    <div class="col-xl-3">
      <div class="jumbotron jumbotron-fluid text-center mt-3">
        <div class="container">
          <?php if (empty($organization)):?>
            <h5>Your organization information has not set up on iGov yet</h5>
          <?php else:?>
            <img src="/uploads/organization/<?=$organization['org_logo'] ?>" height="100" class="mb-3" alt="company logo">
            <div class="media">
              <div class="media-body">
                <h5 class="mt-0 mb-2"><?=$organization['org_name'] ?></h5>
                <p class="mb-0"><?=$organization['org_address'] ?></p>
                <p class="mb-0"><?=$organization['org_c_phone'] ?></p>
                <p class="mb-0"><?=$organization['org_c_email'] ?></p>
                <p class="mb-0"><?=$organization['org_web'] ?></p>
              </div>
            </div>
          <?php endif;?>
        </div>
      </div>
      <div class="card-box" style="border-radius: 10px">
        <small class="float-right">
          <a class="text-success" href="<?=site_url('/reminders')?>">View more</a>
        </small>
        <h4 class="header-title mb-3">Upcoming <span class="text-muted">Reminders</span></h4>
        <ul class="list-group">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Investments and crops project
            <small>Today</small>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Investment Address At Central Bank
            <small>13 Oct 2020</small>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Action Needed
            <small>13 Oct 2020</small>
          </li>
        </ul>
      </div> <!-- end card-box-->
    </div>
    <div class="col-xl-9">
      <div class="row">
        <div class="col-12">
          <div class="page-title-box">
            <div class="page-title-right">
              <span class="text-muted">
                <?php $date = date_create(date('d M Y'));
                  echo date_format($date,"l, d F Y");
                ?>
              </span>
            </div>
            <h4 class="page-title">Welcome, <?=session()->user_name;?></h4>
          </div>
        </div>
      </div>
      <div class="mt-2">
        <ul class="nav nav-pills">
          <li class="nav-item">
            <a href="#overview" data-toggle="tab" aria-expanded="false" class="nav-link active">Overview</a>
          </li>
          <li class="nav-item">
            <a href="#notifications" data-toggle="tab" aria-expanded="true" class="nav-link">Activities</a>
          </li>
          <li class="nav-item">
            <a href="#directory" data-toggle="tab" aria-expanded="false" class="nav-link">Directory</a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane fade show active" id="overview">
            <?=view('pages/dashboard/_overview')?>
          </div>
          <div class="tab-pane fade" id="notifications">
	          <?=view('pages/dashboard/_notifications')?>
          </div>
          <div class="tab-pane" id="directory">
	          <?=view('pages/dashboard/_directory')?>
          </div>
        </div>
      </div>

    </div>
  </div>
	<!-- end page title -->
</div> <!-- container -->
<?= $this->endSection() ?>
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