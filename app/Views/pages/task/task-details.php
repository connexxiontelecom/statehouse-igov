<?= $this->extend('layouts/master'); ?>
<?=$this->section('extra-styles'); ?>
<link href="/assets/libs/dropify/css/dropify.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/ladda/ladda-themeless.min.css" rel="stylesheet" type="text/css" />
<?=$this->endSection() ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
  <!-- start page title -->
  <div class="row">
    <div class="col-12">
      <div class="page-title-box">
        <div class="page-title-right">
          <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="<?= site_url('/') ?>">iGov</a></li>
            <li class="breadcrumb-item"><a href="<?= site_url('/tasks')?>">Tasks</a></li>
            <li class="breadcrumb-item active">Task Details</li>
          </ol>
        </div>
        <h4 class="page-title">Task Details</h4>
      </div>
    </div>
  </div>
  <!-- end page title -->
  <div class="row">
    <div class="col-12">
      <div class="card-box">
        <div class="row">
          <div class="col-lg-4">
            <h5>Manage Task</h5>
          </div>
          <div class="col-lg-8">
            <div class="text-lg-right mt-3 mt-lg-0">
              <a href="<?=site_url('/tasks')?>" type="button" class="btn btn-success waves-effect waves-light">Go Back</a>
            </div>
          </div><!-- end col-->
        </div> <!-- end row -->
      </div> <!-- end card-box -->
    </div><!-- end col-->
  </div>
  <div class="row">
    <div class="col-lg-7">
      <div class="card d-block">
        <div class="card-body">
          <div class="dropdown float-right">
            <a href="#" class="dropdown-toggle arrow-none text-muted"
               data-toggle="dropdown" aria-expanded="false">
              <i class='mdi mdi-dots-horizontal font-18'></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <!-- item-->
              <a href="javascript:void(0);" class="dropdown-item">
                <i class='mdi mdi-attachment mr-1'></i>Attachment
              </a>
              <!-- item-->
              <a href="javascript:void(0);" class="dropdown-item">
                <i class='mdi mdi-pencil-outline mr-1'></i>Edit
              </a>
              <!-- item-->
              <a href="javascript:void(0);" class="dropdown-item">
                <i class='mdi mdi-content-copy mr-1'></i>Mark as Duplicate
              </a>
              <div class="dropdown-divider"></div>
              <!-- item-->
              <a href="javascript:void(0);" class="dropdown-item text-danger">
                <i class='mdi mdi-delete-outline mr-1'></i>Delete
              </a>
            </div> <!-- end dropdown menu-->
          </div> <!-- end dropdown-->
          <h4><?=$task['task_subject']?></h4>
          <div class="row">
            <div class="col-md-4">
              <!-- assignee -->
              <p class="mt-2 mb-1 text-muted">Task Creator</p>
              <div class="media">
                <i class='mdi mdi-account-outline font-18 text-success mr-1'></i>
                <div class="media-body">
                  <h5 class="mt-1 font-size-14">
                    <?=$task['creator']['user_name']?>
                  </h5>
                </div>
              </div>
              <!-- end assignee -->
            </div> <!-- end col -->
            <div class="col-md-4">
              <!-- assignee -->
              <p class="mt-2 mb-1 text-muted">Primary Executor</p>
              <div class="media">
                <i class='mdi mdi-account font-18 text-success mr-1'></i>
                <div class="media-body">
                  <h5 class="mt-1 font-size-14">
                    <?=$task['primary_executor']['user_name']?>
                  </h5>
                </div>
              </div>
              <!-- end assignee -->
            </div> <!-- end col -->
            <div class="col-md-4">
              <!-- start due date -->
              <p class="mt-2 mb-1 text-muted">Due Date</p>
              <div class="media">
                <i class='mdi mdi-calendar-month-outline font-18 text-success mr-1'></i>
                <div class="media-body">
                  <h5 class="mt-1 font-size-14">
                    <?php $date = date_create($task['task_due_date']);
                    echo date_format($date,"d F Y");
                    ?>
                  </h5>
                </div>
              </div>
              <!-- end due date -->
            </div> <!-- end col -->
            <div class="col-md-4">
              <!-- start due date -->
              <p class="mt-2 mb-1 text-muted">Priority</p>
              <div class="media">
                <div class="media-body">
                  <h5 class="mt-1 font-size-14">
                    <?php
                      if ($task['task_priority'] == 0) echo '<span class="badge badge-primary">Low</span>';
                      elseif ($task['task_priority'] == 1) echo '<span class="badge badge-warning">Medium</span>';
                      elseif ($task['task_priority'] == 2) echo '<span class="badge badge-danger">High</span>';
                    ?>
                  </h5>
                </div>
              </div>
              <!-- end due date -->
            </div> <!-- end col -->
            <div class="col-md-4">
              <!-- start due date -->
              <p class="mt-2 mb-1 text-muted">Status</p>
              <div class="media">
                <div class="media-body">
                  <h5 class="mt-1 font-size-14">
                    <?php
                      if ($task['task_status'] == 0) echo '<span class="badge badge-soft-primary badge-pill">Pending</span>';
                      elseif ($task['task_status'] == 1) echo '<span class="badge badge-soft-secondary badge-pill">Ongoing</span>';
                      elseif ($task['task_status'] == 2) echo '<span class="badge badge-soft-success badge-pill">Completed</span>';
                      elseif ($task['task_status'] == 3) echo '<span class="badge badge-soft-danger badge-pill">Cancelled</span>';
                    ?>
                  </h5>
                </div>
              </div>
              <!-- end due date -->
            </div> <!-- end col -->
          </div> <!-- end row -->
          <h5 class="mt-3">Overview:</h5>
          <p class="text-muted mb-4">
            <?=$task['task_overview'] ? $task['task_overview'] : 'No Overview'?>
          </p>
          <h5 class="mt-3">Secondary Executors:</h5>
          <?php if (!empty($task['secondary_executors'])):?>
            <div class="avatar-group">
              <?php foreach ($task['secondary_executors'] as $secondary_executor):?>
                <div class="avatar-sm avatar-group-item">
                  <span class="avatar-title bg-soft-secondary text-secondary font-20 rounded-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?=$secondary_executor['user_name']?>">
                    <?=substr($secondary_executor['user_name'], 0, 1)?>
                  </span>
                </div>
              <?php endforeach; ?>
            </div>
          <?php else:?>
            <p class="text-muted">No Secondary Executors are assigned</p>
          <?php endif;?>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <h4 class="mb-4 mt-0 font-16">Feedback</h4>
          <div class="media">
            <img class="mr-2 rounded-circle" src="../assets/images/users/user-3.jpg"
                 alt="Generic placeholder image" height="32">
            <div class="media-body">
              <h5 class="mt-0">Jeremy Tomlinson <small class="text-muted float-right">5 hours ago</small></h5>
              Nice work, makes me think of The Money Pit.
            </div>
          </div>
          <div class="media mt-3">
            <img class="mr-2 rounded-circle" src="../assets/images/users/user-5.jpg"
                 alt="Generic placeholder image" height="32">
            <div class="media-body">
              <h5 class="mt-0">Kevin Martinez <small class="text-muted float-right">1 day ago</small></h5>
              It would be very nice to have.
            </div>
          </div>
          <div class="border rounded mt-4">
            <form action="#" class="comment-area-box">
              <textarea rows="3" class="form-control border-0 resize-none" placeholder="Your feedback..."></textarea>
              <div class="p-2 bg-light d-flex justify-content-between align-items-center">
                <button type="submit" class="btn btn-sm btn-success"><i class='uil uil-message mr-1'></i>Submit</button>
              </div>
            </form>
          </div> <!-- end .border-->
        </div>
      </div>
    </div>
    <div class="col-lg-5">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title font-16 mb-3">Attachments</h5>
          <form id="task-attachment-form" class="needs-validation" novalidate>
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <div class="form-control-wrap">
                    <input id="file" type="file" data-plugins="dropify" name="file" />
                  </div>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary btn-sm float-right" id="save-btn">Submit</button>
            <button type="submit" class="btn btn-primary" id="save-btn-loading" hidden disabled>
              <span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span> Please wait...
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('extra-scripts'); ?>
<script src="/assets/libs/dropzone/min/dropzone.min.js"></script>
<script src="/assets/libs/dropify/js/dropify.min.js"></script>
<!-- Loading buttons js -->
<script src="/assets/libs/ladda/spin.min.js"></script>
<script src="/assets/libs/ladda/ladda.min.js"></script>

<!-- Buttons init js-->
<!-- Init js-->
<script src="/assets/js/pages/loading-btn.init.js"></script>
<script src="/assets/js/pages/form-fileuploads.init.js"></script>
<?=view('pages/task/_task-scripts.php')?>
<?= $this->endSection(); ?>
