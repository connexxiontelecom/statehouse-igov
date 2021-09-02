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
            <a href="#profile1" data-toggle="tab" aria-expanded="true" class="nav-link">Profile</a>
          </li>
          <li class="nav-item">
            <a href="#messages1" data-toggle="tab" aria-expanded="false" class="nav-link">Staff Directory</a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane fade show active" id="overview">
            <?=view('pages/dashboard/_overview')?>
          </div>
          <div class="tab-pane fade" id="profile1">
            <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
            <p class="mb-0">Vakal text here dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
          </div>
          <div class="tab-pane" id="messages1">
            <p>Vakal text here dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
            <p class="mb-0">Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
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