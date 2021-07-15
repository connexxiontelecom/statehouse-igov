<div id="fileUploadModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h4>Upload Attachment</h4>
                <form method="post" action="<?= site_url('/process-upload') ?>" enctype="multipart/form-data" autocomplete="off">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="">File Name</label>
                        <input type="text" placeholder="File Name" name="filename" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Attachment</label>
                        <input type="file" name="attachments" multiple class="form-control-file">
                        <input type="hidden" name="folder" value="0">
                    </div>
                    <hr>
                    <div class="form-group d-flex justify-content-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary btn-sm">Cancel</button>
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </div>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<div id="folderModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h4>Create New Folder</h4>
                <form method="post" action="<?= site_url('/create-folder') ?>" enctype="multipart/form-data" autocomplete="off">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="">Folder Name</label>
                        <input type="text" placeholder="Folder Name" name="folder_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Parent Folder</label>
                        <select name="parent_folder" id="parent_folder" class="form-control">
                            <option value="0" selected>Default</option>
                            <?php foreach($folders as $folder): ?>
                                <option value="<?= $folder['folder_id'] ?>"><?= $folder['folder'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Visibility</label>
                        <select name="visibility" id="visibility" class="form-control">
                            <option value="1">Private</option>
                            <option value="2">Public</option>
                        </select>
                    </div>
                    <hr>
                    <div class="form-group d-flex justify-content-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary btn-sm">Cancel</button>
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>