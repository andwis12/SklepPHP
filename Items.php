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
    
    <div class=\"col-md-3\">
        <div class=\"card_shadow\">
            <div>
                <img src=\"$image\" alt=\"Image1\" class=\"img-fluid card-img-top\">
                <h4 class='text-info'> $name </h4>
                </br>
                <h4 class='text-info'>$prize PLN</h4>
                 </br>
                <input type=\"text\" name=\"quantity\" class=\"form-control\" value=\"1\" >
                
                <input type=\"submit\" class=\"to-cart-button\" value=\"Do koszyka\">
            </div> 
        
        </div>
    </div>
    
    ";

    echo $template;

}