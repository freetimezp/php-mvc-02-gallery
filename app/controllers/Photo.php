<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied!');

use \Model\Image;

/**
 * Photo class
 */
class Photo
{
	use MainController;

	public function index($id = null)
	{
		$photo = new \Model\Photo;

		$query = " SELECT photos.*, users.username
			FROM photos JOIN users ON users.id = photos.user_id WHERE photos.id = :id LIMIT 1";
		$data['row'] = $photo->query($query, ['id' => $id]);
		if ($data['row']) {
			$data['row'] = $data['row'][0];
		}
		$data['image'] = new Image;
		$data['ses'] = new \Core\Session;

		$this->view('photo', $data);
	}
}
