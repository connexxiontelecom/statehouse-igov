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
            <li class="breadcrumb-item"><a href="javascript:void(0)">e-Office</a></li>
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
              <?php if ($task['task_creator'] == session()->user_id && $task['task_status'] == 0):?>
                <a href="javascript:void(0)" onclick="startTask(<?=$task['task_id']?>)" type="button" class="btn btn-success waves-effect waves-light mr-1"><i class="mdi mdi-clipboard-text-play-outline mr-1"></i> Start Task</a>
              <?php endif;?>
              <?php if ($task['task_creator'] == session()->user_id && $task['task_status'] == 1):?>
                <button type="button" class="btn btn-primary waves-effect waves-light mr-1" data-toggle="modal" data-target="#standard-modal-3"><i class="mdi mdi-check-outline mr-1"></i> Complete Task</button>
              <?php endif;?>
              <?php if ($task['task_creator'] == session()->user_id && ($task['task_status'] == 0 || $task['task_status'] == 1)):?>
                <button type="button" class="btn btn-warning waves-effect waves-light mr-3" data-toggle="modal" data-target="#standard-modal-2"><i class="mdi mdi-close-thick mr-1"></i> Cancel Task</button>
              <?php endif;?>
              <a href="<?=site_url('view-task-log/').$task['task_id']?>" type="button" class="btn btn-success waves-effect waves-light mr-1">View Log</a>
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
            <?=$task['task_overview'] ? $task['task_overview'] : '<span class="badge badge-outline-info">NO OVERVIEW</span>'?>
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
            <p class="text-muted"><span class="badge badge-outline-info">NO SECONDARY EXECUTORS ASSIGNED</span></p>
          <?php endif;?>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <h4 class="mt-0 font-16">Feedback</h4>
          <div class="" style="max-height: 300px; overflow-y: auto">
            <?php if (empty($task['task_feedbacks'])):?>
              <span class="badge badge-outline-info">NO SUBMITTED FEEDBACKS</span>
            <?php else:?>
              <?php foreach ($task['task_feedbacks'] as $task_feedback):?>
                <div class="media mt-3">
                  <div class="avatar-sm mr-2">
                    <span class="avatar-title bg-soft-secondary text-secondary font-20 rounded-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?=$task_feedback['user']['user_name']?>">
                      <?=substr($task_feedback['user']['user_name'], 0, 1)?>
                    </span>
                  </div>
                  <div class="media-body">
                    <h5 class="mt-0">
                      <?=$task_feedback['user']['user_name']?>
                      <small class="text-muted float-right">
                        <?php $date = date_create($task_feedback['created_at']);
                        echo date_format($date,"d F Y H:i a");
                        ?>
                      </small>
                    </h5>
                    <?=$task_feedback['tf_comment']?>
                  </div>
                </div>
              <?php endforeach;?>
            <?php endif;?>
          </div>
          <div class="border rounded mt-4">
            <form id="submit-feedback-form" action="#" class="comment-area-box">
              <textarea id="comment" rows="3" class="form-control border-0 resize-none" placeholder="Your feedback..."></textarea>
              <div class="p-2 bg-light d-flex justify-content-between align-items-center">
                <button type="submit" class="btn btn-sm btn-success float-right" <?=$task['task_status'] != 1 ? 'disabled' : ''?>><i class='mdi mdi-message-outline mr-1'></i>Submit</button>
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
                    <input id="file" type="file" data-plugins="dropify" name="file" <?=$task['task_status'] != 1 ? 'disabled' : ''?>/>
                  </div>
                </div>
              </div>
              <input type="hidden" name="task_id" id="task-id" value="<?=$task['task_id']?>">
            </div>
            <button type="submit" class="btn btn-primary btn-sm float-right" id="save-btn" <?=$task['task_status'] != 1 ? 'disabled' : ''?>>Submit</button>
            <button type="submit" class="btn btn-primary btn-sm float-right" id="save-btn-loading" hidden disabled>
              <span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span> Please wait...
            </button>
          </form>
          <div class="mt-5" style="max-height: 150px; overflow-y: auto">
            <?php if(!empty($task['attachments'])):
              foreach ($task['attachments'] as $attachment):?>
                <div class="card mb-1 shadow-none border">
                  <div class="p-2">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <div class="avatar-sm">
                        <span class="avatar-title badge-soft-primary text-primary rounded">
                           <?php echo strtoupper(substr($attachment['ta_link'], strpos($attachment['ta_link'], ".") + 1)); ?>
                        </span>
                        </div>
                      </div>
                      <div class="col pl-0">
                        <a href="<?='/uploads/tasks/'.$attachment['ta_link']; ?>" target="_blank" class="mb-0 font-12"><?php
                          $filename = 'uploads/tasks/'.$attachment['ta_link'];
                          //											$handle = fopen($filename, "r");
                          //											$contents = fread($handle, filesize($filename));
                          //echo $filename;
                          $size = round(filesize($filename)/(1024 * 1024), 4);
                          echo $attachment['ta_link'] .'<br>';
                          echo $size."MB";
                          //											fclose($handle);

                          ?></a>
                      </div>
                      <div class="col-auto">
                        <!-- Button -->
                        <a href="<?='/uploads/tasks/'.$attachment['ta_link']; ?>" download="<?=$attachment['ta_link']; ?>" target="_blank" class="btn btn-link font-16 text-muted">
                          <i class="dripicons-download"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; else: echo '<span class="badge badge-outline-info">NO SUBMITTED ATTACHMENTS</span>'; endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="standard-modal-2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form id="task-cancellation-form" class="needs-validation" novalidate>
          <div class="modal-header">
            <h4 class="modal-title" id="standard-modalLabel">Task Cancellation</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="reason">Cancellation Reason</label><span style="color:red;"> *</span>
                  <textarea name="reason" id="reason" rows="4" class="form-control" required></textarea>
                  <div class="invalid-feedback">
                    Please enter a cancellation reason.
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="save-btn">Submit & Cancel</button>
            <button type="submit" class="btn btn-primary" id="save-btn-loading" hidden disabled>
              <span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span> Please wait...
            </button>
          </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <div id="standard-modal-3" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form id="task-completion-form" class="needs-validation" novalidate>
          <div class="modal-header">
            <h4 class="modal-title" id="standard-modalLabel">Task Completion</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="summary">Completion Summary</label><span style="color:red;"> *</span>
                  <textarea name="summary" id="summary" rows="4" class="form-control" required></textarea>
                  <div class="invalid-feedback">
                    Please enter a completion summary.
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="save-btn">Submit & Complete</button>
            <button type="submit" class="btn btn-primary" id="save-btn-loading" hidden disabled>
              <span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span> Please wait...
            </button>
          </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
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
