<?php
require_once('ValidationInterface.php');

class CSRFValidation implements ValidationInterface
{
    private $postedToken;

    public function setToken($postedToken){
        $this->postedToken = $postedToken;
    }

    public function check()
    {
        if(!empty($_SESSION['token'])){
            if(time() >= $_SESSION['token_expire']){
                unset($_SESSION['token']);
                unset($_SESSION['token_expire']);
            }
        }

        if(isset($_SESSION['token']) && $this->postedToken == $_SESSION['token']){
            return true;
        }else{
            throw new \Exception('Invalid or expired token.');
        }
    }

}