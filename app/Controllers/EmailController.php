<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Ddeboer\Imap\Server;
use Ddeboer\Imap\SearchExpression;
use Ddeboer\Imap\Search\Email\To;
use Ddeboer\Imap\Search\Text\Body;

class EmailController extends BaseController
{
    public $server = null;
    public $connection = null;
    public $host = null;
    public $username = null;
    public $password = null;

    public function __construct()
    {
        if (session()->get('type') == 1): //employee
            echo view('auth/access_denied');
            exit;
        endif;

        /*$this->server = new Server('mail.connexxiongroup.com', '993', '/imap/ssl/validate-cert');
        $this->connection = $this->server->authenticate('joseph@connexxiongroup.com', 'connect@joseph');*/

    }

    public function connectToMailServer(){
        $host = "{mail.connexxiongroup.com:993/imap/ssl/validate-cert}";
        $username = "joseph@connexxiongroup.com";
        $password = "connect@joseph";
        return imap_open($host, $username, $password);
       /* $server = new Server('mail.connexxiongroup.com', '993', '/imap/ssl/validate-cert');
       return $server->authenticate($username,$password);*/
    }

    public function getMessagesByFlag($mailbox, $flag){
        return imap_search($mailbox, $flag);
    }

    public function composeEmail(){
        /*$message = "Please activate the account ".anchor('user/activate/8skskaj2e9','Activate Now','');
        $email = \Config\Services::email();
        $email->setFrom('joseph@connexxiongroup.com', 'your Title Here');
        $email->setTo('talktojoegee@gmail.com');
        $email->setSubject('Your Subject here | tutsmake.com');
        $email->setMessage($message);//your message here

        $email->setCC('treasuredgig@gmail.com');//CC
        $email->setBCC('joegbudu@gmail.com');// and BCC
        //$filename = '/img/yourPhoto.jpg'; //you can use the App patch
        //$email->attach($filename);

        $email->send();
        $email->printDebugger(['headers']);*/


        $data = [
            'firstTime'=>$this->session->firstTime,
            'username'=>$this->session->username
        ];
        return view('pages/email/compose-email',$data);
    }

    public function processMail(){
        $headers =  'MIME-Version: 1.0' . "\r\n";
        $headers .= 'From: Your name <joseph@connexxiongroup.com>' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        mail(
            'talktojoegee@gmail.com',
            'Hello test',
            'This is a test message actually',
        $headers
        /* ?string $cc = null,
         ?string $bcc = null,
         ?string $return_path = null*/
        );
    }
    /**
     * Return array of IMAP messages for pagination
     *
     * @param   int     $page       page number to get
     * @param   int     $per_page   number of results per page
     * @param   array   $sort       array('subject', 'asc') etc
     *
     * @return  mixed   array containing imap_fetch_overview, pages, and total rows if successful, false if an error occurred
     * @author  Raja K
     */
    public function listMessages($page = 1, $per_page = 25, $sort = null) {
        $limit = ($per_page * $page);
        $start = ($limit - $per_page) + 1;
        $start = ($start < 1) ? 1 : $start;
        $limit = (($limit - $start) != ($per_page - 1)) ? ($start + ($per_page-1)) : $limit;
        $info = imap_check($this->connectToMailServer());
        $limit = ($info->Nmsgs < $limit) ? $info->Nmsgs : $limit;
        $sorted = null;
        if(true === is_array($sort)) {
            $sorting = array(
                'direction' => array(   'asc' => 0,
                    'desc' => 1),

                'by'        => array(   'date' => SORTDATE,
                    'arrival' => SORTARRIVAL,
                    'from' => SORTFROM,
                    'subject' => SORTSUBJECT,
                    'size' => SORTSIZE));
            $by = (true === is_int($by = $sorting['by'][$sort[0]]))
                ? $by
                : $sorting['by']['date'];
            $direction = (true === is_int($direction = $sorting['direction'][$sort[1]]))
                ? $direction
                : $sorting['direction']['desc'];

            $sorted = imap_sort($this->connectToMailServer(), $by, $direction);

            $msgs = array_chunk($sorted, $per_page);
            $msgs = $msgs[$page-1];
        }
        else
            $msgs = range($start, $limit); //just to keep it consistent

        $result = imap_fetch_overview($this->connectToMailServer(), implode(',',$msgs), 0);
        if(false === is_array($result)) return false;

        //sorting!
        if(true === is_array($sorted)) {
            $tmp_result = array();
            foreach($result as $r)
                $tmp_result[$r->msgno] = $r;

            $result = array();
            foreach($msgs as $msgno) {
                $result[] = $tmp_result[$msgno];
            }
        }

        return $result;
        $return = array('res' => $result,
            'start' => $start,
            'limit' => $limit,
            'sorting' => array('by' => $sort[0], 'direction' => $sort[1]),
            'total' => imap_num_msg($this->connectToMailServer()));
        $return['pages'] = ceil($return['total'] / $per_page);
        return $return;
    }
    public function listMessages2($nStart=0, $nCnt=10) {

        if (!$this->connectToMailServer()) {
            return NULL;
        }

        if (($nStart+$nCnt) > $this->getNum()) {
            $nCnt = $this->getNum() - $nStart;
        }

        $aMsgs = imap_fetch_overview($this->connectToMailServer(), ($nStart+1).':'.($nStart+$nCnt));
        $aRet = array();
        if ($aMsgs) {
            foreach ($aMsgs as $msg) {
                $aRet[$msg->udate] = $msg;
            }
        }

        krsort($aRet);

        var_dump($aRet);
    }
    public function getNum(){$mailbox = $this->connectToMailServer(); return imap_num_msg($mailbox);}
	public function index()
	{
	    if($this->connectToMailServer()){
	       /* $mailboxes = $this->connectToMailServer()->getMailboxes();
	        $inbox = $this->connectToMailServer()->getMailbox('INBOX');
	        //$messages = (array) $inbox->getMessages();
	        $messages = $inbox->getMessages();
	        $messages = array($messages);
            $records_per_page = 10;*/

// include the pagination class


// instantiate the pagination object
            //$pagination = new \Zebra_Pagination();

// the number of total records is the number of records in the array
            //$pagination->records(count($messages));

// records per page
            //$pagination->records_per_page($records_per_page);

// here's the magic: we need to display *only* the records for the current page
           /* $messages = array_slice(
                $messages,
                (($pagination->get_page() - 1) * $records_per_page),
                $records_per_page
            );*/


//print_r($messages);


//            $messages_array = [];
//
//	        foreach($messages as $message){
//	            //echo $message->getId()."<br/> \n";
//	            //echo $message->getSubject()."<br/> \n";
//	            array_push($messages_array, $message->getSubject());
//	            array_push($messages_array, $message->getId());
//	            array_push($messages_array, $message->getDate());
//	            array_push($messages_array, $message->getBodyText());
//            }
//	       echo print_r($messages_array);
	        //return gettype($messages);
	        /*foreach($mailboxes as $mailbox){
                if($mailbox->getAttributes() & LATT_NOSELECT){
                    continue;
                }
                printf('Mailbox "%s" has %s messages ', $mailbox->getName(), $mailbox->count());
            }*/
        }else{
	        echo "<strong>Whoops!</strong> We couldn't establish connection to your mailserver.";
        }

	}

