<div class="inbox-leftbar">



    <a href="<?= site_url('/compose-email') ?>" class="btn btn-danger btn-block waves-effect waves-light">Compose</a>

    <div class="mail-list mt-4">
        <a href="<?= route_to('messages-in','INBOX') ?>" class="text-danger font-weight-bold">
            <i class="dripicons-inbox mr-2"></i>Inbox</a>
        <a href="<?= route_to('messages-in','Archive') ?>"><i class="dripicons-star mr-2"></i>Archive</a>
        <a href="<?= route_to('messages-in','Drafts') ?>">
            <i class="dripicons-document mr-2"></i>Draft</a>
        <a href="<?= route_to('messages-in','Sent') ?>"><i class="dripicons-exit mr-2"></i>Sent Mail</a>
        <a href="<?= route_to('messages-in','Trash') ?>"><i class="dripicons-trash mr-2"></i>Trash</a>
    </div>
</div>