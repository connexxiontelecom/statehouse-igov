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
                            <?php if(session()->has('success')): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <?= session()->get('success') ?>
                                </div>
                            <?php endif; ?>
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
                        </div>
                    </div>
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
                                            <a class="dropdown-item" data-toggle="modal" data-target="#vendorModal_<?= $vendor['vendor_id'] ?>" href="javascript:void(0);"><i class="mdi mdi-check-all mr-2 text-muted font-18 vertical-middle"></i>View Vendor</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <div class="modal fade" id="vendorModal_<?= $vendor['vendor_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Vendor Details</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?= route_to('update-vendor') ?>" method="post" enctype="multipart/form-data">
                                                <?= csrf_field() ?>
                                                <div class="row mb-2">
                                                    <div class="col-md-6">
                                                        <label for="contractor_name">Vendor Name</label>
                                                        <input type="text" id="vendor_name" name="vendor_name"  value="<?= $vendor['vendor_name'] ?>" class="form-control" placeholder="Vendor Name">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="email">Email Address</label>
                                                        <input type="text" id="email" name="email"  value="<?= $vendor['vendor_email'] ?>" class="form-control" placeholder="Email Address">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="mobile_no">Mobile No.</label>
                                                        <input type="text" id="mobile_no" name="mobile_no"  value="<?= $vendor['vendor_mobile_no'] ?>" class="form-control" placeholder="Mobile No.">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="website">Website</label>
                                                        <input type="text" id="website" name="website"  value="<?= $vendor['vendor_website'] ?>" class="form-control" placeholder="Website">
                                                    </div>
                                                </div>
                                                <div class="row mb-2 mt-3">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Address</label>
                                                            <textarea name="address" id="address" style="resize:none;" placeholder="Type contractor address"  class="form-control"><?= $vendor['vendor_address'] ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">About Vendor</label>
                                                            <textarea name="about_vendor" id="about_contractor"  style="resize:none;" placeholder="What kind of service or products does this vendor offer?" class="form-control"><?= $vendor['about_vendor'] ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 d-flex justify-content-center">
                                                        <div class="btn-group ">
                                                            <input type="hidden" name="vendor_key" value="<?= $vendor['vendor_id'] ?>">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button class="btn btn-primary btn-sm" type="submit" name="submit">Save changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
