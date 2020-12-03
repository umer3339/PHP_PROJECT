<?php
include('login.php');
session_start();
session_destroy();
    
    header("Location:sigup.php");
    
   
 

?>