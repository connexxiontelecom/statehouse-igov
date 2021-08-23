<?= $this->extend('layouts/admin'); ?>

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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Add New Contractor</a></li>
                    </ol>
                </div>
                <h4 class="page-title">Add New Contractor</h4>
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
                            <h4 class="header-title">Add New Contractor</h4>
                            <p class="text-muted font-13">
                                Use the form below to add new contractor
                            </p>
                        </div>
                        <div class="col-lg-4">
                            <div class="text-lg-right mt-lg-0">
                                <div class="btn-group mr-2">
                                    <a href="<?= route_to('manage-contractors') ?>" class="btn btn-success btn-sm"><i class="mdi mdi-library mr-1"></i> Manage Contractors</a>
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
                    <form action="<?= route_to('add-new-contractor') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <label for="contractor_name">Contractor Name</label>
                                <input type="text" id="contractor_name" name="contractor_name" class="form-control" placeholder="Contractor Name">
                                <?php if ($validation->getError('contractor_name')): ?>
                                    <div class="text-danger">
                                        <?= $validation->getError('contractor_name') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <label for="email">Email Address</label>
                                <input type="text" id="email" name="email" class="form-control" placeholder="Email Address">
                                <?php if ($validation->getError('email')): ?>
                                    <div class="text-danger">
                                        <?= $validation->getError('email') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="mobile_no">Mobile No.</label>
                                <input type="text" id="mobile_no" name="mobile_no" class="form-control" placeholder="Mobile No.">
                                <?php if ($validation->getError('mobile_no')): ?>
                                    <div class="text-danger">
                                        <?= $validation->getError('mobile_no') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <label for="website">Website</label>
                                <input type="text" id="website" name="website" class="form-control" placeholder="Website">
                                <?php if ($validation->getError('website')): ?>
                                    <div class="text-danger">
                                        <?= $validation->getError('website') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row mb-2 mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <textarea name="address" id="address" style="resize:none;" placeholder="Type contractor address" class="form-control"></textarea>
                                    <?php if ($validation->getError('address')): ?>
                                        <div class="text-danger">
                                            <?= $validation->getError('address') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">About Contractor</label>
                                    <textarea name="about_contractor" id="about_contractor" style="resize:none;" placeholder="What kind of service or products does this contractor offer?" class="form-control"></textarea>
                                    <?php if ($validation->getError('about_contractor')): ?>
                                        <div class="text-danger">
                                            <?= $validation->getError('about_contractor') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
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
