<?php $this->view('includes/header', $data); ?>

<?php $this->view('includes/hero', $data); ?>

<div class="p-4">
    <h3>Featured Photos</h3>
</div>

<div class="row my-3 p-4 justify-content-center">

    <?php if (!empty($rows)) : ?>
        <?php foreach ($rows as $row) : ?>
            <div class="col-sm-3 m-2 py-2 text-center bg-light">
                <a href="#">
                    <img src="<?= get_image($image->getThumbnail($row->image, 250, 250)); ?>" alt="photo" class="img-thumbnail p-0" style="object-fit: cover;">
                    <div class="card-header text-center">
                        <?= esc($row->title); ?>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <div class="my-4 p-2 text-center">
            No images found!
        </div>
    <?php endif; ?>
</div>

<?php $this->view('includes/footer', $data);
