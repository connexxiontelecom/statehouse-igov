<?=
$this->extend('layouts/master')
?>




<?= $this->section('content') ?>


<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">

            <div class="page-title-box">

                <div class="page-title-right">

                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?= site_url('office') ?>">iGov</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Email</a></li>
                        <li class="breadcrumb-item active"><?= $mailbox ?? 'Email' ?></li>
                    </ol>

                </div>
                <h4 class="page-title"><?= $mailbox ?? 'Email' ?></h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">

        <!-- Right Sidebar -->
        <div class="col-12">
            <div class="card-box">
                <?php echo view('pages/email/partials/_menu') ?>
                <div class="inbox-rightbar">

                    <div class="mt-3">
                        <ul class="message-list">
                            <?php if($messages->count() > 0): ?>
                                <p><strong>Total: </strong> <?= $total ?></p>
                                <?php foreach($messages as $message): ?>
                                    <li class="unread">
                                        <div class="date col-mail"> <?= date('d M, Y h:i a', strtotime($message->getDate())) ?></div>
                                        <div class="col-mail col-mail-1">
                                            <a href="<?= route_to('read-mail', $message->getUid(), $mailbox ) ?>" class="title" style="left:10px!important;">
                                                <?=  strlen($message->getFrom()[0]->mail) > 20 ? substr($message->getFrom()[0]->mail,0,20).'...' : $message->getFrom()[0]->mail ?>
                                            </a>
                                        </div>
                                        <div class="col-mail col-mail-2">
                                            <a href="<?= route_to('read-mail', $message->getUid(), $mailbox ) ?>" class="subject">
                                                <?= $message->getSubject() ?></span>
                                            </a>
                                            <div class="date"><?= $message->getAttachments()->count() > 0 ? "<i class='ti-files'></i>" : ''; ?></div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-center p-4">There're no mails in <strong><?= $mailbox ?? '' ?></strong> folder</p>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <?php if($messages->count() > 0): ?>
                    <div class="row">
                        <div class="col-7 mt-1">
                          <?= $pagination->render() ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="clearfix"></div>
            </div>

        </div>
    </div>







    <?= $this->endSection() ?>

    <?= $this->section('extra-scripts') ?>


    <?= $this->endSection() ?>
