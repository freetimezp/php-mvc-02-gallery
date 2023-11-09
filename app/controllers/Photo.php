<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied!');

use \Model\Image;
use \Model\Comment;

/**
 * Photo class
 */
class Photo
{
	use MainController;

	public function index($id = null)
	{
		$photo = new \Model\Photo;
		$req = new \Core\Request;
		$data['ses'] = $ses = new \Core\Session;

		$query = " SELECT photos.*, users.username
			FROM photos JOIN users ON users.id = photos.user_id WHERE photos.id = :id LIMIT 1";
		$data['row'] = $row = $photo->get_row($query, ['id' => $id]);
		if ($data['row']) {
			$data['title'] = ucfirst($data['row']->title);
		}

		$comment = new Comment;

		if ($req->posted() && $row && $ses->is_logged_in()) {
			$post_data = $req->post();
			//show($post_data);

			if ($comment->validate($post_data)) {
				$post_data['user_id'] = user('id');
				$post_data['post_id'] = $id;
				$post_data['date_created'] = date("Y-m-d H:i:s");
				$comment->insert($post_data);

				redirect('photo/' . $id);
			}

			$data['errors'] = $comment->errors;
		}

		$limit = 10;
		$data['pager'] = new \Core\Pager($limit);
		$offset = $data['pager']->offset;

		$comment->limit = $limit;
		$comment->offset = $offset;
		$data['comments'] = $comment->where(['post_id' => $id]);
		$data['comments'] = $comment->getUserDetails($data['comments']);
		$data['image'] = new Image;

		$this->view('photo', $data);
	}
}
