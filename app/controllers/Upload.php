<?php 

namespace Controller;

defined('ROOTPATH') OR exit('Access Denied!');

/**
 * Upload class
 */
class Upload
{
	use MainController;

	public function index()
	{

		$this->view('upload');
	}

}
