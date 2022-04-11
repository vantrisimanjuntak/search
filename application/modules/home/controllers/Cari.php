<?php class Cari extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    function index()
    {
        $data['title'] = 'Pencarian';
        $this->load->view('home_view', $data);
    }
}
