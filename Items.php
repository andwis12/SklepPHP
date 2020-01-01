<?php

require_once('db.php');
require_once('account.php');


function get_items($category, $filter , $min , $max , $order_by)
{


    $connection = @new mysqli("localhost","root","","sklep");

    if($connection->connect_errno!=0)
    {
        echo "Error : ".$connection->connect_errno;

       
    }else
    {
        $query = "SELECT * FROM items INNER JOIN productcategories ON items.ProductId=productcategories.ProductId WHERE Category='$category'";
        if(isset($filter))
        {
            $query .= "AND Producent='$filter'";
           
            $result = @$connection->query($query);

        }

        if(!$max==null)
        {
            if(isset($min)) $min=0;

            $query .="AND ( Price BETWEEN '$min' AND '$max' )";
        }


        if(!$order_by==null)
        {
            if($order_by=="Price ASC") $query .="ORDER BY Price ASC";
            else $query .="ORDER BY Price DESC";
        }
        
        
        
        $result = @$connection->query($query);
          
        
    }
    return $result;

}

function display_procudents($category)
{
    $connection = @new mysqli("localhost","root","","sklep");


    $result = @$connection->query("SELECT DISTINCT(Producent) FROM items INNER JOIN productcategories ON items.ProductId=productcategories.ProductId WHERE Category='$category'");
     
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        $marka = $row['Producent'];

        echo "
        <div class=\"ml-3 form-check\">
            <input class=\"form-check-input\" type=\"radio\" name=\"marka\" id=\"marka\" value=\"$marka\">
            <label class=\"form-check-label\" for=\"exampleRadios1\">$marka</label>
        </div>
        ";
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


