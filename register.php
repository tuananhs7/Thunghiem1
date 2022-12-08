<html lang="en">    
    <head>
        <meta charset="UTF-8">
        <title>Register</title>
    </head>
    <body>
        <form method="post">
            Username:
            <br><input type="text" name="username"><br>
            Password:
            <br><input type="password" name="password"><br>
            Config password:
            <br><input type="password" name="cfpassword"><br>
            <br>
            <button name="register" id="submitbtn" type="submit">Register</button>
        </form>

        <?php
        require_once 'Core/user.php';
        require_once 'Core/librarySql.php';

        if (isset($_POST['register'])) {
            if (
                    isset($_POST['username']) &&
                    isset($_POST['password']) &&
                    isset($_POST['cfpassword']) &&
                    $_POST['username'] !== "" &&
                    $_POST['password'] !== "" &&
                    $_POST['cfpassword'] !== ""
            ) {
                if ($_POST['password'] === $_POST['cfpassword']) {
                    $CheckUser = new User();

                    $CheckUser->username = $_POST['username'];

                    $list = $CheckUser->CheckUserExistsOrNot();

                    if (count($list) === 0) {
                        //Create new obiject 
                        $User = new User();

                        $User->username = $_POST['username'];
                        $User->password = md5($_POST['password']);

                        $User->AddNewUsers();

                        session_start();
                        $_SESSION["notice"] = '<br>Register: Register success!';

                        setcookie("username", $_POST['username'], time() + 3600, "/");
                        header("Location: /home.php");
                    } else {
                        echo 'Register: Register failure, the account you entered already exists!<br>';
                    }
                } else {
                    echo "Register: Confirm password is incorrect!<br>";
                }
            } else {
                echo "Register: Something is empty!<br>";
            }
        }
        ?>
        <a href='/login.php'>If you have an account, please click here to login</a>
    </body>
</html>