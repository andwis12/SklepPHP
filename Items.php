<?php

require_once('db.php');
require_once('account.php');


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

function display_item($name,$prize,$image,$id)
{
    $template = "
    
    <div class=\"col-md-3 \">
        <div class=\"card_shadow d-flex flex-column\">
        
         
            
                <img src=\"$image\" alt=\"Image1\" class=\"img-fluid card-img-top\">
                <h5 > $name </h5>
                </br>
                <h5 >$prize PLN</h5>
                 </br>
           
                
               <a href=\"AddToCart.php?action=addToCart&id=$id\">Do koszyka</a>
            
        
        </div>
    </div>
    
    ";

    echo $template;

}

