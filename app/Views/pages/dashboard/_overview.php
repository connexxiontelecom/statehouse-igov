<p class="text-muted">Get up to date with all the latest activities on your iGov account.</p>

<div class="row">
  <div class="col-xl-4">
    <div class="card-box" style="border-radius: 10px">
      <small class="float-right">
        <a class="text-success" href="<?=site_url('/memos')?>">View more</a>
      </small>
      <h4 class="header-title mb-3">Memos</h4>
      <div class="widget-chart text-center" dir="ltr">
        <h5 class="text-muted mt-3">All memos</h5>
        <h2 data-plugin="counterup"><?=$overview_stats['memos']?></h2>
        <div class="row mt-3">
          <div class="col-6">
            <p class="text-muted font-15 mb-1 text-truncate">My memos</p>
            <h4 data-plugin="counterup"><?=$overview_stats['my_memos']?></h4>
          </div>
          <div class="col-6">
            <p class="text-muted font-15 mb-1 text-truncate">Signature requests</p>
            <h4 data-plugin="counterup"><?=$overview_stats['unsigned_memos']?></h4>
          </div>
        </div> <!-- end row -->
      </div>
    </div> <!-- end card-box -->
  </div> <!-- end col-->

  <div class="col-xl-4">
    <div class="card-box" style="border-radius: 10px;">
      <small class="float-right">
        <a class="text-success" href="<?=site_url('/circulars')?>">View more</a>
      </small>
      <h4 class="header-title mb-3">Circulars</h4>
      <div class="widget-chart text-center" dir="ltr">
        <h5 class="text-muted mt-3">All circulars</h5>
        <h2 data-plugin="counterup"><?=$overview_stats['circulars']?></h2>
        <div class="row mt-3">
          <div class="col-6">
            <p class="text-muted font-15 mb-1 text-truncate">My circulars</p>
            <h4 data-plugin="counterup"><?=$overview_stats['my_circulars']?></h4>
          </div>
          <div class="col-6">
            <p class="text-muted font-15 mb-1 text-truncate">Signature requests</p>
            <h4 data-plugin="counterup"><?=$overview_stats['unsigned_circulars']?></h4>
          </div>
        </div> <!-- end row -->
      </div>
    </div> <!-- end card-box -->
  </div> <!-- end col-->

  <div class="col-xl-4">
    <div class="card-box" style="border-radius: 10px;">
      <small class="float-right">
        <a class="text-success" href="<?=site_url('/notices')?>">View more</a>
      </small>
      <h4 class="header-title mb-3">Notices</h4>
      <div class="widget-chart text-center" dir="ltr">
        <h5 class="text-muted mt-3">All notices</h5>
        <h2 data-plugin="counterup"><?=$overview_stats['notices']?></h2>
        <div class="row mt-3">
          <div class="col-6">
            <p class="text-muted font-15 mb-1 text-truncate">My notice</p>
            <h4 data-plugin="counterup"><?=$overview_stats['my_notices']?></h4>
          </div>
          <div class="col-6">
            <p class="text-muted font-15 mb-1 text-truncate">Signature requests</p>
            <h4 data-plugin="counterup"><?=$overview_stats['unsigned_circulars']?></h4>
          </div>
        </div> <!-- end row -->

      </div>
    </div> <!-- end card-box -->
  </div> <!-- end col-->
</div>

<div class="row">
  <div class="col-xl-12">
    <div class="card-box" style="border-radius: 10px">
      <small class="float-right">
        <a class="text-success" href="<?=site_url('/tasks')?>">View more</a>
      </small>
      <h4 class="header-title mb-3">Recent <span class="text-muted">Assigned Tasks</span></h4>
      <div class="table-responsive">
        <table class="table table-borderless table-nowrap table-hover table-centered m-0">
          <thead class="thead-light">
          <tr>
            <th>Subject</th>
            <th>Primary Executor</th>
            <th class="text-center">Priority</th>
            <th class="text-center">Status</th>
            <th class="text-center">Actions</th>
          </tr>
          </thead>
          <tbody>
          <?php foreach ($recent_tasks as $task):?>
          <tr>
            <td><h5><?=$task['task_subject']?></h5></td>
            <td><?=$task['executor']['user_name']?></td>
            <td class="text-center">
            <?php
                if ($task['task_priority'] == 0) echo '<span class="badge badge-primary">Low</span>';
                elseif ($task['task_priority'] == 1) echo '<span class="badge badge-warning">Medium</span>';
                elseif ($task['task_priority'] == 2) echo '<span class="badge badge-danger">High</span>';
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
      </div> <!-- end .table-responsive-->
    </div> <!-- end card-box-->
  </div>
</div>

<div class="row">
  <div class="col-xl-12">
    <div class="card-box" style="border-radius: 10px">
      <small class="float-right">
        <a class="text-success" href="<?=site_url('/tasks')?>">View more</a>
      </small>
      <h4 class="header-title mb-3">Recent <span class="text-muted">Workflow Requests</span></h4>
      <div class="table-responsive">
        <table class="table table-borderless table-nowrap table-hover table-centered m-0">
          <thead class="thead-light">
          <tr>
            <th>Date</th>
            <th>Amount</th>
            <th>Title</th>
            <th>Type</th>
            <th class="text-center">Action</th>
          </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div> <!-- end .table-responsive-->
    </div> <!-- end card-box-->
  </div>
</div>