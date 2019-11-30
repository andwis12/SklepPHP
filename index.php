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
                <img src="logo.png">
            </div>
            <div id="search">
                <input type="text" name="box" placeholder="Czego szukasz?" align="center"/>
                <button class="search-box-button">&#128269;</button>
            </div>
            <div id="login">
                <div>
                    <img src="user-profile.png">
                </div>
                    <div>
                        <?php
                            if(!isset($_SESSION['user']))
                            {
                                echo "Zaloguj się \n Załóż konto";
                                header('login.php');
                            }else
                            {
                                echo "Moje konto \n Wyloguj";
                            }
                        ?>
                    </div >
            </div>
        </div>
        <div id="menu">
            <nav>
                <ul>
                    <li><a href="">Laptopy i tablety</a></li>
                    <li><a href="">Telefony i GPS</a></li>
                    <li><a href="">Komputery stacjonarne</a></li>
                    <li><a href="">Podzespoły komputerowe</a></li>
                    <li><a href="">Akcesoria</a></li>
                </ul>
            </nav>

        </div>
        <div class="items">

            <div class="row text-center py-5">
                <?php
                $items = get_items("okazja");
                while ($row = mysqli_fetch_array($items, MYSQLI_ASSOC))
                {
                    display_item($row['ProductName'],$row['Price'],$row['ProductImage']);

                }
                ?>
            </div>


        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>