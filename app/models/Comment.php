<?php

namespace Model;

defined('ROOTPATH') or exit('Access Denied!');

/**
 * Comment class
 */
class Comment
{

	use Model;

	protected $table = 'comments';
	protected $primaryKey = 'id';
	protected $loginUniqueColumn = 'id';

	protected $allowedColumns = [

		'post_id',
		'user_id',
		'comment',
		'date_created',
		'date_updated',
	];

	/*****************************
	 * 	rules include:
		required
		alpha
		email
		numeric
		unique
		symbol
		longer_than_8_chars
		alpha_numeric_symbol
		alpha_numeric
		alpha_symbol
	 * 
	 ****************************/
	protected $onInsertValidationRules = [
		'comment' => [
			'required',
		],
	];

	public function getUserDetails(array|bool $rows)
	{
		if ($rows) {
			foreach ($rows as $key => $row) {
				$user_row = $this->get_row("SELECT * FROM users WHERE id = :id LIMIT 1", ['id' => $row->user_id]);

				if ($user_row) {
					$rows[$key]->user_row = $user_row;
				}
			}
		}


		return $rows;
	}

	public function getComments(int $post_id)
	{
		$query = "SELECT count(id) as total FROM comments WHERE post_id = :post_id";
		$row = $this->query($query, ['post_id' => $post_id]);

		return $row[0]->total;
	}
}
