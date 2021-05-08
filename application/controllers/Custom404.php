<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Custom404 extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this
            ->output
            ->set_status_header('404');
        $data['content'] = 'custom404view'; // View name
        $this
            ->load
            ->view('CustomView404', $data);
    }
}
