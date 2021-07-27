<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class EmailController extends BaseController
{
    public function __construct()
    {
        if (session()->get('type') == 1): //employee
            echo view('auth/access_denied');
            exit;
        endif;



    }
	public function index()
	{
        $mailbox = "{mail.cnx247.com:143/imap/ssl/novalidate-cert}INBOX";
        $username = 'test@cnx247.com';
        $password = 'P@ssword#123';
        $inbox = imap_open($mailbox, $username, $password) or die('Cannot connect to email: ' . imap_last_error());
        return $inbox;

		return view('pages/email/index');
	}
}
