<?php





function display_if_user_logged()
{

    $username = $_SESSION['user'];
    $connection = @new mysqli( "localhost","root","","sklep");
    
    $result = $connection->query("SELECT * FROM customers WHERE Login='$username'");

    if (!$result) {
        printf("Error: %s\n", mysqli_error($connection));
        exit();
    }

    $userdet = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $id= $userdet['CustomerId'];

    echo"
           <div>                    
                <div id=\"account\"><a href=\"UserDetails.php?action=userinformations&id=$id\">Moje konto</a></div>
                <div id=\"logout\"><a href=\"logout.php\">Wyloguj</a></div>                                             
           </div >
       ";
}


function display_if_user_not_logged()
{
    echo"
           <div>
                <a href=\"login.php\">                 
                    Zaloguj się
                    </br>
                    Załóż konto
                </a>                                     
           </div >
    
    ";
}










