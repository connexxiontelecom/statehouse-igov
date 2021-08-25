<?= $this->extend('layouts/master'); ?>
<?=$this->section('extra-styles'); ?>
<link href="/assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/dropify/css/dropify.min.css" rel="stylesheet" type="text/css" />
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
            <li class="breadcrumb-item"><a href="javascript: void(0);">Messaging</a></li>
            <li class="breadcrumb-item"><a href="<?= site_url('/memos')?>">Memo Board</a></li>
            <li class="breadcrumb-item active">New External Memo</li>
          </ol>
        </div>
        <h4 class="page-title">New External Memo</h4>
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
              <h4 class="header-title mt-2 mb-4">Create External Memo Form</h4>
            </div>
            <div class="col-lg-4">
              <a href="<?=site_url('/memos')?>" type="button" class="btn btn-success float-right">Go Back</a>
            </div>
          </div>
          <form class="needs-validation" id="new-external-memo-form" novalidate>
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="ref-no">Reference No</label><span style="color: red"> *</span>
                  <input type="text" class="form-control" id="ref-no" name="p_ref_no" required>
                  <div class="invalid-feedback">
                    Please enter a reference number.
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group" id="department-div">
                  <label for="p-recipients">Recipients</label><span style="color: red"> *</span>
                  <textarea class="form-control" name="p_recipients" id="p-recipients" rows="3" required></textarea>
                  <small class="form-text text-muted">Please enter each recipient and their official titles/designations on a new line.</small>
                  <div class="invalid-feedback">
                    Please enter the recipients.
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="subject">Subject</label><span style="color: red"> *</span>
                  <input type="text" id="subject" class="form-control" name="p_subject" required>
                  <div class="invalid-feedback">
                    Please enter a subject.
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="snow-editor">Body</label><span style="color: red"> *</span>
                  <div id="snow-editor" class="form-control body" style="height: 300px;"></div> <!-- end Snow-editor-->
                  <div class="invalid-feedback">
                    Please enter a body.
                  </div>
                </div>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-12">
                <div id="myId" class="dropzone">
                  <div class="dz-message needsclick">
                    <i class="hi text-muted dripicons-cloud-upload"></i>
                    <h3>Drop all other relevant attachments here...</h3>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="signed-by">Signed By</label><span style="color: red"> *</span>
                  <select class="form-control" id="signed-by" name="p_signed_by" data-toggle="select2" required>
                    <option value="">Select user</option>
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
                    Please select the signer.
                  </div>
                </div>
              </div>
            </div>
            <div class="row g-3">
              <div class="col-lg-12 offset-lg-12">
                <div class="form-group mt-2">
                  <button type="submit" class="ladda-button ladda-button-demo btn btn-primary btn-block" dir="ltr" data-style="zoom-in"">Submit</button>
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
<?=view('pages/posts/memos/_memo-scripts.php')?>
<script src="/assets/libs/dropzone/min/dropzone.min.js"></script>
<script src="/assets/libs/dropify/js/dropify.min.js"></script>
<?= $this->endSection(); ?>
