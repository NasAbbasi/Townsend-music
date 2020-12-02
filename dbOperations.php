<?php
require_once('config.php');

class dbOperations
{
    private $connection;

    function __construct() {
        $conn = mysqli_connect(dbHost, dbUsername, dbPassword, dbName);
        if($conn->connect_error)
        {
            throw new \Exception("Cannot connect to the database.");
        }
        $this->connection = $conn;
    }

    public function insert($sql){
        if(mysqli_query($this->connection, $sql)){
            return true;
        }else{
            throw new \Exception("Items are not inserted.");
        }
    }

    public function Close(){
        mysqli_close();
    }

}