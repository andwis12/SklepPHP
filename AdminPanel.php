<?php
require_once('account.php');
require_once('Items.php');
session_start();

$connection = @new mysqli( "localhost","root","","sklep");

if(isset($_POST['add'])) 
{
    unset($_POST['add']);
    $name = $_POST['Name'];
    $quantity = $_POST['quantity'];
    $Photo = $_POST['Photo'];
    $Category = $_POST['Category'];
    $Producent = $_POST['Producent'];
    $Cena = $_POST['Cena'];

    $result = $connection->query("SELECT * FROM items WHERE ProductName='$name'");
    
    if(!$result->num_rows>0)
    {
        $insert = "INSERT into items(ProductName,Quantity,Price,ProductImage,Producent) VALUES ('$name','$quantity','$Cena' , '$Photo' , '$Producent') ";
        $connection->query($insert);
        $order_index = $connection->insert_id;

        $insert_category = "INSERT into productcategories(ProductId,Category) VALUES ('$order_index','$Category')";

        $connection->query($insert_category);
    }
}else if(isset($_POST['delete']))
{
    $name = $_POST['Name'];
    
    $result = $connection->query("SELECT * FROM items WHERE ProductName='$name'");

    if(!$result->num_rows==0)
    {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $productId = $row['ProductId'];

        $connection->query("DELETE FROM items WHERE ProductName='$name'");
        $connection->query("DELETE FROM productcategiores WHERE ProductId='$productId'");
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
                            if($_SESSION['user']=='admin') display_admin_panel();
                            else display_if_user_logged();
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
            <h1>Zamówienia użytkowników</h1>
                <?php
                    display_user_orders();
                ?>
        </div>
        <div class="user-info">
            <h1>Zarządzanie przedmiotami</h1>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Nazwa</th>
                                    <th scope="col">Dostępna ilość</th>
                                    <th scope="col">Zdjecie</th>
                                    <th scope="col">Kategoria</th>
                                    <th scope="col">Producent</th>
                                    <th scope="col">Cena</th>
                                </tr>
                            </thead>
                        <tbody>
                            <tr>
                                <td>+</td>
                                <form action="AdminPanel.php" method="post">
                                    <td><input type="text" class="input-field" required name="Name"></td>
                                    <td><input type="text" class="input-field" required name="quantity"></td>
                                    <td><input type="text" class="input-field" required name="Photo"></td>
                                    <td><input type="text" class="input-field" required name="Category"></td>
                                    <td><input type="text" class="input-field" required name="Producent"></td>
                                    <td><input type="text" class="input-field" required name="Cena"></td>
                                    <td> <button type="submit" name="add" class="submit-btn">Dodaj Przedmiot</button></td>
                                </form>
                            </tr>

                            <tr>
                                <td>-</td>
                                <form action="AdminPanel.php" method="post">
                                    <td><input type="text" class="input-field" required name="Name"></td>
                                    <td> <button type="submit" name="delete" class="submit-btn">Usuń Przedmiot</button></td>
                                </form>
                            </tr>

                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
        <?php
            print_footer();
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
</body>