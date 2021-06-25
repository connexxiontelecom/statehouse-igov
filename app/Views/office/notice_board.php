<?=
	$this->extend('layouts/admin')
?>




<?= $this->section('content') ?>


<div class="container-fluid">
	
	<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box">
				<div class="page-title-right">
					<ol class="breadcrumb m-0">
						<li class="breadcrumb-item"><a href="<?= site_url('office') ?>">iGov</a></li>
						<li class="breadcrumb-item"><a href="javascript: void(0);">Messaging Settings</a></li>
						<li class="breadcrumb-item active">Notice Board</li>
					</ol>
				</div>
				<h4 class="page-title">Notice Board</h4>
			</div>
		</div>
	</div>
	<!-- end page title -->
	
	

	
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					
					
					
					
					<div class="row">
						
						<?php foreach ($notices as $notice):  ?>
						<div class="col-lg-4" style="padding-bottom: 20px">
							<div class="card-box project-box" style=" <?php if($notice['n_status'] == 3): ?>background-color: lavenderblush; <?php endif; ?>;" >
								<div class="dropdown float-right">
									<a href="#" class="dropdown-toggle card-drop arrow-none" data-toggle="dropdown" aria-expanded="false">
										<i class="mdi mdi-dots-horizontal m-0 text-muted h3"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item" href="#">Edit</a>
										<a class="dropdown-item" href="#">Delete</a>
										<a class="dropdown-item" href="#">Add Members</a>
										<a class="dropdown-item" href="#">Add Due Date</a>
									</div>
								</div> <!-- end dropdown -->
								<!-- Title-->
								<h4 class="mt-0"><a href="<?=site_url('notice-board')."/".$notice['n_id'] ?>" class="text-dark"><?=$notice['n_subject'] ?></a></h4>
								
								<!-- Desc-->
								<p class="text-muted font-13 mb-3 sp-line-2">
									<?=word_limiter($notice['n_body'], 70) ?>
								
								</p>
								<p class="text-muted font-13 mb-3 sp-line-2">
									<a href="<?=site_url('notice-board')."/".$notice['n_id'] ?>" class="font-weight-bold text-muted">view more</a></p>
								<!-- Task info-->
							
								<!-- Team-->
								<div class="avatar-group mb-3">
									<a href="javascript: void(0);" class="avatar-group-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?=$notice['user_name'] ?>">
										<img src="/assetsa/images/user.png" class="rounded-circle avatar-sm" alt="friend" />
									</a>
									
									
								</div>
								<!-- Progress-->
							
							
							</div> <!-- end card box-->
						</div><!-- end col-->
						
						<?php endforeach; ?>
						
					
					</div>
			
					<!-- end row -->
					
					<div class="row">
						<div class="col-12">
							<div class="text-center mb-3">
								<a href="javascript:void(0);" class="text-danger"><i class="mdi mdi-spin mdi-loading mr-1"></i> Load more </a>
							</div>
						</div> <!-- end col-->
					</div>
					<!-- end row -->
				
				</div> <!-- end card body-->
			</div> <!-- end card -->
		</div><!-- end col-->
	</div>
	
	<!-- end row -->



</div> <!-- container -->
<!-- Long Content Scroll Modal -->
<div class="modal fade" id="new-notice" tabindex="-1" role="dialog"
	 aria-labelledby="scrollableModalTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="scrollableModalTitle">New Notice</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="" id="notice_form">
					<div class="form-group mb-3">
						<label for="subject">Subject</label>
						<input type="text" id="subject" name="n_subject" class="form-control">
					</div>
					
					<div id="snow-editor" style="height: 300px;">
					
					
					</div> <!-- end Snow-editor-->
					
		
					<textarea id="notice_body" style="display: none" name="n_body"></textarea>
					
					<div class="row g-3">
						<div class="col-lg-12 offset-lg-12">
							<div class="form-group mt-2">
								<button type="button" onclick="submitForm()"  class="ladda-button ladda-button-demo btn btn-primary btn-block" dir="ltr" data-style="zoom-in">Submit</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?= $this->endSection() ?>

<script>

    function submitForm(){
        console.log('hello');
    }
    // $("#notice_button").click(function(e){
    // // $("#notice_button").on("click",function(e){
    //     e.preventDefault();
    //     //$("#notice_body").val($("#snow-editor").html());
    //    // $('#notice_form').submit()
	// 	console.log('hello');
	// 	console.log($("#snow-editor").html());
    // })
</script>
