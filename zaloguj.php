<?php

    require_once "db.php";
    session_start();

    $connection = @new mysqli($host,$db_user,$db_password,$db_name);

    if($connection->connect_errno!=0)
    {
        echo "Error : ".$connection->connect_errno;
    }else
    {
        $login = $_POST['login'];
        $password = $_POST['password'];

        $_SESSION['user'] = $login;

        $sql = "SELECT * FROM customers WHERE Login='$login' AND Hasło ='$password'";
        

        if($result = @$connection->query($sql))
        {
            $userow = $result->num_rows;
            if($userow>0)
            {
                $userdet = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $_SESSION['userid']=$userdet['CustomerId'];
                echo "udało ci się zalogować";
                header('Location: index.php');
            }else
            {
                echo "Błędny login lub hasło";
            }

        }

        $connection->close();
    }




