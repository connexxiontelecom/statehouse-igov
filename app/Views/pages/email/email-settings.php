<?=
$this->extend('layouts/master')
?>




<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">

        <div class="page-title-box">

            <div class="page-title-right">

                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="<?= site_url('office') ?>">iGov</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Email</a></li>
                    <li class="breadcrumb-item active">Email Settings</li>
                </ol>

            </div>
            <h4 class="page-title">Email Settings</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <?php echo view('pages/email/partials/_menu') ?>
            <div class="inbox-rightbar">

                <div class="mt-4">
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
                    <form action="<?= site_url('/email-settings') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <input type="text" name="host_name" placeholder="Host Name" class="form-control" value="<?= $settings['hostname'] ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" name="port_no" placeholder="Port No." class="form-control" value="<?= $settings['port_no'] ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" name="username" placeholder="Username/Email" class="form-control" value="<?= $settings['username'] ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" placeholder="Password" class="form-control">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary btn-sm float-right" type="submit">Save settings</button>
                        </div>
                    </form>
                </div>

            </div>

            <div class="clearfix"></div>
        </div>

    </div> <!-- end Col -->

</div>

<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>
<script src="/assets/bower_components/tinymce/tinymce.min.js"></script>
<script src="/assets/bower_components/tinymce.js"></script>
<?= $this->endSection() ?>
