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
                    <h5 class="font-18"><?= $message->getSubject() ?></h5>
                    <div class="media mb-3 mt-1">
                        <div class="media-body">
                            <small class="float-right">Date: <?= date('d M, Y', strtotime($message->getDate())) ?? '' ?></small>
                            <h6 class="m-0 font-14">Name: <?= $message->getFrom()[0]->mail ?? '' ?></h6>
                            <small class="text-muted">From: <?= $message->getFrom()[0]->mail?? '' ?></small>
                        </div>
                    </div>

                   <?= $message->getHTMLBody() ?>
                    <p class="mt-2">
                        <?php if($message->getAttachments()->count() > 0): ?>
                        <?php foreach ($message->getAttachments() as $attachment): ?>
                            <?php if(pathinfo("/uploads/email-attachments/".$attachment->name, PATHINFO_EXTENSION) == 'docx'): ?>
                                <a href="<?= "/uploads/email-attachments/".$attachment->name ?>" >
                                    <img height="64" width="64" src="/assets/formats/doc.png" alt="<?= substr($attachment->name,0,10)?>">
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </p>
                </div>

                <div class="clearfix"></div>
            </div>

        </div> <!-- end Col -->

    </div>

    <?= $this->endSection() ?>

    <?= $this->section('extra-scripts') ?>

    <?= $this->endSection() ?>
