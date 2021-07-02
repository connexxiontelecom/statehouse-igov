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
						<li class="breadcrumb-item"><a href="javascript: void(0);">Messaging</a></li>
						<li class="breadcrumb-item"><a href="<?= site_url('/memos')?>">Memo Board</a></li>
						<li class="breadcrumb-item"><a href="<?= site_url('/my-memos')?>">My Memos</a></li>
						<li class="breadcrumb-item active">New memo</li>
					</ol>
				</div>
				<h4 class="page-title">New memo</h4>
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
              <h4 class="header-title mt-2 mb-4">Create Memo Form</h4>
            </div>
            <div class="col-lg-4">
              <a href="<?=site_url('/my-memos')?>" type="button" class="btn btn-sm btn-primary float-right"> <i class="mdi mdi-arrow-left mr-2"></i>Go Back</a>
            </div>
          </div>
          <form class="needs-validation" id="new-memo-form" novalidate>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="subject">Subject</label>
                  <input type="text" id="subject" class="form-control" name="p_subject" required>
                  <div class="invalid-feedback">
                    Please enter a subject.
                  </div>
                </div>
              </div>
				<div class="col-lg-3">
					<div class="form-group">
						<label for="signed-by">Memo Type</label>
						<select class="form-control" id="memo-type" name="p_direction" required>
							<option value="" disabled selected>Select Memo Type</option>
				           <option value="1"> Internal </option>
							<option value="2"> External </option>
						</select>
						<div class="invalid-feedback">
							Please select the signer.
						</div>
					</div>
				</div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label for="signed-by">Signed By</label>
                  <select class="form-control" id="signed-by" name="p_signed_by" required>
                    <option value="">Select user</option>
                    <?php foreach($signed_by as $user):
						if($user['user_username'] !== $username):
						?>
						
                      <option value="<?=$user['user_id']?>">  <?=$user['user_name'];?> </option>
                    <?php endif; endforeach;?>
                  </select>
                  <div class="invalid-feedback">
                    Please select the signer.
                  </div>
                </div>
              </div>
            </div>
	
			  <div class="row">
				  <div class="col-lg-6">
					  <div class="form-group" id="department-div">
						  <label for="subject">Department</label>
						  <select class="form-control" id="memo-type" name="p_department_id" required>
							  <option value="" disabled selected>Select Department</option>
							  <option value="a">All Departments</option>
							 <?php foreach ($departments as $department): ?>
						  	<option value="<?=$department['dpt_id']; ?>"> <?=$department['dpt_name']; ?></option>
						  	<?php endforeach; ?>
						  </select>
					  </div>
					
					  <div class="form-group" id="department-div">
						  <label for="subject">Offices</label>
						  <select class="form-control" id="memo-type" name="p_direction" required>
							  <option value="" disabled selected>Select Department</option>
							  <?php foreach ($departments as $department): ?>
								  <option value="<?=$department['dpt_id']; ?>"> <?=$department['dpt_name']; ?></option>
							  <?php endforeach; ?>
						  </select>
					  </div>
				  </div>
				 
			  </div>
     
			  
			  
			  <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="snow-editor">Body</label>
                  <div id="snow-editor" class="form-control body" style="height: 300px;"></div> <!-- end Snow-editor-->
                  <div class="invalid-feedback">
                    Please enter a body.
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
<?=view('pages/posts/_memo-scripts.php')?>
<?= $this->endSection(); ?>
