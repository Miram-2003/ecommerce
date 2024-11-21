<?php
session_start();
session_unset();
session_destroy();
header("Location: ../login/customer_login.php");
exit();
?>