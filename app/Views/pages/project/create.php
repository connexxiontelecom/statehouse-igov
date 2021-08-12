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
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="projectname">Project Name</label>
                                <input type="text" id="projectname" class="form-control" placeholder="Enter project name">
                            </div>

                            <div class="form-group">
                                <label for="project-overview">Project Overview</label>
                                <textarea class="form-control" id="project-overview" rows="5" placeholder="Enter some brief about project.."></textarea>
                            </div>

                            <div class="form-group">
                                <label>Project Privacy</label> <br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1">Private</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio2">Team</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input" checked="">
                                    <label class="custom-control-label" for="customRadio3">Public</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <!-- Date View -->
                                    <div class="form-group">
                                        <label>Start Date</label>
                                        <input type="hidden" class="form-control flatpickr-input" data-toggle="flatpicker" placeholder="October 9, 2019"><input class="form-control form-control input" placeholder="October 9, 2019" tabindex="0" type="text" readonly="readonly">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <!-- Date View -->
                                    <div class="form-group">
                                        <label>Due Date</label>
                                        <input type="hidden" class="form-control flatpickr-input" data-toggle="flatpicker" placeholder="March 9, 2020"><input class="form-control form-control input" placeholder="March 9, 2020" tabindex="0" type="text" readonly="readonly">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="project-priority">Project Priority</label>

                                <select class="form-control select2-hidden-accessible" data-toggle="select2" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    <option value="MD" data-select2-id="3">Medium</option>
                                    <option value="HI">High</option>
                                    <option value="LW">Low</option>
                                </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="2" style="width: 576.6px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-f2fk-container"><span class="select2-selection__rendered" id="select2-f2fk-container" role="textbox" aria-readonly="true" title="Medium">Medium</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                            </div>

                            <div class="form-group">
                                <label for="project-budget">Budget</label>
                                <input type="text" id="project-budget" class="form-control" placeholder="Enter project budget">
                            </div>

                        </div> <!-- end col-->

                        <div class="col-xl-6">
                            <div class="form-group mt-3 mt-xl-0">
                                <label for="projectname" class="mb-0">Avatar</label>
                                <p class="text-muted font-14">Recommended thumbnail size 800x400 (px).</p>

                                <form action="/" method="post" class="dropzone dz-clickable" id="myAwesomeDropzone" data-plugin="dropzone" data-previews-container="#file-previews" data-upload-preview-template="#uploadPreviewTemplate">


                                    <div class="dz-message needsclick">
                                        <i class="h3 text-muted dripicons-cloud-upload"></i>
                                        <h4>Drop files here or click to upload.</h4>
                                    </div>
                                </form>

                                <!-- Preview -->
                                <div class="dropzone-previews mt-3" id="file-previews"></div>

                                <!-- file preview template -->
                                <div class="d-none" id="uploadPreviewTemplate">
                                    <div class="card mt-1 mb-0 shadow-none border">
                                        <div class="p-2">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <img data-dz-thumbnail="" src="#" class="avatar-sm rounded bg-light" alt="">
                                                </div>
                                                <div class="col pl-0">
                                                    <a href="javascript:void(0);" class="text-muted font-weight-bold" data-dz-name=""></a>
                                                    <p class="mb-0" data-dz-size=""></p>
                                                </div>
                                                <div class="col-auto">
                                                    <!-- Button -->
                                                    <a href="" class="btn btn-link btn-lg text-muted" data-dz-remove="">
                                                        <i class="mdi mdi-close"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end file preview template -->
                            </div>

                            <div class="form-group mb-0">
                                <label for="project-overview">Team Members</label>

                                <select class="form-control select2-hidden-accessible" data-toggle="select2" data-select2-id="4" tabindex="-1" aria-hidden="true">
                                    <option data-select2-id="6">Select</option>
                                    <option value="AZ">Mary Scott</option>
                                    <option value="CO">Holly Campbell</option>
                                    <option value="ID">Beatrice Mills</option>
                                    <option value="MT">Melinda Gills</option>
                                    <option value="NE">Linda Garza</option>
                                    <option value="NM">Randy Ortez</option>
                                    <option value="ND">Lorene Block</option>
                                    <option value="UT">Mike Baker</option>
                                </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="5" style="width: 576.6px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-pes0-container"><span class="select2-selection__rendered" id="select2-pes0-container" role="textbox" aria-readonly="true" title="Select">Select</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>

                                <div class="mt-2">
                                    <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mat Helme" class="d-inline-block">
                                        <img src="/assets/images/users/user-6.jpg" class="rounded-circle avatar-xs" alt="friend">
                                    </a>

                                    <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="" data-original-title="Michael Zenaty" class="d-inline-block">
                                        <img src="/assets/images/users/user-7.jpg" class="rounded-circle avatar-xs" alt="friend">
                                    </a>

                                    <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="" data-original-title="James Anderson" class="d-inline-block">
                                        <img src="/assets/images/users/user-8.jpg" class="rounded-circle avatar-xs" alt="friend">
                                    </a>

                                    <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="" data-original-title="Lorene Block" class="d-inline-block">
                                        <img src="/assets/images/users/user-4.jpg" class="rounded-circle avatar-xs" alt="friend">
                                    </a>

                                    <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mike Baker" class="d-inline-block">
                                        <img src="/assets/images/users/user-5.jpg" class="rounded-circle avatar-xs" alt="friend">
                                    </a>
                                </div>

                            </div>
                        </div> <!-- end col-->
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
