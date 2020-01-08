<?php

    require_once "db.php";
    session_start();

    $connection = @new mysqli($host,$db_user,$db_password,$db_name);

    if($connection->connect_errno!=0)
    {
    echo "Error : ".$connection->connect_errno;
    }else
    {
        $username = $_POST['login'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];


        $query = $connection->query("SELECT * FROM customers WHERE Login='$username' ");

        if(!$query)
        {
            trigger_error('Invalid query: ' . $connection->error);
        }


        if(!$query->num_rows>0)
        {
            $password_hash = password_hash($password,PASSWORD_DEFAULT);

            $add = $connection->query("INSERT into customers(Login,email,Hasło,Imię,Nazwisko) VALUES ('$username','$email','$password_hash','$name','$surname')");
            header("Location:login.php");

        }else
        {
            $_SESSION['blad_rejestracji'] = true;
        }

        echo $password;
    }