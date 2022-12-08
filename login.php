<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
    </head>
    <body>
        <form method="post">
            Username:
            <br><input type="text" name="username"><br>
            Password:
            <br><input type="password" name="password"><br>
            <br>            
            <button name="login"type="submit">Login</button>
        </form>  

        <?php
        if (isset($_COOKIE["username"])) {
            header("Location: /home.php");
        } else {
            require_once 'Core/user.php';
            require_once 'Core/librarySql.php';

            if (isset($_POST['login'])) {
                if (
                        isset($_POST['username']) &&
                        isset($_POST['password']) &&
                        $_POST['username'] !== "" &&
                        $_POST['password'] !== ""
                ) {
                    $User = new User();

                    $User->username = $_POST['username'];
                    $User->password = md5($_POST['password']);

                    $list = $User->Login();

                    if (count($list) === 1) {
                        setcookie("username", $_POST['username'], time() + 3600, "/");
                        header("Location: /home.php");
                    } else {
                        echo 'Login: username or password is not correct!<br>';
                    }
                } else {
                    echo "Login: Something is empty!<br>";
                }
            }
        }
        ?>
        <a href='/register.php'>If you don't have an account, please click here to register</a>  
    </body>
</html>