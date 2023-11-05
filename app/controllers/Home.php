<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied!');

use \Model\Photo;
use \Model\Like;
use \Model\Image;

/**
 * home class
 */
class Home
{
	use MainController;

	public function index()
	{
		$data['title'] = 'Home';

		$photo = new Photo;

		$photo->limit = 20;
		$data['rows'] = $photo->findAll();
		$data['image'] = new Image;
		$data['like'] = new Like;

		$this->view('home', $data);
	}
}
