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
                        <li class="breadcrumb-item active">Workflow Requests</li>
                    </ol>
                </div>
                <h4 class="page-title">Workflow Requests</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <a href="<?= site_url('/workflow-requests/new-request') ?>" class="btn btn-sm btn-blue waves-effect waves-light float-right">
                    <i class="mdi mdi-plus-circle"></i> Add New Request
                </a>
                <h4 class="header-title mb-4">My Workflow Requests</h4>

                <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100" id="tickets-table">
                    <thead>
                    <tr>
                        <th>
                            S/No.
                        </th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th class="hidden-sm">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php  $serial = 1; ?>
                    <?php foreach($my_requests as $request): ?>
                        <tr>
                            <td><?= $serial++ ?></td>
                            <td><?= date('d M, Y', strtotime($request['created_at']))  ?></td>
                            <td class="text-right"><?= number_format($request['amount'],2) ?></td>
                            <td><?= $request['request_title']  ?></td>
                            <td><?= strlen(strip_tags($request['request_description'])) > 35 ? substr(strip_tags($request['request_description']),0,35).'...' : strip_tags($request['request_description'])  ?></td>
                            <td><?= $request['workflow_type_name'] ?></td>
                            <td>
                                <a href="<?= site_url('/workflow-requests/view/'.$request['workflow_request_id']) ?>" class="btn btn-info btn-sm">View</a>
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

