<?php
session_start();

class Index extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (!isset($_SESSION['username'])) {
            header('Location: signin');
        } else {
            $this->view('home/index', []);
        }
    }
}
