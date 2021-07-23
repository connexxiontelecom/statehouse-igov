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
                        <li class="breadcrumb-item"><a href="<?= site_url('/workflow-requests')?>">Workflow Requests</a></li>
                        <li class="breadcrumb-item active">Submit New Workflow Request</li>
                    </ol>
                </div>
                <h4 class="page-title">Submit New Workflow Request</h4>
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
                            <h4 class="header-title mt-2 mb-4">Submit New Workflow Request</h4>
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
                            <a href="<?=site_url('/workflow-requests')?>" type="button" class="btn btn-sm btn-primary float-right"> <i class="mdi mdi-arrow-left mr-2"></i>Go Back</a>
                        </div>
                    </div>
                    <?php $validation = \Config\Services::validation(); ?>
                    <form enctype="multipart/form-data" id="training-form" class="needs-validation"  action="<?= site_url('/workflow-requests/new-request') ?>" method="post" novalidate>
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="subject">Title</label>
                                    <input type="text" placeholder="Title" id="title" class="form-control" name="title">
                                    <div class="invalid-feedback">
                                        Please enter a title
                                    </div>
                                    <?php if($validation->getError('title')) {?>
                                        <div class='text-danger mt-2'>
                                            <?= $error = $validation->getError('title'); ?>
                                        </div>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="subject">Workflow Type</label>
                                    <select name="workflow_type" id="workflow_type" class="form-control" >
                                        <option selected disabled>--Select workflow type --</option>
                                        <?php foreach($workflow_types as $type): ?>
                                            <option value="<?= $type['workflow_type_id'] ?>"><?= $type['workflow_type_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        select workflow type
                                    </div>
                                    <?php if($validation->getError('workflow_type')) {?>
                                        <div class='text-danger mt-2'>
                                            <?= $error = $validation->getError('workflow_type'); ?>
                                        </div>
                                    <?php }?>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="subject">Amount</label>
                                    <input type="number" step="0.01" placeholder="Amount" name="amount" class="form-control" >
                                    <div class="invalid-feedback">
                                        Please enter a amount
                                    </div>
                                    <?php if($validation->getError('amount')) {?>
                                        <div class='text-danger mt-2'>
                                            <?= $error = $validation->getError('amount'); ?>
                                        </div>
                                    <?php }?>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="subject">Attachment(s)</label>
                                    <input type="file" name="attachments[]" multiple class="form-control-file">
                                    <div class="invalid-feedback">
                                        Please enter a amount
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="snow-editor">Description</label>
                                    <div id="snow-editor" class="form-control body" style="height: 300px;"></div>
                                    <div class="invalid-feedback">
                                        Please enter a description.
                                    </div>
                                    <?php if($validation->getError('description')) {?>
                                        <div class='text-danger mt-2'>
                                            <?= $error = $validation->getError('description'); ?>
                                        </div>
                                    <?php }?>
                                    <textarea name="description" style="display:none" id="hiddenArea"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-lg-12 offset-lg-12 d-flex justify-content-center">
                                <div class="form-group mt-2">
                                    <button type="submit" class="ladda-button ladda-button-demo btn btn-primary " dir="ltr" data-style="zoom-in"">Submit</button>
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




