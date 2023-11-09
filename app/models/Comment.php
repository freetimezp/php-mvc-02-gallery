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
}
