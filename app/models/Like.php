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

	public function userLiked(int $user_id, int $post_id)
	{
		if ($this->first(['user_id' => $user_id, 'post_id' => $post_id, 'disabled' => 0])) {
			return true;
		}

		return false;
	}
}
