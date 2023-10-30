<?php $this->view('includes/header', $data); ?>

<div class="col-md-4 border bg-light shadow p-4 mt-4 mx-auto">
	<?php if (message()) : ?>
		<div class="alert alert-success text-center">
			<?= message('', true); ?>
		</div>
	<?php endif; ?>

	<h1 class="mb-4">Login</h1>

	<form method="post">

		<input class="form-control" value="<?= old_value('email') ?>" name="email" placeHolder="Email"><br>
		<div><small class="text-danger"><?= $user->getError('email') ?></small></div><br>
		<input class="form-control" type="password" value="<?= old_value('password') ?>" name="password" placeHolder="Password"><br>
		<div><small class="text-danger"><?= $user->getError('password') ?></small></div><br>
		<button class="btn btn-primary">Login</button>
	</form>
</div>

<?php $this->view('includes/footer', $data);
