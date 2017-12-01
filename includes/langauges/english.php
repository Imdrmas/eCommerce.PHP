<?php

if( function_exists('lang') == FALSE ) {
function lang($phrase){
    static $lang = array(
            // navbar
          'HOME'           =>   'Elgadah',
          'CATEGORIES'     =>   'Categories',
          'ITEMS'          =>   'Items',
          'MEMBERS'        =>   'Members',
          'COMMENTS'       =>   'Comments',
          'LOGS'           =>   'Logs',

    );
    return $lang[$phrase];
}
}

 ?>
