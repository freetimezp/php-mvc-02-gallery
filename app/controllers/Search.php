<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied!');

use \Model\Photo;
use \Model\Image;
use \Core\Pager;

/**
 * Search class
 */
class Search
{
    use MainController;

    public function index()
    {
        $photo = new Photo;

        $limit = 24;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        $photo->order_type = 'desc';
        $photo->limit = $limit;
        $photo->offset = $offset;

        $find = $_GET['find'] ?? '';
        if (!empty($find)) {
            $find = "%$find%";
            $query = "SELECT * FROM photos WHERE title LIKE :find LIMIT $limit OFFSET $offset";
            $data['rows'] = $photo->query($query, ['find' => $find]);
        }

        $data['image'] = new Image;
        $data['pager'] = $pager;

        $this->view('search', $data);
    }
}
