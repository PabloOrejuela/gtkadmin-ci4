<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Login extends BaseController {

    public function index() {
        
        $data['title'] = '';
        $data['subtitle']='';
        $data['main_content'] = 'home/login';
        return view('dashboard/index_login', $data);

    }
}
