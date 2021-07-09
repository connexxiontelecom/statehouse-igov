<?= $this->extend('layouts/master'); ?>
<?=$this->section('extra-styles'); ?>
<link href="/assets/libs/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" />

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
						<li class="breadcrumb-item"><a href="<?= site_url('/circulars')?>">circular Board</a></li>
						<li class="breadcrumb-item"><a href="<?= site_url('/my-circulars')?>">My circulars</a></li>
						<li class="breadcrumb-item active">New circular</li>
					</ol>
				</div>
				<h4 class="page-title">New circular</h4>
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
              <h4 class="header-title mt-2 mb-4">Create Internal circular Form</h4>
            </div>
            <div class="col-lg-4">
              <a href="<?=site_url('/my-circulars')?>" type="button" class="btn btn-sm btn-primary float-right"> <i class="mdi mdi-arrow-left mr-2"></i>Go Back</a>
            </div>
          </div>
          <form class="needs-validation" id="new-internal-circular-form" novalidate>
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
						<label for="subject">Ref No</label>
						<input type="text"  class="form-control" name="p_ref_no" required>
						<div class="invalid-feedback">
							Please enter a reference number.
						</div>
					</div>
	
	
				</div>
	
			
	
				<div class="col-lg-3">
					
					<div class="form-group mb-3" id="department">
					
						<label for="department">Departments</label>
						<select  class="form-control select2-multiple"  data-toggle="select2" multiple="multiple" data-placeholder="Choose Department ...">
							
							<option value="a">All Departments</option>
							<?php foreach ($departments as $department): ?>
								<option value="<?=$department['dpt_id']; ?>"> <?=$department['dpt_name']; ?></option>
							<?php endforeach; ?>
						</select>
			
						
					</div>
					<div class="form-group mb-3" style="margin-top: 30px">
						<div class="custom-control custom-switch">
							<input type="checkbox" class="custom-control-input"  name="all_department" value="1" id="allDepartment" >
							<label class="custom-control-label" for="allDepartment">Select All Departments</label>
						</div>
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
	
			  <div class="row">
		
				 
				  <div class="col-lg-12">
					  <div id="myId" class="dropzone">
						  <div class="dz-message needsclick">
							  <i class="hi text-muted dripicons-cloud-upload"></i>
							  <h3>Drop all other relevant attachments here...</h3>
						  </div>
					  </div>
				  </div>
		
				 
			  </div>
	
			  <div class="row" style="margin-top: 15px">
				  <div class="col-lg-3" >
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




<?=view('pages/posts/_circular-scripts.php')?>

<script src="/assets/libs/dropzone/min/dropzone.min.js"></script>
<script src="/assets/libs/dropify/js/dropify.min.js"></script>
<script>
    $("#allDepartment").click(function(){
        if($("#allDepartment").is(':checked')){
           $("#department").hide();
        }else{
           $("#department").show();
        }
    });
</script>


<script src="/assets/libs/selectize/js/standalone/selectize.min.js"></script>
<script src="/assets/libs/mohithg-switchery/switchery.min.js"></script>
<script src="/assets/libs/multiselect/js/jquery.multi-select.js"></script>
<script src="/assets/libs/select2/js/select2.min.js"></script>
<script src="/assets/libs/jquery-mockjax/jquery.mockjax.min.js"></script>
<script src="/assets/libs/devbridge-autocomplete/jquery.autocomplete.min.js"></script>
<script src="/assets/libs/bootstrap-select/js/bootstrap-select.min.js"></script>
<script src="/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<!--<script src="/assets/js/pages/form-advanced.init.js"></script>-->

<?= $this->endSection(); ?>
