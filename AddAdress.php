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
            $city = $_POST['City'];
            $postalcode = $_POST['PostalCode'];
            $adress = $_POST['Adress'];

            $query = "SELECT Adress FROM customeradress WHERE Adress='$adress' AND PostalCode='$postalcode' AND Adress='$adress'";

            if($result = @$connection->query($query))
            {
                $adresses = $result->num_rows;
                if($adresses==0)
                {
                    $insert = "INSERT into customeradress(CustomerId,City,PostalCode,Adress) VALUES ('$id','$city','$postalcode','$adress')";
                    $connection->query($insert);
                }
            }
            
        }
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);