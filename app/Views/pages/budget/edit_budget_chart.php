<?= $this->extend('layouts/master') ?>
<?= $this->section('extra-styles') ?>
	<link href="/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

<?= $this->endSection() ?>
<?= $this->section('content') ?>
	<div class="container-fluid">
		<!-- start page title -->
		<div class="row">
			<div class="col-12">
				<div class="page-title-box">
					<div class="page-title-right">
						<ol class="breadcrumb m-0">
							<li class="breadcrumb-item"><a href="<?= site_url('office') ?>">iGov</a></li>
							<li class="breadcrumb-item"><a id="b_link" href="#">Budget Charts</a></li>
							
							
							<li class="breadcrumb-item active">Edit Budget Header</li>
						</ol>
					</div>
					<h4 class="page-title"> <?=$budget['budget_title'] ?> - <?=$budget['budget_year'] ?></h4>
				</div>
			</div>
		</div>
		
		<form id="budget_form" method="post" action="<?=site_url('budget-charts') ?>">
			<input type="hidden" name="bh_budget_id" value="<?=$bhs['bh_budget_id'] ?>">
		
		</form>
		<!-- end page title -->
		<div class="row" style="margin-top: -50px">
			<div class="col-sm-6">
				<div class="card">
					<div class="card-body">
						<h4 style="float: right" class="header-title">Edit Budget Header</h4>
						<div class="row mt-4">
							<div class="col">
								
								<?php if(session()->has('action')): ?>
									<div class="alert alert-success alert-dismissible fade show" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										<i class="mdi mdi-check-all mr-2"></i><strong>Action Successful !</strong>
									</div>
								<?php endif; ?>
								
								<?php if(session()->has('error')): ?>
									<div class="alert alert-danger alert-dismissible fade show" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										<i class="mdi mdi-check-all mr-2"></i><strong>An Error Occurred</strong>
									</div>
								<?php endif; ?>
								
								
								<form method="post">
									
							
									
									<div class="form-group mb-3">
										<label for="example-input-normal">Code</label>
										<input type="text" id="example-input-normal" name="bh_code" value="<?=$bhs['bh_code'] ?>" class="form-control" placeholder="Code" readonly required>
									</div>
									
									<div class="form-group mb-3">
										<label for="example-input-normal">Narration: </label>
										<input type="text" id="example-input-normal" name="bh_title" value="<?=$bhs['bh_title']; ?>" class="form-control" placeholder="Narration" readonly required>
									</div>
									
									
							
									
									<div class="form-group mb-3">
										<label for="example-input-normal">Amount: </label>
										<input type="text" id="example-input-normal" name="bh_amount" value="<?=$bhs['bh_amount']; ?>" class="form-control number" placeholder="Amount" required>
									</div>
									
									<input type="hidden" name="bh_budget_id" value="<?=$budget['budget_id'] ?>">
									<div class="form-group mb-3">
										
										<button type="submit" class="ladda-button ladda-button-demo btn btn-primary btn-block" dir="ltr" data-style="zoom-in"">Submit</button>
									
									</div>
								
								
								</form>
							</div> <!-- end col -->
						</div> <!-- end row -->
					
					
					</div> <!-- end card-body -->
				</div> <!-- end card-->
			</div> <!-- end col -->
		</div>
	</div>
	<!-- Long Content Scroll Modal -->

<?= $this->endSection() ?>
<?= $this->section('extra-scripts') ?>
	<script src="/assets/libs/select2/js/select2.min.js"></script>
	<script>

        let form = document.getElementById("budget_form");

        document.getElementById("b_link").addEventListener("click", function (e) {
            e.preventDefault();
            form.submit();
        });

        function get_parents(){
            let cat =  $("#category").val();
            let b_id = <?=$budget['budget_id'] ?>;
            $.ajax({
                url: '<?php echo site_url('fetch-parent') ?>',
                type: 'post',
                data: { cat, b_id },
                dataType: 'json',
                success:function(response){
                    $("#parent").empty();
                    $("#parent").append('<option value="0">  None </option>');
                    for (let i=0; i<response.length; i++) {
                        $("#parent").append('<option value="' + response[i].bh_code + '">' + response[i].bh_title + '</option>');
                    }

                }
            });

        }
	
	</script>



<?= $this->endSection() ?>
<?php
