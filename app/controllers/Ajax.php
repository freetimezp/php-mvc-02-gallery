<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied!');

use \Model\Like;
use \Core\Request;
use \Core\Session;

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

        if (!$ses->is_logged_in()) {
            echo ("You need login to like image..");
            die;
        }

        if ($req->posted()) {
            $post_data = $req->post();
            $post_data['user_id'] = $ses->user('id');
            //show($post_data);

            if ($post_data['data_type'] == 'like') {
                if ($row = $like->first(['user_id' => $post_data['user_id'], 'post_id' => $post_data['post_id']])) {

                    if ($row->disabled) {
                        $post_data['disabled'] = 0;
                    } else {
                        $post_data['disabled'] = 1;
                    }

                    $like->update($row->id, $post_data);
                } else {
                    $post_data['disabled'] = 0;
                    $like->insert($post_data);
                }
            }
        }

        //echo ("ajax controller");
    }
}
