<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Inicio';
        $data['subtitle']='Index';
        $data['main_content'] = 'home/inicio';
        return view('dashboard/index', $data);
    }
}
