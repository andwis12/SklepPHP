<!DOCTYPE HTML>
<?php
    require_once('Items.php');
    require_once('account.php');
    session_start();
?>



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
            <div>
                <form action="search.php" method="POST">
                <input type="text" name="search" placeholder="Czego szukasz?">
                <button type="submit" name="submit-search">Szukaj</button>
                </form>
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
        <div class="items">
            <div class="paragraph">
                Wyniki wyszukiwania
            </div>
            <div class="row text-center py-5 ">
                <?php
                    if(isset($_POST['submit-search']))
                    {
                        $conn = mysqli_connect("localhost","root","","sklep");
                        $search = mysqli_real_escape_string($conn,$_POST['search']);
                        $sql = "SELECT * FROM items WHERE ProductName LIKE '%$search%' OR Producent LIKE '%$search%'";
                        
                        $result = mysqli_query($conn,$sql);
                        $queryResult = mysqli_num_rows($result);

                        if($queryResult>0)
                        {
                            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                            {
                                display_item($row['ProductName'],$row['Price'],$row['ProductImage'],$row['ProductId']);
                            }
                        }else
                        {
                            echo "
                            <div class=\"no-results\">
                                <h1>Brak wyników<h1>
                            </div>";
                        }
                    }else
                    {
                        echo "
                        <div class=\"no-results\">
                            <h1>Brak wyników<h1>
                        </div>";
                    }
                ?>
            </div>
        </div>
    </div>
    <?php print_footer();
        ?>
  

</body>