<?= $this->extend('layouts/admin') ?>
<?= $this->section('extra-styles') ?>

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
						<li class="breadcrumb-item"><a href="<?=site_url('budget-setups') ?>">Budgets</a></li>
						<li class="breadcrumb-item active">Budget Setup</li>
					</ol>
				</div>
				<?php if(!empty($budget)): ?>
				<h4 class="page-title"> <?=$budget['budget_title'] ?> - <?=$budget['budget_year'] ?></h4>
				<?php else: ?>
					<h4 class="page-title"> No Active Budget</h4>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<!-- end page title -->
	<div class="row" style="margin-top: -50px">
		<div class="col-sm-4">
			<div class="card">
				<div class="card-body">
					
				
							
							<h4 style="float: right" class="header-title">View Budget Chart</h4>
							<div class="row mt-4">
								<div class="col">
									
									
									<form method="post">
										
										<div class="form-group mb-3">
											<label for="account-type">Budget Profiles</label>
											<select class="form-control" name="bh_budget_id" >
												<?php foreach ($budgets as $bud): ?>
													<option value="<?=$bud['budget_id'] ?>"><?=$bud['budget_title'] ?> - <?=$bud['budget_year']; ?></option>
												
												<?php endforeach; ?>
											
											</select>
										</div>
										
										
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
	
	<?php if(!empty($budget)): ?>
	
	<div class="row" style="margin-top: -50px">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-body">
					
					<div class="row">
						<div class="col-xl-12">
							<?php if($budget['budget_status'] == 1): ?>
							<a href="<?=site_url('new-budget-chart') ?>" class="btn btn-success waves-effect waves-light"><i class="fas fa-plus"></i></a></a>
							<?php endif; ?>
							
							<?php if(!empty($bhs)): ?>
								
								<table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
									<thead>
									<tr>
										<th>S/N</th>
										<th>Code</th>
										<th>Item</th>
										<th> Project Status</th>
										<th> Responsible Office</th>
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
													<td> <?=implode('', $bh['office_d']); ?></td>
													<td>  <?php if($bh['bh_acc_type']): echo number_format($bh['bh_amount']); endif; ?></td>
													
													<td>
														
														<a href="<?=site_url('edit-budget-chart/'.$bh['bh_id']) ?>" class="btn btn-success waves-effect waves-light"><i class="far fa-edit"></i></a>
													
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
												<h3 class="mt-3 mb-2">No Budget Chart Setup</h3>
												
												<a href="<?=site_url('new-budget-chart') ?>" class="btn btn-success waves-effect waves-light">New Chart</a>
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
