<?php


class mail
{
    private $to;
    private $from;
    private $subject;
    private $message;

    function __construct($data)
    {
        $this->to = "admin@townsend.com"; // if it is supposed to be client email -> $data['email']
        $this->from = "info@townsend.com";
        $this->subject = "New User";
        $this->message = $this->writeMsg($data);
    }

    private function writeMsg($data){
        $text = "Contact Info \n";
        $text .= "User name: " . $data["name"] . "\n";
        $text .= "User message: " . $data["message"] . "\n";
        $text .= "User IP Address: " . $data["ipAddress"] . "\n";
        $text .= "Date: " . $data["date"] . "\n";
        return $text;
    }

    public function send(){
        $headers = 'From: ' . $this->from . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        return mail($this->to, $this->subject, $this->message, $headers);
    }

}