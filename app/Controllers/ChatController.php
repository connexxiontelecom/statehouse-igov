<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Chat;

class ChatController extends BaseController
{
    public function __construct()
    {
        if (session()->get('type') == 1): //employee
            echo view('auth/access_denied');
            exit;
        endif;
        $this->chat = new Chat();

    }
	public function index()
	{
		//
	}
}
