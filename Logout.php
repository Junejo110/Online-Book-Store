<?php
session_start();
session_unset();



$_SESSION['logout_message'] = "Successfully logged out.";


header("Location:Login.php");

exit;
?>