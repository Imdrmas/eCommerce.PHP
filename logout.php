<?php

session_start();   // start the session
session_unset();   // Unset tha data
session_destroy(); // destory the session

header ('Location: login.php?lang=en');
exit();


 ?>
