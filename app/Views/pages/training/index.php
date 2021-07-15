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
                        <li class="breadcrumb-item active">Trainings</li>
                    </ol>
                </div>
                <h4 class="page-title">Trainings</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <a href="<?= site_url('add-new-training') ?>" class="btn btn-sm btn-blue waves-effect waves-light float-right">
                    <i class="mdi mdi-plus-circle"></i> Add New Training
                </a>
                <h4 class="header-title mb-4">Manage Trainings</h4>

                <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100" id="tickets-table">
                    <thead>
                    <tr>
                        <th>
                            S/No.
                        </th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Author</th>
                        <th>Date</th>
                        <th class="hidden-sm">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php  $serial = 1; ?>
                    <?php foreach($trainings as $training): ?>
                    <tr>
                        <td><?= $serial++ ?> </td>
                        <td>
                           <?= strlen($training['title']) > 35 ? substr($training['title'],0,35).'...' :  $training['title'] ?>
                        </td>

                        <td>
                            <?= strip_tags(strlen($training['description'])) > 35 ? substr(strip_tags($training['description']),0,35).'...' : strip_tags($training['description']) ?>
                        </td>

                        <td>
                            author
                        </td>

                        <td>
                           <?= date('d M, Y', strtotime($training['created_at'])) ?>
                        </td>
                        <td>
                            <div class="btn-group dropdown">
                                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="<?= site_url('/edit-training/'.$training['slug']) ?>"><i class="mdi mdi-pencil mr-2 text-muted font-18 vertical-middle"></i>Edit Training</a>
                                    <a class="dropdown-item" href="<?= site_url('/trainings/'.$training['slug']) ?>"><i class="mdi mdi-check-all mr-2 text-muted font-18 vertical-middle"></i>View Training</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div><!-- end col -->
    </div>
</div>

<?= $this->endSection(); ?>

