<?php

/* CATEGORIES => [ Mange | Edit | Update | Add | Insert | Delete | stats ]  */

   $do = isset($_GET['do']) ? $_GET['do'] : 'Mange';

// if the page is main page
if ($do == 'Mange'){
  echo '<h1 style="color: green;">Welcome you are in Mange page</h1>';
}
  elseif ($do == 'Add'){
  echo '<h1 style="color: blue;">welcome you are in Add page</h1>';
}
  elseif ($do == 'Insert'){
  echo '<h1 style="color: olive;">welcome you are in insert page</h1>';
}
  else {
  echo '<h1 style="color: red;">Error there\s no page With this name</h1>';
}
 ?>