	public function test(){
        //$messages = $this->listMessages(1,25);
        /*foreach($messages as $message){
            echo $message->subject. "<br/>\n";
        }*/
        //$start = $_GET['page'];
        $page = 0;
        $uri = new \CodeIgniter\HTTP\URI(current_url(true));
        $params = $uri->getQuery();

//     echo $params;
        if($params){
            $page = trim($params, 'page=');
            //echo $page;
        }
        $records_per_page = 20;
        $pagination = new \Zebra_Pagination();
        $pagination->records($this->getNum());
        $pagination->records_per_page($records_per_page);
        $messages = $this->listMessages3($page,20);
        /*foreach($messages as $message){
            echo $message->subject. "<br/>\n";
        }*/
        $data = [
            'firstTime'=>$this->session->firstTime,
            'username'=>$this->session->username,
            'messages'=>$messages,
            'pagination'=>$pagination
        ];
        return view('pages/email/index', $data);
    }

    public function listMessages3($nStart=0, $nCnt=10) {

        if (!$this->connectToMailServer()) {
            return NULL;
        }

        if (($nStart+$nCnt) > $this->getNum()) {
            $nCnt = $this->getNum()-$nStart;
        }

        $aMsgs = imap_fetch_overview($this->connectToMailServer(), ($nStart+1).':'.($nStart+$nCnt));
        $aRet = array();
        if ($aMsgs) {
            foreach ($aMsgs as $msg) {
                $aRet[$msg->udate] = $msg;
            }
        }

        krsort($aRet);

        return $aRet;
    }

	public function viewMail($id){
        $host = "{mail.connexxiongroup.com:993/imap/ssl/validate-cert}";
        $username = "joseph@connexxiongroup.com";
        $password = "connect@joseph";
        //return imap_open($host, $username, $password);
         $server = new Server('mail.connexxiongroup.com', '993', '/imap/ssl/validate-cert');
        $connection =  $server->authenticate($username,$password);

        //$message = imap_body($this->connectToMailServer(), $id); // imap_search($this->server->get, $id);
        $mailbox = $connection->getMailbox('INBOX');
        $message = $mailbox->getMessage($id);
        $data = [
            'subject'=>$message->getSubject(),
            'body'=>$message->getBodyText(),
            'date'=>$message->getDate(),
            'attachments'=>$message->getAttachments(),
            'bcc'=>$message->getBcc(),
            'cc'=>$message->getCc(),
            'from'=>$message->getFrom(),
            'firstTime'=>$this->session->firstTime,
            'username'=>$this->session->username
        ];
        return view('pages/email/view', $data);

    }

}
