<!DOCTYPE HTML>
<html lang="pl">

<head>
    <meta charset="utf-8" />

    <link rel="stylesheet" href="style/loginStyle.css"/>

</head>

<body>
    <div class="hero">
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()">Log In</button>
                <button type="button" class="toggle-btn" onclick="register()">Register</button>
            </div>
            <form id="login" class="input-group" action="zaloguj.php" method="post">
                <input type="text" class="input-field" placeholder="Username" required name="login">
                <input type="text" class="input-field" placeholder="Password" required name="password">
                <button type="submit" class="submit-btn">Zaloguj</button>

            </form>

            <form id="register" class="input-group" action="registration.php" method="post">
                <input type="text" class="input-field" placeholder="Username" name="login" required >
                <input type="email" class="input-field" placeholder="Email" name="email" required>
                <input type="text" class="input-field" placeholder="Password"name="password" required >
                <input type="text" class="input-field" placeholder="Imię" name="name" required >
                <input type="text" class="input-field" placeholder="Nazwisko" name="surname" required >
                <button type="submit" class="submit-btn">Zarejestruj</button>
            </form>
        </div>
    </div>

    <script>
        var x = document.getElementById("login");
        var y = document.getElementById("register");
        var z = document.getElementById("btn");

        function register()
        {
            x.style.left = "-400px";
            y.style.left = "50px";
            z.style.left = "110px";
        }

        function login()
        {
            x.style.left = "50px";
            y.style.left = "450px";
            z.style.left = "0px";
        }

    </script>



</body>
</html>