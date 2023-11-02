<?php $this->view('includes/header', $data); ?>


<div class="pt-4 text-center">
    <h3>User Profile</h3>
</div>

<div class="row mb-3 p-1 justify-content-center">

    <?php if (!empty($row)) : ?>
        <div class="col-md-6 m-2 py-2 text-center bg-light">
            <table class="table table-striped table-hover text-start">
                <tr>
                    <th>#</th>
                    <td><?= $row->id; ?></td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td><?= esc($row->username); ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?= esc($row->email); ?></td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td><?= esc($row->role); ?></td>
                </tr>
                <tr>
                    <th>Date Created</th>
                    <td><?= get_date($row->date_created); ?></td>
                </tr>
                <tr>
                    <th>Date Updated</th>
                    <td><?= get_date($row->date_updated); ?></td>
                </tr>
            </table>

            <?php if ($ses->is_logged_in() && $ses->user('id') == $row->id) : ?>
                <a href="<?= ROOT; ?>/profile/edit/<?= $row->id; ?>">
                    Edit Profile
                </a>
                <a href="<?= ROOT; ?>/profile/delete/<?= $row->id; ?>">
                    Delete Profile
                </a>
            <?php endif; ?>

        </div>
    <?php else : ?>
        <div class="my-4 p-2 text-center">
            Image not found!
        </div>
    <?php endif; ?>

</div>

<?php $this->view('includes/footer', $data);
