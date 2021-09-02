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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Manage Products</a></li>
                    </ol>
                </div>
                <h4 class="page-title">Manage Products</h4>
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
                            <h4 class="header-title">All Products</h4>
                            <p class="text-muted font-13">
                                Below are your list of product
                            </p>
                        </div>
                        <div class="col-lg-4">
                            <div class="text-lg-right mt-lg-0">
                                <div class="btn-group mr-2">
                                    <a href="<?= route_to('add-new-product') ?>" class="btn btn-success btn-sm"><i class="mdi mdi-plus-circle mr-1"></i> Add New Product</a>
                                </div>
                            </div>
                        </div><!-- end col-->
                    </div> <!-- end row -->
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th class="text-center" style="width: 5%">S/n</th>
                            <th>Product Name</th>
                            <th>Cost</th>
                            <th>Quantity</th>
                            <th>In-stock</th>
                            <th class="text-center" style="width: 10%">Actions</th>
                        </tr>

                        </thead>
                        <tbody>
                        <?php $serial = 1; ?>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?= $serial++ ?></td>
                                <td><?= $product['product_name'] ?? '' ?></td>
                                <td class="text-right"><?= number_format($product['cost_price']  ?? 0,2) ?></td>
                                <td><?= $product['quantity'] ?? '' ?></td>
                                <td><?= $product['in_stock'] ?? '' ?></td>
                                <td>
                                    <div class="btn-group dropdown">
                                        <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#productModal_<?=$product['product_id'] ?>">
                                                <i class="mdi mdi-check-all mr-2 text-muted font-18 vertical-middle"></i>View Product
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <div class="modal fade" id="productModal_<?=$product['product_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Product Details</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?= route_to('add-new-product') ?>" method="post" enctype="multipart/form-data">
                                                <?= csrf_field() ?>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="contractor_name">Product Name</label>
                                                        <input type="text" id="product_name" name="product_name" value="<?= $product['product_name'] ?>" readonly class="form-control" placeholder="Product Name">

                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="email">Cost Price</label>
                                                        <input type="text" id="cost_price" name="cost_price" value="<?= $product['cost_price'] ?>" readonly class="form-control" placeholder="Cost Price">

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="quantity">Quantity</label>
                                                        <input type="text" id="quantity" name="quantity" value="<?= $product['quantity'] ?>" readonly class="form-control" placeholder="Quantity">

                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="quantity">Vendor</label>
                                                        <input type="text" value="<?= $product['vendor_name'] ?>" readonly class="form-control">

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 d-flex justify-content-center mt-3">
                                                        <div class="btn-group ">
                                                            <input type="hidden" name="product_key" value="<?= $product['product_id'] ?>">
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

<script src="/assets/js/pages/datatables.init.js"></script>
<?= $this->endSection(); ?>
