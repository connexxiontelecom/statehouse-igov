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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Manage Projects</a></li>
                    </ol>
                </div>
                <h4 class="page-title">Manage Projects</h4>
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
                            <h4 class="header-title">All Projects</h4>
                            <p class="text-muted font-13">
                                Below are your published projects
                            </p>
                        </div>
                        <div class="col-lg-4">
                            <div class="text-lg-right mt-lg-0">
                                <div class="btn-group mr-2">
                                    <a href="<?= route_to('manage-projects') ?>" class="btn btn-success btn-sm"><i class="mdi mdi-library mr-1"></i> Manage Projects</a>
                                </div>
                            </div>
                        </div><!-- end col-->
                    </div> <!-- end row -->
                    create
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>

</div>
<?= $this->endSection(); ?>
<?= $this->section('extra-scripts'); ?>

<?= $this->endSection(); ?>
