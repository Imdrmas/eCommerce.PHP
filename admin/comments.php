<?php
/*
=================================================
== Mange comments page
== You can Add | Edit | Delete cooments from here
=================================================
*/

session_start();
if (isset($_SESSION['Username'])){
    $pageTitle = 'Cpmments';
    include 'init.php';

 $do = isset($_GET['do']) ? $_GET['do'] : 'Mange';

 if ($do == 'Mange'){ // start Mange page =================================
// sélectionnez tous les utilisateurs sauf admin
   // select all users except admin
    $stmt = $con->prepare("SELECT
                                 comments.*, items.Name AS Item_Name, users.Username AS Member
                            FROM
                                 comments
                            INNER JOIN
                                 items
                            ON
                               items.Item_ID = comments.item_id
                            INNER JOIN
                                users
                            ON
                                 users.UserID = comments.user_id
                                 ORDER BY
                            C_id DESC ");
     // Exécute l'instruction
    // Execute the statement
    $stmt->execute();
    // assigner à la variable
    // assign to variable
    $comments = $stmt->fetchAll();
    if (!empty($comments)){
   ?>
   <h1 class="text-center"><?php echo $Manage_Comments[$lang] ?> </h1>
   <div class="container">
     <div class="table-responsive">
       <table class="main-table text-center table table-bordered">
         <tr>
           <td>#ID</td>
           <td> <?php echo $Comment[$lang] ?></td>
           <td><?php echo $Item_Name[$lang] ?></td>
           <td><?php echo $User_Name[$lang] ?></td>
           <td><?php echo $Add_Date[$lang] ?></td>
           <td><?php echo $Control[$lang] ?></td>
         </tr>
         <?php
         foreach ($comments as $comment) {
          echo "<tr>";
          echo "<td>" . $comment['C_id'] . "</td>";
          echo "<td>" . $comment['Comment'] . "</td>";
          echo "<td>" . $comment['Item_Name'] . "</td>";
          echo "<td>" . $comment['Member'] . "</td>";
          echo "<td>" . $comment['Comment_date']. "</td>";
          echo "<td>
           <a href='comments.php?do=Edit&comid=" . $comment['C_id'] . "' class='btn btn-success'><i class='fa fa-edit'></i> $Edit[$lang]</a>
          <a href='comments.php?do=Delete&comid=" . $comment['C_id'] . "' class='btn btn-danger confirm'><i class='fa fa-close'></i> $Delete[$lang]</a>";

  if ($comment['Status'] == 0){
        echo  "<a href='comments.php?do=Approve&comid=" . $comment['C_id'] . "' class='btn btn-info activate'><i class='fa fa-fa-check'></i> $Approve[$lang]</a>";
        }
          echo  "</td>";
          echo "</tr>";
         }
          ?>

       </table>
     </div>
  </div>
  <?php }
  else {
    echo '<div class="container">';
    echo "<p class='nice-message'>".$Theres_No_Comments_To_Show[$lang].".</p>";
    echo '</div>';
  }

   ?>
  <?php
   } elseif ($do == 'Edit'){ // start edit page =============================
  // Vérifiez si vous obtenez l'identifiant de la demande dans le numéro et obtenez une valeur entière
  // Check if get request comid in numeric & get integer value of it
 $comid = isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid']) : 0;
 // Sélectionnez toutes les données selon cette ID
 // Select all data depend on this ID
 $stmt = $con->prepare("SELECT * FROM comments WHERE C_id = ?");
 // Exécuter la requête
 // Execute Query
 $stmt->execute(array($comid));
 // Récupérer les données
 // Fetch The Data
 $row = $stmt->fetch();
 // le nombre de lignes
 // the row Count
 $count = $stmt->rowCount();
 // s'il existe ID Afficher le formulaire
 // if there's such ID show the From
 if ($stmt->rowCount() > 0){

 ?>
   <h1 class="text-center"><?php echo $Edit_Comment[$lang] ?></h1>
   <div class="container">
    <form class="form-horizontal" action="?do=Update" method="POST">
      <input type="hidden" name="comid" value="<?php echo $comid ?>">
       <!-- start Comment field -->
       <div class="form-group form-group-lg">
      <label class="col-sm-3 control-label"><?php echo $Comment[$lang] ?></label>
      <div class="col-sm-9 col-md-6">
      <textarea class="form-control" name="comment"> <?php echo $row['Comment'] ?> </textarea>
      </div>
    </div>
      <!-- end Comment field -->

   <!-- start submit field -->
     <div class="form-group form-group-lg">
   <div class="col-sm-offset-3 col-sm-9">
     <input type="submit" name="btn" value="<?php echo $Save[$lang] ?>" class="btn btn-primary btn-lg">
   </div>
    </div>
  <!-- end submit field -->
    </form>
  </div>

<?php
// SI il n'y a pas ID d'affichage le message d'erreur
// IF there's no such ID show Error Message
} else {
  echo "<div class='container'> ";
  $theMsg = "<br><p class='alert alert-danger'>".$This_ID_is_not_Exist[$lang].".</p>";
  redirectHome($theMsg);
  echo "</div>";
}

 } elseif($do == 'Update'){ // Update page ===================================
   echo "<h1 class='text-center'> Update Comment </h1>";
   echo "<div class='container'>";
      if ($_SERVER['REQUEST_METHOD'] == 'POST'){

             // Obtenez une variable à partir du formulaire
            // Get variable from the form
            $comid    = $_POST['comid'];
            $comment  = $_POST['comment'];
              // Mettre à jour la base de données avec cette infos
            // Update the database with this infos
            $stmt = $con->prepare("UPDATE comments SET Comment = ? WHERE C_id = ?");
            $stmt->execute(array($comment, $comid));
            // Echo Success Message

            $theMsg = "<div class='alert alert-success'> " . $stmt->rowCount() . $Record_Updated[$lang] .'</div>';
            redirectHome($theMsg,  'back');

    } else {
        $theMsg =  "<br><p class='alert alert-danger'>".$Sorry_You_Cant_Browse_This_Page_directly[$lang].".</p>";
        redirectHome($theMsg);
      }
      echo "</div>";
 } elseif ($do == 'Delete'){ // start Delete page ========================

   echo "<h1 class='text-center'> $Delete_Comment[$lang]</h1>";
   echo "<div class='container'>";
   // Vérifiez si vous obtenez l'identifiant de la demande dans le numéro et obtenez une valeur entière
   // Check if get request comid in numeric & get integer value of it
   $comid = isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid']) : 0;
   // Sélectionnez toutes les données selon cette ID
   // Select all data depend on this ID
   $check = checkItem('C_id', 'comments', $comid);
 // s'il existe ID Afficher le formulaire
  // if there's such ID show the From
  if ($check > 0){
      $stmt = $con->prepare("DELETE FROM comments WHERE C_id = :zid");
      $stmt->bindParam(":zid", $comid);
      $stmt->execute();

      // Echo Success Message
      $theMsg = "<div class='alert alert-success'> " . $stmt->rowCount() . ' ' . $Record_Delete[$lang] .'</div>';
      redirectHome($theMsg,  'back');

  } else {
    $theMsg = "<br><p class='alert alert-danger'>".$This_ID_is_not_Exist[$lang].".</p>";
    redirectHome($theMsg);
  }
  echo "</div>";

} elseif ($do == 'Approve') { // Activate page ================================

  echo "<h1 class='text-center'> $Approve[$lang] </h1>";
 echo "<div class='container'>";
    // Vérifiez si vous obtenez l'identifiant de la demande dans le numéro et obtenez une valeur entière
  // Check if get request userid in numeric & get integer value of it
 $comid = isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid']) : 0;
    // Sélectionnez toutes les données selon cette ID
 // Select all data depend on this ID
  $check = checkItem('C_id', 'comments', $comid);
 // s'il existe ID Afficher le formulaire
 // if there's such ID show the From
 if ($check > 0){
     $stmt = $con->prepare("UPDATE comments SET Status = 1 WHERE C_id = ?");
     $stmt->execute(array($comid));

     // Echo Success Message
     $theMsg = "<div class='alert alert-success'> " . $stmt->rowCount() . ' ' . $Record_Approved[$lang] .'</div>';
     redirectHome($theMsg,  'back');

 } else {
   $theMsg = "<br><p class='alert alert-danger'>".$This_ID_is_not_Exist[$lang].".</p>";
   redirectHome($theMsg);
 }
 echo "</div>";

}
    include $tpl . 'footer.php';
}
  else {
  header('Location: index.php');
  exit();

}
