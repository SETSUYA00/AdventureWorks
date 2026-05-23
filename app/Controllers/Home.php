<?php
namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('templates/header', ['title' => 'Dashboard'])
             . view('dashboard')
             . view('templates/footer');
    }
}