<!DOCTYPE HTML>
<?php
    require_once('Items.php');
    require_once('account.php');
    session_start();
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
            

            <div class="properties">
                <div class ="shopping-cart">
                    <div>
                        <img src="shopping-cart.png">
                    </div>
                    <a href="koszyk.php">
                        Koszyk
                    </a>
                </div>
                <div id="login">
                    <div>
                        <img src="user-profile.png">
                    </div>
                        <?php
                        if(isset($_SESSION['user']))
                        {
                            if($_SESSION['user']=='admin') display_admin_panel();
                            else
                            {
                                display_if_user_logged();
                            }
                        }else
                        {
                            display_if_user_not_logged();
                        }
                        ?>
                </div>
            </div>
        </div>
        <nav>
            <ul>
                <li><a href="category.php?category=Laptopy i tablety">Laptopy i tablety</a></li>
                <li><a href="category.php?category=Telefony">Telefony</a></li>
                <li><a href="category.php?category=Telewizory">Telewizory</a></li>
                <li><a href="category.php?category=Podzespoły komputerowe">Podzespoły komputerowe</a></li>
                <li><a href="category.php?category=Akcesoria">Akcesoria</a></li>
            </ul>
        </nav>
        
        
        <div class="wrapper">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <img class="d-block w-100" src="1.jpg" alt="First slide">
                    </div>
                    <div class="carousel-item">
                    <img class="d-block w-100" src="2.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                    <img class="d-block w-100" src="3.jpg" alt="Third slide">
                    </div>
                    <div class="carousel-item">
                    <img class="d-block w-100" src="4.jpg" alt="Third slide">
                    </div>
                    <div class="carousel-item">
                    <img class="d-block w-100" src="5.jpg" alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="items">


            <div class="paragraph">
                Bestsellery
            </div>

            <div class="row text-center py-5 ">


                <?php
                $items = get_items("okazja",null,null,null,null);
                while ($row = mysqli_fetch_array($items, MYSQLI_ASSOC))
                {
                    display_item($row['ProductName'],$row['Price'],$row['ProductImage'],$row['ProductId']);
                }
                ?>

            </div>
        </div>
        <?php print_footer();
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>