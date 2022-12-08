<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
    </head>
    <body>
        <?php
        if (isset($_COOKIE["username"])) {
            echo "Welcome " . $_COOKIE["username"];
            echo "
                    <br>
                    <a href='/logout.php'><button>Logout</button></a>
                    <a href='/resetpassword.php'><button>Reset password</button></a>
                ";
        } else {
            echo "
                    Home Page
                    <br>
                    <a href='/login.php'>If you have an account, please click here to login</a>
                    <br>
                    <a href='/register.php'>If you don't have an account, please click here to register</a>
                ";
        }
        session_start();
        if (isset($_SESSION["notice"])) {
            echo $_SESSION["notice"];
        }
        session_unset();
        ?>
    </body>
</html>