<?= $this->extend('layouts/master'); ?>
<?=$this->section('extra-styles'); ?>
  <link href="/assets/libs/dropify/css/dropify.min.css" rel="stylesheet" type="text/css" />
  <link href="/assets/libs/ladda/ladda-themeless.min.css" rel="stylesheet" type="text/css" />
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
              <li class="breadcrumb-item"><a href="javascript:void(0)">Manage Fleet</a></li>
              <li class="breadcrumb-item"><a href="<?=site_url('active-vehicles')?>">Active Vehicles</a></li>
              <li class="breadcrumb-item active">New Vehicle</li>
						</ol>
					</div>
					<h4 class="page-title">New Vehicle</h4>
				</div>
			</div>
		</div>
		<!-- end page title -->
		<div class="row">
			<div class="col-12">
				<div class="card-box">
					<div class="row">
						<div class="col-lg-1"></div>
						<div class="col-lg-11">
							<div class="text-lg-right mt-3 mt-lg-0">
								<a href="<?=site_url('active-vehicles')?>" type="button" class="btn btn-success waves-effect waves-light">Go Back</a>
							</div>
						</div><!-- end col-->
					</div> <!-- end row -->
				</div> <!-- end card-box -->
			</div><!-- end col-->
		</div>
		<form class="needs-validation" id="new-vehicle-form" novalidate>
			<div class="row">
				<div class="col-12">
					<div class="card-box">
						<h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Vehicle Details</h5>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="fv-color">Color</label><span style="color: red"> *</span>
                  <input type="text" class="form-control" id="fv-color" name="fv_color" required>
                  <div class="invalid-feedback">
                    Please enter a color.
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="fv-fvt-id">Vehicle Type</label>
                  <select class="form-control" data-toggle="select2" id="fv-fvt-id" name="fv_fvt_id">
                    <option value="" selected disabled>Select</option>
			              <?php foreach ($vehicle_types as $vehicle_type): ?>
                      <option value="<?=$vehicle_type['fvt_id']?>">
					              <?=$vehicle_type['fvt_name']?>
                      </option>
			              <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="fv-brand">Brand</label><span style="color: red"> *</span>
                  <input type="text" class="form-control" id="fv-brand" name="fv_brand" required>
                  <div class="invalid-feedback">
                    Please enter a brand.
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="fv-maker">Maker/Model</label><span style="color: red"> *</span>
                  <input type="text" class="form-control" id="fv-maker" name="fv_maker" required>
                  <div class="invalid-feedback">
                    Please enter a maker/model.
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="fv-engine-type">Engine Type</label><span style="color: red"> *</span>
                  <input type="text" class="form-control" id="fv-engine-type" name="fv_engine_type" required>
                  <div class="invalid-feedback">
                    Please enter an engine type.
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="fv-purchase-price">Purchase Price</label><span style="color: red"> *</span>
                  <input type="text" class="form-control" id="fv-purchase-price" name="fv_purchase_price" required>
                  <div class="invalid-feedback">
                    Please enter a purchase price.
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="fv-mileage">Mileage</label><span style="color: red"> *</span>
                  <input type="text" class="form-control" id="fv-mileage" name="fv_mileage" required>
                  <div class="invalid-feedback">
                    Please enter a mileage.
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="fv-year">Year</label><span style="color: red"> *</span>
                  <input type="text" class="form-control" id="fv-year" name="fv_year" required>
                  <div class="invalid-feedback">
                    Please enter a year.
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="fv-plate-no">Plate Number</label><span style="color: red"> *</span>
                  <input type="text" class="form-control" id="fv-plate-no" name="fv_plate_no" required>
                  <div class="invalid-feedback">
                    Please enter a plate number.
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="fv-policy-no">Policy Number (INSR)</label><span style="color: red"> *</span>
                  <input type="text" class="form-control" id="fv-policy-no" name="fv_policy_no" required>
                  <div class="invalid-feedback">
                    Please enter a policy number.
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="fv-chassis-no">Chassis Number</label><span style="color: red"> *</span>
                  <input type="text" class="form-control" id="fv-chassis-no" name="fv_chassis_no" required>
                  <div class="invalid-feedback">
                    Please enter a chassis number.
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="fv-purchase-date">Purchase Date</label><span style="color: red"> *</span>
                  <input type="date" class="form-control" id="fv-purchase-date" name="fv_purchase_date" required>
                  <div class="invalid-feedback">
                    Please select a purchase date.
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="fv-tank-capacity">Tank Capacity</label><span style="color: red"> *</span>
                  <input type="text" class="form-control" id="fv-tank-capacity" name="fv_tank_capacity" required>
                  <div class="invalid-feedback">
                    Please enter a tank capacity.
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="file">Vehicle Image</label>
                  <div class="form-control-wrap">
                    <input id="file" type="file" data-plugins="dropify" name="file"/>
                  </div>
                </div>
              </div>
            </div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12 text-center">
					<button class="btn btn-success waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> Register</button>
					<a href="<?=site_url('active-vehicles')?>" type="button" class="btn btn-danger waves-effect waves-light m-1"><i class="fe-x mr-1"></i> Cancel</a>
				</div>
			</div>
		</form>
	</div>
<?= $this->endSection(); ?>
<?= $this->section('extra-scripts'); ?>
  <script src="/assets/libs/dropzone/min/dropzone.min.js"></script>
  <script src="/assets/libs/dropify/js/dropify.min.js"></script>
  <!-- Loading buttons js -->
  <script src="/assets/libs/ladda/spin.min.js"></script>
  <script src="/assets/libs/ladda/ladda.min.js"></script>

  <!-- Buttons init js-->
  <!-- Init js-->
  <script src="/assets/js/pages/loading-btn.init.js"></script>
  <script src="/assets/js/pages/form-fileuploads.init.js"></script>
<?=view('pages/fleet/_fleet-scripts.php')?>
<?= $this->endSection(); ?>