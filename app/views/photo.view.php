<?php $this->view('includes/header', $data); ?>


<div class="pt-4 text-center">
    <h3>Single Image View</h3>
</div>

<div class="row mb-3 p-1 justify-content-center">

    <?php if (!empty($row)) : ?>
        <div class="col-sm-12 m-2 py-2 text-center bg-light">
            <div class="card-header text-center">
                <h4><?= esc($row->title); ?></h4>
            </div>
            <div class="card-header text-center mb-1">
                <a href="<?= ROOT; ?>/profile/<?= $row->user_id; ?>">
                    Posted by: <i><?= esc($row->username); ?></i>
                </a>
            </div>
            <img src="<?= get_image($row->image); ?>" alt="photo" class="img-thumbnail d-block mx-auto p-0 shadow mb-3" style="object-fit: cover;">
            <a href="<?= ROOT; ?>/photo/<?= $row->id; ?>">
                Delete Image
            </a>
        </div>
    <?php else : ?>
        <div class="my-4 p-2 text-center">
            Image not found!
        </div>
    <?php endif; ?>

</div>

<?php $this->view('includes/footer', $data);
