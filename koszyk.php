<?php
    session_start();

    $total_price=0;

   

    


    function get_items_from_cart(&$total_price)
    {
        $count = 0;

        if (isset($_POST['update']) && isset($_SESSION['ItemsCart'])) 
        {
            
            foreach ($_POST as $k => $v) 
            {
                if (strpos($k, 'quantity') !== false && is_numeric($v)) {
                    $id_k = str_replace('quantity-', '', $k);
                    $quantity = (int)$v;

                    if($quantity > 0)
                    {
                        $_SESSION['ItemsCart'][$id_k]['quantity']=$quantity;
                    }

                }
                
            }

           
        }

        if(isset($_REQUEST['id']) && !empty($_REQUEST['id']))
        {
            $id = $_REQUEST['id'];
        }

        foreach($_SESSION['ItemsCart'] as $product)
        {
            $id = $product['ProductId'];
            $image = $product['ProductImage'];
            $productname = $product['ProductName'];
            $price = $product['Price'];
            $quantity = $product['Quantity'];
            $quantity2 = $product['quantity'];

            $total_price+= $price*$quantity2;

            $one_price=$price*$quantity2;

            echo "
            <tr>
            <td><img src=\"$image\" width=\"50px\" height=\"50px\"/> </td>
            <td>$productname</td>
            <td>$quantity</td>
            <td><input class=\"form-control\" name=\"quantity-$count\"type=\"text\" value=\"$quantity2\" /></td>
            <td class=\"text-right\">$one_price PLN</td>
            <td class=\"text-right\"><a href=\"DeleteFromCart.php?action=delete&id=$count\">Usuń</td>
            </tr>
            ";

            $count++;

        }



    }
?>





<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style/Style.css"/>
</head>


<body>
<div class="container mb-4">
    <?php 
    if(isset($_SESSION['ItemsCart']))
    {
    ?>
    <div class="row">
        <div class="col-12">
            <form action="koszyk.php" method="post">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"> </th>
                            <th scope="col">Nazwa Produktu</th>
                            <th scope="col">Dostępna ilość</th>
                            <th scope="col" class="text-center">Ilość</th>
                            <th scope="col" class="text-right">Cena</th>
                            <th scope="col" class="text-right"></th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php
                            get_items_from_cart($total_price);
                        ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Cena</td>
                            <td class="text-right"><?php echo "$total_price" ?>PLN</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Dostawa</td>
                            <td class="text-right">8 PLN</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>Razem</strong></td>
                            <td class="text-right"><strong><?php $total_price+=8;
                                                    echo "$total_price" ?>PLN</strong></td>
                        </tr>
                    </tbody>
                </table>
                
            </div>
        </div>
        
        <div class="col mb-2">
            <div class="row">
                <div class="col-sm-12 col-md-4 text-right">
                    <button class="btn btn-lg btn-block btn-success text-uppercase"  type="submit" value="Update" name="update" >Aktualizuj</button>
                </div>
                </form>
                <div class="col-sm-12 col-md-4">
                    <a href="index.php">
                    <button class="btn btn-block btn-light">Wróć na stronę główną</button>
                    </a>
                </div>
                
                <div class="col-sm-12 col-md-4 text-right">
                    <a href=Checkout.php>
                        <button class="btn btn-lg btn-block btn-success text-uppercase">Zamawiam</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <?php
    }else
    {
        echo '
        <div class="empty-b">
            <div class="center">
                <h2>Twoj koszyk jest pusty </h2>
                <div class="col-sm-12  col-md-6">
                        <a href="index.php">
                        <button class="btn btn-block btn-light btn-custom">Wróć na stronę główną</button>
                        </a>
                </div>
            </div>
        </div>
        
        ';
    }
    ?>
</div>
      

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>



</body>




