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
						<li class="breadcrumb-item"><a href="<?= site_url('manage-registries')?>">Registries</a></li>
						<li class="breadcrumb-item active">Manage Registry</li>
					</ol>
				</div>
				<h4 class="page-title">Manage Registry</h4>
			</div>
		</div>
	</div>
	<!-- end page title -->
  <form method="post">
    <div class="row" style="margin-top: -50px">
      <div class="col-lg-6">
        <div class="card-box">
          <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Registry Details</h5>
          <div class="form-group mb-3">
            <label for="registry-name">Registry Name</label>
            <input type="text" id="registry-name" name="registry_name" class="form-control" value="<?=$registry['registry_name']?>" required>
          </div>
          <div class="form-group mb-3">
            <label class="mb-2">Status</label>
            <br/>
            <div class="radio form-check-inline">
              <input type="radio" id="inlineRadio1" value="1" name="registry_status" <?=$registry['registry_status'] == 1 ? 'checked': ''?>>
              <label for="inlineRadio1"> Active </label>
            </div>
            <div class="radio form-check-inline">
              <input type="radio" id="inlineRadio2" value="0" name="registry_status" <?=$registry['registry_status'] == 0 ? 'checked': ''?>>
              <label for="inlineRadio2"> Inactive </label>
            </div>
          </div>
          <div class="form-group">
            <label for="site-desc">Registry Description</label>
            <textarea class="form-control" name="registry_description" id="site-desc" rows="4"><?=$registry['registry_description']?></textarea>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card-box">
          <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">Registry Access</h5>
          <div class="custom-control custom-checkbox float-left">
            <input type="checkbox" class="custom-control-input" id="select-all">
            <label class="custom-control-label" for="select-all">
              Select all users
            </label>
          </div>
          <div class="mt-5" style="height: 300px; overflow: auto">
					  <?php foreach ($department_employees as $department => $employees): ?>
						  <?php if(!empty($employees)):?>
                <h5 class="mb-2 font-size-16"><?=$department?></h5>
							  <?php foreach ($employees as $employee):?>
                  <div class="custom-control custom-checkbox mt-1">
                    <input type="checkbox" class="custom-control-input user" id="<?=$employee['user']['user_id']?>"
                           value="<?=$employee['user']['user_id']?>" name="registry_users[]"
                            <?=in_array($employee['user']['user_id'], $registry['registry_users']) ? 'checked' : ''?>
                    >
                    <label class="custom-control-label strikethrough" for="<?=$employee['user']['user_id']?>">
										  <?=$employee['position']['pos_name'].' ('.$employee['user']['user_name'].')'?>
                    </label>
                  </div>
							  <?php endforeach;?>
						  <?php endif;?>
					  <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="text-center mb-3">
          <a href="<?=site_url('manage-registry')?>" type="button" class="btn w-sm btn-danger waves-effect">Cancel</a>
          <button type="submit" class="btn w-sm btn-success waves-effect waves-light">Save</button>
        </div>
      </div>
    </div>
    <input type="hidden" name="registry_id" value="<?=$registry['registry_id']?>">
  </form>
</div>
<?= $this->endSection() ?>
<?= $this->section('extra-scripts') ?>
<script>
  $('#select-all').click(e => {
    let selectAll = $('#select-all')[0]
    let allUserCheckboxes = $('.user')
    allUserCheckboxes.each(function () {
      this.checked = selectAll.checked
    })
  })
</script>
<?= $this->endSection() ?>
