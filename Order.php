<?php

require_once "db.php";
session_start();

$connection = @new mysqli($host,$db_user,$db_password,$db_name);

if($connection->connect_errno!=0)
{
    echo "Error : ".$connection->connect_errno;
}else
{
    $name = $_SESSION['user'];
    if($result = @$connection->query("SELECT * FROM customers WHERE Login='$name'"))
    {
        $persondetails = mysqli_fetch_array($result, MYSQLI_ASSOC);      

        $id = $persondetails['CustomerId'];
        $date = date("Y/m/d");
        $Status = "W realizacji";

        $add_order = $connection->query("INSERT into orders(CustomerId,Date,Status) VALUES ('$id','$date','$Status')");
        $order_index = $connection->insert_id;
        

        foreach($_SESSION['ItemsCart'] as $product)
        {
            $product_id = $product['ProductId'];
            $quantity2 = $product['quantity'];
            $add_order_details= $connection->query("INSERT into orderdetails(OrderId,ProductId,QuantityInOrder) VALUES ('$order_index','$product_id','$quantity2')");
        }
    }



   
   


}



?>