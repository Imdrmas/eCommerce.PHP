<?php
/*
=================================================
== Mange Memebers page
== You can Add | Edit | Delete Memebers from here
=================================================
*/
session_start();
if (isset($_SESSION['Username'])){
    $pageTitle = 'Member';
    include 'init.php';
 $do = isset($_GET['do']) ? $_GET['do'] : 'Mange';
 if ($do == 'Mange'){ // start Mange page =================================
// Page pour members no Pending
  $query = '';
  if (isset($_GET['page']) && $_GET['page'] == 'Pending'){
    $query = 'AND RegStatus = 0';
  }
   // sélectionnez tous les utilisateurs sauf admin
   // select all users except admin
    $stmt = $con->prepare("SELECT * FROM users WHERE GroupID != 1 $query ORDER BY UserID DESC");
    // Exécuter l'instruction
    // Execute the statement
    $stmt->execute();
     // assigner à la variable
    // assign to variable
    $rows = $stmt->fetchAll();
    if (!empty($rows)){
   ?>
   <h1 class="text-center"><?php echo $Manage_Members[$lang]; ?></h1>
   <div class="container">
     <div class="table-responsive">
       <table class="main-table mange-members text-center table table-bordered">
         <tr>
           <td>#ID</td>
           <td><?php echo $Avatar[$lang]; ?></td>
           <td><?php echo $Username[$lang]; ?></td>
           <td><?php echo $Email[$lang]; ?></td>
           <td><?php echo $Full_Name[$lang]; ?></td>
           <td><?php echo $Registered_Date[$lang]; ?></td>
           <td><?php echo $Control[$lang]; ?></td>
         </tr>
         <?php
         foreach ($rows as $row) {
          echo "<tr>";
          echo "<td>" . $row['UserID'] . "</td>";
          echo "<td>";
          if (empty($row['avatar'])){
           echo "<img class='my-image img-thumbnail img-responsive img-circle' src='uploads/default/avatar.png' alt='image' />";
             } else {
               echo "<img class='my-image img-thumbnail img-responsive img-circle' src='uploads/avatars/" . $row['avatar'] . "' alt='image' />";
             }
          echo  "</td>";
          echo "<td>" . $row['Username'] . "</td>";
          echo "<td>" . $row['Email'] . "</td>";
          echo "<td>" . $row['FullName'] . "</td>";
          echo "<td>" . $row['Date']. "</td>";
          echo "<td>
           <a href='members.php?do=Edit&userid=" . $row['UserID'] . "' class='btn btn-success'><i class='fa fa-edit'></i> $Edit[$lang] </a>
          <a href='members.php?do=Delete&userid=" . $row['UserID'] . "' class='btn btn-danger confirm'><i class='fa fa-close'></i> $Delete[$lang]</a>";

  if ($row['RegStatus'] == 0){
  echo  "<a href='members.php?do=Activate&userid=" . $row['UserID'] . "' class='btn btn-info activate'><i class='fa fa-fa-check'></i> $Activate[$lang]</a>";
  }
        echo  "</td>";
          echo "</tr>";
         }
          ?>
       </table>
     </div>
        <a href="members.php?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> <?php echo $New_Member[$lang]; ?></a>
  </div>
  <?php } else {
    echo '<div class="container">';
    echo "<p class='nice-message2'>".$Theres_no_memeber_to_show[$lang]."</p>";
    echo "<a href='members.php?do=Add' class='btn btn-primary'><i class='fa fa-plus'> </i> $New_Member[$lang] </a>";
    echo '</div>';
  }
  ?>
  <?php
   } elseif ($do == 'Add'){ // start Add Members page ======================== ?>
    <h1 class="text-center"><?php echo $Add_New_Member[$lang]; ?></h1>
    <div class="container">
     <form class="form-horizontal" action="?do=Insert" method="POST" enctype="multipart/form-data">
        <!-- start Username field -->
        <div class="form-group form-group-lg">
       <label class="col-sm-3 control-label"><?php echo $Username[$lang]; ?></label>
       <div class="col-sm-9 col-md-6">
         <input type="text" name="username" class="form-control" autocomplete="off"
         required="required" placeholder="<?php echo $Username_to_login_into_shop[$lang]; ?>">
       </div>
     </div>
       <!-- end Username field -->
       <!-- start Password field -->
         <div class="form-group form-group-lg">
      <label class="col-sm-3 control-label"><?php echo $Password[$lang]; ?></label>
      <div class="col-sm-9 col-md-6">
        <input type="password" name="password" class="password form-control"
        autocomplete="new-password" placeholder="<?php echo $Password_must_be_hard_complex[$lang]; ?>" required="required">
        <i class="show-pass fa fa-eye fa-2x hidden-xs"></i>
      </div>
        </div>
      <!-- end Username field -->
      <!-- start Email field -->
        <div class="form-group form-group-lg">
     <label class="col-sm-3 control-label"><?php echo $Email[$lang]; ?></label>
     <div class="col-sm-9 col-md-6">
       <input type="email" name="email" class="form-control"
       required="required" placeholder="<?php echo $Email_must_be_valid[$lang]; ?>">
     </div>
       </div>
     <!-- end Email field -->
     <!-- start FullName field -->
       <div class="form-group form-group-lg">
    <label class="col-sm-3 control-label"><?php echo $Full_Name[$lang]; ?></label>
    <div class="col-sm-9 col-md-6">
      <input type="text" name="full" class="form-control"
      required="required"
      placeholder="<?php echo $Full_name_appear_in_your_profile_page[$lang]; ?>">
    </div>
     </div>
    <!-- end FullName field -->
    <!-- start User Avatar field -->
      <div class="form-group form-group-lg">
   <label class="col-sm-3 control-label"><?php echo $Avatar[$lang]; ?></label>
   <div class="col-sm-9 col-md-6">
     <input type="file" name="avatar" class="form-control"
     required="required" placeholder="<?php echo $Full_name_appear_in_your_profile_page[$lang]; ?>">
   </div>
    </div>
   <!-- end User Avatar field -->
    <!-- start submit field -->
      <div class="form-group form-group-lg">
    <div class="col-sm-offset-3 col-sm-9">
      <input type="submit" name="btn" value="<?php echo $Choose_Avatar[$lang]; ?>" class="btn btn-primary btn-sm">
    </div>
     </div>
   <!-- end submit field -->
     </form>
   </div>
<?php } elseif ($do == 'Insert'){ // start Insert members page ======================
     if ($_SERVER['REQUEST_METHOD'] == 'POST'){
       ?>
      <h1 class="text-center"><?php echo $Insert_Member[$lang]; ?></h1>
      <?php
       echo "<div class='container'>";
        // Charger des variables
       // Upload variables
       $avatarName  = $_FILES['avatar']['name'];
       $avatarSize  = $_FILES['avatar']['size'];
       $avatarTmp   = $_FILES['avatar']['tmp_name'];
       $avatarType  = $_FILES['avatar']['type'];
        // liste des types de fichiers autorisés à télécharger
       // list of allowed file typed to Upload
       $avatarAllowedExtension = array("jpeg", "jpg", "png", "gif");
        // Get avatar Extension
        $avatarExtension = strtolower(end(explode('.', $avatarName)));
            // Obtenez une variable à partir du formulaire
           // Get variable from the form
           $user  = $_POST['username'];
           $pass  = $_POST['password'];
           $email = $_POST['email'];
           $name  = $_POST['full'];
           $hashPass = sha1($_POST['password']);
            // valide le formulaire
           // validate the form
           $formErrors = array();
           if (strlen($user) < 4){
             $formErrors[] = "$Usernam_cant_be_less[$lang].";
           }
           if (strlen($user) > 20){
             $formErrors[] = "$Username_cannot_be_more[$lang].";
           }
           if (empty($user)){
             $formErrors[] = "$Username_can_not_be_Empty[$lang].";
           }
           if (empty($pass)){
             $formErrors[] = "$Password_can_not_be_Empty[$lang].";
           }
           if (empty($name)){
             $formErrors[] = "$Full_Name_cannot_be_Empty[$lang].";
           }
           if (empty($email)){
             $formErrors[] = "$Email_cannot_be_Empty[$lang].";
           }
           if (! empty($avatarName) && ! in_array($avatarExtension, $avatarAllowedExtension)){
              $formErrors[] = "$This_Extension_Is_Not_Allowed[$lang].";
           }
           if (empty($avatarName)){
              $formErrors[] = "$Avatar_Is_Required[$lang].";
           }
           if ($avatarSize > 4194304){
              $formErrors[] = "$Avatar_Cannot_Be_Larger_than[$lang].";
           }
           // Loop into Errors array et écho
          // Loop into Errors array and echo it
           foreach($formErrors as $error){
             echo '<div class=" alert alert-danger">' . $error . '</div>';
           }
          // Vérifier s'il n'y a pas d'erreur, procéder à l'opération de mise à jour
       // Check if there's no error proceed the update operation
       if (empty($formErrors)){
         $avatar = rand(0, 10000000000) . '_' . $avatarName;
         move_uploaded_file($avatarTmp, "uploads/avatars//" . $avatar);
          // vérifier si l'utilisateur existe dans la base de données
         // check if user exist in database
         $check = checkItem("Username", "users", $user);
         if ($check == 1){

           $theMsg = "<p class='alert alert-danger'>".$Sorry_This_User_Is_Exist[$lang].".</p>";
           redirectHome($theMsg, 'back');

         } else {


        // Insérer l'information utilisateur dans la base de données
       // Insert userinfo in database
       $stmt = $con->prepare("INSERT INTO
                             users(Username, Password, Email, FullName, RegStatus, Date, avatar)
                             VALUES(:zuser, :zpass, :zmail, :zname, 1, now(), :zavatar) ");
         $stmt->execute(array(
           'zuser'   => $user,
           'zpass'   => $hashPass,
           'zmail'   => $email,
           'zname'   => $name,
           'zavatar' => $avatar
         ));
           // Echo Success Message
           $theMsg = "<div class='alert alert-success'> " . $stmt->rowCount() . $Record_Inserted[$lang] . '</div>';
           redirectHome($theMsg, 'back');
   }
    }
     }
     else {
         echo "<div class='container'> ";
         $theMsg =  "<p class='alert alert-danger'>".$Sorry_You_Cant_Browse_This_Page_directly[$lang]."</p>";
         redirectHome($theMsg);
            echo "</div>";
       }
     echo "</div>";
} elseif ($do == 'Edit'){ // start edit page =============================
   // Vérifier si vous demandez l'identifiant d'utilisateur en numérique et obtener une valeur entière
  // Check if get request userid in numeric & get integer value of it
 $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
 // Sélectionner toutes les données dépend de cette ID
 // Select all data depend on this ID
 $stmt = $con->prepare("SELECT * FROM users WHERE UserID = ? LIMIT 1");
 // Exécuter la requête
 // Execute Query
 $stmt->execute(array($userid));
 // Récupérer les données
 // Fetch The Data
 $row = $stmt->fetch();
 // le nombre de lignes
 // the row Count
 $count = $stmt->rowCount();
 // s'il existe un tel message d'identité,
 // if there's such ID show the From
 if ($stmt->rowCount() > 0){
 ?>
   <h1 class="text-center"><?php echo $Edit_Member[$lang]; ?></h1>
   <div class="container">
    <form class="form-horizontal" action="?do=Update" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="userid" value="<?php echo $userid ?>">
       <!-- start Username field -->
       <div class="form-group form-group-lg">
      <label class="col-sm-3 control-label"><?php echo $Username[$lang]; ?></label>
      <div class="col-sm-9 col-md-6">
        <input type="text" name="username" class="form-control" value="<?php echo $row['Username'] ?>"
        autocomplete="off" required="required">
      </div>
    </div>
      <!-- end Username field -->
      <!-- start Password field -->
        <div class="form-group form-group-lg">
     <label class="col-sm-3 control-label"><?php echo $Password[$lang]; ?></label>
     <div class="col-sm-9 col-md-6">
       <input type="hidden" name="oldpassword" value="<?php echo $row['Password'] ?>" >
       <input type="password" name="newpassword" class="form-control"
       autocomplete="new-password" placeholder="<?php echo $Leave_blank_if_you_dont_want_to_change[$lang]; ?>">
     </div>
       </div>
     <!-- end Username field -->
     <!-- start Email field -->
       <div class="form-group form-group-lg">
    <label class="col-sm-3 control-label"><?php echo $Email[$lang]; ?></label>
    <div class="col-sm-9 col-md-6">
      <input type="email" name="email" value="<?php echo $row['Email'] ?>" class="form-control" required="required">
    </div>
      </div>
    <!-- end Email field -->
    <!-- start FullName field -->
      <div class="form-group form-group-lg">
   <label class="col-sm-3 control-label"><?php echo $Full_Name[$lang]; ?></label>
   <div class="col-sm-9 col-md-6">
     <input type="text" name="full" value="<?php echo $row['FullName'] ?>" class="form-control" required="required">
   </div>
    </div>
   <!-- end FullName field -->
   <!-- start User Avatar field -->
     <div class="form-group form-group-lg">
  <label class="col-sm-3 control-label"><?php echo $Avatar[$lang]; ?></label>
  <div class="col-sm-9 col-md-6">
    <input type="file" name="avatar" class="form-control" required="required">
  </div>
   </div>
  <!-- end User Avatar field -->
   <!-- start submit field -->
     <div class="form-group form-group-lg">
   <div class="col-sm-offset-3 col-sm-9">
     <input type="submit" name="btn" value="<?php echo $Save[$lang]; ?>" class="btn btn-primary btn-md">
   </div>
    </div>
  <!-- end submit field -->
    </form>
  </div>

<?php
// SI il n'y a pas d'ID affichage le message d'erreur
// IF there's no such ID show Error Message
} else {
  echo "<div class='container'> ";
$theMsg =  "<p class='alert alert-danger'>".$This_ID_is_not_Exist[$lang].".</p>";
  redirectHome($theMsg);
  echo "</div>";
}

 } elseif($do == 'Update'){ // Update page ===================================
   ?>
  <h1 class="text-center"><?php echo $Update_Member[$lang]; ?></h1>
  <?php
   echo "<div class='container'>";
      if ($_SERVER['REQUEST_METHOD'] == 'POST'){
         // Charger des variables
        // Upload variables
        $avatarName  = $_FILES['avatar']['name'];
        $avatarSize  = $_FILES['avatar']['size'];
        $avatarTmp   = $_FILES['avatar']['tmp_name'];
        $avatarType  = $_FILES['avatar']['type'];
         // liste des types de fichiers autorisés à télécharger
        // list of allowed file typed to Upload
        $avatarAllowedExtension = array("jpeg", "jpg", "png", "gif");
         // Get avatar Extension
         $avatarExtension = strtolower(end(explode('.', $avatarName)));

             // obtenir une variable à partir du formulaire
            // Get variable from the form
            $id    = $_POST['userid'];
            $user  = $_POST['username'];
            $email = $_POST['email'];
            $name  = $_POST['full'];
            // Truc de mot de passe
             // Password Trick
             $pass = '';
             $pass = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);
             // valider le formulaire
            // validate the form
            $formErrors = array();

            if (strlen($user) < 4){
              $formErrors[] = "$Usernam_cant_be_less[$lang].";
            }
            if (strlen($user) > 20){
              $formErrors[] = "$Username_cannot_be_more[$lang].";
            }
            if (empty($user)){
              $formErrors[] = "$Username_can_not_be_Empty[$lang].";
            }
            if (empty($pass)){
              $formErrors[] = "$Password_can_not_be_Empty[$lang].";
            }
            if (empty($name)){
              $formErrors[] = "$Full_Name_cannot_be_Empty[$lang].";
            }
            if (empty($email)){
              $formErrors[] = "$Email_cannot_be_Empty[$lang].";
            }

            if (! empty($avatarName) && ! in_array($avatarExtension, $avatarAllowedExtension)){
               $formErrors[] = "$This_Extension_Is_Not_Allowed[$lang].";
            }

            if (empty($avatarName)){
               $formErrors[] = "$Avatar_Is_Required[$lang].";
            }
            if ($avatarSize > 4194304){
               $formErrors[] = "$Avatar_Cannot_Be_Larger_than[$lang].";
            }
           // Loop into Errors array and echo it
            foreach($formErrors as $error){
              echo '<div class=" alert alert-danger">' . $error . '</div>';
            }

          $stmt2 = $con->prepare("SELECT *
                                 FROM  users
                                 WHERE Username = ?
                                 AND   UserID = ?");
          $stmt2->execute(array($user, $id));
          $count = $stmt2->rowCount();
          if ($count == 1){
            $theMsg =  "<p class='alert alert-danger'>".$Sorry_This_User_Is_Exist[$lang].".</p>";
            redirectHome($theMsg,  'back');
          } else {
         // Vérifier s'il n'y a pas d'erreur, procédez à l'opération de mise à jour
        // Check if there's no error proceed the update operation
        if (empty($formErrors)){
          $avatar = rand(0, 10000000000) . '_' . $avatarName;
          move_uploaded_file($avatarTmp, "uploads/avatars//" . $avatar);

            // Mettre à jour la base de données avec cette infos
            // Update the database with this infos
            $stmt = $con->prepare("UPDATE
                                     users
                                 SET
                                     Username = ?,
                                     Password = ?,
                                     Email = ?,
                                     FullName = ?,
                                     avatar = ?
                               WHERE UserID = ?");
            $stmt->execute(array($user, $pass, $email, $name, $avatar, $id));
            // Echo Success Message
            $theMsg = "<div class='alert alert-success'> " . $stmt->rowCount() . $Record_Updated[$lang] . '</div>';
            redirectHome($theMsg,  'back');
      }
    }
    }
     else {
    $theMsg =  "<br><p class='alert alert-danger'>".$Sorry_You_Cant_Browse_This_Page_directly[$lang].".</p>";
        redirectHome($theMsg,  'back');
      }   echo "</div>";
 } elseif ($do == 'Delete'){ // start Delete page ========================

   ?>
  <h1 class="text-center"><?php echo $Delete_Member[$lang]; ?></h1>
  <?php
  echo "<div class='container'>";
  // Vérifiez si vous obtenez un identifiant d'utilisateur de demande dans un numéro et obtenez une valeur entière
   // Check if get request userid in numeric & get integer value of it
  $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
  // Sélectionner toutes les données dépendant de cette ID
  // Select all data depend on this ID
   $check = checkItem('userid', 'users', $userid);

   // s'il existe un ID affichage le formulaire
  // if there's such ID show the From
  if ($check > 0){
      $stmt = $con->prepare("DELETE FROM users WHERE UserID = :zuser");
      $stmt->bindParam(":zuser", $userid);
      $stmt->execute();
      // Echo Success Message


    $theMsg = "<br><div class='alert alert-success'> " . $stmt->rowCount() . ' ' . $Record_Delete[$lang] . '</div>';
      redirectHome($theMsg,  'back');
  } else {
    $theMsg =  "<br><p class='alert alert-danger'>".$This_ID_is_not_Exist[$lang].".</p>";
    redirectHome($theMsg);
  }
  echo "</div>";
} elseif ($do == 'Activate') { // Activate page ================================
  ?>
 <h1 class="text-center"><?php echo $Activate_Member[$lang]; ?></h1>
 <?php
 echo "<div class='container'>";
 // Vérifiez si vous obtenez un identifiant d'utilisateur de demande dans un numéro et obtenez une valeur entière
  // Check if get request userid in numeric & get integer value of it
 $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
   // Sélectionner toutes les données dépendant de cette ID
 // Select all data depend on this ID
  $check = checkItem('userid', 'users', $userid);
   // s'il existe un ID affichage le formulaire
 // if there's such ID show the From
 if ($check > 0){
     $stmt = $con->prepare("UPDATE users SET RegStatus = 1 WHERE UserID = ?");
     $stmt->execute(array($userid));
     // Echo Success Message
     $theMsg = "<br><div class='alert alert-success'> " . $stmt->rowCount() . $Activated_Member[$lang] . '</div>';
     redirectHome($theMsg,  'back');
 } else {
$theMsg =  "<br><p class='alert alert-danger'>".$This_ID_is_not_Exist[$lang].".</p>";
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
