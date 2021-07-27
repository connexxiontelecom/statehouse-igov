<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Ddeboer\Imap\Server;

class TestController extends BaseController
{
	public function index()
	{
		$server = new Server('mail.connexxiongroup.com', '993', '/imap/ssl/validate-cert');
		
		//print_r($server);
//		$server = new Server(
//			$hostname, // required
//			$port,     // defaults to '993'
//			$flags,    // defaults to '/imap/ssl/validate-cert'
//			$parameters
//		);

// $connection is instance of \Ddeboer\Imap\Connection
		$connection = $server->authenticate('oki-peter@connexxiongroup.com', '');

		//$mailboxes = $connection->getMailboxes();
		$mailboxes = $connection->getMailbox('INBOX');
		$messages = $mailboxes->getMessages();

		foreach ($messages as $message) {

			echo $message->getBodyHtml();    // Content of text/html part, if present

			echo '<br>';
			
			echo '<hr>';
//
//			echo $message->getBodyText();
			// $message is instance of \Ddeboer\Imap\Message
		}
//
//		foreach ($mailboxes as $mailbox) {
//			// Skip container-only mailboxes
//			// @see https://secure.php.net/manual/en/function.imap-getmailboxes.php
//			if ($mailbox->getAttributes() & \LATT_NOSELECT) {
//				continue;
//			}
//
//			// $mailbox is instance of \Ddeboer\Imap\Mailbox
//			printf('Mailbox "%s" has %s messages', $mailbox->getName(), $mailbox->count());
//		}
	}
}
