<?php

/*
=======================================
== templates Page
=================================
*/

  ob_start(); // Output Buffering start
session_start();
if (isset($_SESSION['Username'])){
    $pageTitle = 'Member';
    include 'init.php';


 $do = isset($_GET['do']) ? $_GET['do'] : 'Mange';


// si la variable do est egale à mange
//
 if ($do == 'Mange'){ // start page mange


} 
elseif($do == 'Add'){ //
//
//  }
//  elseif($do == 'Inser'){
//
// }
// elseif($do == 'Edit'){
//
// }
// elseif($do == 'Update'){
//
// }
// elseif($do == 'delete'){
//
// }
 include $tpl . 'footer.php';
}
else {
header('Location: index.php');
exit();

}

ob_end_flush();





 ?>
