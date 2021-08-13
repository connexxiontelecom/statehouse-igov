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
                    <form id="compose-email" action="<?= site_url('/compose-email') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="subject">To</label>
                                    <input type="text" name="to" placeholder="To: Receiver" class="form-control"  required>
                                    <div class="invalid-feedback">
                                        Please enter a receiver
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="subject">Subject</label>
                                    <input type="text" name="subject" placeholder="Subject" class="form-control"  required>
                                    <div class="invalid-feedback">
                                        Please enter subject
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="snow-editor">Message</label>
                                    <div id="snow-editor" class="form-control body" style="height: 300px;"></div>
                                    <div class="invalid-feedback">
                                        Please enter message.
                                    </div>
                                    <textarea name="message_body" style="display:none" id="hiddenArea"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="fallback">
                                    <input name="file" type="file" />
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-lg-12 offset-lg-12 d-flex justify-content-center">
                                <div class="form-group mt-2">
                                    <button type="submit" class="ladda-button ladda-button-demo btn btn-primary " dir="ltr" data-style="zoom-in"">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

            <div class="clearfix"></div>
        </div>

    </div> <!-- end Col -->

</div>

<?= $this->endSection() ?>

<?= $this->section('extra-scripts'); ?>
    <script>
        $(document).ready(function(){
            var quill = new Quill ();
            $("#compose-email").on("submit",function(){
                $("#hiddenArea").val($("#snow-editor").html());
            })
        });
    </script>
<?= $this->endSection(); ?>