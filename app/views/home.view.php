<?php $this->view('includes/header', $data); ?>

<?php $this->view('includes/hero', $data); ?>

<div class="p-4">
    <h3>Featured Photos</h3>
</div>

<div class="row my-3 p-4 justify-content-center">

    <?php if (!empty($rows)) : ?>
        <?php foreach ($rows as $row) : ?>
            <?php $this->view('includes/photo-card', ['row' => $row, 'image' => $image]); ?>
        <?php endforeach; ?>
    <?php else : ?>
        <div class="my-4 p-2 text-center">
            No images found!
        </div>
    <?php endif; ?>
</div>

<?php $this->view('includes/footer', $data);
