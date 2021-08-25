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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Edit Project</a></li>
                    </ol>
                </div>
                <h4 class="page-title">Edit Project</h4>
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
                            <h4 class="header-title">Edit Project</h4>
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
                    <form action="<?= route_to('update-project') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <label for="projectname">Project Name</label>
                                <input type="text" id="project_name" value="<?= $project->project_name ?>" name="project_name" class="form-control" placeholder="Project Name">
                                <?php if ($validation->getError('project_name')): ?>
                                    <div class="text-danger">
                                        <?= $validation->getError('project_name') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <label for="projectname">Sponsor</label>
                                <input type="text" id="sponsor" name="sponsor" value="<?= $project->project_sponsor ?>" class="form-control" placeholder="Sponsor">
                                <?php if ($validation->getError('sponsor')): ?>
                                    <div class="text-danger">
                                        <?= $validation->getError('sponsor') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="projectname">Project Manager</label>
                                <select class="form-control select2-hidden-accessible"  data-toggle="select2" data-select2-id="4" tabindex="-1" aria-hidden="true" name="project_manager">
                                    <option disabled selected>-- Select project manager --</option>
                                    <?php foreach($employees as $employee): ?>
                                        <option value="<?= $employee['employee_id'] ?>"><?= $employee['employee_f_name'] ?> <?= $employee['employee_l_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if ($validation->getError('project_manager')): ?>
                                    <div class="text-danger">
                                        <?= $validation->getError('project_manager') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <label for="projectname">Team Members</label>
                                <select class="form-control select2-hidden-accessible" multiple="multiple" data-toggle="select2" data-select2-id="5" tabindex="-1" aria-hidden="true" name="team_members[]">
                                    <option disabled selected>-- Select project manager --</option>
                                    <?php foreach($employees as $employee): ?>
                                        <option value="<?= $employee['employee_id'] ?>"><?= $employee['employee_f_name'] ?> <?= $employee['employee_l_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if ($validation->getError('team_members')): ?>
                                    <div class="text-danger">
                                        <?= $validation->getError('team_members') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row mb-2 mt-3">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Project Privacy</label> <br>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadio1" name="privacy" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio1">Private</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                        <label class="custom-control-label" for="privacy">Team</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadio3" name="privacy" class="custom-control-input" checked="">
                                        <label class="custom-control-label" for="customRadio3">Public</label>
                                    </div>
                                </div>
                                <?php if ($validation->getError('privacy')): ?>
                                    <div class="text-danger">
                                        <?= $validation->getError('privacy') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-3">
                                <label for="priority">Priority</label>
                                <select name="priority" id="priority" class="form-control">
                                    <option disabled selected>-- Select priority --</option>
                                    <option value="1">Normal</option>
                                    <option value="2">Medium</option>
                                    <option value="3">High</option>
                                </select>
                                <?php if ($validation->getError('priority')): ?>
                                    <div class="text-danger">
                                        <?= $validation->getError('priority') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label for="project-budget">Budget</label>
                                    <input type="number" step="0.01" id="budget" value="<?= $project->project_budget ?>" name="budget" class="form-control" placeholder="Budget">
                                    <?php if ($validation->getError('budget')): ?>
                                        <div class="text-danger">
                                            <?= $validation->getError('budget') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2 mt-3">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <input type="datetime-local" name="start_date" class="form-control"  placeholder="October 9, 2019">
                                    <?php if ($validation->getError('start_date')): ?>
                                        <div class="text-danger">
                                            <?= $validation->getError('start_date') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>End Date</label>
                                    <input type="datetime-local" name="end_date" class="form-control"  placeholder="March 9, 2020">
                                    <?php if ($validation->getError('end_date')): ?>
                                        <div class="text-danger">
                                            <?= $validation->getError('end_date') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Attachment(s)</label>
                                    <input type="file" name="attachments[]" class="form-control-file" multiple>
                                    <?php if ($validation->getError('attachments')): ?>
                                        <div class="text-danger">
                                            <?= $validation->getError('attachments') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2 mt-3">
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label for="project-overview">Project Overview</label>
                                    <textarea class="form-control" id="project_overview" name="project_overview" rows="5" placeholder="Enter some brief about project.."><?= $project->project_description ?></textarea>
                                    <?php if ($validation->getError('project_overview')): ?>
                                        <div class="text-danger">
                                            <?= $validation->getError('project_overview') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-center">
                                <input type="hidden" name="project" value="<?= $project->project_id ?>">
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
