<?php
unset($_SESSION["user-logged-in"]);
header("Location: ../index.php");
exit;
?>