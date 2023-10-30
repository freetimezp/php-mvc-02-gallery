<?php $this->view('includes/header', $data); ?>

<div class="col-md-4 border bg-light shadow p-4 mt-4 mx-auto">
    <h1>Upload Image</h1>

    <form method="post" enctype="multipart/form-data">
        <input class="form-control" value="<?= old_value('title') ?>" name="title" placeHolder="Title"><br>
        <div><small class="text-danger"><?= $photo->getError('title') ?></small></div><br>

        <label class="d-block">
            <div class="input-group mb-3">
                <input onchange="display_image(this.files[0])" name="image" type="file" class="form-control" id="uploadImageInput">
                <label for="uploadImageInput" class="input-group-text">Select Image</label>
            </div>
            <div><small class="text-danger"><?= $photo->getError('image') ?></small></div><br>

            <div>
                <img src="<?= get_image(); ?>" alt="upload" class="js-img-preview img-thumbnail d-block mx-auto" style="cursor: pointer;">
            </div>
        </label>

        <button class="btn btn-primary">Upload</button>
    </form>
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
