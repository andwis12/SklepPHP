<?php

require_once('db.php');


function get_items($category)
{


    $connection = @new mysqli("localhost","root","","sklep");

    if($connection->connect_errno!=0)
    {
        echo "Error : ".$connection->connect_errno;
    }else
    {
        if($result = @$connection->query("SELECT * FROM items WHERE ProductCategory='$category'"))
        {
            return $result;
        }
    }

}

function display_item($name,$prize,$image)
{
    $template = "
    
    <div class=\"col-md-3 \">
        <div class=\"card_shadow d-flex flex-column\">
        
         
            
                <img src=\"$image\" alt=\"Image1\" class=\"img-fluid card-img-top\">
                <h5 > $name </h5>
                </br>
                <h5 >$prize PLN</h5>
                 </br>
           
                
                <input type=\"submit\" class=\"to-cart-button mt-auto\" value=\"Do koszyka\">
            
        
        </div>
    </div>
    
    ";

    echo $template;

}