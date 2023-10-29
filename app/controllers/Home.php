<?php

class Home extends Controller
{
    public function index($a = '', $b = '', $c = '')
    {
        echo "this is index method" . "<br>";

        $this->view('home');
    }

    public function edit($a = '', $b = '', $c = '')
    {
        echo "this is edit method" . "<br>";

        $this->view('home');
    }
}
