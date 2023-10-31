<div class="col-sm-2 col-md-3 col-lg-2 m-2 py-2 text-center bg-light">
    <a href="<?= ROOT; ?>/photo/<?= $row->id; ?>">
        <img src="<?= get_image($image->getThumbnail($row->image, 250, 250)); ?>" alt="photo" class="img-thumbnail p-0" style="object-fit: cover;">
        <div class="card-header text-center">
            <?= esc($row->title); ?>
        </div>
    </a>
</div>