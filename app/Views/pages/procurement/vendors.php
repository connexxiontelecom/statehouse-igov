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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Manage Vendors</a></li>
                    </ol>
                </div>
                <h4 class="page-title">Manage Vendors</h4>
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
                            <h4 class="header-title">All Vendors</h4>
                            <p class="text-muted font-13">
                                Below are your list of vendors
                            </p>
                        </div>
                        <div class="col-lg-4">
                            <div class="text-lg-right mt-lg-0">
                                <div class="btn-group mr-2">
                                    <a href="<?= route_to('add-new-vendor') ?>" class="btn btn-success btn-sm"><i class="mdi mdi-plus-circle mr-1"></i> Add New Vendor</a>
                                </div>
                            </div>
                        </div><!-- end col-->
                    </div> <!-- end row -->
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th class="text-center" style="width: 5%">S/n</th>
                            <th>Vendor Name</th>
                            <th>Email</th>
                            <th>Mobile No.</th>
                            <th>Website</th>
                            <th class="text-center" style="width: 10%">Actions</th>
                        </tr>

                        </thead>
                        <tbody>
                        <?php $serial = 1; ?>
                        <?php foreach ($vendors as $vendor): ?>
                            <tr>
                                <td><?= $serial++ ?></td>
                                <td><?= $vendor['vendor_name'] ?></td>
                                <td><?= $vendor['vendor_email'] ?></td>
                                <td><?= $vendor['vendor_mobile_no'] ?></td>
                                <td><?= $vendor['vendor_website'] ?></td>
                                <td>
                                    <div class="btn-group dropdown">
                                        <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="javascript:void(0);"><i class="mdi mdi-check-all mr-2 text-muted font-18 vertical-middle"></i>View Vendor</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
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
