<style>
    .heart svg {
        transition: all .5s ease-in-out;
    }

    .heart:hover svg {
        transform: scale(1.2);
    }
</style>

<div class="col-sm-2 col-md-3 col-lg-2 m-2 py-2 text-center bg-light" style="position: relative;">
    <?php
    $heart_color = $like->userLiked(user('id'), $row->id) ? '#fd0dd8' : '#0d6efd';
    $likes = $like->getLikes($row->id);
    if ($likes == 0) {
        $likes = '';
    }
    ?>
    <div onclick="post.like('<?= $row->id; ?>', this)" style="position: absolute; right: 31px; cursor: pointer;" class="p-2 bg-white heart">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="<?= $heart_color; ?>">
            <path d="m12 5.72c-2.624-4.517-10-3.198-10 2.461 0 3.725 4.345 7.727 9.303 12.54.194.189.446.283.697.283s.503-.094.697-.283c4.977-4.831 9.303-8.814 9.303-12.54 0-5.678-7.396-6.944-10-2.461z" fill-rule="nonzero" />
        </svg>
        <span class="js-likes-count">
            <?= $likes; ?>
        </span>
    </div>

    <a href="<?= ROOT; ?>/photo/<?= $row->id; ?>">
        <img src="<?= get_image($image->getThumbnail($row->image, 250, 250)); ?>" alt="photo" class="img-thumbnail p-0" style="object-fit: cover;">
        <div class="card-header text-center">
            <?= esc($row->title); ?>
        </div>
    </a>
</div>