<!DOCTYPE HTML>
<?php
    session_start();

    ?>

<html lang="pl">

<head>
    <meta charset="utf-8" />

    

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
            <div class="items">

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
    </div>

<body>
</html>