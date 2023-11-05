<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied!');

use \Core\Request;
use \Core\Session;
use \Model\Like;

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

        $info = [];

        if (!$ses->is_logged_in()) {
            echo ("You need login to like image..");
            die;
        }

        if ($req->posted()) {
            $post_data = $req->post();
            $info['data_type'] = $post_data['data_type'];
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
            }
        }

        echo json_encode($info);
        //echo ("ajax controller");
    }
}
