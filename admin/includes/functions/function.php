<?php

 /* FRANAIS
 ** obtenir la fonction V2.0
 ** fonction pour obtenir tous les enregistrements à partir
 ** de n'importe quelle table de base de données
 */
/*  ENGLISH
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
  /* FRANAIS
  ** Fonction de titre V1.0
  ** qui écho le titre de la page au cas où la page
  ** a la variable $ pageTitle Et echo default Title pour d'autres pages
  */
 /* ENGLISH
 ** Title function V1.0
 ** that Echo the page title in case the page
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
 /* FRANAIS
   ** Fonction de redirection domestique V2.0
   ** cette fonction accepte les paramètres
   ** $ theMsg = Echo the Message [Erreur, succès, danger]
   ** $ url = le lien que vous voulez redéployer vers
   ** $ secondes = secondes avant la redirection
   */
 /* ENGLISH
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
 /* FRANAIS
 ** Check Items function V1.0
 ** functiont pour vérifier les éléments dans la base de données [function accept Parameters]
 ** $ select = l'élément à sélectionner [Exemple: utilisateur, élément, catégorie]
 ** $ from = le tableau à sélectionner dans [Exemple: utilisateurs, éléments, catégories]
 ** $ value = la valeur de Select [Exemple: drmas, box, electronics]
 */
/* ENGLISH
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
/* FRANAIS
** Nombre d'éléments fonction V1.0
** fonction pour compter le nombre d'articles lignes
** $item = l'élément à compter
* $Table = le tableau choisi
*/
/* ENGLISH
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

/* FRANAIS
** Obtenir la dernière fonction d'enregistrement V1.0
** fonction pour obtenir les derniers éléments de la base de données [utilisateurs, éléments, commentaires]
** $ select = champ pour sélectionner
** $ table = le tableau à choisir
** $ commander le DESC par commande
** $ limit = nombre d'enregistrements à obtenir
*/
/* ENGLISH
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
