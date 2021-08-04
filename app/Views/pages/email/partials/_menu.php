<div class="inbox-leftbar">



    <a href="<?= site_url('/compose-email') ?>" class="btn btn-danger btn-block waves-effect waves-light">Compose</a>

    <div class="mail-list mt-4">
        <a href="<?= site_url('/email') ?>" class="text-danger font-weight-bold">
            <i class="dripicons-inbox mr-2"></i>Inbox</a>
        <a href="<?= site_url('/archive-mails') ?>"><i class="dripicons-star mr-2"></i>Archive</a>
        <a href="<?= site_url('/draft-mails') ?>">
            <i class="dripicons-document mr-2"></i>Draft</a>
        <a href="<?= site_url('/sent-mails') ?>"><i class="dripicons-exit mr-2"></i>Sent Mail</a>
        <a href="<?= site_url('/trashed-mails') ?>"><i class="dripicons-trash mr-2"></i>Trash</a>
        <a href="<?= site_url('/spam-mails') ?>"><i class="dripicons-warning mr-2"></i>Spam</a>
    </div>
</div>