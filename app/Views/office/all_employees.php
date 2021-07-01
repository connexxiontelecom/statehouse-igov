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
						<li class="breadcrumb-item"><a href="javascript: void(0);">Employees</a></li>
						<li class="breadcrumb-item active">All Employees</li>
					</ol>
					
				</div>
				<h4 class="page-title">All Employees</h4>
			</div>
		</div>
	</div>
	<!-- end page title -->

	<div class="row" style="margin-top: -50px">
		<div class="col-xl-12">
			<div class="card">
				<div class="card-body">
					
					
					
					<table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
						<thead>
						<tr>
							<th>S/N</th>
							<th>Name</th>
							<th>Position</th>
							<th>Office</th>
							<th> Level </th>
							<th> Step </th>
							<th>E-Mail</th>
							
						</tr>
						</thead>
						
						
						<tbody>
						<?php if($employees):
							$sn =1;
						foreach ($employees as $employee):
						?>
							<tr>
								<td><?=$sn++; ?> </td>
								<td> <?=$employee['employee_f_name']." ".$employee['employee_l_name']; ?></td>
								<td> <?=$employee['pos_name']; ?></td>
								<td> <?=$employee['dpt_name']; ?></td>
								<td> <?=$employee['employee_level']; ?></td>
								<td> <?=$employee['employee_step']; ?></td>
								<td> <?=$employee['employee_mail']; ?></td>
							</tr>
						
						<?php endforeach; endif; ?>
						</tbody>
					</table>
				
				</div> <!-- end card-body -->
			</div> <!-- end card-->
		</div> <!-- end col -->
		
	
	</div>
	
	
	
	
	
	
	
	<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>

	
<?= $this->endSection() ?>
