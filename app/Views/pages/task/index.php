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
            <li class="breadcrumb-item"><a href="javascript:void(0)">e-Office</a></li>
            <li class="breadcrumb-item active"><a href="<?= site_url('tasks')?>">Tasks</a></li>
          </ol>
        </div>
        <h4 class="page-title">Tasks</h4>
      </div>
    </div>
  </div>
  <!-- end page title -->
  <div class="row">
    <div class="col-12">
      <div class="card-box">
        <div class="row">
          <div class="col-lg-8">
            <h4 class="header-title">All Tasks</h4>
            <p class="text-muted font-13">
              Below are tasks you created or were assigned to you.
            </p>
          </div>
          <div class="col-lg-4">
            <div class="text-lg-right mt-3 mt-lg-0">
              <a href="<?=site_url('/new-task')?>" type="button" class="btn btn-success waves-effect waves-light"><i class="mdi mdi-plus-circle mr-1"></i> New Task</a>
            </div>
          </div><!-- end col-->
        </div> <!-- end row -->
        <div class="row">
          <div class="col-12">
            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap w-100">
              <thead>
              <tr>
                <th class="text-center" style="width: 5%">S/n</th>
                <th>Subject</th>
                <th>Primary Executor</th>
                <th>Creator</th>
                <th style="width: 10%">Priority</th>
                <th class="text-center" style="width: 5%">Due Date</th>
                <th class="text-center" style="width: 5%">Status</th>
                <th class="text-center" style="width: 5%">Actions</th>
              </tr>
              </thead>
              <tbody>
                <?php $i=1; foreach ($tasks as $task):?>
                <tr>
                  <td><?=$i; $i++;?></td>
                  <td><?=$task['task_subject']?></td>
                  <td><?=$task['executor']['user_name']?></td>
                  <td><?=$task['creator']['user_name']?></td>
                  <td class="text-center">
                    <?php
                      if ($task['task_priority'] == 0) echo '<span class="badge badge-primary">Low</span>';
                      elseif ($task['task_priority'] == 1) echo '<span class="badge badge-warning">Medium</span>';
                      elseif ($task['task_priority'] == 2) echo '<span class="badge badge-danger">High</span>';
                    ?>
                  </td>
                  <td>
                    <?php $date = date_create($task['task_due_date']);
                    echo date_format($date,"d M Y");
                    ?>
                  </td>
                  <td class="text-center">
                    <?php
                      if ($task['task_status'] == 0) echo '<span class="badge badge-soft-primary badge-pill">Pending</span>';
                      elseif ($task['task_status'] == 1) echo '<span class="badge badge-soft-secondary badge-pill">Ongoing</span>';
                      elseif ($task['task_status'] == 2) echo '<span class="badge badge-soft-success badge-pill">Completed</span>';
                      elseif ($task['task_status'] == 3) echo '<span class="badge badge-soft-danger badge-pill">Cancelled</span>';
                    ?>
                  </td>
                  <td class="text-center">
                    <a href="<?=site_url('task-details/').$task['task_id']?>" data-toggle="tooltip" data-placement="left" title data-original-title="Task Details">
                      <i data-feather="list" class="icon-dual"></i>.
                    </a>
                    <a href="<?=site_url('view-task-log/').$task['task_id']?>" data-toggle="tooltip" data-placement="left" title data-original-title="View Log">
                      <i data-feather="file-text" class="icon-dual"></i>.
                    </a>
                  </td>
                </tr>
              <?php endforeach;?>
              </tbody>
            </table>
          </div> <!-- end card -->
        </div>
      </div>
    </div>
  </div>

</div>
<?= $this->endSection(); ?>
<?= $this->section('extra-scripts'); ?>
<!-- third party js -->
<script src="/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<script src="/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="/assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="/assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
<script src="/assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="/assets/libs/pdfmake/build/vfs_fonts.js"></script>
<!-- third party js ends -->

<!-- Datatables init -->
<script src="/assets/js/pages/datatables.init.js"></script>
<?= $this->endSection(); ?>
