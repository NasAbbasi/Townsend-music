<?php
require_once 'dbOperations.php';

class store{
    private $name;
    private $email;
    private $phone;
    private $message;
    private $newsletter;
    private $ipAddress;

    function __construct($post) {
        $this->name = $post['name'];
        $this->email = $post['email'];
        $this->phone = $post['phone'];
        $this->message = $post['message'];
        $this->newsletter = isset($post['newsletter']) ? $post['newsletter'] : 0;
        $this->ipAddress = $post['ipAddress'];
    }

    public function submit(){
        $sql = "INSERT INTO contacts (name, email, phone, ip_address, message, newsletter)
            VALUES ('".$this->name."','".$this->email."','".$this->phone."', '".$this->ipAddress."', '".$this->message."','".$this->newsletter."')";

        $dbOperation = new dbOperations();
        if($dbOperation->insert($sql)){
            return true;
        }else{
            throw new \Exception("Row not inserted.");
        }
    }
}


