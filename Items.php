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
        if($result = @$connection->query("SELECT * FROM items INNER JOIN productcategories ON items.ProductId=productcategories.ProductId WHERE Category='$category'"));
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
        
                <a href=\"ProductDetailsPage.php?action=ItemDetails&id=$id\" class=\"linkref\">
                    <img src=\"$image\"  alt=\"Image1\" class=\"img-fluid card-img-top\">
                </a>
                <h5 > $name </h5>
                </br>
                <h5 >$prize PLN</h5>
                 </br>
               
                
               <a href=\"AddToCart.php?action=addToCart&id=$id\" class=\"cart\">Do koszyka</a>
            
        
        </div>
    </div>
    
    ";

    echo $template;

}

function print_footer()
{
    $template="
    <footer class=\"page-footer font-small blue\">

    <div class=\"footer-copyright text-center py-3\">© 2019 Copyright: Andrzej Wisiński
    </div>
 

</footer>";

    echo $template;
}
