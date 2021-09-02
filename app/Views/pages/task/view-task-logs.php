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
              <li class="breadcrumb-item"><a href="<?= site_url('/tasks')?>">Tasks</a></li>
              <li class="breadcrumb-item active">View Task Logs</li>
            </ol>
          </div>
          <h4 class="page-title">View Task Logs</h4>
        </div>
      </div>
    </div>
    <!-- end page title -->
    <div class="row">
      <div class="col-12">
        <div class="card-box">
          <div class="row">
            <div class="col-lg-8">
              <h5><?=$task['task_subject']?></h5>
            </div>
            <div class="col-lg-4">
              <div class="text-lg-right mt-3 mt-lg-0">
                <a href="<?=site_url('/tasks')?>" type="button" class="btn btn-success waves-effect waves-light">Go Back</a>
              </div>
            </div><!-- end col-->
          </div> <!-- end row -->
        </div> <!-- end card-box -->
      </div><!-- end col-->
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-lg-8">
                <h4 class="header-title">Task Logs</h4>
                <p class="text-muted font-13">
                  Below is an audit log representing the activities during the execution of this task
                </p>
              </div>
              <div class="col-lg-4">
                <a href="<?=site_url('task-details/').$task['task_id']?>" type="button" class="btn btn-success waves-effect waves-light float-right">Task Details</a>
              </div>
            </div> <!-- end row -->
            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap w-100">
              <thead>
              <tr>
                <th class="text-center" style="width: 5%">S/n</th>
                <th style="width: 10%">Action</th>
                <th style="width: 10%">User</th>
                <th>Details</th>
                <th style="width: 10%">Time</th>
              </tr>
              </thead>
              <tbody>
              <?php $i=1; foreach ($task_logs as $task_log):?>
                <tr>
                  <td><?=$i; $i++;?></td>
                  <td>
                    <?php
                      if ($task_log['tl_action'] == 'task_creation') echo 'Task created';
                      else if ($task_log['tl_action'] == 'task_attachment_upload') echo 'Task attachment uploaded';
                      else if ($task_log['tl_action'] == 'task_started') echo 'Task started';
                      else if ($task_log['tl_action'] == 'task_cancellation') echo 'Task cancelled';
                      else if ($task_log['tl_action'] == 'task_completion') echo 'Task completed';
                      else if ($task_log['tl_action'] == 'feedback_submit') echo 'Feedback submitted';
                    ?>
                  </td>
                  <td><?=$task_log['user']['user_name']?></td>
                  <td><?=$task_log['tl_details']?></td>
                  <td>
                    <?php $date = date_create($task_log['created_at']);
                    echo date_format($date,"d M Y H:i a");
                    ?>
                  </td>
                </tr>
              <?php endforeach;?>
              </tbody>
            </table>
          </div> <!-- end card body-->
        </div> <!-- end card -->
      </div><!-- end col-->
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