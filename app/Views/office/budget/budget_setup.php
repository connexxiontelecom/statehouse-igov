<?= $this->extend('layouts/admin') ?>
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
				<h4 class="page-title">Budget Setup</h4>
			</div>
		</div>
	</div>
	<!-- end page title -->
	<div class="row" style="margin-top: -50px">
		<div class="col-xl-12">
			<div class="card">
				<div class="card-body">
					<?php if(session()->has('action')): ?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<i class="mdi mdi-check-all mr-2"></i><strong>Action Successful !</strong>
						</div>
					<?php endif; ?>
					
					
					<?php if(session()->has('errors')):
						$errors = session()->get('errors');
						foreach ($errors as $error):
							?>
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<i class="mdi mdi-check-all mr-2"></i><strong><?php print_r($error); ?> !</strong>
							</div>
						<?php endforeach; endif; ?>
					
					<form action="" method="post">
					<div class="row">
						<h4> Budget Details</h4>
						<div class="col-xl-12">
							
							<div class="row">
								<div class="col-lg-6">
									<!-- Date View -->
									<div class="form-group">
										<label>Budget Title</label>
										<input type="text" class="form-control" name="budget_title"  placeholder="Budget Title">
									</div>
								</div>
								
								<div class="col-lg-6">
									<!-- Date View -->
									<div class="form-group">
										<label>Year</label>
										<input type="text" class="form-control" name="budget_year" value="<?=date('Y') ?>" placeholder="<?=date('Y') ?>" required>
									</div>
								</div>
							</div>
							
						
						</div> <!-- end col-->
						
					
					</div>
					
					<div class="row" style="margin-top: -9%">
						<h4> Budget Headers</h4>
						<div class="col-xl-12" id="debits">
							
							<div  id="debit1">
								
								<button style="margin-bottom: 5%" type="button" onclick="delete_div(this)"  class="btn btn-danger"><i class="fa fa-minus-square"></i></button>
								
						
									<div class="row">
										
										<div class="col-lg-4">
											<div class="form-group">
												<label  for="application_payroll_group_id">  Title: </label>
												<input type="text" class="form-control" id="bh_title1"  required placeholder="Title"   name="bh_title[]">
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label  for="application_payroll_group_id"> Office: </label>
												<select class="form-control" name="bh_office[]" id="bh_office1"  required>
													<option selected disabled value="">Choose...</option>
													<?php if($departments): foreach ($departments as $department): ?>
													<option value="<?=$department['dpt_id'] ?>"> <?=$department['dpt_name'] ?></option>
													<?php endforeach; endif; ?>
												
												</select>
											</div>
										</div>
										
										
										
										
										
										<div class="col-lg-4" >
											
											<label for="total_amount" class="form-label">Amount:</label>
											<input  type="text" class="form-control number" required onkeyup="confirm_total()"	name="bh_amount[]"/>
										
										
										
										
										</div>
									</div>
									
							
							</div>
							
							
							<div class="form-group" id="clone_dr_button" style="float: right; margin-top: 10px">
								
								<button type="button" onclick="clone_div_dr(this)"   class="btn btn-success"><i class="fa fa-plus-square"> </i></button>
							
							
							</div>
						
						
						</div>
					</div>
					<!-- end row -->
					<div class="row">
						<div class="col-xl-12">
							<div class="row">
								
								<div class="col-lg-4 offset-8">
									<label for="tendered_amount" readonly class="form-label">Total:</label>
									<input  type="text" id="total_amount"
											class="form-control number" readonly disabled/>
								</div>
							</div>
						</div>
						
					</div>
					
					
					<div class="row mt-3">
						<div class="col-12 text-center">
							<button type="submit" class="btn btn-success waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> Create</button>
							<button type="reset" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> Cancel</button>
						</div>
					</div>
					
					</form>
					
					
					
				
				</div> <!-- end card-body -->
			</div> <!-- end card-->
		</div> <!-- end col -->
	</div>
</div>
<!-- Long Content Scroll Modal -->

