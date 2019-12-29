<?php

require_once "db.php";
session_start();

$connection = @new mysqli($host,$db_user,$db_password,$db_name);

if($connection->connect_errno!=0)
{
    echo "Error : ".$connection->connect_errno;
}else
{

    $date = date("Y/m/d");
    echo $date;

}



?>