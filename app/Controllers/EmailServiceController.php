<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmailSetting;
use Carbon\Carbon;
use Webklex\PHPIMAP\ClientManager;
use Webklex\PHPIMAP\Client;
use Webklex\PHPIMAP\Folder;

use CodeIgniter\Config\Imap;

class EmailServiceController extends BaseController
{
    public function __construct()
    {
        if (session()->get('type') == 1): //employee
            echo view('auth/access_denied');
            exit;
        endif;
        $this->emailsetting = new EmailSetting();

    }
    public function getEmailSettings(){
        $settings =  $this->emailsetting->where('employee_id', $this->session->user_employee_id)->first();
        if(!empty($settings)){
            return $settings;
        }else{
            return redirect()->to('email-settings');
        }
    }

    public function connectToMailServer(){
        $settings =  $this->emailsetting->where('employee_id', $this->session->user_employee_id)->first();
        if(!is_null($settings)){
            $cm = new ClientManager();
            $client = $cm->make([
                'host'=>$settings['hostname'],
                'port'=>$settings['port_no'],
                'encryption'=>'ssl',
                'validate_cert'=>true,
                'username'=>$settings['username'],
                'password'=>$settings['password'],
                'protocol'=>'imap'
            ]);
            return $client->connect();
        }else{
            return null;
        }
    }
    public function connectToMailServer2($mailbox){
        $settings = $this->getEmailSettings();
        if(!empty($settings)){
            try{
                $host = "{".$settings['hostname'].":".$settings['port_no']."/imap/ssl/validate-cert}".$mailbox."";
                $username = $settings['username'];
                $password = $settings['password'];
                return @imap_open($host, $username, $password);
            }catch(\Exception $exception){
                return redirect()->back()->with("error", "<strong>Whoops!</strong> Couldn't connect to your mailserver.");
            }

        }else{
            return redirect('/email-settings');
        }
    }

	public function getMessagesInFolder($fold){
        $folder = null;
            $connection = $this->connectToMailServer();
            try{
                if(!empty($connection)){
                    $page = 1;
                    $per_page = 10;
                    $uri = new \CodeIgniter\HTTP\URI(current_url(true));
                    $params = $uri->getQuery();
                    if($params){
                        $page = trim($params, 'page=');
                    }
                    $pages = array();
                    $folder = $connection->getFolder($fold);
                    $total  = $folder->query()->all()->count();
                    $messages = $folder->query()->all()->limit($per_page, $page)->get();
                    for($i = 1; $i<= $total; $i++){
                        array_push($pages, $i);
                    }
                    $pagination = new \Zebra_Pagination();
                    $pagination->records(count($pages));
                    $pagination->records_per_page($per_page);
                    $pages = array_slice($pages, (($pagination->get_page() - 1 ) * $per_page), $per_page );
                    $data = [
                        'firstTime'=>$this->session->firstTime,
                        'username'=>$this->session->username,
                        'pagination'=>$pagination,
                        'mailbox'=>$fold,
                        'total'=>$total,
                        'messages'=>$messages
                    ];
                    return view('pages/email/test', $data);
                }else{
                    return redirect()->to('/email-settings')->with("error", "<strong>Whoops!</strong> We couldn't connect to your mail server. Ensure your settings are correct.");

                }
            }catch(\Exception $exception){
                return redirect()->to('/email-settings')->with("error", "<strong>Whoops!</strong> We couldn't connect to your mail server. ".$exception);
            }

    }

    public function readMail($id, $mailbox){
        $folder = null;
        $connection = $this->connectToMailServer();
        if(!empty($connection)){
            $folder = $connection->getFolder($mailbox);
            $message = $folder->query()->getMessage($id);
            $data = [
                'message'=>$message,
                'firstTime'=>$this->session->firstTime,
                'username'=>$this->session->username,
            ];
            if($message->getAttachments()->count() > 0){
                foreach($message->getAttachments() as $attachment){
                    $attachment->save('uploads/email-attachments/');
                    //file_put_contents('uploads/email-attachments/'.$attachment->getFilename(), $attachment->getDecodedContent()) ;
                }
            }

            return view('pages/email/view-test', $data);
        }else{
            return redirect()->back()->with("error", "<strong>Whoops!</strong> We couldn't connect to your mail server.");

        }
    }

    public function composeEmail(){
        $data = [
            'firstTime'=>$this->session->firstTime,
            'username'=>$this->session->username
        ];
        return view('pages/email/compose-email',$data);
    }

    public function processMail(){
        $settings = $this->getEmailSettings();
        $message = $this->request->getPost('message_body');
        $subject = $this->request->getPost('subject');
        $to = $this->request->getPost('to');
        if(!empty($settings)){
            $dmy = date("d-M-Y H:i:s");
            $filename = "filename.pdf";
            $attachment = chunk_split(base64_encode($filestring));
            $boundary = "------=".md5(uniqid(rand()));

            $msg = ("From: Somebody\r\n"
                . "To: test@example.co.uk\r\n"
                . "Date: $dmy\r\n"
                . "Subject: This is the subject\r\n"
                . "MIME-Version: 1.0\r\n"
                . "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n"
                . "\r\n\r\n"
                . "--$boundary\r\n"
                . "Content-Type: text/html;\r\n\tcharset=\"ISO-8859-1\"\r\n"
                . "Content-Transfer-Encoding: 8bit \r\n"
                . "\r\n\r\n"
                . "Hello this is a test\r\n"
                . "\r\n\r\n"
                . "--$boundary\r\n"
                . "Content-Transfer-Encoding: base64\r\n"
                . "Content-Disposition: attachment; filename=\"$filename\"\r\n"
                . "\r\n" . $attachment . "\r\n"
                . "\r\n\r\n\r\n"
                . "--$boundary--\r\n\r\n");

            imap_append($mbox,$authhost,$msg, "\\Draft");

            imap_close($mbox);


            $username = $settings['username'];
            $stream = $this->connectToMailServer2('INBOX.Sent');
            imap_append($stream, "{".$settings['hostname'].":".$settings['port_no']."/imap/ssl/validate-cert}INBOX.Sent"
                , "From: ".$username."\r\n"
                . "To: ".$to."\r\n"
                . "Subject: ".$subject."\r\n"
                . "\r\n"
                . " ".strip_tags($message)."\r\n"
            );
            imap_close($stream);
           /* $email = \Config\Services::email();
            $email->setFrom($username, 'Joseph');
            $email->setTo($to);
            $email->setSubject($subject);
            $email->setMessage($message);*/
            return redirect()->back()->with("success", "<strong>Success!</strong> Mail sent.");
        }else{
            return redirect('/email-settings');
        }
    }
}
