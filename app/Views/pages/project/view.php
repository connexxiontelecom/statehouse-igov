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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Project Details</a></li>
                    </ol>
                </div>
                <h4 class="page-title">Project Detail</h4>
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
                            <h4 class="header-title">Project Detail</h4>
                            <p class="text-muted font-13">
                                Detail for this project
                            </p>
                        </div>
                        <div class="col-lg-4">
                            <div class="text-lg-right mt-lg-0">
                                <div class="btn-group mr-2">
                                    <a href="<?= route_to('manage-projects') ?>" class="btn btn-success btn-sm"><i class="mdi mdi-library mr-1"></i> Manage Projects</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if(session()->has('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <?= session()->get('success') ?>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-md-6 col-xl-3">
                            <div class="widget-rounded-circle card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="avatar-lg rounded-circle bg-light">
                                            <i class="fe-list font-26 avatar-title text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="text-dark mt-1"><span data-plugin="counterup">942</span></h3>
                                            <p class="text-muted mb-1 text-truncate">Total Tasks</p>
                                        </div>
                                    </div>
                                </div> <!-- end row-->
                            </div> <!-- end widget-rounded-circle-->
                        </div> <!-- end col-->

                        <div class="col-md-6 col-xl-3">
                            <div class="widget-rounded-circle card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="avatar-lg rounded-circle bg-light">
                                            <i class="fe-check-square font-26 avatar-title text-success"></i>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="text-dark mt-1"><span data-plugin="counterup">328</span></h3>
                                            <p class="text-muted mb-1 text-truncate">Total Tasks Completed</p>
                                        </div>
                                    </div>
                                </div> <!-- end row-->
                            </div> <!-- end widget-rounded-circle-->
                        </div> <!-- end col-->

                        <div class="col-md-6 col-xl-3">
                            <div class="widget-rounded-circle card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="avatar-lg rounded-circle bg-light">
                                            <i class="fe-users font-26 avatar-title text-info"></i>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="text-dark mt-1"><span data-plugin="counterup">17</span></h3>
                                            <p class="text-muted mb-1 text-truncate">Total Team Size</p>
                                        </div>
                                    </div>
                                </div> <!-- end row-->
                            </div> <!-- end widget-rounded-circle-->
                        </div> <!-- end col-->

                        <div class="col-md-6 col-xl-3">
                            <div class="widget-rounded-circle card-box">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="avatar-lg rounded-circle bg-light">
                                            <i class="fe-clock font-26 avatar-title text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <h3 class="text-dark mt-1"><span data-plugin="counterup">412</span></h3>
                                            <p class="text-muted mb-1 text-truncate">Total Hours Spent</p>
                                        </div>
                                    </div>
                                </div> <!-- end row-->
                            </div> <!-- end widget-rounded-circle-->
                        </div> <!-- end col-->
                    </div>
                    <div class="row">
                        <div class="col-xl-8 col-lg-6">
                            <!-- project card -->
                            <div class="card d-block">
                                <div class="card-body">
                                    <div class="dropdown float-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="dripicons-dots-3"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-pencil mr-1"></i>Edit</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-delete mr-1"></i>Delete</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-email-outline mr-1"></i>Invite</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-exit-to-app mr-1"></i>Leave</a>
                                        </div>
                                    </div>
                                    <!-- project title-->
                                    <h3 class="mt-0 font-20">
                                        <?= $project->project_name ?? ''?>
                                    </h3>
                                    <div class="">
                                        <?php if($project->project_status == 0): ?>
                                            <label for="" class="badge badge-secondary">Pending</label>
                                        <?php elseif ($project->project_status == 1): ?>
                                            <label for="" class="badge badge-primary">Started</label>
                                        <?php elseif ($project->project_status == 2): ?>
                                            <label for="" class="badge badge-warning">In-progress</label>
                                        <?php elseif ($project->project_statu == 3): ?>
                                            <label for="" class="badge badge-success">Completed</label>
                                        <?php elseif ($project->project_status == 4): ?>
                                            <label for="" class="badge badge-danger">Cancelled</label>
                                        <?php endif; ?>
                                    </div>

                                    <h5>Project Overview:</h5>

                                    <?= $project->project_description ?? '' ?>

                                    <div class="mb-4">
                                        <h5>Tags</h5>
                                        <div class="text-uppercase">
                                            <a href="#" class="badge badge-soft-primary mr-1">Html</a>
                                            <a href="#" class="badge badge-soft-primary mr-1">Css</a>
                                            <a href="#" class="badge badge-soft-primary mr-1">Bootstrap</a>
                                            <a href="#" class="badge badge-soft-primary mr-1">JQuery</a>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-4">
                                                <h5>Start Date</h5>
                                                <p><?= date('d M, Y', strtotime($project->project_start_date)) ?> <small class="text-muted"><?= date('h:i a', strtotime($project->project_start_date)) ?></small></p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-4">
                                                <h5>End Date</h5>
                                                <p><?= date('d M, Y', strtotime($project->project_end_date)) ?> <small class="text-muted"><?= date('h:i a', strtotime($project->project_end_date)) ?></small></p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-4">
                                                <h5>Budget</h5>
                                                <p><?= number_format($project->project_budget ?? 0) ?></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <h5>Team Members:</h5>
                                        <?php foreach ($participants as $participant): ?>
                                        <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?= $participant->employee_f_name ?? '' ?> <?= $participant->employee_l_name ?? '' ?>" class="d-inline-block">
                                            <img src="/assets/images/users/user-6.jpg" class="rounded-circle img-thumbnail avatar-sm" alt="friend">
                                        </a>
                                        <?php endforeach; ?>

                                    </div>

                                </div> <!-- end card-body-->

                            </div> <!-- end card-->

                            <div class="card">
                                <div class="card-body">
                                    <div class="dropdown float-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="dripicons-dots-3"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Latest</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Popular</a>
                                        </div>
                                    </div>

                                    <h4 class="mt-0 mb-3">Comments (258)</h4>

                                    <textarea class="form-control form-control-light mb-2" placeholder="Write message" id="example-textarea" rows="3"></textarea>
                                    <div class="text-right">
                                        <div class="btn-group mb-2">
                                            <button type="button" class="btn btn-link btn-sm text-muted font-18"><i class="dripicons-paperclip"></i></button>
                                        </div>
                                        <div class="btn-group mb-2 ml-2">
                                            <button type="button" class="btn btn-primary btn-sm">Submit</button>
                                        </div>
                                    </div>

                                    <div class="mt-2">
                                        <div class="media">
                                            <img class="mr-2 avatar-sm rounded-circle" src="../assets/images/users/user-3.jpg" alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h5 class="mt-0"><a href="contacts-profile.html" class="text-reset">Jeremy Tomlinson</a> <small class="text-muted">3 hours ago</small></h5>
                                                Nice work, makes me think of The Money Pit.

                                                <br>
                                                <a href="javascript: void(0);" class="text-muted font-13 d-inline-block mt-2"><i class="mdi mdi-reply"></i> Reply</a>

                                                <div class="media mt-3">
                                                    <a class="pr-2" href="#">
                                                        <img src="/assets/images/users/user-4.jpg" class="avatar-sm rounded-circle" alt="Generic placeholder image">
                                                    </a>
                                                    <div class="media-body">
                                                        <h5 class="mt-0"><a href="contacts-profile.html" class="text-reset">Kathleen Thomas</a> <small class="text-muted">1 hours ago</small></h5>
                                                        i'm in the middle of a timelapse animation myself! (Very different though.) Awesome stuff.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="media mt-3">
                                            <img class="mr-2 avatar-sm rounded-circle" src="/assets/images/users/user-2.jpg" alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h5 class="mt-0"><a href="contacts-profile.html" class="text-reset">Jonathan Tiner</a> <small class="text-muted">1 day ago</small></h5>
                                                The parallax is a little odd but O.o that house build is awesome!!

                                                <br>
                                                <a href="javascript: void(0);" class="text-muted font-13 d-inline-block mt-2"><i class="mdi mdi-reply"></i> Reply</a>

                                            </div>
                                        </div>

                                        <div class="media mt-3">
                                            <a class="pr-2" href="#">
                                                <img src="/assets/images/users/user-1.jpg" class="rounded-circle" alt="Generic placeholder image" height="31">
                                            </a>
                                            <div class="media-body">
                                                <input type="text" id="simpleinput" class="form-control form-control-sm form-control-light" placeholder="Add comment">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center mt-2">
                                        <a href="javascript:void(0);" class="text-danger"><i class="mdi mdi-spin mdi-loading mr-1 font-16"></i> Load more </a>
                                    </div>
                                </div> <!-- end card-body-->
                            </div>
                            <!-- end card-->
                        </div> <!-- end col -->

                        <div class="col-lg-6 col-xl-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Files</h5>
                                    <?php if(count($attachments) > 0): ?>
                                    <?php foreach($attachments as $attachment):?>
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
                                                    <a href="javascript:void(0);" class="text-muted font-weight-bold">Ubold-sketch-design.zip</a>
                                                    <p class="mb-0">2.3 MB</p>
                                                </div>
                                                <div class="col-auto">
                                                    <!-- Button -->
                                                    <a href="/uploads/posts/<?=$attachment->project_attachment ?>" class="btn btn-link btn-lg text-muted">
                                                        <i class="dripicons-download"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                    <h5 class="text-center">No attachments</h5>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection(); ?>
<?= $this->section('extra-scripts'); ?>
<script src="/assets/libs/select2/js/select2.min.js"></script>
<?= $this->endSection(); ?>
