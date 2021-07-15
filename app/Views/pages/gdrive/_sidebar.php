<div class="inbox-leftbar">
    <div class="btn-group d-block mb-2">
        <button type="button" class="btn btn-success btn-block waves-effect waves-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-plus"></i> Create New</button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="javascript:void(0);" data-target="#folderModal" data-toggle="modal"><i class="mdi mdi-folder-plus-outline mr-1"></i> Folder</a>
            <a class="dropdown-item" href="javascript:void(0);" data-target="#fileUploadModal" data-toggle="modal"><i class="mdi mdi-file-plus-outline mr-1"></i> File</a>
        </div>
    </div>
    <div class="mail-list mt-3">
        <a href="<?= site_url('my-files') ?>" class="list-group-item border-0"><i class="mdi mdi-folder-outline font-18 align-middle mr-2"></i>My Files</a>
        <a href="<?= site_url('shared-with-me') ?>" class="list-group-item border-0"><i class="mdi mdi-share-variant font-18 align-middle mr-2"></i>Shared with me</a>
    </div>

</div>