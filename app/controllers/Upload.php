<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied!');

use \Core\Request;
use \Core\Session;
use \Model\Photo;

/**
 * Upload class
 */
class Upload
{
	use MainController;

	public function index()
	{
		$data['title'] = "Upload";
		$data['mode'] = "new";

		$req = new Request;
		$ses = new Session;
		$photo = new Photo;

		if (!$ses->is_logged_in()) {
			message("You need to login to edit an image..");
			redirect('login');
		}

		if ($req->posted()) {
			$data = $req->post();

			if ($photo->validate($data)) {
				$data['date_created'] = date("Y-m-d H:i:s");
				$data['user_id'] = $ses->user('id');
				$data['image'] = "";

				$files = $req->files();

				if (!empty($files['image']['name'])) {
					$folder = 'uploads/';
					if (!file_exists($folder)) {
						mkdir($folder, 0777, true);
						file_put_contents($folder . 'index.php', "");
					}

					$allowed = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
					if (in_array($files['image']['type'], $allowed)) {
						$data['image'] = $folder . time() . '_' . $files['image']['name'];
						move_uploaded_file($files['image']['tmp_name'], $data['image']);
						$image = new \Model\Image;
						$image->resize($data['image'], 1000);

						$photo->insert($data);
						redirect('photos');
					} else {
						$photo->errors['image'] = "File type not supported.";
					}
				} else {
					$photo->errors['image'] = "File is required.";
				}
			}
			$data['errors'] = $photo->errors;
		}

		$data['photo'] = $photo;
		$this->view('upload', $data);
	}

	public function edit($id = null)
	{
		$data['title'] = "Edit";
		$data['mode'] = "edit";

		$req = new Request;
		$ses = new Session;
		$photo = new Photo;

		if (!$ses->is_logged_in()) {
			message("You need to login to edit an image..");
			redirect('login');
		}

		$user_id = $ses->user('id');
		$data['row'] = $row = $photo->first(['id' => $id, 'user_id' => $user_id]);

		if ($req->posted() && $row) {
			$data = $req->post();
			$data['id'] = $row->id;

			if ($photo->validate($data)) {
				$data['date_updated'] = date("Y-m-d H:i:s");

				$files = $req->files();

				$folder = 'uploads/';
				if (!file_exists($folder)) {
					mkdir($folder, 0777, true);
					file_put_contents($folder . 'index.php', "");
				}

				$allowed = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];

				if (!empty($files['image']['name'])) {
					if (in_array($files['image']['type'], $allowed)) {
						$data['image'] = $folder . time() . '_' . $files['image']['name'];
						move_uploaded_file($files['image']['tmp_name'], $data['image']);
						$image = new \Model\Image;
						$image->resize($data['image'], 1000);

						if (file_exists($row->image)) {
							unlink($row->image);
						}
					} else {
						$photo->errors['image'] = "File type not supported.";
					}
				}

				if (empty($photo->errors)) {
					$photo->update($row->id, $data);
					redirect('photos');
				}
			}
			$data['errors'] = $photo->errors;
		}

		$data['photo'] = $photo;
		$this->view('upload', $data);
	}

	public function delete($id = null)
	{
		$data['title'] = "Delete";
		$data['mode'] = "delete";

		$req = new Request;
		$ses = new Session;
		$photo = new Photo;

		if (!$ses->is_logged_in()) {
			message("You need to login to delete an image..");
			redirect('login');
		}

		$user_id = $ses->user('id');
		$data['row'] = $row = $photo->first(['id' => $id, 'user_id' => $user_id]);

		if ($req->posted() && $row) {
			show($user_id);
			$data = $req->post();
			$data['id'] = $row->id;

			$photo->delete($row->id);
			if (file_exists($row->image)) {
				unlink($row->image);
			}
			redirect('photos');
		}

		$data['photo'] = $photo;
		$this->view('upload', $data);
	}
}
