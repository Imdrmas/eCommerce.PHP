<?php

   include 'connect.php';

   // Routes

   $tpl  = 'includes/templates/';  // templates Directory
   $lang = 'includes/langauges/';  // langauges Directory
   $func = 'includes/functions/';  // function Directory
   $css  = 'layout/css/';          // Css Directory
   $js   = 'layout/js/';           // Js Directory ?>

   <?php
   include $lang . 'english.php';
   // includes navbar on all pages expect the one with $noNavbar vairable
   // comprend la barre de navigation sur toutes les pages sauf celle avec la variable $ noNavbar = FR
      if (!isset($noNavbar)){ include $tpl . 'navbar.php'; }
   ?>

<?php
   // include the important Files
   include $func . 'function.php';
   //include  $lang . 'detect_language_class.php';
   //include_once $lang . 'french.php';
   include $tpl  . 'header.php';
   ?>
