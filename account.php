<?php


function display_if_user_logged()
{
    echo"
           <div>                    
                <div id=\"account\">Moje konto</div>
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










