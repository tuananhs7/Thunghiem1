<?php

header("Location: /login.php");
setcookie("username", "", time() - 3600, "/");
?>