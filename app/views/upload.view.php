<?php $this->view('includes/header', $data); ?>

<div class="col-md-4 border bg-light shadow p-4 mt-4 mx-auto">
    <h1><?= $title; ?> Image</h1>

    <?php if ($mode == 'new' || (($mode == 'edit' || $mode == 'delete') && $row)) : ?>
        <?php if ($mode == 'delete') : ?>
            <div class="alert alert-danger text-center">
                Are you sure you want to delete this image?
            </div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <input class="form-control" value="<?= old_value('title', $row->title ?? '') ?>" name="title" placeHolder="Title" <?= $mode == 'delete' ? 'disabled' : ''; ?>><br>
            <div><small class="text-danger"><?= $photo->getError('title') ?></small></div><br>

            <label class="d-block">

                <?php if ($mode != 'delete') : ?>
                    <div class="input-group mb-3">
                        <input onchange="display_image(this.files[0])" name="image" type="file" class="form-control" id="uploadImageInput">
                        <label for="uploadImageInput" class="input-group-text">Select Image</label>
                    </div>
                    <div><small class="text-danger"><?= $photo->getError('image') ?></small></div><br>
                <?php endif; ?>

                <div class="mb-3">
                    <img src="<?= get_image($row->image ?? ''); ?>" alt="upload" class="js-img-preview img-thumbnail d-block mx-auto" style="cursor: pointer;">
                </div>
            </label>

            <?php if ($mode == 'delete') : ?>
                <button class="btn btn-danger">Delete</button>
            <?php else : ?>
                <button class="btn btn-primary">Save</button>
            <?php endif; ?>
        </form>
    <?php else : ?>
        <div class="p-2 text-center">
            No image available
        </div>
    <?php endif; ?>

</div>

<script type="text/javascript">
    function display_image(file) {
        let allowed = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
        if (!allowed.includes(file.type)) {
            alert("File type not supported. Try jpg, jpeg, png, webp, gif.")
            return;
        }

        document.querySelector('.js-img-preview').src = URL.createObjectURL(file);
    }
</script>

<?php $this->view('includes/footer', $data);
