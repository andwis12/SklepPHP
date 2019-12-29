<?php

    require_once "db.php";
    session_start();

    $connection = @new mysqli($host,$db_user,$db_password,$db_name);

    if(isset($_REQUEST['id']) && !empty($_REQUEST['id']))
    {
        $id = $_REQUEST['id'];
        if($connection->connect_errno!=0)
        {
            echo "Error : ".$connection->connect_errno;
        }else
        {
            $tel = $_POST['telefon'];

            $query = "SELECT Telefon FROM customerstelephones WHERE Telefon='$tel'";

            if($result = @$connection->query($query))
            {
                $telefonow = $result->num_rows;
                if($telefonow==0)
                {
                    $insert = "INSERT into customerstelephones(CustomerId,Telefon) VALUES ('$id','$tel')";
                    $connection->query($insert);
                }
            }
            
        }
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);