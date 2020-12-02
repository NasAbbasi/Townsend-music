<?php

require_once('Store.php');
require_once("ArrayValidation.php");
require_once("CSRFValidation.php");
require_once("Mail.php");
require_once('vendor/autoload.php');
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    //validate CSRF
    $csrf = new CSRFValidation();
    $csrf->setToken($_POST['token']);
    if($csrf->check()){
        $inputData = makePostArray($_POST);

        //validate posted data
        $validation = new arrayValidation();
        $validation->setArray($inputData);
        $validationResult = $validation->check();

        if(!$validationResult['status']){
            $_SESSION['data'] = $inputData;
            $_SESSION['errors'] = $validationResult['errorMsg'];
            header('Location: form.php');
            exit();
        }else{
            session_destroy();
        }

        //save data in db
        $dbStore = new store($inputData);
        if($dbStore->submit()){
            //send an email
            $mail = new mail($inputData);
            @$mail->send();

            //redirect to another page
            header('Location: page.php');
        }
    }
}

function makePostArray($post) {
    $inputArray = [
        'name' => isset($post["name"]) ? $post["name"] : "",
        'phone' => isset($post["phone"]) ? $post["phone"] : "",
        'email' => isset($post["email"]) ? $post["email"] : "",
        'message' => isset($post["message"]) ? $post["message"] : "",
        'newsletter' => isset($post["newsletter"]) ? $post["newsletter"] : "",
        'ipAddress' => $_SERVER['REMOTE_ADDR'],
        'date' => date('Y-m-d H:i:s'),
    ];

    return $inputArray;
}