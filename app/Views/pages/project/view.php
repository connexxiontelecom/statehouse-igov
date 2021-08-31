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

                            <div class="float-right">

                                <div class="dropdown">
                                    <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Manage Project
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#reportModal">Submit Report</a>
                                        <a class="dropdown-item" href="#">Update Status</a>
                                    </div>
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
                                            <h3 class="text-dark mt-1"><span data-plugin="counterup"><?= number_format($project->project_budget ?? 0) ?></span></h3>
                                            <p class="text-muted mb-1 text-truncate">Project Amount</p>
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
                                            <h3 class="text-dark mt-1"><span data-plugin="counterup">0</span></h3>
                                            <p class="text-muted mb-1 text-truncate">Expenses</p>
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
                                            <h3 class="text-dark mt-1"><span data-plugin="counterup"><?= count($participants ) ?></span></h3>
                                            <p class="text-muted mb-1 text-truncate">Team Size</p>
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
                                            <h3 class="text-dark mt-1"><span data-plugin="counterup"><?= intval(abs(strtotime($project->project_end_date) - strtotime($project->project_start_date))/86400) ?></span></h3>
                                            <p class="text-muted mb-1 text-truncate">Days left</p>
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
                                    <h4 class="mt-0 mb-3">Comments (<?= number_format(count($conversations)) ?>)</h4>
                                    <form action="<?= site_url('/leave-comment') ?>" method="post">
                                        <?= csrf_field() ?>
                                        <textarea name="comment" class="form-control form-control-light mb-2" style="resize:none;" placeholder="Write message" id="example-textarea" rows="3"></textarea>
                                        <div class="text-right">
                                            <input type="hidden" name="convo_project_id" value="<?= $project->project_id ?>">
                                            <div class="btn-group mb-2 ml-2">
                                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                    <div class="mt-2">
                                        <?php foreach ($conversations as $conversation): ?>
                                            <div class="media mb-2">
                                                <img class="mr-2 avatar-sm rounded-circle" src="../assets/images/users/user-3.jpg" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h5 class="mt-0">
                                                        <a href="contacts-profile.html" class="text-reset"><?= $conversation->employee_f_name ?? '' ?> <?= $conversation->employee_l_name ?? '' ?></a> <small class="text-muted"><?= date('d M, Y h:i a', strtotime($conversation->created_at)) ?></small></h5>
                                                    <?= $conversation->project_convo ?? '' ?>
                                                    <br>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mt-0 mb-3">Report(s)</h4>
                                    <div id="accordion" class="mb-3">
                                        <?php foreach ($reports as $report): ?>
                                        <div class="card mb-1">
                                            <div class="card-header" id="heading_<?= $report->project_report_id  ?? '' ?>">
                                                <h5 class="m-0">
                                                    <a class="text-dark collapsed" data-toggle="collapse" href="#collapse_<?= $report->project_report_id  ?? '' ?>" aria-expanded="false">
                                                        <i class=" mr-1 text-primary"></i>
                                                        <?= $report->project_report_subject ?? '' ?>
                                                    </a>
                                                </h5>
                                            </div>

                                            <div id="collapse_<?= $report->project_report_id  ?? '' ?>" class="collapse" aria-labelledby="heading_<?= $report->project_report_id  ?? '' ?>" data-parent="#accordion" style="">
                                                <div class="card-body">
                                                    <?= $report->project_report_content ?? '' ?>
                                                </div>
                                                <?php foreach ($report_attachments as $report_attachment): ?>
                                                 <?php if($report_attachment->project_report_attachment_report_id == $report->project_report_id): ?>
                                                        <a href="/uploads/posts/<?= $report_attachment->project_report_attachment ?>" target="_blank" class="btn btn-primary btn-sm">Download</a>
                                                 <?php endif; ?>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>


                            </div>
                            </div>

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
                                                    <a href="javascript:void(0);" class="text-muted font-weight-bold"><?= substr($project->project_name,0,23) ?></a>
                                                </div>
                                                <div class="col-auto">
                                                    <!-- Button -->
                                                    <a target="_blank" href="/uploads/posts/<?=$attachment->project_attachment ?>" class="btn btn-link btn-lg text-muted">
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
    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Submit Report</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= route_to('submit-project-report') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Subject</label>
                                    <input type="text" placeholder="Subject" name="subject" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Attachment(s)</label>
                                    <input type="file"  placeholder="Attachments" name="attachments[]" multiple class="form-control-file">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Report</label>
                                    <textarea name="report"  id="report" class="form-control" placeholder="Type report here..." cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 d-flex justify-content-center">
                                <input type="hidden" name="project_report" value="<?= $project->project_id ?>">
                                <div class="form-group">
                                    <div class="btn-group">
                                        <button class="btn btn-secondary btn-sm" type="button">Cancel</button>
                                        <button class="btn btn-sm btn-primary" type="submit">Submit</button>
                                    </div>
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
