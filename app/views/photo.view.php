<?php $this->view('includes/header', $data); ?>


<div class="pt-4 text-center">
    <h3>Single Image View</h3>
</div>

<div class="row mb-3 p-1 justify-content-center">

    <?php if (!empty($row)) : ?>
        <div class="col col-sm-12">
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

                <?php if ($ses->is_logged_in() && $ses->user('id') == $row->user_id) : ?>
                    <a href="<?= ROOT; ?>/upload/edit/<?= $row->id; ?>">
                        Edit Image
                    </a>
                    <a href="<?= ROOT; ?>/upload/delete/<?= $row->id; ?>">
                        Delete Image
                    </a>
                <?php endif; ?>

            </div>

            <div class="my-3 border mx-auto row bg-light" style="max-width: 1000px;">
                <h5 class="py-1 d-block">Comments</h5>
                <form method="post">
                    <textarea name="comment" class="form-control my-2" rows="3" placeholder="Write a comment.." required></textarea>
                    <button class="btn btn-primary my-3">Comment</button>
                </form>
                <div class="my-3 js-comments">
                    <?php if (!empty($comments)) : ?>
                        <?php foreach ($comments as $com_row) : ?>
                            <div class="row single-comment border-bottom my-1 mb-2 py-1">
                                <div class="col-sm-2 text-center">
                                    <img src="<?= get_image($com_row->user_row->image ?? ''); ?>" class="img-thumbnail rounded-circle" style="width: 100%; max-width: 100px;">
                                    <div>
                                        <?= ucfirst($com_row->user_row->username) ?? 'Unknown User'; ?>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="text-muted mb-2">
                                        <?= get_date($com_row->date_created); ?>
                                    </div>
                                    <div>
                                        <?= esc($com_row->comment); ?>
                                    </div>

                                    <?php if ($ses->is_logged_in() && $ses->user('id') == $com_row->user_row->id) : ?>
                                        <a href="<?= ROOT; ?>/photo/edit/<?= $com_row->id; ?>">
                                            Edit
                                        </a> |
                                        <a href="<?= ROOT; ?>/photo/delete/<?= $com_row->id; ?>">
                                            Delete
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="alert alert-warning text-center">No comments found</div>
                    <?php endif; ?>
                </div>

                <?= $pager->display(); ?>
            </div>
        </div>
    <?php else : ?>
        <div class="my-4 p-2 text-center">
            Image not found!
        </div>
    <?php endif; ?>

</div>

<?php $this->view('includes/footer', $data);
