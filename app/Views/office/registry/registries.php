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
            <li class="breadcrumb-item"><a href="javascript: void(0);">General Settings</a></li>
            <li class="breadcrumb-item active">Registry</li>
          </ol>
        </div>
        <h4 class="page-title">Registry</h4>
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
          <div>
            <a href="<?=site_url('new-registry')?>" type="button" class="btn btn-primary" style="float: right"> <i class="mdi mdi-plus mr-2"></i>New Registry</a>
          </div>
          <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
            <thead>
            <tr>
              <th>S/N</th>
              <th>Registry Name</th>
              <th>Registry Description</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
            </thead>
            <tbody>
              <?php if ($registries):
                $i = 1;
                foreach ($registries as $registry):
              ?>
                <tr>
                  <td><?=$i++;?></td>
                  <td><?=$registry['registry_name']?></td>
                  <td><?=$registry['registry_description']?></td>
                  <td><?=$registry['registry_status'] == 0 ? 'Inactive' : 'Active'?></td>
                  <td>
                    <a href="<?=site_url('manage-registry/').$registry['registry_id']?>" type="button" class="btn btn-primary"><i class="mdi mdi-pen-lock"></i></a>
                  </td>
                </tr>
              <?php endforeach; endif;?>
            </tbody>
          </table>
        </div> <!-- end card-body -->
      </div> <!-- end card-->
    </div> <!-- end col -->
  </div>
</div>
<!-- Long Content Scroll Modal -->
<div class="modal fade" id="new-registry" tabindex="-1" role="dialog"
     aria-labelledby="scrollableModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="scrollableModalTitle">New Registry</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="">
          <div class="row g-3 align-center">
            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-label" for="site-name">Registry Name</label>
                <span class="form-note">Enter Registry Name</span>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <div class="form-control-wrap">
                  <input type="text" class="form-control" id="site-name" name="registry_name" required>
                </div>
              </div>
            </div>
          </div>
          <div class="row g-3 align-center">
            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-label" for="registry-manager-id">Registry Manager</label>
                <span class="form-note">Select Registry Manager</span>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <select class="form-control input-lg" data-toggle="select2" id="registry-manager-id" name="registry_manager_id">
                  <option value="" selected disabled>Select</option>
		              <?php foreach ($department_employees as $department => $employees): ?>
			              <?php if(!empty($employees)):?>
                      <optgroup label="<?=$department?>">
					              <?php foreach ($employees as $employee): if ($employee['user']['user_id'] != session()->user_id):?>
                          <option value="<?=$employee['user']['user_id']?>">
							              <?=$employee['position']['pos_name'].' ('.$employee['user']['user_name'].')'?>
                          </option>
					              <?php endif; endforeach;?>
                      </optgroup>
			              <?php endif;?>
		              <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row g-3 align-center">
            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-label" for="site-desc">Registry Description</label>
                <span class="form-note">Enter Registry Description</span>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <div class="form-control-wrap">
                  <textarea class="form-control" name="registry_description" id="site-desc" rows="4"></textarea>
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

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?= $this->endSection() ?>

