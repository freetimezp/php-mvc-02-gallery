<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied!');

use \Model\Photo;
use \Model\Image;

/**
 * Photos class
 */
class Photos
{
	use MainController;

	public function index()
	{
		$photo = new Photo;

		$photo->order_type = 'desc';
		$photo->limit = 32;
		$data['rows'] = $photo->findAll();
		$data['image'] = new Image;

		$this->view('photos', $data);
	}
}
