<?php





function display_if_user_logged()
{

    $username = $_SESSION['user'];
    $connection = @new mysqli( "localhost","root","","sklep");
    
    $result = $connection->query("SELECT * FROM customers WHERE Login='$username'");

    if (!$result) {
        printf("Error: %s\n", mysqli_error($connection));
        exit();
    }

    $userdet = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $id= $userdet['CustomerId'];

    echo"
           <div>                    
                <div id=\"account\"><a href=\"UserDetails.php?action=userinformations&id=$id\">Moje konto</a></div>
                <div id=\"logout\"><a href=\"logout.php\">Wyloguj</a></div>                                             
           </div >
       ";
}


function display_if_user_not_logged()
{
    echo"
           <div>
                <a href=\"login.php\">                 
                    Zaloguj się
                    </br>
                    Załóż konto
                </a>                                     
           </div >
    
    ";
}


function display_admin_panel()
{
    echo"
    <div>                    
         <div id=\"account\"><a href=\"AdminPanel.php\">Panel</a></div>
         <div id=\"logout\"><a href=\"logout.php\">Wyloguj</a></div>                                             
    </div >
    ";
}

function display_user_orders()
{
    $username = $_SESSION['user'];
    $connection = @new mysqli( "localhost","root","","sklep");
    
    $result = $connection->query("SELECT * FROM customers WHERE Login='$username'");

    if (!$result) {
        printf("Error: %s\n", mysqli_error($connection));
        exit();
    }

    $userdet = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $id= $userdet['CustomerId'];

    if($_SESSION['user']=='admin') $orders_result = $connection->query("SELECT * FROM orders");
    else $orders_result = $connection->query("SELECT * FROM orders WHERE CustomerId='$id'");

    while ($row = mysqli_fetch_array($orders_result, MYSQLI_ASSOC))
    {
            $OrderId = $row['OrderId'];
            $Date = $row['Date'];
            $Status = $row['Status'];


            echo "          
            <button type=\"button\" class=\"collapsible\">$OrderId - $Date - $Status </button>
            <div class=\"content\">";
 
            display_items_in_order($OrderId);
     
           echo" </div>";
    }

}

function display_items_in_order($orderId)
{
    $connection = @new mysqli( "localhost","root","","sklep");

    
    $items_result = $connection->query("SELECT * FROM orderdetails INNER JOIN items ON orderdetails.ProductId=items.ProductId WHERE OrderId='$orderId'");
    echo '<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nazwa produktu</th>
        <th scope="col">Cena</th>
        <th scope="col">ilosc</th>
      </tr>
    </thead>
    
    <tbody>';

    while ($product = mysqli_fetch_array($items_result, MYSQLI_ASSOC))
    {
        $id = $product['ProductId'];
        $image = $product['ProductImage'];
        $productname = $product['ProductName'];
        $price = $product['Price'];
        $quantity = $product['QuantityInOrder'];
       
        echo "
        <tr>
        <td><img src=\"$image\" width=\"50px\" height=\"50px\"/> </td>
        <td>$productname</td>
        <td>$price PLN</td>
        <td>$quantity</td>
        
        </tr>
        ";
        

    }
    echo '</tbody>
    </table>';

}

function display_user_adresses($userId)
{
    $connection = @new mysqli( "localhost","root","","sklep");

    $adress_result = $connection->query("SELECT * FROM customeradress WHERE CustomerId='$userId'");

    $iterator=1;

    if($adress_result->num_rows!=0)
    {
        while ($adress = mysqli_fetch_array($adress_result, MYSQLI_ASSOC))
        {
            $city = $adress['City'];
            $postal_code = $adress['PostalCode'];
            $adress = $adress['Adress'];

            echo "
            <tr>
                <td>$iterator</td>
                <td>$city</td>
                <td>$postal_code</td>
                <td>$adress</td>       
            </tr>
            ";
            $iterator++;

        }
    }

    
}

