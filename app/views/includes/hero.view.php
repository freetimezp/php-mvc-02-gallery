<?php $image = new \Model\Image; ?>

<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="<?= get_image($image->getThumbnail('assets/images/hero-1.jpg', 1600, 650)) ?>" class="d-block w-100" alt="hero" style="height: 550px; object-fit:cover;">
        </div>
        <div class="carousel-item active">
            <img src="<?= get_image($image->getThumbnail('assets/images/hero-2.jpg', 1600, 650)) ?>" class="d-block w-100" alt="hero" style="height: 550px; object-fit:cover;">
        </div>
        <div class="carousel-item active">
            <img src="<?= get_image($image->getThumbnail('assets/images/hero-3.jpg', 1600, 650)) ?>" class="d-block w-100" alt="hero" style="height: 550px; object-fit:cover;">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>