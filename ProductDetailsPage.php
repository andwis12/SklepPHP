<?php


require_once('db.php');

if(isset($_REQUEST['id']) && !empty($_REQUEST['id']))
{
    $productID = $_REQUEST['id'];

    $connection = @new mysqli($host,$db_user,$db_password,$db_name);

    if($connection->connect_errno!=0)
    {
        echo "Error : ".$connection->connect_errno;
    }else
    {
        if($result = @$connection->query("SELECT * FROM items WHERE ProductId='$productID'"))
        {
            $item = mysqli_fetch_array($result, MYSQLI_ASSOC);

            
        }
    }


}
function display_item_details($Name,$Price,$ProductImage)
{
    $id = $_REQUEST['id'];

    echo 
    "
        <div class=\"row\">
                <div class=\"col-md-8\">
                    <img src=\"$ProductImage\" class=\"img-fluid\">
                </div>

                <div class=\"col-md-4\">
                    <div class=\"item-details\">
                        <h5 > $Name </h5>
                        </br>
                        <h5 >$Price PLN</h5>
                        </br>

                        <button type=\"button\" class=\"btn btn-primary\">Do koszyka</button>
                    </div>
                </div>
        </div>
    
    ";
}

?>

<!DOCTYPE HTML>
<?php
    session_start();
    require_once('Items.php');



?>



<html lang="pl">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="style/Style.css"/>

</head>

<body>
<div id="main_container">
        <div id="top">
            <div id="logo">
                <a href="index.php">
                <img src="logo.png">
                </a>
            </div>
            <div id="search">
                <input type="text" name="box" placeholder="Czego szukasz?" align="center"/>
                <button class="search-box-button">&#128269;</button>
            </div>
            <div class ="shopping-cart">

            </div>
            <div id="login">
                <div>
                    <img src="user-profile.png">
                </div>
                    <?php
                    if(isset($_SESSION['user']))
                    {
                        if(isset($_SESSION['itemscount'])) echo $_SESSION['itemscount'];
                        display_if_user_logged();

                    }else
                    {

                        display_if_user_not_logged();
                    }
                    ?>
            </div>
        </div>




        <nav>
            <ul>
                <li><a href="category.php?category=Laptopy i tablety">Laptopy i tablety</a></li>
                <li><a href="category.php?category=Telefony i GPS">Telefony i GPS</a></li>
                <li><a href="category.php?category=Komputery stacjonarne">Komputery stacjonarne</a></li>
                <li><a href="category.php?category=Podzespoły komputerowe">Podzespoły komputerowe</a></li>
                <li><a href="category.php?category=Akcesoria">Akcesoria</a></li>
            </ul>
        </nav>

        <div class="container">
            <?php
                display_item_details($item['ProductName'],$item['Price'],$item['ProductImage'])
            ?>
                        
        </div>
        <?php
            print_footer();
        ?>
    </div>
    


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>


