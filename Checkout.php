
<?php

    include_once('account.php');
    require_once('Items.php');
    session_start();
    
    $id = $_SESSION['userid'];

    
    $connection = @new mysqli( "localhost","root","","sklep");
        
    $result = $connection->query("SELECT * FROM customers WHERE CustomerId='$id'");
    
    $userdet = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
    $username = $userdet['Login'];
    $email = $userdet['email'];
    $imie = $userdet['Imię'];
    $nazwisko = $userdet['Nazwisko'];
    
    
    $result = @$connection->query("SELECT * FROM customerstelephones  WHERE CustomerId='$id'");
    $result2 =  @$connection->query("SELECT * FROM customeradress  WHERE CustomerId='$id'");
    $useradress = mysqli_fetch_array($result2, MYSQLI_ASSOC);
    
    
    
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

    <div class="checkout-container">
    <div class="crazy-margin">
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Billing address</h4>
      <form class="needs-validation" action="Order.php" novalidate>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">Imię</label>
            <input type="text" class="form-control" id="firstName" placeholder="<?php echo $imie; ?>" value="" required>
            <div class="invalid-feedback">
              Valid first name is required.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Nazwisko</label>
            <input type="text" class="form-control" id="lastName" placeholder="<?php echo $nazwisko;?>" value="" required>
            <div class="invalid-feedback">
              Valid last name is required.
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="username">Nazwa uzytkownika</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">@</span>
            </div>
            <input type="text" class="form-control" id="username" placeholder="<?php echo $username;?>" required>
            <div class="invalid-feedback" style="width: 100%;">
              Your username is required.
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="email">Email <span class="text-muted">(Optional)</span></label>
          <input type="email" class="form-control" id="email" placeholder="<?php echo $email; ?>">
          <div class="invalid-feedback">
            Please enter a valid email address for shipping updates.
          </div>
        </div>

        <div class="mb-3">
          <label for="address">Adres</label>
          <input type="text" class="form-control" id="address" placeholder="<?php echo $useradress['Adress'];?>" required>
          <div class="invalid-feedback">
            Please enter your shipping address.
          </div>
        </div>

        <div class="mb-3">
          <label for="address2">Telefon<span class="text-muted">(Optional)</span></label>
          <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
        </div>

        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="country">Country</label>
            <select class="custom-select d-block w-100" id="country" required>
              <option value="">Choose...</option>
              <option>United States</option>
            </select>
            <div class="invalid-feedback">
              Please select a valid country.
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label for="state">State</label>
            <select class="custom-select d-block w-100" id="state" required>
              <option value="">Choose...</option>
              <option>California</option>
            </select>
            <div class="invalid-feedback">
              Please provide a valid state.
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="zip">Zip</label>
            <input type="text" class="form-control" id="zip" placeholder="" required>
            <div class="invalid-feedback">
              Zip code required.
            </div>
          </div>
        </div>
            <button class="btn btn-primary btn-lg btn-block" type="submit">Zamawiam</button>
        </div>
        </form>
    </div>
    </div>
    <?php print_footer();
        ?>
    </div>
            
   
        

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>