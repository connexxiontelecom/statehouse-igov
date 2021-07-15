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
                        <li class="breadcrumb-item active">View Training</li>
                    </ol>
                </div>
                <h4 class="page-title">Training Details</h4>
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

    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <!-- project card -->
            <div class="card d-block">
                <div class="card-body">
                    <div class="dropdown float-right">
                        <a href="#" class="dropdown-toggle arrow-none text-muted"
                           data-toggle="dropdown" aria-expanded="false">
                            <i class='mdi mdi-dots-horizontal font-18'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- item-->
                            <a href="<?= site_url('/edit-training/'.$training['slug']) ?>" class="dropdown-item">
                                <i class='mdi mdi-pencil-outline mr-1'></i>Edit Training
                            </a>
                            <!-- item-->
                            <a href="<?= site_url('/trainings') ?>" class="dropdown-item">
                                <i class='mdi mdi-content-copy mr-1'></i>Manage Trainings
                            </a>
                            <div class="dropdown-divider"></div>
                            <!-- item-->
                        </div> <!-- end dropdown menu-->
                    </div> <!-- end dropdown-->
                    <div class="clearfix"></div>

                    <h4><?= $training['title'] ?></h4>
                    <h5 class="mt-3">Overview:</h5>
                    <?= $training['description'] ?>
                </div> <!-- end card-body-->

            </div> <!-- end card-->

            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4 mt-0 font-16">Lessons</h4>
                    <div class="row mb-3">
                        <div class="col-md-12 d-flex justify-content-end">
                            <button type="button" data-toggle="modal" data-target="#addNewLessonModal" class="btn btn-sm text-white btn-blue waves-effect waves-light"><i class='mdi mdi-plus-circle mr-1'></i>Add New Lesson</button>
                        </div>
                        <div class="modal fade" id="addNewLessonModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myCenterModalLabel">Add New Lesson</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="<?= site_url('add-new-training-lesson') ?>" enctype="multipart/form-data">
                                            <?= csrf_field() ?>
                                            <div class="form-group">
                                                <label for="">Title</label>
                                                <input type="text" placeholder="Title" name="lesson_title" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Description</label>
                                                <textarea name="lesson_description"  id="lesson_description" placeholder="Type lesson description here..."
                                                          class="form-control"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Attachments</label>
                                                <input type="file" name="attachments[]" multiple class="form-control-file">
                                            </div>
                                            <input type="hidden" name="training" value="<?= $training['training_id'] ?>">
                                            <hr>
                                            <div class="form-group d-flex justify-content-center">
                                                <button class="btn btn-primary btn-sm" type="submit">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clerfix"></div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php $num = 1; ?>
                                    <?php foreach($lessons as $lesson) : ?>
                                        <tr>
                                            <td><?= $num++ ?> </td>
                                            <td><?= strip_tags(strlen($lesson['lesson_title'])) > 20 ? substr(strip_tags($lesson['lesson_title']),0,20).'...' : strip_tags($lesson['lesson_title']) ?> </td>
                                            <td><?= strip_tags(strlen($lesson['lesson_description'])) > 20 ? substr(strip_tags($lesson['lesson_description']),0,20).'...' : strip_tags($lesson['lesson_description']) ?> </td>
                                            <td>
                                                <div class="btn-group dropdown">
                                                    <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0);" data-target="#editLessonModal_<?= $lesson['lesson_id'] ?>" data-toggle="modal"><i class="mdi mdi-check-all mr-2 text-muted font-18 vertical-middle"></i>View Lesson</a>
                                                    </div>
                                                </div>
                                               </td>
                                            <div class="modal fade" id="editLessonModal_<?= $lesson['lesson_id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myCenterModalLabel">Edit Lesson</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="<?= site_url('update-training-lesson') ?>" enctype="multipart/form-data">
                                                                <?= csrf_field() ?>
                                                                <div class="form-group">
                                                                    <label for="">Title</label>
                                                                    <input type="text" value="<?= $lesson['lesson_title'] ?>" placeholder="Title" name="lesson_title" class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Description</label>
                                                                    <textarea name="lesson_description"  id="lesson_description" placeholder="Type lesson description here..."
                                                                              class="form-control"><?= $lesson['lesson_description'] ?></textarea>
                                                                </div>
                                                                <?php foreach ($lesson_attachments as $attach ): ?>
                                                                    <?php if($attach['lesson_attachment_lesson_id'] == $lesson['lesson_id']): ?>
                                                                        <div class="form-group">
                                                                        <div class="card mb-1 shadow-none border">
                                                                            <div class="p-2">
                                                                                <div class="row align-items-center">
                                                                                    <div class="col-auto">
                                                                                        <div class="avatar-sm">
                                                                                        <span class="avatar-title badge-soft-primary text-primary rounded">
                                                                                            ZIP
                                                                                        </span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col pl-0">
                                                                                        <a href="javascript:void(0);" class="text-muted font-weight-bold"><?= $attach['attachment'] ?></a>
                                                                                    </div>
                                                                                    <div class="col-auto">
                                                                                        <!-- Button -->
                                                                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#deletePromptModal_<?= $attach['lesson_attachment_id'] ?>" class="btn btn-link font-16 text-danger">
                                                                                            <i class="dripicons-cross"></i>
                                                                                        </a>

                                                                                        <div id="deletePromptModal_<?= $attach['lesson_attachment_id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                                                                            <div class="modal-dialog modal-sm">
                                                                                                <div class="modal-content modal-filled bg-danger">
                                                                                                    <div class="modal-body p-4">
                                                                                                        <div class="text-center">
                                                                                                            <i class="dripicons-wrong h1 text-white"></i>
                                                                                                            <h4 class="mt-2 text-white">Are you sure?</h4>
                                                                                                            <p class="mt-3 text-white">This action cannot be undone. Are you sure you want to delete this attachment?</p>
                                                                                                            <a href="<?= site_url('/delete-lesson-attachment/'.$attach['lesson_attachment_id']) ?>" class="btn btn-light my-2">Yes, proceed</a>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <a href="/uploads/posts/<?= $attach['attachment'] ?>" target="_blank" class="btn btn-link font-16 text-muted">
                                                                                            <i class="dripicons-download"></i>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                                <input type="hidden" name="lesson" value="<?= $lesson['lesson_id'] ?>">
                                                                <input type="hidden" name="training" value="<?= $training['training_id'] ?>">
                                                                <hr>
                                                                <div class="form-group d-flex justify-content-center">
                                                                    <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-body-->
            </div>
            <!-- end card-->
        </div> <!-- end col -->


    </div>
    <!-- end row -->

</div>
<?= $this->endSection(); ?>
<?= $this->section('extra-scripts'); ?>

<?= $this->endSection(); ?>




