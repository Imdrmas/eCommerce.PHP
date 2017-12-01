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


          // dashboard
          'DASHBOARD'                         =>   'Dashboard',
          'TOTAL MEMBERS'                     =>   'Total Members',
          'PENDING MEMBERS'                   =>   'Pending Members',
          'TOTAL ITEMS'                       =>   'Total Items',
          'TOTAL COMMENTS'                    =>   'Total Comments',
          'LASTEST 5 REGISTERED USERS'        =>   'Latest 5 Registered Users',
          'LASTEST 5 ITEMS'                   =>   'Latest 5 Items',
          'LASTEST 5 COMMENTS'                =>   'Latest 5 Comments',
          'THERES NO ITEM TO SHOW'            =>   'There\'s No Item To Show',

          // categories
          'MANGE CATEGORIES'           =>   'Mange Categories',
          'ORDERING:'                  =>   'Ordering:',
          'ASC'                        =>   'Asc',
          'DESC'                       =>   'Desc',
          'VIEW'                       =>   'View',
          'FULL'                       =>   'Full',
          'CLASSIC'                    =>   'Classic',
          'NEW CATEGORY'               =>   'New Category',
          'THERES NO ITEM TO SHOW'     =>   'There\'s No Category To Show',
          'NEW ITEM'                   =>   'New Category',
          'NAME'                       =>   'Name',
          'DESCRIPTION'                =>   'Description',
          'ORDERING'                   =>   'Ordering',
          'PARENT'                     =>   'Parent?',
          'NONE'                       =>   'None',
          'VISIBILITY'                 =>   'ViSibility',
          'YES'                        =>   'Yes',
          'NO'                         =>   'No',
          'COMMENTING'                 =>   'Commenting',
          'YES'                        =>   'Yes',
          'NO'                         =>   'No',
          'ALLOW ADS'                  =>   'Allow Ads',
          'YES'                        =>   'Yes',
          'NO'                         =>   'No',
          'ADD CATEGORY'               =>   'Add Category',
          'UPDATED CATEGORY'           =>   'Update Category',
          'EDIT CATEGORY'              =>   'Edit Category',// COPY FROM HERE
          'SAVE'                       =>   'Save',
          'DELETED CATEGORY'           =>   'Delete Category ',

          // Membres
          'MANGE MEMBERS'           =>   'Mange Members',
          'ID'                      =>   '#Id',
          'AVATAR'                  =>   'Avatar',
          'USERNAME'                =>   'Username',
          'EMAIL'                   =>   'Email',
          'FULL NAME'               =>   'Full Name',
          'REGISTERED'              =>   'Registered Date',
          'CONTROL'                 =>   'Control',
          'NEW MEMBERS'             =>   'New Member ',
          'ADD NEW MEMBER'          =>   'Add New Member',
          'USERNAME'                =>   'Username',
          'PASSWORD'                =>   'Password',
          'EMAIL'                   =>   'Email',
          'NAME'                    =>   'Full Name',
          'USER AVATAR'             =>   'User Avatar',
          'INSERT MEMBERS'          =>   'Insert Member ',
          'EDIT MEMBERS'            =>   'Edit Member', // COPY FROM HERE
          'SAVE'                    =>   'Save',
          'UPDATED MEMBER'          =>   'Update Member',
          'DELETED MEMBER'          =>   'Delete Member',
          'ACTIVATED MEMBER'        =>   'Activate Member',
          ''           =>   '',
          ''           =>   '',
          ''           =>   '',
          ''           =>   '',
          ''           =>   '',
          ''           =>   '',
          ''           =>   '',
          ''           =>   '',
          ''           =>   '',
          ''           =>   '',
          ''           =>   '',
          ''           =>   '',
          ''           =>   '',
          ''           =>   '',
          ''           =>   '',
          ''           =>   '',

    );
    return $lang[$phrase];
}
}

 ?>
