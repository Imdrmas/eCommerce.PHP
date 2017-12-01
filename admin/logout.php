<?php

session_start();   // start the session
session_unset();   // Unset the data
session_destroy(); // destory the session

header ('Location: index.php');
exit();


 ?>
