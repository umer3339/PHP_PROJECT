<?php

 class DataBaseAction
{
 private $connection;
 function __construct()
 {
     $this->connection =new PDO("mysql:host=localhost;dbname=test", "root", "");
 }

 function Getconnection()
 {
    return $this->connection;
 }
}

//database_connection.php



?>