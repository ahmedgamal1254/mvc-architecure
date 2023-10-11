<?php 

require_once 'app/Libs/mailer/src/PHPMailer.php';
require_once 'app/Libs/mailer/src/Exception.php';
require_once 'app/Libs/mailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

abstract class Email{

    public $mail;

    protected $from="";

    protected $to="";

    protected $title="";

    protected $body=[];

    protected $allbody="";

    protected $to_title="";

    protected $from_title="";

    public function initalize(){
        $this->mail=new PHPMailer(true);

        $this->mail->isSMTP();// Set mailer to use SMTP
        $this->mail->CharSet = "utf-8"; // set charset to utf8
        $this->mail->SMTPAuth = true; // Enable SMTP authentication
        $this->mail->SMTPSecure = SMTPSECURE; // Enable TLS encryption, `ssl` also accepted

        $this->mail->Host = EMAILHOST; // Specify main and backup SMTP servers
        $this->mail->Port = EMAILPORT; // TCP port to connect to

        $this->mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $this->mail->isHTML(true);// Set email format to HTML

        $this->mail->SMTPDebug = 0; // to see exactly what's the issue

        $this->mail->Username = EMAILUSERNAME;
        
        $this->mail->Password = EMAILPASSWORD;    
    }

    public function SendEmail(){
        $this->initalize();

        try {
            // Recipients
            $this->mail->setFrom($this->from, $this->from_title);
            $this->mail->addAddress($this->to, $this->to_title);     // Add a recipient
         
            $this->mail->Subject = $this->title;
            $this->mail->Body    = $this->body;
            $this->mail->AltBody = $this->allbody;
 
            $this->mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }
    }

    public function array_data($data){
        $result='';

        foreach ($data as $key => $value) {
            $result.="{$key} :- {$value} <br>";
        }

        return $result;
    }
}