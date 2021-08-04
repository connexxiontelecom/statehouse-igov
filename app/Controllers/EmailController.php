<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmailSetting;
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
        $this->emailsetting = new EmailSetting();

        /*$this->server = new Server('mail.connexxiongroup.com', '993', '/imap/ssl/validate-cert');
        $this->connection = $this->server->authenticate('joseph@connexxiongroup.com', 'connect@joseph');*/

    }

    public function showEmailSettingsForm(){
        $data = [
            'firstTime'=>$this->session->firstTime,
            'username'=>$this->session->username,
            'settings'=>$this->emailsetting->where('employee_id', $this->session->user_employee_id)->first()
        ];
        return view('pages/email/email-settings', $data);
    }

    public function processEmailSettings(){
        if($this->request->getMethod() == 'post') {
            helper(['form', 'url']);
            $hostname = $this->request->getPost('host_name');
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $port = $this->request->getPost('port_no');
            if(empty($hostname) || empty($username) || empty($password) || empty($port)){
                return redirect()->back()->with("error", "<strong>Whoops!</strong> All the fields are required.");
            }else{
                $data = [
                  'port_no'=>$port,
                  'username'=>$username,
                  'hostname'=>$hostname,
                  'password'=>$password,
                  'employee_id'=>$this->session->user_employee_id
                ];
                $settings = $this->emailsetting->where('employee_id', $this->session->user_employee_id)->first();
                if(empty($settings)){
                    $this->emailsetting->save($data);
                    return redirect()->back()->with("success", "<strong>Success!</strong> Your email settings saved.");
                }else{
                    $this->emailsetting->update($settings['email_settings_id'], $data);
                    return redirect()->back()->with("success", "<strong>Success!</strong> Your changes were saved.");
                }

            }
        }
    }
    public function getEmailSettings(){
        return $this->emailsetting->where('employee_id', $this->session->user_employee_id)->first();
    }
    public function connectToMailServer($mailbox){
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

    public function getMessagesByFlag($mailbox, $flag){
        return imap_search($mailbox, $flag);
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
            $username = $settings['username'];
            $stream = $this->connectToMailServer('INBOX.Sent');
            $check = imap_check($stream);
            //echo "Msg Count before append: ". $check->Nmsgs . "\n";
            imap_append($stream, "{".$settings['hostname'].":".$settings['port_no']."/imap/ssl/validate-cert}INBOX.Sent"
                , "From: ".$username."\r\n"
                . "To: ".$to."\r\n"
                . "Subject: ".$subject."\r\n"
                . "\r\n"
                . " ".strip_tags($message)."\r\n"
            );
            //$check = imap_check($stream);
            //echo "Msg Count after append : ". $check->Nmsgs . "\n";
            imap_close($stream);
            $email = \Config\Services::email();
            $email->setFrom($username, 'Joseph');
            $email->setTo($to);
            $email->setSubject($subject);
            $email->setMessage($message);
            return redirect()->back()->with("success", "<strong>Success!</strong> Mail sent.");
        }else{
            return redirect('/email-settings');
        }


       /* $headers =  'MIME-Version: 1.0' . "\r\n";
        $headers .= 'From: Your name <joseph@connexxiongroup.com>' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        mail(
            'talktojoegee@gmail.com',
            'Hello test',
            'This is a test message actually',
        //$headers
        /* ?string $cc = null,
         ?string $bcc = null,
         ?string $return_path = null
        );*/


     //your message here
        //$email->setCC('treasuredgig@gmail.com');//CC
    // $email->setBCC('joegbudu@gmail.com');// and BCC
     //$filename = '/img/yourPhoto.jpg'; //you can use the App patch
     //$email->attach($filename);

     //$email->send();












     //return redirect()->back()->with("success", "<strong>Success!</strong> Mail sent.");
    }
    public function listMessages($page = 1, $per_page = 25, $sort = null) {
        $limit = ($per_page * $page);
        $start = ($limit - $per_page) + 1;
        $start = ($start < 1) ? 1 : $start;
        $limit = (($limit - $start) != ($per_page - 1)) ? ($start + ($per_page-1)) : $limit;
        $info = imap_check($this->connectToMailServer('INBOX'));
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

            $sorted = imap_sort($this->connectToMailServer('INBOX'), $by, $direction);

            $msgs = array_chunk($sorted, $per_page);
            $msgs = $msgs[$page-1];
        }
        else
            $msgs = range($start, $limit); //just to keep it consistent

        $result = imap_fetch_overview($this->connectToMailServer('INBOX'), implode(',',$msgs), 0);
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
            'total' => imap_num_msg($this->connectToMailServer('INBOX')));
        $return['pages'] = ceil($return['total'] / $per_page);
        return $return;
    }
    public function listMessages2($nStart=0, $nCnt=10) {

        if (!$this->connectToMailServer('INBOX')) {
            return NULL;
        }

        if (($nStart+$nCnt) > $this->getNum()) {
            $nCnt = $this->getNum() - $nStart;
        }

        $aMsgs = imap_fetch_overview($this->connectToMailServer('INBOX'), ($nStart+1).':'.($nStart+$nCnt));
        $aRet = array();
        if ($aMsgs) {
            foreach ($aMsgs as $msg) {
                $aRet[$msg->udate] = $msg;
            }
        }

        krsort($aRet);

        var_dump($aRet);
    }
    public function getNum($mail){
        /*if (!$this->connectToMailServer($mail)) {
            return  redirect()->back()->with("error", "<strong>Whoops!</strong> Couldn't connect to your mail server.");
        }*/
            $mailbox = $this->connectToMailServer($mail);
            return imap_num_msg($mailbox);

    }
	public function index()
	{
	    if($this->connectToMailServer('INBOX')){
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
        $settings = $this->getEmailSettings();
        if(!is_null($settings)){
            $page = 0;
            $uri = new \CodeIgniter\HTTP\URI(current_url(true));
            $params = $uri->getQuery();

            if($params){
                $page = trim($params, 'page=');
            }
            if (!$this->connectToMailServer('INBOX')) {
                return  redirect()->back()->with("error", "<strong>Whoops!</strong> Couldn't connect to your mail server.");
            }else{
                $data = $this->fetchMails($page, 'INBOX');
                return view('pages/email/index', $data);
            }

        }else{
            return redirect()->back()->with("error", "<strong>Whoops!</strong> We need your email settings to retrieve your connect.");
        }

    }


    public function getSentMails(){
        $settings = $this->getEmailSettings();
        if(!is_null($settings)){
            $page = 0;
            $uri = new \CodeIgniter\HTTP\URI(current_url(true));
            $params = $uri->getQuery();

            if($params){
                $page = trim($params, 'page=');
            }
            if (!$this->connectToMailServer('INBOX.Sent')) {
                return  redirect()->back()->with("error", "<strong>Whoops!</strong> Couldn't connect to your mail server.");
            }else{
                $data = $this->fetchMails($page, 'INBOX.Sent');
                return view('pages/email/index', $data);
            }

        }else{
            return redirect()->back()->with("error", "<strong>Whoops!</strong> We need your email settings to retrieve your connect.");
        }

    }
    public function getDraftMails(){
        $settings = $this->getEmailSettings();
        if(!is_null($settings)){
            $page = 0;
            $uri = new \CodeIgniter\HTTP\URI(current_url(true));
            $params = $uri->getQuery();

            if($params){
                $page = trim($params, 'page=');
            }
            if (!$this->connectToMailServer('INBOX.Drafts')) {
                return  redirect()->back()->with("error", "<strong>Whoops!</strong> Couldn't connect to your mail server.");
            }else{
                $data = $this->fetchMails($page, 'INBOX.Drafts');
                return view('pages/email/index', $data);
            }

        }else{
            return redirect()->back()->with("error", "<strong>Whoops!</strong> We need your email settings to retrieve your connect.");
        }

    }
    public function listMessages3($mailbox, $nStart=0, $nCnt=10) {

      /*  if (!$this->connectToMailServer($mailbox)) {
            return  redirect()->back()->with("error", "<strong>Whoops!</strong> Couldn't connect to your mail server.");
        }*/

        if (($nStart+$nCnt) > $this->getNum($mailbox)) {
            $nCnt = $this->getNum($mailbox)-$nStart;
        }

        //$aMsgs = imap_sort($this->connectToMailServer($mailbox), SORTDATE, 1, SE_UID);
        $aMsgs = imap_fetch_overview($this->connectToMailServer($mailbox), ($nStart+1).':'.($nStart+$nCnt));
        $aRet = array();
        if ($aMsgs) {
            foreach ($aMsgs as $msg) {
                $aRet[$msg->udate] = $msg;
            }
        }

        krsort($aRet);

        return $aRet;
    }

    public function getArchivedMails(){
        $settings = $this->getEmailSettings();
        if(!is_null($settings)){
            $page = 0;
            $uri = new \CodeIgniter\HTTP\URI(current_url(true));
            $params = $uri->getQuery();

            if($params){
                $page = trim($params, 'page=');
            }
            if (!$this->connectToMailServer('INBOX.Archive')) {
                return  redirect()->back()->with("error", "<strong>Whoops!</strong> Couldn't connect to your mail server.");
            }else{
                $data = $this->fetchMails($page, 'INBOX.Archive');
                return view('pages/email/index', $data);
            }

        }else{
            return redirect()->back()->with("error", "<strong>Whoops!</strong> We need your email settings to retrieve your connect.");
        }

    }
    public function getTrashedMails(){
        $settings = $this->getEmailSettings();
        if(!is_null($settings)){
            $page = 0;
            $uri = new \CodeIgniter\HTTP\URI(current_url(true));
            $params = $uri->getQuery();

            if($params){
                $page = trim($params, 'page=');
            }
            if (!$this->connectToMailServer('INBOX.Trash')) {
                return  redirect()->back()->with("error", "<strong>Whoops!</strong> Couldn't connect to your mail server.");
            }else{
                $data = $this->fetchMails($page, 'INBOX.Trash');
                return view('pages/email/index', $data);
            }

        }else{
            return redirect()->back()->with("error", "<strong>Whoops!</strong> We need your email settings to retrieve your connect.");
        }

    }
    public function getSpamMails(){
        $settings = $this->getEmailSettings();
        if(!is_null($settings)){
            $page = 0;
            $uri = new \CodeIgniter\HTTP\URI(current_url(true));
            $params = $uri->getQuery();

            if($params){
                $page = trim($params, 'page=');
            }
            if (!$this->connectToMailServer('INBOX.Spam')) {
                return  redirect()->back()->with("error", "<strong>Whoops!</strong> Couldn't connect to your mail server.");
            }else{
                $data = $this->fetchMails($page, 'INBOX.Spam');
                return view('pages/email/index', $data);
            }

        }else{
            return redirect()->back()->with("error", "<strong>Whoops!</strong> We need your email settings to retrieve your connect.");
        }

    }
    public function fetchMails($page, $mailbox){
        /*
        * INBOX
        * INBOX.Sent
        * INBOX.Archive
        * INBOX.Drafts
        * INBOX.Trash
        * INBOX.Junk
        * INBOX.spam
         */
      /*  if (!$this->connectToMailServer($mailbox)) {
            return  redirect()->back()->with("error", "<strong>Whoops!</strong> Couldn't connect to your mail server.");
        }*/

        $records_per_page = 20;
        $pagination = new \Zebra_Pagination();

            $messages = $this->listMessages3($mailbox,$page,20);
            $pagination->records($this->getNum($mailbox));
            $pagination->records_per_page($records_per_page);
            return  [
                'firstTime'=>$this->session->firstTime,
                'username'=>$this->session->username,
                'messages'=>$messages,
                'pagination'=>$pagination,
                'mailbox'=>$mailbox
            ];


    }

	public function viewMail($id, $mailbox){

        $results = imap_fetch_overview($this->connectToMailServer($mailbox), $id, FT_UID);
        if(!empty($results)){
            $messageOverview = array_shift($results);
            if (!isset($messageOverview->date)) {
                $messageOverview->date = null;
            }
            //return var_dump($messageOverview);
            $data = [
                'subject'=>$messageOverview->subject,
                'body'=> $this->get_part($this->connectToMailServer($mailbox), $id, "TEXT/HTML"),//imap_body($this->connectToMailServer($mailbox), $id),
                'date'=>$messageOverview->date,
                //'attachments'=>$message->getAttachments(),
                //'bcc'=>$message->getBcc(),
                //'cc'=>$message->getCc(),
                'from'=>$messageOverview->from,
                'firstTime'=>$this->session->firstTime,
                'username'=>$this->session->username
            ];
            return view('pages/email/view', $data);
        }else{
            return redirect()->back()->with("error", "<strong>Whoops!</strong> Couldn't retrieve mail.");
        }

        /*$connection = $this->openImapStream();
        $mailbox = $connection->getMailbox('INBOX.Sent');

        $message = $mailbox->getMessage($id);
        $data = [
            'subject'=>$message->getSubject(),
            'body'=>$message->getBodyHtml(),
            'date'=>$message->getDate(),
            'attachments'=>$message->getAttachments(),
            'bcc'=>$message->getBcc(),
            'cc'=>$message->getCc(),
            'from'=>$message->getFrom(),
            'firstTime'=>$this->session->firstTime,
            'username'=>$this->session->username
        ];
        return view('pages/email/view', $data);*/

    }
    function get_part($imap, $uid, $mimetype, $structure = false, $partNumber = false)
    {
        if (!$structure) {
            $structure = imap_fetchstructure($imap, $uid, FT_UID);
        }
        if ($structure) {
            if ($mimetype == $this->get_mime_type($structure)) {
                if (!$partNumber) {
                    $partNumber = 1;
                }
                $text = imap_fetchbody($imap, $uid, $partNumber, FT_UID);
                switch ($structure->encoding) {
                    case 3:
                        return imap_base64($text);
                    case 4:
                        return imap_qprint($text);
                    default:
                        return $text;
                }
            }

            // multipart
            if ($structure->type == 1) {
                foreach ($structure->parts as $index => $subStruct) {
                    $prefix = "";
                    if ($partNumber) {
                        $prefix = $partNumber . ".";
                    }
                    $data = $this->get_part($imap, $uid, $mimetype, $subStruct, $prefix . ($index + 1));
                    if ($data) {
                        return $data;
                    }
                }
            }
        }
        return false;
    }
    function get_mime_type($structure)
    {
        $primaryMimetype = ["TEXT", "MULTIPART", "MESSAGE", "APPLICATION", "AUDIO", "IMAGE", "VIDEO", "OTHER"];

        if ($structure->subtype) {
            return $primaryMimetype[(int)$structure->type] . "/" . $structure->subtype;
        }
        return "TEXT/PLAIN";
    }
    public function openImapStream(){
        $settings = $this->getEmailSettings();

        if(!empty($settings)){
            $host = $settings['hostname'];
            $port = $settings['port_no'];
            $username = $settings['username'];
            $password = $settings['password'];
            $server = new Server($host, $port, '/imap/ssl/validate-cert');
            return $server->authenticate($username,$password);
        }else{
            return redirect()->route('/email-settings')->with("error", "<strong>Whoops!</strong> Enter your email settings to proceed.");
        }
    }

}
