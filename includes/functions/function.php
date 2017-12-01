<?php ob_start(); // Output Buffering start
/*
** Get All function V2.0
** function to get All Records from any database table
*/
function getAllFrom($field, $table, $where = NULL, $and = NULL, $orderfield, $ordering = "DESC"){
  global $con;
  $getAll = $con->prepare("SELECT $field FROM $table $where $and ORDER BY $orderfield $ordering");
  $getAll->execute();
  $all = $getAll->fetchAll();
  return $all;
}
/*
** Get Ad Items function V2.0
** function to get Ad Items from database
*/
function getItems($where, $value, $approve = NULL){
  global $con;
  $sql = $approve == NULL ? 'AND Approve = 1' : '';

  $getItems = $con->prepare("SELECT * FROM items WHERE $where = ? $sql ORDER BY Item_ID DESC");
  $getItems->execute(array($value));
  $items = $getItems->fetchAll();
  return $items;
}

/*
** Get Records function V1.0
** function to get Categories from database
*/
function getCat(){
  global $con;
  $getCat = $con->prepare("SELECT * FROM categories ORDER BY ID ASC");
  $getCat->execute();
  $cats = $getCat->fetchAll();
  return $cats;
}

/*
** Check if user is not Actived
** function to Check the regStatus of the user
*/

function checkUserStatus($user){
global $con;
$stmtx = $con->prepare("SELECT
                      Username, RegStatus
                      FROM
                      users
                      WHERE
                      Username = ?
                      AND RegStatus = 0");
$stmtx->execute(array($user));
$status = $stmtx->rowCount();
return $status;

}   

//========================================== start function backend
 /*
 ** Title function V1.0
 ** Title function that Eco the page title in case the page
 ** has the variable $pageTitle And echo default Title for other pages
 **
 */

 function getTitle(){
   global $pageTitle;

   if (isset($pageTitle)){
     echo $pageTitle;

   } else {
     echo 'Default';
   }
 }

 /*
 ** Home Redirect function V2.0
 ** this function ccept Parameters
 ** $theMsg = Echo the Message [ Error, Success, danger ]
 ** $url = the link you want to Redirect to
 ** $seconds = seconds before redirecting
 */
 function redirectHome($theMsg, $url = null, $seconds = 3){

    if ($url === null){
      $url = 'index.php';
      $link = 'Homepage';
    } else {
      if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== ''){
          $url = $_SERVER['HTTP_REFERER'];
          $link = 'Previous';
      } else {
        $url = 'index.php';
        $link = 'Homepage';
      }
    }
   echo  $theMsg;
   echo "<div class='alert alert-info'> You will be redirected to $link after $seconds Seconds . </div>";
   header("refresh:$seconds;url=$url");
   exit();
 }

/*
** Check Items function V1.0
** functiont to check items in database [ function accept Parameters ]
** $select = the Item to Select [Example: user, item, category]
** $from = the table to select from [ Example: users, items, categories]
** $value = the value of Select [Example: drmas, box, electronics ]
*/
function checkItem($select, $from, $value){
  global $con;
  $stmtement = $con->prepare("SELECT $select FROM $from WHERE $select = ?");
  $stmtement->execute(array($value));
  $count = $stmtement->rowCount();

  return $count;
}

/*
** Count number of Items function V1.0
** function to count number of items rows
** $item = the item to count
* $table = the table th choose from
*/
function countItems($item, $table){
  global $con;
  $stmt2 = $con->prepare("SELECT COUNT($item) FROM $table");
  $stmt2->execute();
  return $stmt2->fetchColumn();
}


/*
** Get latest records function V1.0
** function to get latest items from database [users, items, comments]
** $select = field to select
** $table = the table to choose from
** $order the DESC by order
** $limit = number of records to get
*/
function getLatest($select, $table, $order, $limit = 5){
  global $con;
  $getStmt = $con->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT 5");
  $getStmt->execute();
  $rows = $getStmt->fetchAll();
  return $rows;
}





ob_end_flush();
