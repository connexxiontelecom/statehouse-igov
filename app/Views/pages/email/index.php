<?=
$this->extend('layouts/admin')
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
                        <li class="breadcrumb-item active">Email</li>
                    </ol>

                </div>
                <h4 class="page-title">Email</h4>
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
                            <?php if(count($messages) > 0): ?>
                            <?php foreach($messages as $message): ?>
                            <li class="unread">
                                <div class="col-mail col-mail-1">
                                    <a href="<?= route_to('read-mail', $message->uid, $mailbox ) ?>" class="title"><?=  $message->from ?></a>
                                </div>

                                <div class="col-mail col-mail-2">
                                    <a href="<?= route_to('read-mail', $message->uid,$mailbox ) ?>" class="subject"><?= $message->subject ?></span>
                                    </a>
                                    <div class="date"><?= $message->date ?></div>
                                </div>
                            </li>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <!-- end .mt-4 -->

                    <div class="row">
                        <div class="col-7 mt-1">
                            <?= $pagination->render() ?>
                        </div>
                    </div>
                    <!-- end row-->
                </div>
                <!-- end inbox-rightbar-->

                <div class="clearfix"></div>
            </div> <!-- end card-box -->

        </div> <!-- end Col -->
    </div>







    <?= $this->endSection() ?>

    <?= $this->section('extra-scripts') ?>


    <?= $this->endSection() ?>
