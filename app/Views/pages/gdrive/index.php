<?= $this->extend('layouts/master'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">GDrive</li>
                    </ol>
                </div>
                <h4 class="page-title">GDrive</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <?php echo view('pages/gdrive/_sidebar'); ?>
                <div class="inbox-rightbar">
                    <?php echo view('pages/gdrive/_search-form') ?>

                    <div class="mt-3">
                        <h5 class="mb-2">Quick Access</h5>
                        <?php if(session()->has('error')): ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <?= session()->get('error') ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if(session()->has('success')): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <?= session()->get('success') ?>
                            </div>
                        <?php endif; ?>
                        <div class="row mx-n1 no-gutters">
                            <?php foreach($folders as $fold1): ?>
                                <?php if($fold1['parent_id'] == 0) : ?>
                                    <div class="col-xl-3 col-lg-6">
                                        <div class="card m-1 shadow-none border">
                                            <div class="p-2">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <div class="avatar-sm">
                                                    <span class="avatar-title bg-light text-secondary rounded">
                                                        <img height="32" width="32" src="/assets/formats/folder.png" alt="<?= $fold1['folder'] ?>">
                                                    </span>
                                                        </div>
                                                    </div>
                                                    <div class="col pl-0">
                                                        <a href="/open-folder/<?= $fold1['folder_id'] ?>" class="text-muted font-weight-bold"><?= $fold1['folder'] ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>

                            <?php foreach($files as $file): ?>
                                <?php if($file['folder_id'] == 0) :?>
                                    <?php if(pathinfo($file['file_name'], PATHINFO_EXTENSION) == 'pdf'): ?>
                                        <div class="col-xl-3 col-lg-6">
                                            <div class="card m-1 shadow-none border">
                                                <div class="p-2">
                                                    <div class="row align-items-center">
                                                        <div class="col-auto">
                                                            <div class="avatar-sm">
                                                    <span class="avatar-title bg-light text-secondary rounded">
                                                        <img height="32" width="32" src="/assets/formats/pdf.png" alt="<?= $file['file_name'] ?>">
                                                    </span>
                                                            </div>
                                                        </div>
                                                        <div class="col pl-0">
                                                            <a href="javascript:void(0);"  class="text-muted font-weight-bold"><?= strlen($file['name']) > 12 ? substr($file['name'],0,12).'...' : $file['name'] ?></a>
                                                            <p class="mb-0 font-13">
                                                                <?php if($file['size'] >= 1073741824):
                                                                    echo number_format($file['size'] / 1073741824, 2) . ' GB';
                                                                ?>
                                                                <?php elseif($file['size'] >= 1048576):
                                                                    echo number_format($file['size'] / 1048576, 2) . ' MB';
                                                                ?>
                                                                <?php elseif($file['size'] >= 1024):
                                                                    echo number_format($file['size'] / 1024, 2) . ' KB';
                                                                ?>
                                                                <?php elseif($file['size'] > 1):
                                                                    echo $file['size'] . ' bytes';
                                                                ?>
                                                                <?php elseif($file['size'] == 1):
                                                                    echo $file['size'] . ' byte';
                                                                ?>
                                                                <?php else:
                                                                    echo '0 bytes';
                                                                ?>
                                                                <?php endif;  ?>
                                                            </p>
                                                        </div>
                                                    </div> <!-- end row -->
                                                </div> <!-- end .p-2-->
                                                <div class="btn-group dropdown">
                                                    <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-xs" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0);" data-target="#shareWithModal_<?=$file['file_id'] ?>" data-toggle="modal"><i class="mdi mdi-share-variant mr-2 text-muted vertical-middle"></i>Share with</a>
                                                        <a class="dropdown-item" href="/uploads/posts/<?= $file['file_name'] ?>" target="_blank"><i class="mdi mdi-download mr-2 text-muted vertical-middle"></i>Download</a>
                                                        <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#removeFileModal_<?=$file['file_id'] ?>"><i class="mdi mdi-delete mr-2 text-muted vertical-middle"></i>Remove</a>
                                                    </div>
                                                </div>
                                                <div id="removeFileModal_<?=$file['file_id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <div class="text-center mt-2 mb-4">
                                                                    <h4 class="text-danger">Are You Sure?</h4>
                                                                </div>
                                                                <p>This action cannot be undone. Are you sure you want to remove <strong><?= $file['name'] ?></strong> ? </p>
                                                                <div class="form-group text-center">
                                                                    <a class="btn btn-danger text-white" href="<?= site_url('/remove-file/'.$file['file_id']) ?>">Yes, proceed.</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="shareWithModal_<?=$file['file_id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <div class="text-center mt-2 mb-4">
                                                                    <h4 class="text-success">Share with</h4>
                                                                </div>
                                                                <form action="<?= site_url('share-file-with') ?>" method="post">
                                                                    <?= csrf_field() ?>
                                                                    <div class="form-group">
                                                                        <label for="">User</label>
                                                                        <select name="user" id="user"
                                                                                class="form-control">
                                                                            <option selected disabled>--Select user--</option>
                                                                            <?php foreach($users as $user): ?>
                                                                                <option value="<?= $user['user_id'] ?>"><?= $user['user_name'] ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                        <input type="hidden" name="file_id" value="<?= $file['file_id'] ?>">
                                                                    </div>
                                                                    <div class="form-group text-center">
                                                                        <button class="btn btn-primary text-white" type="submit">Submit</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php elseif(pathinfo($file['file_name'], PATHINFO_EXTENSION) == 'ppt'): ?>
                                        <div class="col-xl-3 col-lg-6">
                                            <div class="card m-1 shadow-none border">
                                                <div class="p-2">
                                                    <div class="row align-items-center">
                                                        <div class="col-auto">
                                                            <div class="avatar-sm">
                                                    <span class="avatar-title bg-soft-primary text-primary rounded">
                                                        <img height="32" width="32" src="/assets/formats/ppt.png" alt="<?= $file['file_name'] ?>">
                                                    </span>
                                                            </div>
                                                        </div>
                                                        <div class="col pl-0">
                                                            <a href="/uploads/posts/<?= $file['file_name'] ?>" class="text-muted font-weight-bold"> <?= strlen($file['name']) > 12 ? substr($file['name'],0,12).'...' : $file['name'] ?></a>
                                                            <p class="mb-0 font-13">
                                                                <?php if($file['size'] >= 1073741824):
                                                                    echo number_format($file['size'] / 1073741824, 2) . ' GB';
                                                                    ?>
                                                                <?php elseif($file['size'] >= 1048576):
                                                                    echo number_format($file['size'] / 1048576, 2) . ' MB';
                                                                    ?>
                                                                <?php elseif($file['size'] >= 1024):
                                                                    echo number_format($file['size'] / 1024, 2) . ' KB';
                                                                    ?>
                                                                <?php elseif($file['size'] > 1):
                                                                    echo $file['size'] . ' bytes';
                                                                    ?>
                                                                <?php elseif($file['size'] == 1):
                                                                    echo $file['size'] . ' byte';
                                                                    ?>
                                                                <?php else:
                                                                    echo '0 bytes';
                                                                    ?>
                                                                <?php endif;  ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="btn-group dropdown">
                                                    <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-xs" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0);" data-target="#shareWithModal_<?=$file['file_id'] ?>" data-toggle="modal"><i class="mdi mdi-share-variant mr-2 text-muted vertical-middle"></i>Share with</a>
                                                        <a class="dropdown-item" href="/uploads/posts/<?= $file['file_name'] ?>" target="_blank"><i class="mdi mdi-download mr-2 text-muted vertical-middle"></i>Download</a>
                                                        <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#removeFileModal_<?=$file['file_id'] ?>"><i class="mdi mdi-delete mr-2 text-muted vertical-middle"></i>Remove</a>
                                                    </div>
                                                </div>
                                                <div id="removeFileModal_<?=$file['file_id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <div class="text-center mt-2 mb-4">
                                                                    <h4 class="text-danger">Are You Sure?</h4>
                                                                </div>
                                                                <p>This action cannot be undone. Are you sure you want to remove <strong><?= $file['name'] ?></strong> ? </p>
                                                                <div class="form-group text-center">
                                                                    <a class="btn btn-danger text-white" href="<?= site_url('/remove-file/'.$file['file_id']) ?>">Yes, proceed.</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="shareWithModal_<?=$file['file_id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <div class="text-center mt-2 mb-4">
                                                                    <h4 class="text-success">Share with</h4>
                                                                </div>
                                                                <form action="<?= site_url('share-file-with') ?>" method="post">
                                                                    <?= csrf_field() ?>
                                                                    <div class="form-group">
                                                                        <label for="">User</label>
                                                                        <select name="user" id="user"
                                                                                class="form-control">
                                                                            <option selected disabled>--Select user--</option>
                                                                            <?php foreach($users as $user): ?>
                                                                                <option value="<?= $user['user_id'] ?>"><?= $user['user_name'] ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                        <input type="hidden" name="file_id" value="<?= $file['file_id'] ?>">
                                                                    </div>
                                                                    <div class="form-group text-center">
                                                                        <button class="btn btn-primary text-white" type="submit">Submit</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php elseif(pathinfo($file['file_name'], PATHINFO_EXTENSION) == 'doc'): ?>
                                        <div class="col-xl-3 col-lg-6">
                                            <div class="card m-1 shadow-none border">
                                                <div class="p-2">
                                                    <div class="row align-items-center">
                                                        <div class="col-auto">
                                                            <div class="avatar-sm">
                                                    <span class="avatar-title bg-light text-secondary rounded">
                                                        <img height="32" width="32" src="/assets/formats/doc.png" alt="<?= $file['file_name'] ?>">
                                                    </span>
                                                            </div>
                                                        </div>
                                                        <div class="col pl-0">
                                                            <a href="/uploads/posts/<?= $file['file_name'] ?>" class="text-muted font-weight-bold"><?= strlen($file['name']) > 12 ? substr($file['name'],0,12).'...' : $file['name'] ?></a>
                                                            <p class="mb-0 font-13">
                                                                <?php if($file['size'] >= 1073741824):
                                                                    echo number_format($file['size'] / 1073741824, 2) . ' GB';
                                                                    ?>
                                                                <?php elseif($file['size'] >= 1048576):
                                                                    echo number_format($file['size'] / 1048576, 2) . ' MB';
                                                                    ?>
                                                                <?php elseif($file['size'] >= 1024):
                                                                    echo number_format($file['size'] / 1024, 2) . ' KB';
                                                                    ?>
                                                                <?php elseif($file['size'] > 1):
                                                                    echo $file['size'] . ' bytes';
                                                                    ?>
                                                                <?php elseif($file['size'] == 1):
                                                                    echo $file['size'] . ' byte';
                                                                    ?>
                                                                <?php else:
                                                                    echo '0 bytes';
                                                                    ?>
                                                                <?php endif;  ?>
                                                            </p>
                                                        </div>
                                                    </div> <!-- end row -->
                                                </div> <!-- end .p-2-->
                                                <div class="btn-group dropdown">
                                                    <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-xs" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0);" data-target="#shareWithModal_<?=$file['file_id'] ?>" data-toggle="modal"><i class="mdi mdi-share-variant mr-2 text-muted vertical-middle"></i>Share with</a>
                                                        <a class="dropdown-item" href="/uploads/posts/<?= $file['file_name'] ?>" target="_blank"><i class="mdi mdi-download mr-2 text-muted vertical-middle"></i>Download</a>
                                                        <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#removeFileModal_<?=$file['file_id'] ?>"><i class="mdi mdi-delete mr-2 text-muted vertical-middle"></i>Remove</a>
                                                    </div>
                                                </div>
                                                <div id="removeFileModal_<?=$file['file_id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <div class="text-center mt-2 mb-4">
                                                                    <h4 class="text-danger">Are You Sure?</h4>
                                                                </div>
                                                                <p>This action cannot be undone. Are you sure you want to remove <strong><?= $file['name'] ?></strong> ? </p>
                                                                <div class="form-group text-center">
                                                                    <a class="btn btn-danger text-white" href="<?= site_url('/remove-file/'.$file['file_id']) ?>">Yes, proceed.</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="shareWithModal_<?=$file['file_id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <div class="text-center mt-2 mb-4">
                                                                    <h4 class="text-success">Share with</h4>
                                                                </div>
                                                                <form action="<?= site_url('share-file-with') ?>" method="post">
                                                                    <?= csrf_field() ?>
                                                                    <div class="form-group">
                                                                        <label for="">User</label>
                                                                        <select name="user" id="user"
                                                                                class="form-control">
                                                                            <option selected disabled>--Select user--</option>
                                                                            <?php foreach($users as $user): ?>
                                                                                <option value="<?= $user['user_id'] ?>"><?= $user['user_name'] ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                        <input type="hidden" name="file_id" value="<?= $file['file_id'] ?>">
                                                                    </div>
                                                                    <div class="form-group text-center">
                                                                        <button class="btn btn-primary text-white" type="submit">Submit</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php elseif(pathinfo($file['file_name'], PATHINFO_EXTENSION) == 'docx'): ?>
                                        <div class="col-xl-3 col-lg-6">
                                            <div class="card m-1 shadow-none border">
                                                <div class="p-2">
                                                    <div class="row align-items-center">
                                                        <div class="col-auto">
                                                            <div class="avatar-sm">
                                                    <span class="avatar-title bg-light text-secondary rounded">
                                                        <img height="32" width="32" src="/assets/formats/doc.png" alt="<?= $file['file_name'] ?>">
                                                    </span>
                                                            </div>
                                                        </div>
                                                        <div class="col pl-0">
                                                            <a href="/uploads/posts/<?= $file['file_name'] ?>" class="text-muted font-weight-bold"><?= strlen($file['name']) > 12 ? substr($file['name'],0,12).'...' : $file['name'] ?></a>
                                                            <p class="mb-0 font-13">
                                                                <?php if($file['size'] >= 1073741824):
                                                                    echo number_format($file['size'] / 1073741824, 2) . ' GB';
                                                                    ?>
                                                                <?php elseif($file['size'] >= 1048576):
                                                                    echo number_format($file['size'] / 1048576, 2) . ' MB';
                                                                    ?>
                                                                <?php elseif($file['size'] >= 1024):
                                                                    echo number_format($file['size'] / 1024, 2) . ' KB';
                                                                    ?>
                                                                <?php elseif($file['size'] > 1):
                                                                    echo $file['size'] . ' bytes';
                                                                    ?>
                                                                <?php elseif($file['size'] == 1):
                                                                    echo $file['size'] . ' byte';
                                                                    ?>
                                                                <?php else:
                                                                    echo '0 bytes';
                                                                    ?>
                                                                <?php endif;  ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="btn-group dropdown">
                                                    <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-xs" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0);" data-target="#shareWithModal_<?=$file['file_id'] ?>" data-toggle="modal"><i class="mdi mdi-share-variant mr-2 text-muted vertical-middle"></i>Share with</a>
                                                        <a class="dropdown-item" href="/uploads/posts/<?= $file['file_name'] ?>" target="_blank"><i class="mdi mdi-download mr-2 text-muted vertical-middle"></i>Download</a>
                                                        <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#removeFileModal_<?=$file['file_id'] ?>"><i class="mdi mdi-delete mr-2 text-muted vertical-middle"></i>Remove</a>
                                                    </div>
                                                </div>
                                                <div id="removeFileModal_<?=$file['file_id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <div class="text-center mt-2 mb-4">
                                                                    <h4 class="text-danger">Are You Sure?</h4>
                                                                </div>
                                                                <p>This action cannot be undone. Are you sure you want to remove <strong><?= $file['name'] ?></strong> ? </p>
                                                                <div class="form-group text-center">
                                                                    <a class="btn btn-danger text-white" href="<?= site_url('/remove-file/'.$file['file_id']) ?>">Yes, proceed.</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="shareWithModal_<?=$file['file_id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <div class="text-center mt-2 mb-4">
                                                                    <h4 class="text-success">Share with</h4>
                                                                </div>
                                                                <form action="<?= site_url('share-file-with') ?>" method="post">
                                                                    <?= csrf_field() ?>
                                                                    <div class="form-group">
                                                                        <label for="">User</label>
                                                                        <select name="user" id="user"
                                                                                class="form-control">
                                                                            <option selected disabled>--Select user--</option>
                                                                            <?php foreach($users as $user): ?>
                                                                                <option value="<?= $user['user_id'] ?>"><?= $user['user_name'] ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                        <input type="hidden" name="file_id" value="<?= $file['file_id'] ?>">
                                                                    </div>
                                                                    <div class="form-group text-center">
                                                                        <button class="btn btn-primary text-white" type="submit">Submit</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php elseif(pathinfo($file['file_name'], PATHINFO_EXTENSION) == 'jpg'): ?>
                                        <div class="col-xl-3 col-lg-6">
                                            <div class="card m-1 shadow-none border">
                                                <div class="p-2">
                                                    <div class="row align-items-center">
                                                        <div class="col-auto">
                                                            <div class="avatar-sm">
                                                    <span class="avatar-title bg-light text-secondary rounded">
                                                       <img height="32" width="32" src="/assets/formats/jpg.png" alt="<?= $file['file_name'] ?>">
                                                    </span>
                                                            </div>
                                                        </div>
                                                        <div class="col pl-0">
                                                            <a href="/uploads/posts/<?= $file['file_name'] ?>" class="text-muted font-weight-bold"><?= strlen($file['name']) > 12 ? substr($file['name'],0,12).'...' : $file['name'] ?></a>
                                                            <p class="mb-0 font-13">
                                                                <?php if($file['size'] >= 1073741824):
                                                                    echo number_format($file['size'] / 1073741824, 2) . ' GB';
                                                                    ?>
                                                                <?php elseif($file['size'] >= 1048576):
                                                                    echo number_format($file['size'] / 1048576, 2) . ' MB';
                                                                    ?>
                                                                <?php elseif($file['size'] >= 1024):
                                                                    echo number_format($file['size'] / 1024, 2) . ' KB';
                                                                    ?>
                                                                <?php elseif($file['size'] > 1):
                                                                    echo $file['size'] . ' bytes';
                                                                    ?>
                                                                <?php elseif($file['size'] == 1):
                                                                    echo $file['size'] . ' byte';
                                                                    ?>
                                                                <?php else:
                                                                    echo '0 bytes';
                                                                    ?>
                                                                <?php endif;  ?>
                                                            </p>
                                                        </div>
                                                    </div> <!-- end row -->
                                                </div> <!-- end .p-2-->
                                                <div class="btn-group dropdown">
                                                    <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-xs" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0);" data-target="#shareWithModal_<?=$file['file_id'] ?>" data-toggle="modal"><i class="mdi mdi-share-variant mr-2 text-muted vertical-middle"></i>Share with</a>
                                                        <a class="dropdown-item" href="/uploads/posts/<?= $file['file_name'] ?>" target="_blank"><i class="mdi mdi-download mr-2 text-muted vertical-middle"></i>Download</a>
                                                        <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#removeFileModal_<?=$file['file_id'] ?>"><i class="mdi mdi-delete mr-2 text-muted vertical-middle"></i>Remove</a>
                                                    </div>
                                                </div>
                                                <div id="removeFileModal_<?=$file['file_id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <div class="text-center mt-2 mb-4">
                                                                    <h4 class="text-danger">Are You Sure?</h4>
                                                                </div>
                                                                <p>This action cannot be undone. Are you sure you want to remove <strong><?= $file['name'] ?></strong> ? </p>
                                                                <div class="form-group text-center">
                                                                    <a class="btn btn-danger text-white" href="<?= site_url('/remove-file/'.$file['file_id']) ?>">Yes, proceed.</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="shareWithModal_<?=$file['file_id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <div class="text-center mt-2 mb-4">
                                                                    <h4 class="text-success">Share with</h4>
                                                                </div>
                                                                <form action="<?= site_url('share-file-with') ?>" method="post">
                                                                    <?= csrf_field() ?>
                                                                    <div class="form-group">
                                                                        <label for="">User</label>
                                                                        <select name="user" id="user"
                                                                                class="form-control">
                                                                            <option selected disabled>--Select user--</option>
                                                                            <?php foreach($users as $user): ?>
                                                                                <option value="<?= $user['user_id'] ?>"><?= $user['user_name'] ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                        <input type="hidden" name="file_id" value="<?= $file['file_id'] ?>">
                                                                    </div>
                                                                    <div class="form-group text-center">
                                                                        <button class="btn btn-primary text-white" type="submit">Submit</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->
                                        </div>
                                    <?php elseif(pathinfo($file['file_name'], PATHINFO_EXTENSION) == 'jpeg'): ?>
                                        <div class="col-xl-3 col-lg-6">
                                            <div class="card m-1 shadow-none border">
                                                <div class="p-2">
                                                    <div class="row align-items-center">
                                                        <div class="col-auto">
                                                            <div class="avatar-sm">
                                                    <span class="avatar-title bg-light text-secondary rounded">
                                                        <img height="32" width="32" src="/assets/formats/jpg.png" alt="<?= $file['file_name'] ?>">
                                                    </span>
                                                            </div>
                                                        </div>
                                                        <div class="col pl-0">
                                                            <a href="/uploads/posts/<?= $file['file_name'] ?>" class="text-muted font-weight-bold"><?= strlen($file['name']) > 12 ? substr($file['name'],0,12).'...' : $file['name'] ?></a>
                                                            <p class="mb-0 font-13">
                                                                <?php if($file['size'] >= 1073741824):
                                                                    echo number_format($file['size'] / 1073741824, 2) . ' GB';
                                                                    ?>
                                                                <?php elseif($file['size'] >= 1048576):
                                                                    echo number_format($file['size'] / 1048576, 2) . ' MB';
                                                                    ?>
                                                                <?php elseif($file['size'] >= 1024):
                                                                    echo number_format($file['size'] / 1024, 2) . ' KB';
                                                                    ?>
                                                                <?php elseif($file['size'] > 1):
                                                                    echo $file['size'] . ' bytes';
                                                                    ?>
                                                                <?php elseif($file['size'] == 1):
                                                                    echo $file['size'] . ' byte';
                                                                    ?>
                                                                <?php else:
                                                                    echo '0 bytes';
                                                                    ?>
                                                                <?php endif;  ?>
                                                            </p>
                                                        </div>
                                                    </div> <!-- end row -->
                                                </div> <!-- end .p-2-->
                                                <div class="btn-group dropdown">
                                                    <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-xs" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0);" data-target="#shareWithModal_<?=$file['file_id'] ?>" data-toggle="modal"><i class="mdi mdi-share-variant mr-2 text-muted vertical-middle"></i>Share with</a>
                                                        <a class="dropdown-item" href="/uploads/posts/<?= $file['file_name'] ?>" target="_blank"><i class="mdi mdi-download mr-2 text-muted vertical-middle"></i>Download</a>
                                                        <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#removeFileModal_<?=$file['file_id'] ?>"><i class="mdi mdi-delete mr-2 text-muted vertical-middle"></i>Remove</a>
                                                    </div>
                                                </div>
                                                <div id="removeFileModal_<?=$file['file_id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <div class="text-center mt-2 mb-4">
                                                                    <h4 class="text-danger">Are You Sure?</h4>
                                                                </div>
                                                                <p>This action cannot be undone. Are you sure you want to remove <strong><?= $file['name'] ?></strong> ? </p>
                                                                <div class="form-group text-center">
                                                                    <a class="btn btn-danger text-white" href="<?= site_url('/remove-file/'.$file['file_id']) ?>">Yes, proceed.</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="shareWithModal_<?=$file['file_id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <div class="text-center mt-2 mb-4">
                                                                    <h4 class="text-success">Share with</h4>
                                                                </div>
                                                                <form action="<?= site_url('share-file-with') ?>" method="post">
                                                                    <?= csrf_field() ?>
                                                                    <div class="form-group">
                                                                        <label for="">User</label>
                                                                        <select name="user" id="user"
                                                                                class="form-control">
                                                                            <option selected disabled>--Select user--</option>
                                                                            <?php foreach($users as $user): ?>
                                                                                <option value="<?= $user['user_id'] ?>"><?= $user['user_name'] ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                        <input type="hidden" name="file_id" value="<?= $file['file_id'] ?>">
                                                                    </div>
                                                                    <div class="form-group text-center">
                                                                        <button class="btn btn-primary text-white" type="submit">Submit</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->
                                        </div>

                                    <?php elseif(pathinfo($file['file_name'], PATHINFO_EXTENSION) == 'xlsx'): ?>
                                        <div class="col-xl-3 col-lg-6">
                                            <div class="card m-1 shadow-none border">
                                                <div class="p-2">
                                                    <div class="row align-items-center">
                                                        <div class="col-auto">
                                                            <div class="avatar-sm">
                                                    <span class="avatar-title bg-light text-secondary rounded">
                                                        <img height="32" width="32" src="/assets/formats/xls.png" alt="<?= $file['file_name'] ?>">
                                                    </span>
                                                            </div>
                                                        </div>
                                                        <div class="col pl-0">
                                                            <a href="/uploads/posts/<?= $file['file_name'] ?>" class="text-muted font-weight-bold"><?= strlen($file['name']) > 12 ? substr($file['name'],0,12).'...' : $file['name'] ?></a>
                                                            <p class="mb-0 font-13">
                                                                <?php if($file['size'] >= 1073741824):
                                                                    echo number_format($file['size'] / 1073741824, 2) . ' GB';
                                                                    ?>
                                                                <?php elseif($file['size'] >= 1048576):
                                                                    echo number_format($file['size'] / 1048576, 2) . ' MB';
                                                                    ?>
                                                                <?php elseif($file['size'] >= 1024):
                                                                    echo number_format($file['size'] / 1024, 2) . ' KB';
                                                                    ?>
                                                                <?php elseif($file['size'] > 1):
                                                                    echo $file['size'] . ' bytes';
                                                                    ?>
                                                                <?php elseif($file['size'] == 1):
                                                                    echo $file['size'] . ' byte';
                                                                    ?>
                                                                <?php else:
                                                                    echo '0 bytes';
                                                                    ?>
                                                                <?php endif;  ?>
                                                            </p>
                                                        </div>
                                                    </div> <!-- end row -->
                                                </div> <!-- end .p-2-->
                                                <div class="btn-group dropdown">
                                                    <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-xs" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0);" data-target="#shareWithModal_<?=$file['file_id'] ?>" data-toggle="modal"><i class="mdi mdi-share-variant mr-2 text-muted vertical-middle"></i>Share with</a>
                                                        <a class="dropdown-item" href="/uploads/posts/<?= $file['file_name'] ?>" target="_blank"><i class="mdi mdi-download mr-2 text-muted vertical-middle"></i>Download</a>
                                                        <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#removeFileModal_<?=$file['file_id'] ?>"><i class="mdi mdi-delete mr-2 text-muted vertical-middle"></i>Remove</a>
                                                    </div>
                                                </div>
                                                <div id="removeFileModal_<?=$file['file_id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <div class="text-center mt-2 mb-4">
                                                                    <h4 class="text-danger">Are You Sure?</h4>
                                                                </div>
                                                                <p>This action cannot be undone. Are you sure you want to remove <strong><?= $file['name'] ?></strong> ? </p>
                                                                <div class="form-group text-center">
                                                                    <a class="btn btn-danger text-white" href="<?= site_url('/remove-file/'.$file['file_id']) ?>">Yes, proceed.</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="shareWithModal_<?=$file['file_id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <div class="text-center mt-2 mb-4">
                                                                    <h4 class="text-success">Share with</h4>
                                                                </div>
                                                                <form action="<?= site_url('share-file-with') ?>" method="post">
                                                                    <?= csrf_field() ?>
                                                                    <div class="form-group">
                                                                        <label for="">User</label>
                                                                        <select name="user" id="user"
                                                                                class="form-control">
                                                                            <option selected disabled>--Select user--</option>
                                                                            <?php foreach($users as $user): ?>
                                                                                <option value="<?= $user['user_id'] ?>"><?= $user['user_name'] ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                        <input type="hidden" name="file_id" value="<?= $file['file_id'] ?>">
                                                                    </div>
                                                                    <div class="form-group text-center">
                                                                        <button class="btn btn-primary text-white" type="submit">Submit</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php elseif(pathinfo($file['file_name'], PATHINFO_EXTENSION) == 'pptx'): ?>
                                        <div class="col-xl-3 col-lg-6">
                                            <div class="card m-1 shadow-none border">
                                                <div class="p-2">
                                                    <div class="row align-items-center">
                                                        <div class="col-auto">
                                                            <div class="avatar-sm">
                                                    <span class="avatar-title bg-light text-secondary rounded">
                                                        <img height="32" width="32" src="/assets/formats/ppt.png" alt="<?= $file['file_name'] ?>">
                                                    </span>
                                                            </div>
                                                        </div>
                                                        <div class="col pl-0">
                                                            <a href="/uploads/posts/<?= $file['file_name'] ?>" class="text-muted font-weight-bold"><?= strlen($file['name']) > 12 ? substr($file['name'],0,12).'...' : $file['name'] ?></a>
                                                            <p class="mb-0 font-13">
                                                                <?php if($file['size'] >= 1073741824):
                                                                    echo number_format($file['size'] / 1073741824, 2) . ' GB';
                                                                    ?>
                                                                <?php elseif($file['size'] >= 1048576):
                                                                    echo number_format($file['size'] / 1048576, 2) . ' MB';
                                                                    ?>
                                                                <?php elseif($file['size'] >= 1024):
                                                                    echo number_format($file['size'] / 1024, 2) . ' KB';
                                                                    ?>
                                                                <?php elseif($file['size'] > 1):
                                                                    echo $file['size'] . ' bytes';
                                                                    ?>
                                                                <?php elseif($file['size'] == 1):
                                                                    echo $file['size'] . ' byte';
                                                                    ?>
                                                                <?php else:
                                                                    echo '0 bytes';
                                                                    ?>
                                                                <?php endif;  ?>
                                                            </p>
                                                        </div>
                                                    </div> <!-- end row -->
                                                </div> <!-- end .p-2-->
                                                <div class="btn-group dropdown">
                                                    <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-xs" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0);" data-target="#shareWithModal_<?=$file['file_id'] ?>" data-toggle="modal"><i class="mdi mdi-share-variant mr-2 text-muted vertical-middle"></i>Share with</a>
                                                        <a class="dropdown-item" href="/uploads/posts/<?= $file['file_name'] ?>" target="_blank"><i class="mdi mdi-download mr-2 text-muted vertical-middle"></i>Download</a>
                                                        <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#removeFileModal_<?=$file['file_id'] ?>"><i class="mdi mdi-delete mr-2 text-muted vertical-middle"></i>Remove</a>
                                                    </div>
                                                </div>
                                                <div id="removeFileModal_<?=$file['file_id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <div class="text-center mt-2 mb-4">
                                                                    <h4 class="text-danger">Are You Sure?</h4>
                                                                </div>
                                                                <p>This action cannot be undone. Are you sure you want to remove <strong><?= $file['name'] ?></strong> ? </p>
                                                                <div class="form-group text-center">
                                                                    <a class="btn btn-danger text-white" href="<?= site_url('/remove-file/'.$file['file_id']) ?>">Yes, proceed.</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="shareWithModal_<?=$file['file_id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <div class="text-center mt-2 mb-4">
                                                                    <h4 class="text-success">Share with</h4>
                                                                </div>
                                                                <form action="<?= site_url('share-file-with') ?>" method="post">
                                                                    <?= csrf_field() ?>
                                                                    <div class="form-group">
                                                                        <label for="">User</label>
                                                                        <select name="user" id="user"
                                                                                class="form-control">
                                                                            <option selected disabled>--Select user--</option>
                                                                            <?php foreach($users as $user): ?>
                                                                                <option value="<?= $user['user_id'] ?>"><?= $user['user_name'] ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                        <input type="hidden" name="file_id" value="<?= $file['file_id'] ?>">
                                                                    </div>
                                                                    <div class="form-group text-center">
                                                                        <button class="btn btn-primary text-white" type="submit">Submit</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="col-xl-3 col-lg-6">
                                            <div class="card m-1 shadow-none border">
                                                <div class="p-2">
                                                    <div class="row align-items-center">
                                                        <div class="col-auto">
                                                            <div class="avatar-sm">
                                                    <span class="avatar-title bg-light text-secondary rounded">
                                                        <img height="32" width="32" src="/assets/formats/file.png" alt="<?= $file['file_name'] ?>">
                                                    </span>
                                                            </div>
                                                        </div>
                                                        <div class="col pl-0">
                                                            <a href="/uploads/posts/<?= $file['file_name'] ?>" class="text-muted font-weight-bold"><?= strlen($file['name']) > 12 ? substr($file['name'],0,12).'...' : $file['name'] ?></a>
                                                            <p class="mb-0 font-13">
                                                                <?php if($file['size'] >= 1073741824):
                                                                    echo number_format($file['size'] / 1073741824, 2) . ' GB';
                                                                    ?>
                                                                <?php elseif($file['size'] >= 1048576):
                                                                    echo number_format($file['size'] / 1048576, 2) . ' MB';
                                                                    ?>
                                                                <?php elseif($file['size'] >= 1024):
                                                                    echo number_format($file['size'] / 1024, 2) . ' KB';
                                                                    ?>
                                                                <?php elseif($file['size'] > 1):
                                                                    echo $file['size'] . ' bytes';
                                                                    ?>
                                                                <?php elseif($file['size'] == 1):
                                                                    echo $file['size'] . ' byte';
                                                                    ?>
                                                                <?php else:
                                                                    echo '0 bytes';
                                                                    ?>
                                                                <?php endif;  ?>
                                                            </p>
                                                        </div>
                                                    </div> <!-- end row -->
                                                </div> <!-- end .p-2-->
                                                <div class="btn-group dropdown">
                                                    <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-xs" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0);" data-target="#shareWithModal_<?=$file['file_id'] ?>" data-toggle="modal"><i class="mdi mdi-share-variant mr-2 text-muted vertical-middle"></i>Share with</a>
                                                        <a class="dropdown-item" href="/uploads/posts/<?= $file['file_name'] ?>" target="_blank"><i class="mdi mdi-download mr-2 text-muted vertical-middle"></i>Download</a>
                                                        <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#removeFileModal_<?=$file['file_id'] ?>"><i class="mdi mdi-delete mr-2 text-muted vertical-middle"></i>Remove</a>
                                                    </div>
                                                </div>
                                                <div id="removeFileModal_<?=$file['file_id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <div class="text-center mt-2 mb-4">
                                                                    <h4 class="text-danger">Are You Sure?</h4>
                                                                </div>
                                                                <p>This action cannot be undone. Are you sure you want to remove <strong><?= $file['name'] ?></strong> ? </p>
                                                                <div class="form-group text-center">
                                                                    <a class="btn btn-danger text-white" href="<?= site_url('/remove-file/'.$file['file_id']) ?>">Yes, proceed.</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="shareWithModal_<?=$file['file_id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <div class="text-center mt-2 mb-4">
                                                                    <h4 class="text-success">Share with</h4>
                                                                </div>
                                                                <form action="<?= site_url('share-file-with') ?>" method="post">
                                                                    <?= csrf_field() ?>
                                                                    <div class="form-group">
                                                                        <label for="">User</label>
                                                                        <select name="user" id="user"
                                                                                class="form-control">
                                                                            <option selected disabled>--Select user--</option>
                                                                            <?php foreach($users as $user): ?>
                                                                                <option value="<?= $user['user_id'] ?>"><?= $user['user_name'] ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                        <input type="hidden" name="file_id" value="<?= $file['file_id'] ?>">
                                                                    </div>
                                                                    <div class="form-group text-center">
                                                                        <button class="btn btn-primary text-white" type="submit">Submit</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>
            </div> <!-- end card-box -->

        </div> <!-- end Col -->
    </div><!-- End row -->

</div> <!-- container -->
<?php echo view('pages/gdrive/_modals'); ?>

<?= $this->endSection(); ?>

