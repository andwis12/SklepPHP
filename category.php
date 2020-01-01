<!DOCTYPE HTML>
<?php

require_once('Items.php');
require_once('account.php');
session_start();



if(isset($_REQUEST['category']) && !empty($_REQUEST['category']))
{
    $productsCategory = $_REQUEST['category'];
}

$filter=null;
$min=null;
$max=null;
$order_by=null;

if(isset($_POST['Filtruj']))
{
    if(isset($_POST['marka']))
        $filter=$_POST['marka'];
    if(isset($_POST['min']))
        $min=0;
    if(isset($_POST['max']))
        $max=$_POST['max'];
    
    if(isset($_POST['sortuj']))
        $order_by = $_POST['sortuj'];
    
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
                <li><a href="category.php?category=Telefony">Telefony</a></li>
                <li><a href="category.php?category=Telewizory">Telewizory</a></li>
                <li><a href="category.php?category=Podzespoły komputerowe">Podzespoły komputerowe</a></li>
                <li><a href="category.php?category=Akcesoria">Akcesoria</a></li>
            </ul>
        </nav>
        <div class="box">
  <div class="box__content">
    <div class="box__title">Filtruj</div>
    <div class="box__description">
      
	  <div  id="searchbar"> 
        <?php
            $actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
        ?>
        <form class="mt-2 mb-2 ml-2 mr-2" action="category.php?category=<?php echo"$productsCategory";?>" method="POST" id="searchForm" />
            <input class="form-control" type="text" name ="q" id="searchBox" placeholder="Szukaj" autocomplete= "off" onMouseDown="active();" onBlue="inactive();" />
           	
			<div id="options">
				  <label class="ml-3 form-check-label">MARKA:</label>
                  <?php
                        display_procudents($productsCategory);
                  ?>
			</div>
			  
                <div id="options">
                    <label class="ml-3 mb-2 form-check-label">CENA:</label>
                    <div class="form-check">
                    <label>Od:</label>
                    <input  id="inputprice" type="text" class="mb-3" name ="min"  placeholder="min"  />
                    <label>Do:</label>
                    <input  id="inputprice" type="text" class=" mb-3 " name ="max"  placeholder="max"  />
                    </div>
                </div>
                <div id="options">
                    <label class="ml-3  form-check-label">Sortuj:</label>
                
                    <div class="ml-3 form-check">
                        <input class="form-check-input" type="radio" name="sortuj" id="sortuj" value="Price ASC">
                        <label class="form-check-label" for="exampleRadios1">Cena rosnąco</label>
                    </div>


                    <div class="ml-3 form-check">
                        <input class="form-check-input" type="radio" name="sortuj" id="sortuj" value="Price DESC">
                        <label class="form-check-label" for="exampleRadios2">Cena malejąco</label>
                    </div>
                    
                    <div class="ml-3 form-check">
                        <input class="form-check-input" type="radio" name="sortuj" id="sortuj" value="ProductName ASC">
                        <label class="form-check-label" for="exampleRadios2">Nazwa A-Z</label>
                    </div>
                    
                    <div class="ml-3 form-check">
                        <input class="form-check-input" type="radio" name="sortuj" id="sortuj" value="ProductName DESC">
                        <label class="form-check-label" for="exampleRadios2">Nazwa Z-A</label>
                    </div>
                </div>
                <input  id="dropdownMenuButton" class="mt-2 btn btn-outline-success" type="submit" id="searchButton" name="Filtruj" value="Filtruj"/>
        </form>
        
</div>	
	  
      </div>
    </div>
  </div>
  

        
        <div class="items">


            <div class="paragraph">
                <?php
                    echo $productsCategory;
                ?>
            </div>

            <div class="row text-center py-5 ">
                <?php
                    $items = get_items($productsCategory,$filter,$min,$max,$order_by);
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