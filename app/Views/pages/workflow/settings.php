<?= $this->extend('layouts/admin'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?= site_url('/') ?>">iGov</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Workflow</a></li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                </div>
                <h4 class="page-title">Workflow Settings</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12">
            <?php if(session()->has('success')): ?>
                <div class="alert alert-success" role="alert">
                    <i class="mdi mdi-check-all mr-2"></i> <?= session()->get('success') ?>
                </div>
            <?php endif; ?>
            <?php if(session()->has('error')): ?>
                <div class="alert alert-warning" role="alert">
                    <i class="mdi mdi-alert-outline mr-2"></i> <?= session()->get('error') ?>
                </div>
            <?php endif; ?>
            <div class="card-box">
                <h4 class="header-title mb-4">Workflow Settings</h4>

                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="#home" data-toggle="tab" aria-expanded="false" class="nav-link">
                            Types
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#profile" data-toggle="tab" aria-expanded="true" class="nav-link active">
                            Workflow Processors
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#messages" data-toggle="tab" aria-expanded="false" class="nav-link">
                            Exceptions
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="home">
                        <p>Register different forms of workflow here.</p>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <form action="<?= site_url('/workflow/add-new-workflow-type') ?>" method="post">
                                            <?= csrf_field() ?>
                                            <div class="form-group">
                                                <label for="">Workflow Type</label>
                                                <input type="text" placeholder="Workflow type" name="workflow_type" class="form-control">
                                            </div>
                                            <div class="form-group d-flex justify-content-center">
                                                <div class="btn-group">
                                                    <button class="btn btn-primary btn-sm" type="submit">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="table-responsive">
                                            <table class="table table-striped mb-0">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Workflow Name</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $serial = 1; foreach($workflow_types as $type): ?>
                                                <tr>
                                                    <th scope="row"><?= $serial++ ?></th>
                                                    <td><?= $type['workflow_type_name'] ?></td>
                                                    <td>
                                                        <a data-target="#editModal_<?= $type['workflow_type_id'] ?>" data-toggle="modal" href="javascript:void(0);" class="btn btn-warning btn-sm">Edit</a>
                                                        <div id="editModal_<?= $type['workflow_type_id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="multiple-oneModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title" id="multiple-oneModalLabel">Edit Workflow Type</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="<?= site_url('/workflow/update-workflow-type') ?>" method="post">
                                                                            <?= csrf_field() ?>
                                                                            <div class="form-group">
                                                                                <label for="">Workflow Type</label>
                                                                                <input type="text" placeholder="Workflow type" value="<?= $type['workflow_type_name'] ?>" name="workflow_type" class="form-control">
                                                                                <input type="hidden" name="workflow_index" value="<?= $type['workflow_type_id'] ?>">
                                                                            </div>
                                                                            <div class="form-group d-flex justify-content-center">
                                                                                <div class="btn-group">
                                                                                    <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane show active" id="profile">
                       <div class="row">
                           <div class="col-md-4">
                               <h5>Normal Workflow Process</h5>
                               <form action="<?= site_url('/workflow/setup-exception-workflow-processor') ?>" method="post">
                                   <?= csrf_field() ?>
                                   <div class="form-group">
                                       <label for="">Employee</label>
                                       <select name="employee"  id="employee" class="form-control">
                                           <option selected disabled>--Select employee--</option>
                                           <?php foreach($employees as $emp): ?>
                                               <option value="<?= $emp['user_id'] ?>"><?= $emp['user_name'] ?></option>
                                           <?php endforeach; ?>
                                       </select>
                                   </div>
                                   <div class="form-group">
                                       <label for="">Department</label>
                                       <select name="department" id="department" class="form-control">
                                           <option selected disabled>--Select department--</option>
                                           <?php foreach($departments as $depart): ?>
                                               <option value="<?= $depart['dpt_id'] ?>"><?= $depart['dpt_name'] ?></option>
                                           <?php endforeach; ?>
                                       </select>
                                   </div>
                                   <div class="form-group">
                                       <label for="">Workflow Type</label>
                                       <select name="workflow_type" id="workflow_type" class="form-control">
                                           <option selected disabled>--Select workflow type</option>
                                           <?php foreach($workflow_types as $w_type): ?>
                                               <option value="<?= $w_type['workflow_type_id'] ?>"><?= $w_type['workflow_type_name'] ?></option>
                                           <?php endforeach; ?>
                                       </select>
                                   </div>
                                   <div class="form-group d-flex justify-content-center">
                                       <div class="form-group">
                                           <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                       </div>
                                   </div>
                               </form>
                           </div>
                           <div class="col-md-8">
                               <div class="table-responsive">
                                   <table class="table table-striped mb-0">
                                       <thead>
                                       <tr>
                                           <th>#</th>
                                           <th>Workflow Processor</th>
                                           <th>Department</th>
                                           <th>Workflow Type</th>
                                           <th>Action</th>
                                       </tr>
                                       </thead>
                                       <tbody>
                                       <?php $no = 1; foreach($processors as $processor): ?>
                                           <tr>
                                               <th scope="row"><?= $no++ ?></th>
                                               <td><?= $processor['user_name'] ?></td>
                                               <td><?= $processor['dpt_name'] ?></td>
                                               <td><?= $processor['workflow_type_name'] ?></td>
                                               <td>
                                                   <a href="javascript:void(0);" data-toggle="modal" data-target="#processorModal_<?= $processor['workflow_processor_id'] ?>" class="btn btn-sm btn-warning text-white">Edit</a>
                                                   <div id="processorModal_<?= $processor['workflow_processor_id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="multiple-oneModalLabel" aria-hidden="true">
                                                       <div class="modal-dialog">
                                                           <div class="modal-content">
                                                               <div class="modal-header">
                                                                   <h4 class="modal-title" id="multiple-oneModalLabel">Edit Settings</h4>
                                                                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                               </div>
                                                               <div class="modal-body">
                                                                   <form action="<?= site_url('/workflow/update-workflow-processor') ?>" method="post">
                                                                       <?= csrf_field() ?>
                                                                       <div class="form-group">
                                                                           <label for="">Employee</label>
                                                                           <select name="employee"  id="employee" class="form-control">
                                                                               <option selected disabled>--Select employee--</option>
                                                                               <?php foreach($employees as $emp): ?>
                                                                                   <option value="<?= $emp['user_id'] ?>" <?= $emp['user_id'] == $processor['w_flow_employee_id'] ? 'selected' : '' ?> ><?= $emp['user_name'] ?></option>
                                                                               <?php endforeach; ?>
                                                                           </select>
                                                                       </div>
                                                                       <div class="form-group">
                                                                           <label for="">Department</label>
                                                                           <select name="department" id="department" class="form-control">
                                                                               <option selected disabled>--Select department--</option>
                                                                               <?php foreach($departments as $depart): ?>
                                                                                   <option value="<?= $depart['dpt_id'] ?>" <?= $depart['dpt_id'] == $processor['w_flow_department_id'] ? 'selected' : '' ?>><?= $depart['dpt_name'] ?></option>
                                                                               <?php endforeach; ?>
                                                                           </select>
                                                                       </div>
                                                                       <div class="form-group">
                                                                           <label for="">Workflow Type</label>
                                                                           <select name="workflow_type" id="workflow_type" class="form-control">
                                                                               <option selected disabled>--Select workflow type</option>
                                                                               <?php foreach($workflow_types as $w_type): ?>
                                                                                   <option value="<?= $w_type['workflow_type_id'] ?>" <?= $w_type['workflow_type_id'] == $processor['w_flow_type_id'] ? 'selected' : '' ?>><?= $w_type['workflow_type_name'] ?></option>
                                                                               <?php endforeach; ?>
                                                                           </select>
                                                                       </div>
                                                                       <div class="form-group d-flex justify-content-center">
                                                                           <div class="form-group">
                                                                               <input type="hidden" name="workflow_ex_processor" value="<?= $processor['workflow_processor_id'] ?>">
                                                                               <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                                                                           </div>
                                                                       </div>
                                                                   </form>
                                                               </div>
                                                           </div>
                                                       </div>
                                                   </div>
                                               </td>
                                           </tr>
                                       <?php endforeach; ?>
                                       </tbody>
                                   </table>
                               </div>
                           </div>
                       </div>
                    </div>
                    <div class="tab-pane" id="messages">
                        <div class="row">
                            <div class="col-md-4">
                                <h5>Exceptional Workflow Process</h5>
                                <form action="<?= site_url('/workflow/setup-exception-workflow-processor') ?>" method="post">
                                    <?= csrf_field() ?>
                                    <div class="form-group">
                                        <label for="">From Employee</label>
                                        <select name="employee"  id="employee" class="form-control">
                                            <option selected disabled>--Select employee--</option>
                                            <?php foreach($employees as $emp): ?>
                                                <option value="<?= $emp['user_id'] ?>"><?= $emp['user_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">To Employee</label>
                                        <select name="to" id="to" class="form-control">
                                            <option selected disabled>--Select department--</option>
                                            <?php foreach($employees as $e): ?>
                                                <option value="<?= $e['user_id'] ?>"><?= $e['user_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Workflow Type</label>
                                        <select name="workflow_type" id="workflow_type" class="form-control">
                                            <option selected disabled>--Select workflow type</option>
                                            <?php foreach($workflow_types as $w_type): ?>
                                                <option value="<?= $w_type['workflow_type_id'] ?>"><?= $w_type['workflow_type_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group d-flex justify-content-center">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-8">
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Request From</th>
                                            <th>Directed To</th>
                                            <th>Workflow Type</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1; foreach($ex_processors as $ex_processor): ?>
                                            <tr>
                                                <th scope="row"><?= $no++ ?></th>
                                                <td><?= $ex_processor['user_name'] ?></td>
                                                <td><?= $ex_processor['w_flow_ex_to_id'] ?></td>
                                                <td><?= $ex_processor['workflow_type_name'] ?></td>
                                                <td>
                                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#processorModal_<?= $ex_processor['workflow_ex_processor_id'] ?>" class="btn btn-sm btn-warning text-white">Edit</a>
                                                    <div id="processorModal_<?= $ex_processor['workflow_ex_processor_id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="multiple-oneModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="multiple-oneModalLabel">Edit Settings</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="<?= site_url('/workflow/update-workflow-processor') ?>" method="post">
                                                                        <?= csrf_field() ?>
                                                                        <div class="form-group">
                                                                            <label for="">From Employee</label>
                                                                            <select name="employee"  id="employee" class="form-control">
                                                                                <option selected disabled>--Select employee--</option>
                                                                                <?php foreach($employees as $emp): ?>
                                                                                    <option value="<?= $emp['user_id'] ?>" <?= $emp['user_id'] == $ex_processor['w_flow_ex_employee_id'] ? 'selected' : '' ?> ><?= $emp['user_name'] ?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="">To Employee</label>
                                                                            <select name="department" id="department" class="form-control">
                                                                                <option selected disabled>--Select department--</option>
                                                                                <?php foreach($employees as $em): ?>
                                                                                    <option value="<?= $em['user_id'] ?>" <?= $em['user_id'] == $ex_processor['w_flow_ex_employee_id'] ? 'selected' : '' ?> ><?= $emp['user_name'] ?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="">Workflow Type</label>
                                                                            <select name="workflow_type" id="workflow_type" class="form-control">
                                                                                <option selected disabled>--Select workflow type</option>
                                                                                <?php foreach($workflow_types as $w_type): ?>
                                                                                    <option value="<?= $w_type['workflow_type_id'] ?>" <?= $w_type['workflow_type_id'] == $ex_processor['w_flow_ex_type_id'] ? 'selected' : '' ?>><?= $w_type['workflow_type_name'] ?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group d-flex justify-content-center">
                                                                            <div class="form-group">
                                                                                <input type="hidden" name="workflow_processor" value="<?= $ex_processor['workflow_ex_processor_id'] ?>">
                                                                                <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end card-box-->
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('extra-scripts'); ?>
<!--view('pages/notice/_notice-scripts.php')-->
<?= $this->endSection(); ?>




