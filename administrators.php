<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Administrators</title>
        <style>
            *{
                margin : 0px ;
                padding : 0px
            }

            table {
                width: calc(100% - 40px);
                color: #000000;
                border-collapse: collapse;
                margin-left: 20px;
                margin-top: 20px;
            }

            td, th {
                border-bottom: 1px solid #dedede;
                text-align: left;
                padding: 5px 15px;
                height: 19px;
            }

            tr {
                background-color: #eeeeee;
            }

            tr:nth-child(even) {
                background-color: #ffffff;
            }

            button{
                border: 1px solid black;
                border-radius: 3px;
                padding: 2px 4px;
            }
        </style>
    </head>
    <body>
        <?php
        require_once 'Core/user.php';
        require_once 'Core/librarySql.php';

        if (isset($_POST["deleteuser"])) {
            $User = new User();

            $User->username = $_POST['deleteuser'];

            $User->DeleteUser();

            session_start();
            $_SESSION["notice"] = '<br>Administrators: Success delete ' . $_POST['deleteuser'] . '!<br>';
        }
        ?>

        <table>
            <tr>
                <th>STT</th>
                <th>Username</th>
                <th>Password</th>
                <th>Action</th>
            </tr>
            <?php
            $User = new User();
            $MyArray = $User->ShowAllUsers();
            $strTable = "";
            $a = 1;
            for ($i = 0; $i < count($MyArray); $i++) {
                $obj = $MyArray[$i];
                $strTable .= '<tr>';
                $strTable .= '<td>';
                $strTable .= $a++;
                $strTable .= '</td>';

                $strTable .= '<td>';
                $strTable .= $obj->username;
                $strTable .= '</td>';

                $strTable .= '<td>';
                $strTable .= $obj->password;
                $strTable .= '</td>';

                $strTable .= '<td>';
                $strTable .= '<form method="post"><button type="submit" value="' . $obj->username . '" name="deleteuser">DELETE</button></form>';
                $strTable .= '</td>';
                $strTable .= '</tr>';
            }
            echo $strTable;
            ?>
        </table>
        <?php
        if (isset($_SESSION["notice"])) {
            echo $_SESSION["notice"];
        }
        session_unset();
        ?>
        <a href="/home.php">Exit</a>        
    </body>
</html>