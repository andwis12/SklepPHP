<?php

session_start();

if(isset($_REQUEST['action']) && !empty($_REQUEST['action']))
{
    if($_REQUEST['action'] == 'delete')
    {
        $productID = $_REQUEST['id'];

        unset($_SESSION['ItemsCart'][$productID]);


        $_SESSION['ItemsCart'] = array_values($_SESSION['ItemsCart']); 

        $_SESSION['itemscount']-=1;

    }

}

if($_SESSION['itemscount']==0)
{
    if(isset($_SESSION['ItemsCart']))
    {
        unset($_SESSION['ItemsCart']);
    }
}

header('Location: ' . $_SERVER['HTTP_REFERER']);











