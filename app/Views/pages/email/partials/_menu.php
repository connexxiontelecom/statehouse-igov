<div class="inbox-leftbar">

    <a href="<?= site_url('/email') ?>" class="btn btn-danger btn-block waves-effect waves-light">Inbox</a>

    <div class="mail-list mt-4">
        <a href="<?= site_url('/email') ?>" class="text-danger font-weight-bold">
            <i class="dripicons-inbox mr-2"></i>Inbox</a>
        <a href="javascript: void(0);"><i class="dripicons-star mr-2"></i>Starred</a>
        <a href="javascript: void(0);"><i class="dripicons-clock mr-2"></i>Snoozed</a>
        <a href="javascript: void(0);"><i class="dripicons-document mr-2"></i>Draft<span class="badge badge-soft-info float-right ml-2">32</span></a>
        <a href="<?= site_url('/sent-mails') ?>"><i class="dripicons-exit mr-2"></i>Sent Mail</a>
        <a href="javascript: void(0);"><i class="dripicons-trash mr-2"></i>Trash</a>
        <a href="javascript: void(0);"><i class="dripicons-tag mr-2"></i>Important</a>
        <a href="javascript: void(0);"><i class="dripicons-warning mr-2"></i>Spam</a>
    </div>
</div>