<?php

require_once('account.php');
require_once('Items.php');
session_start();

if(isset($_REQUEST['id']) && !empty($_REQUEST['id']))
{
    $id = $_REQUEST['id'];
}

$connection = @new mysqli( "localhost","root","","sklep");
    
$result = $connection->query("SELECT * FROM customers WHERE CustomerId='$id'");

$userdet = mysqli_fetch_array($result, MYSQLI_ASSOC);

$username = $userdet['Login'];
$email = $userdet['email'];
$imie = $userdet['Imię'];
$nazwisko = $userdet['Nazwisko'];


$result = @$connection->query("SELECT * FROM customerstelephones  WHERE CustomerId='$id'");
$result2 =  @$connection->query("SELECT * FROM customeradress  WHERE CustomerId='$id'");



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
            <div id="search">
                <input type="text" name="box" placeholder="Czego szukasz?" align="center"/>
                <button class="search-box-button">&#128269;</button>
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
                            display_if_user_logged();
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
                <li><a href="category.php?category=Telefony i GPS">Telefony i GPS</a></li>
                <li><a href="category.php?category=Komputery stacjonarne">Komputery stacjonarne</a></li>
                <li><a href="category.php?category=Podzespoły komputerowe">Podzespoły komputerowe</a></li>
                <li><a href="category.php?category=Akcesoria">Akcesoria</a></li>
            </ul>
        </nav>
        <div class="user-info">
            <h1> Ustawienia konta </h1>


            <table class="table">
            <tbody>
                <tr>
                    <div class="user-txt">
                        <td>Login : </td>
                        <td><?php echo $username ?></td>
                    </div>
                </tr>
                <tr>
                    <div class="user-txt">
                        <td>E-mail: </td>
                        <td><?php echo $email ?></td>
                    </div>
                </tr>
                <tr>
                    <div class="user-txt">
                        <td>Imie: </td>
                        <td><?php echo $imie ?></td>
                    </div>
                </tr>
                <tr>
                    <div class="user-txt">
                        <td>Nazwisko: </td>
                        <td><?php echo $nazwisko ?></td>
                    </div>
                </tr>
                <tr>
                    <div class="user-txt">
                        <td>Telefony:</td>
                        <td>
                            <label>
                                <select>
                                    <?php
                                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                                        {
                                            echo '<option>'.$row["Telefon"].'</option>';
                                        }
                                    ?>
                                </select>
                            </label>
                        </td>
                        <form id="login" class="input-group" action="AddTelephone.php?id=<?php echo"$id" ?>" method="post">
                         <td>   
                            <input type="text" class="input-field" required name="telefon">
                        </td>
                        <td>
                            <button type="submit" class="submit-btn">Dodaj</button>
                        </td>
                        </form> 
                    </div>
                </tr>
               
            </tbody>
            </table>
            <h4>Adresy</h4>

            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Miasto</th>
                    <th scope="col">Kod Pocztowy</th>
                    <th scope="col">Adres</th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        display_user_adresses($id);
                    ?>
                    <tr>
                            <td>+</td>
                        <form action="AddAdress.php?id=<?php echo"$id" ?>" method="post">
                            <td><input type="text" class="input-field" required name="City"></td>
                            <td><input type="text" class="input-field" required name="PostalCode"></td>
                            <td><input type="text" class="input-field" required name="Adress"></td>
                            <td> <button type="submit" class="submit-btn">Dodaj Adress</button></td>
                        </form>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="user-info">
            <h1>Twoje zamowienia</h1>
            <?php
                display_user_orders();
            ?>


        
        </div>
        <?php print_footer();
        ?>
    </div>
   

    <script>
        var coll = document.getElementsByClassName("collapsible");
        var i;

        for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.display === "block") {
            content.style.display = "none";
            } else {
            content.style.display = "block";
            }
        });
        }
    </script>                                   


    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
