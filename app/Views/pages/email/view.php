<?=
$this->extend('layouts/admin')
?>




<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">

        <div class="page-title-box">

            <div class="page-title-right">

                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="<?= site_url('office') ?>">iGov</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Email</a></li>
                    <li class="breadcrumb-item active">Compose Email</li>
                </ol>

            </div>
            <h4 class="page-title">Email</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <!-- Left sidebar -->
            <div class="inbox-leftbar">

                <a href="<?= site_url('/compose-email') ?>" class="btn btn-danger btn-block waves-effect waves-light">Compose</a>

                <div class="mail-list mt-4">
                    <a href="javascript: void(0);" class="text-danger font-weight-bold"><i class="dripicons-inbox mr-2"></i>Inbox<span class="badge badge-soft-danger float-right ml-2">7</span></a>
                    <a href="javascript: void(0);"><i class="dripicons-star mr-2"></i>Starred</a>
                    <a href="javascript: void(0);"><i class="dripicons-clock mr-2"></i>Snoozed</a>
                    <a href="javascript: void(0);"><i class="dripicons-document mr-2"></i>Draft<span class="badge badge-soft-info float-right ml-2">32</span></a>
                    <a href="javascript: void(0);"><i class="dripicons-exit mr-2"></i>Sent Mail</a>
                    <a href="javascript: void(0);"><i class="dripicons-trash mr-2"></i>Trash</a>
                    <a href="javascript: void(0);"><i class="dripicons-tag mr-2"></i>Important</a>
                    <a href="javascript: void(0);"><i class="dripicons-warning mr-2"></i>Spam</a>
                </div>

                <h6 class="mt-4">Labels</h6>

                <div class="list-group b-0 mail-list">
                    <a href="#" class="list-group-item border-0"><span class="mdi mdi-circle text-info mr-2"></span>Web App</a>
                    <a href="#" class="list-group-item border-0"><span class="mdi mdi-circle text-warning mr-2"></span>Recharge</a>
                    <a href="#" class="list-group-item border-0"><span class="mdi mdi-circle text-dark mr-2"></span>Wallet Balance</a>
                    <a href="#" class="list-group-item border-0"><span class="mdi mdi-circle text-primary mr-2"></span>Friends</a>
                    <a href="#" class="list-group-item border-0"><span class="mdi mdi-circle text-success mr-2"></span>Family</a>
                </div>

            </div>
            <!-- End Left sidebar -->

            <div class="inbox-rightbar">

                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-light waves-effect"><i class="mdi mdi-archive font-18"></i></button>
                    <button type="button" class="btn btn-sm btn-light waves-effect"><i class="mdi mdi-alert-octagon font-18"></i></button>
                    <button type="button" class="btn btn-sm btn-light waves-effect"><i class="mdi mdi-delete-variant font-18"></i></button>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-light dropdown-toggle waves-effect" data-toggle="dropdown" aria-expanded="false">
                        <i class="mdi mdi-folder font-18"></i>
                        <i class="mdi mdi-chevron-down"></i>
                    </button>
                    <div class="dropdown-menu">
                        <span class="dropdown-header">Move to</span>
                        <a class="dropdown-item" href="javascript: void(0);">Social</a>
                        <a class="dropdown-item" href="javascript: void(0);">Promotions</a>
                        <a class="dropdown-item" href="javascript: void(0);">Updates</a>
                        <a class="dropdown-item" href="javascript: void(0);">Forums</a>
                    </div>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-light dropdown-toggle waves-effect" data-toggle="dropdown" aria-expanded="false">
                        <i class="mdi mdi-label font-18"></i>
                        <i class="mdi mdi-chevron-down"></i>
                    </button>
                    <div class="dropdown-menu">
                        <span class="dropdown-header">Label as:</span>
                        <a class="dropdown-item" href="javascript: void(0);">Updates</a>
                        <a class="dropdown-item" href="javascript: void(0);">Social</a>
                        <a class="dropdown-item" href="javascript: void(0);">Promotions</a>
                        <a class="dropdown-item" href="javascript: void(0);">Forums</a>
                    </div>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-light dropdown-toggle waves-effect" data-toggle="dropdown" aria-expanded="false">
                        <i class="mdi mdi-dots-horizontal font-18"></i> More
                        <i class="mdi mdi-chevron-down"></i>
                    </button>
                    <div class="dropdown-menu">
                        <span class="dropdown-header">More Option :</span>
                        <a class="dropdown-item" href="javascript: void(0);">Mark as Unread</a>
                        <a class="dropdown-item" href="javascript: void(0);">Add to Tasks</a>
                        <a class="dropdown-item" href="javascript: void(0);">Add Star</a>
                        <a class="dropdown-item" href="javascript: void(0);">Mute</a>
                    </div>
                </div>

                <div class="mt-4">
                    <h5 class="font-18"><?= $subject ?></h5>

                    <hr/>

                    <div class="media mb-3 mt-1">
                        <img class="d-flex mr-2 rounded-circle" src="../assets/images/users/user-2.jpg" alt="placeholder image" height="32">
                        <div class="media-body">
                            <small class="float-right">date</small>
                            <h6 class="m-0 font-14">Steven Smith</h6>
                            <small class="text-muted">From: </small>
                        </div>
                    </div>

                   <?= $body ?>
                    <hr/>


            </div>

            <div class="clearfix"></div>
        </div>

    </div> <!-- end Col -->

</div>

<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>

<?= $this->endSection() ?>
