<?php

require_once('db.php');
session_start();

if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){
    if($_REQUEST['action'] == 'addToCart' && !empty($_REQUEST['id'])) {
        $productID = $_REQUEST['id'];

        $connection = @new mysqli($host,$db_user,$db_password,$db_name);

        if($connection->connect_errno!=0)
        {
            echo "Error : ".$connection->connect_errno;
        }else
        {
            $result = $connection->query("SELECT * FROM items WHERE ProductId ='$productID'");
            if (!$result) {
                printf("Error: %s\n", mysqli_error($connection));
                exit();
            }


            $item = mysqli_fetch_array($result, MYSQLI_ASSOC);

            if(isset($_SESSION['ItemsCart']))
            {

                if(!in_array($item,$_SESSION['ItemsCart']))
                {
                    $item['quantity']=1;
                    $_SESSION['ItemsCart'][] = $item;
                    
                    if(isset($_SESSION['itemscount']))
                        $_SESSION['itemscount']+=1;
                    else $_SESSION['itemscount']=1;


                    echo $item['ProductName'];
                }
            }else
            {
                $item['quantity']=1;
                $_SESSION['ItemsCart'][] = $item;
                $_SESSION['itemscount']=1;
                
            }
            header('Location: ' . $_SERVER['HTTP_REFERER']);

        }


    }
}