<?= $this->endSection() ?>
<?= $this->section('content') ?>
<script>
	let clones_id = [1];
	let clones_ids = [1];
	function clone_div_dr() {
		let elem = document.getElementById('debit1');
		if (elem.style.display === 'none') {
			elem.style.display = 'block';
		}
		else {
			// Create a copy of it
			let clone = elem.cloneNode(true);
			// Update the ID and add a class
			let count_clones = clones_ids.length;
			let count_cloness = count_clones + 1;
			
			let n = clones_id.includes(count_cloness);
			
			while(n === true){
				count_cloness = count_cloness + 1;
				n = clones_id.includes(count_cloness);
			}
			
			clone.id = 'debit'+count_cloness;
			// document.getElementById('work_experiences').appendChild(clone);
			let payments = document.getElementById('debits');
			
			let clone_button = document.getElementById('clone_dr_button');
			//clone.insertBefore(work_experience_button);
			payments.insertBefore(clone, clone_button)
			clones_id.push(count_cloness)
			
			let new_elem = document.getElementById('debit'+count_clones);
			// Inject it into the DOM
			
			
			// inputs = elem.getElementsByTagName('textarea');
			// for (index = 0; index < inputs.length; ++index) {
			//     // if(inputs[index].type == 'textarea')
			//     inputs[index].value = '';
			// }
			// var textarea = elem.getElementsByTagName('textarea');
			// textarea.value = '';
			
			// console.log(new_elems);
			elem.after(new_elem);
			
			
			//document.getElementById('temp_id').id = "target"+count_cloness ;
			//document.getElementById('payment_type1').id = "payment_type"+count_cloness ;
			//console.log(clones_id);
			
			
			
			let new_id = 'debit'+count_cloness;
			
			let inputs = $("#" + new_id).find("select, input");
			let index;
			for (index = 0; index < inputs.length; ++index) {
				if (inputs[index].name === 'bh_office[]') {
					// console.log('i changed target');
					inputs[index].id = "bh_office" + count_cloness;
					
					inputs[index].value = '';
				}
				
			}
			
			
			
			for (index = 0; index < inputs.length; ++index) {
				if (inputs[index].name === 'bh_title[]') {
					inputs[index].id = "bh_title" + count_cloness;
					inputs[index].value = '';
				}
			}
			
			for (index = 0; index < inputs.length; ++index) {
				if (inputs[index].name === 'bh_amount[]') {
					inputs[index].id = "bh_amount" + count_cloness;
					inputs[index].value = '';
				}
			}
			
			
			
		}
		//let master_amount = parseFloat($('#master_amount').val().replace(/,/g, ''));
		//let master_inputs = $("#payments").find("select, input");
		//console.log(master_inputs.length);
		// let index;
		// let payment_amount = 0;
		//  for (index = 0; index < master_inputs.length; ++index) {
		//      if (master_inputs[index].name === 'payment_amount[]') {
		//          // console.log('i changed target');
		//          payment_amount =  parseFloat(master_inputs[index].value.replace(/,/g, '')) + payment_amount;
		//      }
		//  }
		
		
		//console.log(payment_amount);
		
		
		
		
	}
	
	function delete_div(e) {
		let id = e.parentElement.id;
		if ((id === 'credit1') || (id === 'debit1')) {
			alert('cannot remove');
		} else {
			
			
			e.parentElement.remove();
			confirm_total();
		}
	}
	
	function confirm_total(){
		let debit_inputs = $("#debits").find("select, input");
		
		let index;
		
		let debit_amount = 0;
		for (index = 0; index < debit_inputs.length; ++index) {
			if (debit_inputs[index].name === 'bh_amount[]') {
				var cVal =  debit_inputs[index].value;
				var tDecimal = testDecimals(cVal);
				if (tDecimal.length > 1) {
					//console.log("You cannot enter more than one decimal point");
					cVal = cVal.slice(0, -1);
				}
				debit_inputs[index].value = replaceCommas(cVal);
				
				debit_amount = parseFloat(debit_inputs[index].value.replace(/,/g, '')) + debit_amount;
			}
			
		}
		
		$("#total_amount").val(debit_amount.toLocaleString());
		
		let total_amount = $('#total_amount').val();
		
		$("#tendered_amount").attr({
			"max" : total_amount,        // substitute your own
			"min" : 1          // values (or variables) here
		});
		
		
	}
</script>

<?= $this->endSection() ?>
