<?php 

namespace Controller;

defined('ROOTPATH') OR exit('Access Denied!');

/**
 * Photos class
 */
class Photos
{
	use MainController;

	public function index()
	{

		$this->view('photos');
	}

}
