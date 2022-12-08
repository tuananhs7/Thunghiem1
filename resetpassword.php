<html>
    <head>
        <meta charset="UTF-8">
        <title>Reset password</title>
    </head>
    <body>
        <form method="post">            
            Old password:
            <br><input type="password" name="oldpassword"><br>
            New password:
            <br><input type="password" name="newpassword"><br>
            Config new password:
            <br><input type="password" name="cfnewpassword"><br>
            <br>                    
            <button name="reset"type="submit">Reset</button>
        </form>  

        <?php
        if (!isset($_COOKIE["username"])) {
            header("Location: /login.php");
        } else {
            require_once 'Core/user.php';
            require_once 'Core/librarySql.php';

            if (isset($_POST['reset'])) {
                if (
                        isset($_POST['oldpassword']) &&
                        isset($_POST['newpassword']) &&
                        isset($_POST['cfnewpassword']) &&
                        $_POST['oldpassword'] !== "" &&
                        $_POST['newpassword'] !== "" &&
                        $_POST['cfnewpassword'] !== ""
                ) {
                    if ($_POST['newpassword'] === $_POST['cfnewpassword']) {

                        $User = new User();

                        $User->username = $_COOKIE["username"];
                        $User->password = md5($_POST['oldpassword']);

                        $list = $User->Login();

                        if (count($list) === 1) {
                            $User = new User();

                            $User->username = $_COOKIE["username"];
                            ;
                            $User->password = md5($_POST['newpassword']);

                            $User->ChangePassword();

                            session_start();
                            $_SESSION["notice"] = '<br>Reset password: Password reset successful';
                            header("Location: /home.php");
                        } else {
                            echo 'Reset password: Old password is not correct!<br>';
                        }
                    } else {
                        echo "Reset password: Confirm new password is incorrect!<br>";
                    }
                } else {
                    echo "Reset password: Something is empty!<br>";
                }
            }
        }
        ?> 
        <a href='/home.php'>Cancel reset password, comeback home page</a>  
    </body>
</html>