<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied!');

use \Core\Request;
use \Core\Session;
use \Model\Like;
use \Model\Comment;

/**
 * ajax class
 */
class Ajax
{
    use MainController;

    public function index()
    {
        $ses = new Session;
        $req = new Request;
        $like = new Like;
        $comment = new Comment;

        $info['error'] = '';

        if ($req->posted()) {
            $post_data = $req->post();
            $info['data_type'] = $post_data['data_type'];

            if (!$ses->is_logged_in()) {
                $info['error'] = ("You need login to like image..");
                echo json_encode($info);
                die;
            }

            $post_data['user_id'] = $ses->user('id');
            //show($post_data);

            if ($post_data['data_type'] == 'like') {
                if ($row = $like->first(['user_id' => $post_data['user_id'], 'post_id' => $post_data['post_id']])) {
                    $disabled = 1;
                    $info['liked'] = false;

                    if ($row->disabled == 1) {
                        $disabled = 0;
                        $info['liked'] = true;
                    }

                    $like->update($row->id, ['disabled' => $disabled]);
                } else {
                    $post_data['disabled'] = 0;
                    $like->insert($post_data);

                    $info['liked'] = true;
                }

                $info['likes'] = $like->getLikes($post_data['post_id']);
            } else if ($post_data['data_type'] == 'delete-comment') {
                $row = $comment->first(['id' => $post_data['comment_id'], 'user_id' => user('id')]);
                if ($row) {
                    $comment->delete($row->id);
                }
            }
        }

        echo json_encode($info);
        //echo ("ajax controller");
    }
}
