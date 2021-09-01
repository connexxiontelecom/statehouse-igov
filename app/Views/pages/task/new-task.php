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
            <li class="breadcrumb-item active">New Task</li>
          </ol>
        </div>
        <h4 class="page-title">New Task</h4>
      </div>
    </div>
  </div>
  <!-- end page title -->
  <div class="row">
    <div class="col-12">
      <div class="card-box">
        <div class="row">
          <div class="col-lg-8">
            <h5 style="text-transform: capitalize">Create New Task</h5>
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
  <form class="needs-validation" id="new-task-form" novalidate>
    <div class="row">
      <div class="col-lg-7">
        <div class="card-box">
          <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Task Details</h5>
          <div class="form-group">
            <label for="subject">Subject</label><span style="color: red"> *</span>
            <input type="text" id="subject" class="form-control" name="task_subject" required>
            <div class="invalid-feedback">
              Please enter a subject.
            </div>
          </div>
          <div class="form-group">
            <label for="executor">Primary Executor</label><span style="color: red"> *</span>
            <select class="form-control" data-toggle="select2" id="executor" name="task_executor" required>
              <option value="" selected disabled>Select</option>
              <?php foreach ($department_employees as $department => $employees): ?>
                <?php if(!empty($employees)):?>
                  <optgroup label="<?=$department?>">
                    <?php foreach ($employees as $employee):?>
                      <option value="<?=$employee['user']['user_id']?>">
                        <?=$employee['position']['pos_name'].' ('.$employee['user']['user_name'].')'?>
                      </option>
                    <?php endforeach;?>
                  </optgroup>
                <?php endif;?>
              <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">
              Please select the primary executor.
            </div>
          </div>
          <div class="form-group">
            <label for="due-date">Due Date</label><span style="color: red"> *</span>
            <input type="date" class="form-control" id="due-date" name="task_due_date" required value="<?=date('Y-m-d')?>">
            <div class="invalid-feedback">
              Please select a due date.
            </div>
          </div>
          <div class="form-group mb-3">
            <label class="mb-2">Priority</label>
            <br/>
            <div class="radio form-check-inline">
              <input type="radio" id="inlineRadio1" value="0" name="task_priority" checked>
              <label for="inlineRadio1"> Low </label>
            </div>
            <div class="radio form-check-inline">
              <input type="radio" id="inlineRadio2" value="1" name="task_priority">
              <label for="inlineRadio2"> Medium </label>
            </div>
            <div class="radio form-check-inline">
              <input type="radio" id="inlineRadio3" value="2" name="task_priority">
              <label for="inlineRadio3"> High </label>
            </div>
          </div>
          <div class="form-group">
            <label for="overview">Overview</label>
            <textarea class="form-control" id="overview" rows="5" name="task_overview"></textarea>
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="card-box">
          <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Task Executors</h5>
          <div class="custom-control custom-checkbox float-left">
            <input type="checkbox" class="custom-control-input" id="select-all">
            <label class="custom-control-label" for="select-all">
              Select all users
            </label>
          </div>
          <div class="mt-5" style="height: 300px; overflow: auto">
            <?php foreach ($department_employees as $department => $employees): ?>
              <?php if(!empty($employees)):?>
                <h5 class="mb-2 font-size-16"><?=$department?></h5>
                <?php foreach ($employees as $employee):?>
                  <div class="custom-control custom-checkbox mt-1">
                    <input type="checkbox" class="custom-control-input user" id="<?=$employee['user']['user_id']?>"
                           value="<?=$employee['user']['user_id']?>" name="task_executors[]">
                    <label class="custom-control-label strikethrough" for="<?=$employee['user']['user_id']?>">
                      <?=$employee['position']['pos_name'].' ('.$employee['user']['user_name'].')'?>
                    </label>
                  </div>
                <?php endforeach;?>
              <?php endif;?>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="text-center mb-3">
          <a href="<?=site_url('tasks')?>" type="button" class="btn w-sm btn-danger waves-effect">Cancel</a>
          <button type="submit" class="btn w-sm btn-success waves-effect waves-light">Save</button>
        </div>
      </div>
    </div>
  </form>
</div>
<?= $this->endSection(); ?>
<?= $this->section('extra-scripts') ?>
<script>
  $('#select-all').click(e => {
    let selectAll = $('#select-all')[0]
    let allUserCheckboxes = $('.user')
    allUserCheckboxes.each(function () {
      this.checked = selectAll.checked
    })
  })
</script>
<?=view('pages/task/_task-scripts.php')?>
<?= $this->endSection() ?>
