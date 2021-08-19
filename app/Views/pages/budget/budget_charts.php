<?= $this->extend('layouts/master') ?>
<?= $this->section('extra-styles') ?>

<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="container-fluid">

<?php if(!empty($budget)): ?>
	<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box">
				<div class="page-title-right">
					<ol class="breadcrumb m-0">
						<li class="breadcrumb-item"><a href="<?= site_url('office') ?>">iGov</a></li>
						<li class="breadcrumb-item"><a href="<?=site_url('budget-setups') ?>">Budgets</a></li>
						<li class="breadcrumb-item active">Budget Setup</li>
					</ol>
				</div>
				<h4 class="page-title"> <?=$budget['budget_title'] ?> - <?=$budget['budget_year'] ?></h4>
			</div>
		</div>
	</div>
	<!-- end page title -->

	
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-body">
					
					<div class="row">
						<div class="col-xl-12">
							
							
							<?php if(!empty($bhs)): ?>
								
								
								<table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
									<thead>
									<tr>
										<th>S/N</th>
										<th>Code</th>
										<th>Item</th>
										<th> Project Status</th>
<!--										<th> Responsible Office</th>-->
										<th>Amount</th>
										<th> Action </th>
									</tr>
									</thead>
									<tbody>
									<?php $i = 1;  foreach ($categories as $category): ?>
										<tr>
											<td colspan="2"><h4> <?=$category['bc_name']; ?></h4> </td>
										
										</tr>
										
										<?php
										
										foreach ($bhs as $bh):
											if($bh['bh_cat'] == $category['bc_id']):
												?>
												<tr>
													<td><?=$i++;?></td>
													<td <?php if($bh['bh_acc_type'] == 0): echo 'style="font-weight: bold;"';  endif; ?>><?=$bh['bh_code'];?></td>
													<td <?php if($bh['bh_acc_type'] == 0): echo 'style="font-weight: bold;"';  endif; ?>><?=$bh['bh_title'];?></td>
													<td> <? if($bh['bh_project'] == 1 ): echo $bh['bh_project_status']; endif; ?></td>
<!--												<td> --><?//=implode(	'', $bh['office_d']); ?><!--</td>-->
													<td>  <?php if($bh['bh_acc_type']): echo number_format($bh['bh_amount']); endif; ?></td>
													
													<td>
														<?php 	if(in_array($employee_id, json_decode($bh['bh_office'])) && $bh['bh_acc_type'] == 1): ?>
															<a href="<?=site_url('edit-budget-input/'.$bh['bh_id']) ?>" class="btn btn-success waves-effect waves-light"><i class="far fa-edit"></i></a>
														<?php endif; ?>
													</td>
										
												</tr>
											<?php endif; endforeach; ?>
									<?php endforeach; ?>
									
									
									
									</tbody>
								</table>
							
							
							<?php else: ?>
								<div class="col-md-12 col-lg-12 col-xl-12">
									<div class="card bg-pattern">
										
										<div class="card-body p-4">
											
											<div class="auth-logo">
												<a href="/" class="logo logo-dark text-center">
                                        <span class="logo-lg">
                                            <img src="../assets/images/logo-sm.png" alt="" height="22">
                                        </span>
												</a>
												
												<a href="/" class="logo logo-light text-center">
                                        <span class="logo-lg">
                                            <img src="../assets/images/logo-sm.png" alt="" height="22">
                                        </span>
												</a>
											</div>
											
											<div class="text-center mt-4">
												<h1 class="text-error">Oops</h1>
												<h3 class="mt-3 mb-2">No Budget Assigned to You yet</h3>
												
												</div>
										
										</div> <!-- end card-body -->
									</div>
									<!-- end card -->
								
								</div> <!-- end col -->
							
							<?php endif; ?>
						</div> <!-- end col -->
					</div> <!-- end row -->
				
				
				</div> <!-- end card-body -->
			</div> <!-- end card-->
		
		</div> <!-- end col -->
	</div>
<?php else: ?>
	<div class="row">
		<div class="col-12">
			<div class="page-title-box">
				<div class="page-title-right">
					<ol class="breadcrumb m-0">
						<li class="breadcrumb-item"><a href="<?= site_url() ?>">iGov</a></li>
						
						<li class="breadcrumb-item active">Budget Input</li>
					</ol>
				</div>
				<h4 class="page-title"> No Active Budget</h4>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 col-lg-12 col-xl-12">
			<div class="card bg-pattern">
				
				<div class="card-body p-4">
					
					<div class="auth-logo">
						<a href="/" class="logo logo-dark text-center">
                                        <span class="logo-lg">
                                            <img src="../assets/images/logo-sm.png" alt="" height="22">
                                        </span>
						</a>
						
						<a href="/" class="logo logo-light text-center">
                                        <span class="logo-lg">
                                            <img src="../assets/images/logo-sm.png" alt="" height="22">
                                        </span>
						</a>
					</div>
					
					<div class="text-center mt-4">
						<h1 class="text-error">Oops</h1>
						<h3 class="mt-3 mb-2">No Active Budget yet</h3>
					
					</div>
				
				</div> <!-- end card-body -->
			</div>
			<!-- end card -->
		
		</div> <!-- end col -->
	</div>

	
<?php endif; ?>
</div>



<!-- Long Content Scroll Modal -->

<?= $this->endSection() ?>
<?= $this->section('extra-scripts') ?>


<?= $this->endSection() ?>
