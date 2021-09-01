<?= $this->extend('layouts/master'); ?>

<?= $this->section('extra-styles') ?>
<link href="/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<?= $this->endsection() ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?= site_url('/') ?>">iGov</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Add New Product</a></li>
                    </ol>
                </div>
                <h4 class="page-title">Add New Product</h4>
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
                            <h4 class="header-title">Add New Product</h4>
                            <p class="text-muted font-13">
                                Use the form below to add new product
                            </p>
                        </div>
                        <div class="col-lg-4">
                            <div class="text-lg-right mt-lg-0">
                                <div class="btn-group mr-2">
                                    <a href="<?= route_to('manage-products') ?>" class="btn btn-success btn-sm"> Go Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $validation =  \Config\Services::validation(); ?>
                    <?php if(session()->has('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <?= session()->get('success') ?>
                        </div>
                    <?php endif; ?>
                    <form action="<?= route_to('add-new-product') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="contractor_name">Product Name</label>
                                <input type="text" id="product_name" name="product_name" class="form-control" placeholder="Product Name">
                                <?php if ($validation->getError('product_name')): ?>
                                    <div class="text-danger">
                                        <?= $validation->getError('product_name') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <label for="email">Cost Price</label>
                                <input type="text" id="cost_price" name="cost_price" class="form-control" placeholder="Cost Price">
                                <?php if ($validation->getError('cost_price')): ?>
                                    <div class="text-danger">
                                        <?= $validation->getError('cost_price') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="quantity">Quantity</label>
                                <input type="text" id="quantity" name="quantity" class="form-control" placeholder="Quantity">
                                <?php if ($validation->getError('quantity')): ?>
                                    <div class="text-danger">
                                        <?= $validation->getError('quantity') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <label for="quantity">Vendor</label>
                                <select name="vendor" id="vendor" class="form-control "  data-toggle="select2" data-select2-id="5" tabindex="-1" aria-hidden="true">
                                    <?php foreach ($vendors as $vendor): ?>
                                    <option value="<?= $vendor['vendor_id'] ?>"><?= $vendor['vendor_name'] ?? '' ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if ($validation->getError('vendor')): ?>
                                    <div class="text-danger">
                                        <?= $validation->getError('vendor') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-center">
                                <div class="btn-group ">
                                    <a href="" class="btn btn-secondary btn-sm">Cancel</a>
                                    <button class="btn btn-primary btn-sm" type="submit" name="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection(); ?>
<?= $this->section('extra-scripts'); ?>
<script src="/assets/libs/select2/js/select2.min.js"></script>
<?= $this->endSection(); ?>
