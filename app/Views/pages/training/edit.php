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
                        <li class="breadcrumb-item"><a href="<?= site_url('/trainings')?>">Trainings</a></li>
                        <li class="breadcrumb-item active">Edit Training</li>
                    </ol>
                </div>
                <h4 class="page-title">Edit Training</h4>
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
                            <h4 class="header-title mt-2 mb-4">Edit Training</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <?php if(session()->has('error')): ?>
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <?= session()->get('error') ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if(session()->has('success')): ?>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <?= session()->get('success') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <a href="<?=site_url('/trainings')?>" type="button" class="btn btn-sm btn-primary float-right"> <i class="mdi mdi-arrow-left mr-2"></i>Go Back</a>
                        </div>
                    </div>
                    <form id="training-form" class="needs-validation"  action="<?= site_url('/update-training') ?>" method="post" novalidate>
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="subject">Title</label>
                                    <input type="text" value="<?= $training[0]['title'] ?>" placeholder="Title" id="title" class="form-control" name="title" required>
                                    <div class="invalid-feedback">
                                        Please enter a title
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="snow-editor">Description</label>
                                    <div id="snow-editor" class="form-control body" style="height: 300px;">
                                        <?= $training[0]['description'] ?>
                                    </div>
                                    <div class="invalid-feedback">
                                        Please enter a description.
                                    </div>
                                    <textarea name="description" style="display:none" id="hiddenArea"></textarea>
                                    <input type="hidden" name="training" value="<?= $training[0]['training_id'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-lg-12 offset-lg-12 d-flex justify-content-center">
                                <div class="form-group mt-2">
                                    <button type="submit" class="ladda-button ladda-button-demo btn btn-primary " dir="ltr" data-style="zoom-in"">Save changes</button>
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
<script>
    $(document).ready(function(){
        var quill = new Quill ();
        $("#training-form").on("submit",function(){
            $("#hiddenArea").val($("#snow-editor").html());
        })
    });
</script>
<?= $this->endSection(); ?>




