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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Messaging</a></li>
                        <li class="breadcrumb-item active">circular Board</li>
                    </ol>
                </div>
                <h4 class="page-title">GDrive</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-lg-5">
                        <h4 class="header-title mt-2 mb-4">Upload New File</h4>
                    </div>
                    <div class="col-lg-3">
                        <form method="get">
                            <div class="form-group">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="search_params">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary waves-effect waves-light" type="submit">Search</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-2">

                        <a href="<?=site_url('/my-circulars')?>" type="button" class="btn btn-primary btn-sm btn-block float-right">My circulars</a>

                    </div>
                    <div class="col-lg-2">
                        <a href="<?=site_url('/new-circular')?>" type="button" class="btn btn-primary btn-sm btn-block float-right"> <i class="mdi mdi-plus mr-2"></i>New circular</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">File</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Folder</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <?php if (session('error')) : ?>
                                    <div class="alert alert-warning alert-dismissible">
                                        <?= session('error') ?>
                                        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                                    </div>
                                <?php endif ?>
                                <?php if (session('success')) : ?>
                                    <div class="alert alert-success alert-dismissible">
                                        <?= session('success') ?>
                                        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                                    </div>
                                <?php endif ?>
                                <form method="post" action="<?= site_url('/process-upload') ?>" enctype="multipart/form-data" autocomplete="off">
                                    <?= csrf_field() ?>
                                    <div class="form-group">
                                        <label for="">File Name</label>
                                        <input type="text" placeholder="File Name" name="filename" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Attachment</label>
                                        <input type="file" name="attachments" multiple class="form-control-file">
                                    </div>
                                    <hr>
                                    <div class="form-group d-flex justify-content-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-secondary btn-sm">Cancel</button>
                                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <form method="post" action="<?= site_url('/create-folder') ?>" enctype="multipart/form-data" autocomplete="off">
                                        <?= csrf_field() ?>
                                        <div class="form-group">
                                            <label for="">Folder Name</label>
                                            <input type="text" placeholder="Folder Name" name="folder_name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Parent Folder</label>
                                            <select name="parent_folder" id="parent_folder" class="form-control">
                                                <option value="0" selected>Default</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Visibility</label>
                                            <select name="visibility" id="visibility" class="form-control">
                                                <option value="1">Private</option>
                                                <option value="2">Public</option>
                                            </select>
                                        </div>
                                        <hr>
                                        <div class="form-group d-flex justify-content-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-secondary btn-sm">Cancel</button>
                                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <h4 class="header-title mt-2 mb-4">All Documents</h4>
                        <?php foreach($files as $file): ?>
                            <a class="btn btn-sm btn-primary text-white" target="_blank" href="uploads/posts/<?= $file['file_name'] ?>"><?= $file['name'] ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection(); ?>

