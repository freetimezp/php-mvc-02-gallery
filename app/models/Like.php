<?php

namespace Model;

defined('ROOTPATH') or exit('Access Denied!');

/**
 * Like class
 */
class Like
{

	use Model;

	protected $table = 'likes';
	protected $primaryKey = 'id';
	protected $loginUniqueColumn = 'id';

	protected $allowedColumns = [
		'user_id',
		'post_id',
		'disabled',
	];
}
