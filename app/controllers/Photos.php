<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied!');

use \Model\Photo;
use \Model\Image;
use \Model\Like;
use \Core\Pager;

/**
 * Photos class
 */
class Photos
{
	use MainController;

	public function index()
	{
		$photo = new Photo;

		$limit = 24;
		$pager = new Pager($limit);
		$offset = $pager->offset;

		$photo->order_type = 'desc';
		$photo->limit = $limit;
		$photo->offset = $offset;

		$data['rows'] = $photo->findAll();
		$data['image'] = new Image;
		$data['like'] = new Like;
		$data['pager'] = $pager;

		$this->view('photos', $data);
	}
}
