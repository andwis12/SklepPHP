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
            $adress = $_POST['adress'];

            $query = "SELECT Adress FROM customeradress WHERE Adress='$adress'";

            if($result = @$connection->query($query))
            {
                $adresses = $result->num_rows;
                if($adresses==0)
                {
                    $insert = "INSERT into customeradress(CustomerId,Adress) VALUES ('$id','$adress')";
                    $connection->query($insert);
                }
            }
            
        }
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);