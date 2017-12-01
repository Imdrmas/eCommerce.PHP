<?php

/*
=======================================
== Items Page
=================================
*/
  ob_start(); // Output Buffering start
session_start();
if (isset($_SESSION['Username'])){
    $pageTitle = 'Items';
    include 'init.php';

 $do = isset($_GET['do']) ? $_GET['do'] : 'Mange';
 if ($do == 'Mange'){ // start mange items page ============================

     $stmt = $con->prepare("SELECT
                              items.*,
                              categories.Name AS category_name,
                              users.Username
                          FROM
                             items
                          INNER JOIN
                             categories
                          ON
                             categories.ID = items.Cat_ID
                          INNER JOIN
                             users
                          ON users.UserID = items.Member_ID
                          ORDER BY
                             Item_ID DESC");
      // Exécute l'instruction
     // Execute the statement
     $stmt->execute();
     // assigner à la variable
     // assign to variable
     $items = $stmt->fetchAll();
     if (!empty($items)){
    ?>
    <h1 class="text-center"><?php echo $Manage_Items[$lang]; ?></h1>
    <div class="container">
      <div class="table-responsive mange-items">
        <table class="main-table text-center table table-bordered">
          <tr>
            <td>#ID</td>
            <td><?php echo $Photo[$lang]; ?></td>
            <td><?php echo $Name[$lang]; ?></td>
            <td><?php echo $Description[$lang]; ?></td>
            <td><?php echo $Price[$lang]; ?></td>
            <td><?php echo $Adding_Date[$lang]; ?></td>
            <td><?php echo $Category[$lang]; ?></td>
            <td><?php echo $Username[$lang]; ?></td>
            <td><?php echo $Control[$lang]; ?></td>
          </tr>
          <?php
          foreach ($items as $item) {
           echo "<tr>";
           echo "<td>" . $item['Item_ID'] . "</td>";
             echo "<td>";
             if (empty($item['avatar'])){
            echo "<img class='my-image img-thumbnail' src='uploads/default/avatar.png' alt='image' />";
                } else {
                  echo "<img class='img-responsive' src='uploads/avatars/" . $item['avatar'] . "' alt='image' />";
                }
           echo  "</td>";
           echo "<td>" . $item['Name'] . "</td>";
           echo "<td>" . $item['Description'] . "</td>";
           echo "<td> $" . $item['Price'] . "</td>";
           echo "<td>" . $item['Add_Date']. "</td>";
           echo "<td>" . $item['category_name']. "</td>";
           echo "<td>" . $item['Username']. "</td>";
           echo "<td>
            <a href='Items.php?do=Edit&itemid=" . $item['Item_ID'] . "' class='btn btn-success'><i class='fa fa-edit'></i> $Edit[$lang]</a>
           <a href='Items.php?do=Delete&itemid=" . $item['Item_ID'] . "' class='btn btn-danger confirm'><i class='fa fa-close'></i> $Delete[$lang]</a>";
           if ($item['Approve'] == 0){
           echo  "<a href='Items.php?do=Approve&itemid=" . $item['Item_ID'] . "' class='btn btn-info activate'><i class='fa fa-check'></i> $Approve[$lang]</a>";
           }

         echo  "</td>";
           echo "</tr>";
          }
           ?>

        </table>
      </div>
         <a href="Items.php?do=Add" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> <?php echo $New_Item[$lang]; ?></a>
   </div>
   <?php } else {
     echo '<div class="container">';
     echo '<div class="nice-message">There\'s No Item To Show </div>';
     echo "<a href='Items.php?do=Add' class='btn btn-primary'><i class='fa fa-plus'></i> $New_Item[$lang] </a>";
     echo '</div>';
   }
    ?>
   <?php
 } elseif($do == 'Add'){ // start add items page ================================= ?>
    <h1 class="text-center"><?php echo $Add_New_Item[$lang]; ?></h1>
    <div class="container">
     <form class="form-horizontal" action="?do=Insert" method="POST" enctype="multipart/form-data">
        <!-- start name field -->
        <div class="form-group form-group-lg">
       <label class="col-sm-3 control-label"><?php echo $Names[$lang]; ?></label>
       <div class="col-sm-9 col-md-6">
         <input
          type="text"
          name="name"
          class="form-control"
          required="required"
          placeholder="<?php echo $Name_Of_The_Item[$lang]; ?>">
       </div>
     </div>
       <!-- end name field -->
       <!-- start Description field -->
       <div class="form-group form-group-lg">
      <label class="col-sm-3 control-label"><?php echo $Description[$lang]; ?></label>
      <div class="col-sm-9 col-md-6">
        <input
         type="text"
         name="description"
         class="form-control"
         required="required"
         placeholder="<?php echo $Description_of_the_item[$lang]; ?>">
      </div>
    </div>
      <!-- end Description field -->
      <!-- start Price field -->
      <div class="form-group form-group-lg">
     <label class="col-sm-3 control-label"><?php echo $Price[$lang]; ?></label>
     <div class="col-sm-9 col-md-6">
       <input
        type="text"
        name="price"
        class="form-control"
        required="required"
        placeholder="<?php echo $Price_of_the_item[$lang]; ?>">
     </div>
     </div>
     <!-- end Price field -->
     <!-- start Country field -->
     <div class="form-group form-group-lg">
    <label class="col-sm-3 control-label"><?php echo $Country[$lang]; ?></label>
    <div class="col-sm-9 col-md-6">
      <input
       type="text"
       name="country"
       class="form-control"
       required="required"
       placeholder="<?php echo $Country_of_Mede[$lang]; ?>">
    </div>
    </div>
    <!-- end Country field -->
    <!-- start User Avatar field -->
      <div class="form-group form-group-lg">
   <label class="col-sm-3 control-label"><?php echo $User_Avatar[$lang]; ?></label>
   <div class="col-sm-9 col-md-6">
     <input type="file" name="avatar" class="form-control" required="required">
   </div>
    </div>
   <!-- end User Avatar field -->
    <!-- start Status field -->
    <div class="form-group form-group-lg">
   <label class="col-sm-3 control-label"><?php echo $Status[$lang]; ?></label>
   <div class="col-sm-9 col-md-6">
     <select name="status">
       <option value="0">...</option>
       <option value="1"><?php echo $New[$lang]; ?></option>
       <option value="2"><?php echo $Like_New[$lang]; ?></option>
       <option value="3"><?php echo $Used[$lang]; ?></option>
       <option value="4"><?php echo $Very_Old[$lang]; ?></option>
     </select>
   </div>
   </div>
   <!-- end Status field -->
   <!-- start Members field -->
   <div class="form-group form-group-lg">
  <label class="col-sm-3 control-label"><?php echo $Member[$lang]; ?></label>
  <div class="col-sm-9 col-md-6">
    <select name="member">
      <option value="0">...</option>
      <?php
      $allMembers = getAllFrom("*", "users", "", "", "UserID");
       foreach ($allMembers as $user){
         echo "<option value='" . $user['UserID'] . "'>" . $user['Username'] . "</option>";
       }
       ?>
    </select>
  </div>
  </div>
  <!-- end Members field -->
  <!-- start Categories field -->
  <div class="form-group form-group-lg">
 <label class="col-sm-3 control-label"><?php echo $Categories[$lang]; ?></label>
 <div class="col-sm-9 col-md-6">
   <select name="category">
     <option value="0">...</option>
     <?php
     $allCats = getAllFrom("*", "categories", "where Parent = 0", "", "ID");
      foreach ($allCats as $cat){
        echo "<option value='" . $cat['ID'] . "'>" . $cat['Name'] . "</option>";
        $childCats = getAllFrom("*", "categories", "where Parent = {$cat['ID']}", "", "ID");
        foreach ($childCats as $child){
        echo "<option value='" . $child['ID'] . "'>-- " . $child['Name'] . "</option>";
        }
      }
      ?>
   </select>
 </div>
 </div>
 <!-- end Categories field -->
 <!-- start Tags field -->
 <div class="form-group form-group-lg">
<label class="col-sm-3 control-label"><?php echo $Tags[$lang]; ?></label>
<div class="col-sm-9 col-md-6">
  <input
   type="text"
   name="tags"
   class="form-control"
   placeholder="<?php echo $Separate_Tags_With_Comma[$lang] ?>(,)">
</div>
</div>
<!-- end Tags field -->
    <!-- start submit field -->
      <div class="form-group form-group-lg">
    <div class="col-sm-offset-3 col-sm-9">
      <input type="submit" name="btn" value="<?php echo $Add_Item[$lang]; ?>" class="btn btn-primary">
    </div>
     </div>
   <!-- end submit field -->
     </form>
   </div>

  <?php }elseif ($do == 'Insert'){ // start Insert items page ======================

       if ($_SERVER['REQUEST_METHOD'] == 'POST'){

         echo "<h1 class='text-center'> $Itsert_Item[$lang] </h1>";
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
             $name      = $_POST['name'];
             $desc      = $_POST['description'];
             $price     = $_POST['price'];
             $country   = $_POST['country'];
             $status    = $_POST['status'];
             $member    = $_POST['member'];
             $cat       = $_POST['category'];
             $tags      = $_POST['tags'];
               // valide le formulaire
             // validate the form
             $formErrors = array();

             if (empty($name)){
               $formErrors[] = "$Name_cannot_be_Empty[$lang]";
             }
             if (empty($desc)){
               $formErrors[] = "$Description_cannot_be_Empty[$lang]";
             }
             if (empty($price)){
               $formErrors[] = "$Price_cannot_be_Empty[$lang]";
             }
             if (empty($country )){
               $formErrors[] = "$Country_cannot_be_Empty[$lang]";
             }
             if ($status == 0){
               $formErrors[] = "$You_must_choose_the_Status[$lang]";
             }
             if ($member == 0){
               $formErrors[] = "$You_must_choose_the_Member[$lang]";
             }
             if ($cat == 0){
               $formErrors[] = "$You_must_choose_the_Category[$lang]";
             }
             if (! empty($avatarName) && ! in_array($avatarExtension, $avatarAllowedExtension)){
                $formErrors[] = "$This_Extension_Is_Not_Allowed[$lang]";
             }
             if (empty($avatarName)){
                $formErrors[] = "$Avatar_Is_Required[$lang]";
             }
             if ($avatarSize > 4194304){
                $formErrors[] = "$Avatar_Cannot_Be_Larger_than[$lang]";
             }
             // Loop into Errors array et écho
            // Loop into Errors array and echo it
             foreach($formErrors as $error){
               echo '<div class=" alert alert-danger">' . $error . '</div>';
             }

          // Vérifiez s'il n'y a pas d'erreur, procédez à l'opération de mise à jour
         // Check if there's no error proceed the update operation
         if (empty($formErrors)){
           $avatar = rand(0, 10000000000) . '_' . $avatarName;
           move_uploaded_file($avatarTmp, "uploads/avatars//" . $avatar);

          // Insérer l'information utilisateur dans la base de données
         // Insert userinfo in database
         $stmt = $con->prepare("INSERT INTO
                               items(Name, Description, Price, Country_Made, Status, Add_Date, Cat_ID, Member_ID, Tags, avatar)
                               VALUES(:zname, :zdesc, :zprice, :zcountry, :zstatus, now(), :zcat, :zmember, :ztags, :zavatar) ");
           $stmt->execute(array(
             'zname'     => $name,
             'zdesc'     => $desc,
             'zprice'    => $price,
             'zcountry'  => $country,
             'zstatus'   => $status,
             'zmember'   => $member,
             'zcat'      => $cat,
             'ztags'     => $tags,
             'zavatar'   => $avatar
           ));
             // Echo Success Message

             $theMsg = "<div class='alert alert-success'> " . $stmt->rowCount() . $Record_Inserted[$lang] .'</div>';
             redirectHome($theMsg, 'back');

     }
       }
       else {
           echo "<div class='container'> ";
           $theMsg =  "<p class='alert alert-danger'>".$Sorry_You_Cant_Browse_This_Page_directly[$lang]."</p>";
           redirectHome($theMsg);
              echo "</div>";
         }
       echo "</div>";
  }elseif ($do == 'Edit'){ // start edit item page =============================
    // Vérifiez si vous obtenez l'ID de l'article de demande dans le numéro et en obtenez une valeur entière
    // Check if get request itemid in numeric & get integer value of it
   $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
   // Sélectionnez toutes les données selon cette ID
   // Select all data depend on this ID
   $stmt = $con->prepare("SELECT * FROM items WHERE Item_ID = ?");
   // Exécuter la requête
   // Execute Query
   $stmt->execute(array($itemid));
   // Récupérer les données
   // Fetch The Data
   $item = $stmt->fetch();
   // le nombre de lignes
   // the row Count
   $count = $stmt->rowCount();
   // s'il existe ID Afficher la formulaire
   // if there's such ID show the From
   if ($stmt->rowCount() > 0){
   ?>
   <h1 class="text-center"><?php echo $Edit_Item[$lang]; ?></h1>
   <div class="container">
    <form class="form-horizontal" action="?do=Update" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="itemid" value="<?php echo $itemid ?>">
       <!-- start name field -->
       <div class="form-group form-group-lg">
      <label class="col-sm-3 control-label"><?php echo $Names[$lang]; ?></label>
      <div class="col-sm-9 col-md-6">
        <input
         type="text"
         name="name"
         class="form-control"
         required="required"
         placeholder="<?php echo $Name_Of_The_Item[$lang]; ?>"
         value="<?php echo $item['Name'] ?>"
         >

      </div>
    </div>
      <!-- end name field -->
      <!-- start Description field -->
      <div class="form-group form-group-lg">
     <label class="col-sm-3 control-label"><?php echo $Description[$lang]; ?></label>
     <div class="col-sm-9 col-md-6">
       <input
        type="text"
        name="description"
        class="form-control"
        required="required"
        placeholder="<?php echo $Description_of_the_item[$lang]; ?>"
         value="<?php echo $item['Description'] ?>">
     </div>
   </div>
     <!-- end Description field -->
     <!-- start Price field -->
     <div class="form-group form-group-lg">
    <label class="col-sm-3 control-label"><?php echo $Price[$lang]; ?></label>
    <div class="col-sm-9 col-md-6">
      <input
       type="text"
       name="price"
       class="form-control"
       required="required"
       placeholder="<?php echo $Price_of_the_item[$lang]; ?>"
        value="<?php echo $item['Price'] ?>">
    </div>
    </div>
    <!-- end Price field -->
    <!-- start Country field -->
    <div class="form-group form-group-lg">
   <label class="col-sm-3 control-label"><?php echo $Country[$lang]; ?></label>
   <div class="col-sm-9 col-md-6">
     <input
      type="text"
      name="country"
      class="form-control"
      required="required"
      placeholder="<?php echo $Country_of_Mede[$lang]; ?>"
      value="<?php echo $item['Country_Made'] ?>">
   </div>
   </div>
   <!-- end Country field -->
   <!-- start User Avatar field -->
     <div class="form-group form-group-lg">
  <label class="col-sm-3 control-label"><?php echo $User_Avatar[$lang]; ?></label>
  <div class="col-sm-9 col-md-6">
    <input type="file" name="avatar" class="form-control" required="required">
  </div>
   </div>
  <!-- end User Avatar field -->
   <!-- start Status field -->
   <div class="form-group form-group-lg">
  <label class="col-sm-3 control-label"><?php echo $Status[$lang]; ?></label>
  <div class="col-sm-9 col-md-6">
    <select name="status">
      <option value="1" <?php if ($item['Status'] == 1){ echo 'selected';} ?>><?php echo $New[$lang]; ?></option>
      <option value="2" <?php if ($item['Status'] == 2){ echo 'selected';} ?>><?php echo $Like_New[$lang]; ?></option>
      <option value="3" <?php if ($item['Status'] == 3){ echo 'selected';} ?>><?php echo $Used[$lang]; ?></option>
      <option value="4" <?php if ($item['Status'] == 4){ echo 'selected';} ?>><?php echo $Very_Old[$lang]; ?></option>
    </select>
  </div>
  </div>
  <!-- end Status field -->
  <!-- start Members field -->
  <div class="form-group form-group-lg">
 <label class="col-sm-3 control-label"><?php echo $Member[$lang]; ?></label>
 <div class="col-sm-9 col-md-6">
   <select name="member">
     <?php
      $stmt = $con->prepare("SELECT * FROM users");
      $stmt->execute();
      $users = $stmt->fetchAll();
      foreach ($users as $user){
        echo "<option value='" . $user['UserID'] . "'"; if ($item['Member_ID'] == $user['UserID'])
        { echo 'selected';} echo">" . $user['Username'] . "</option>";
      }
      ?>
   </select>
 </div>
 </div>
 <!-- end Members field -->
 <!-- start Categories field -->
 <div class="form-group form-group-lg">
<label class="col-sm-3 control-label"><?php echo $Categories[$lang]; ?></label>
<div class="col-sm-9 col-md-6">
  <select name="category">
    <?php
     $stmt2 = $con->prepare("SELECT * FROM categories");
     $stmt2->execute();
     $cats = $stmt2->fetchAll();
     foreach ($cats as $cat){
       echo "<option value='" . $cat['ID'] . "'"; if ($item['Cat_ID'] == $cat['ID'])
       { echo 'selected';} echo">" . $cat['Name'] . "</option>";
     }
     ?>
  </select>
</div>
</div>
<!-- end Categories field -->
<!-- start Tags field -->
<div class="form-group form-group-lg">
<label class="col-sm-3 control-label"><?php echo $Tags[$lang]; ?></label>
<div class="col-sm-9 col-md-6">
 <input
  type="text"
  name="tags"
  class="form-control"
  placeholder="<?php echo $Separate_Tags_With_Comma[$lang] ?>(,)"
  value="<?php echo $item['Tags'] ?>">
</div>
</div>
<!-- end Tags field -->
   <!-- start submit field -->
     <div class="form-group form-group-lg">
   <div class="col-sm-offset-3 col-sm-9">
     <input type="submit" name="btn" value="<?php echo $Save[$lang] ?>" class="btn btn-primary btn-sm">
   </div>
    </div>
  <!-- end submit field -->
    </form>
    <?php
    // sélectionnez tous les utilisateurs sauf admin
    // select all users except admin
     $stmt = $con->prepare("SELECT
                                  comments.*, users.Username AS Member
                             FROM
                                  comments
                             INNER JOIN
                                 users
                             ON
                                  users.UserID = comments.user_id
                              WHERE item_id = ?");
      // Exécute l'instruction
     // Execute the statement
     $stmt->execute(array($itemid));
     // assigner à la variable
     // assign to variable
     $rows = $stmt->fetchAll();
     if (!empty($rows)){
    ?>
    <h1 class="text-center"><?php echo $Manage_Comments[$lang];?> [ <?php echo $item['Name'] ?> ]</h1>
      <div class="table-responsive">
        <table class="main-table text-center table table-bordered">
          <tr>
            <td> <?php echo $Comment[$lang] ?></td>
            <td><?php echo $User_Name[$lang] ?></td>
            <td><?php echo $Add_Date[$lang] ?></td>
            <td><?php echo $Control[$lang] ?></td>
          </tr>
          <?php
          foreach ($rows as $row) {
           echo "<tr>";
           echo "<td>" . $row['Comment'] . "</td>";
           echo "<td>" . $row['Member'] . "</td>";
           echo "<td>" . $row['Comment_date']. "</td>";
           echo "<td>
            <a href='comments.php?do=Edit&comid=" . $row['C_id'] . "' class='btn btn-success'><i class='fa fa-edit'></i> $Edit[$lang]</a>
           <a href='comments.php?do=Delete&comid=" . $row['C_id'] . "' class='btn btn-danger confirm'><i class='fa fa-close'></i> $Delete[$lang]</a>";

   if ($row['Status'] == 0){
         echo  "<a href='comments.php?do=Approve&comid=" . $row['C_id'] . "' class='btn btn-info activate'><i class='fa fa-fa-check'></i> $Approve[$lang]</a>";
         }
           echo  "</td>";
           echo "</tr>";
          }
           ?>

        </table>
   </div>
   <?php } ?>
  </div>

  <?php
  // SI il n'y a pas ID affichage le message d'erreur
  // IF there's no such ID show Error Message
  } else {
    echo "<div class='container'> ";
    $theMsg =  "<p class='alert alert-danger'>".$This_ID_is_not_Exist[$lang].".</p>";
    redirectHome($theMsg);
    echo "</div>";
  }
   }elseif($do == 'Update'){ // Update page ===================================
     echo "<h1 class='text-center'> $Update_Item[$lang]</h1>";
     echo "<div class='container'>";
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
           // Charger des variables
          // Upload variables
          $avatarName  = $_FILES['avatar']['name'];
          $avatarSize  = $_FILES['avatar']['size'];
          $avatarTmp   = $_FILES['avatar']['tmp_name'];
          $avatarType  = $_FILES['avatar']['type'];
           // liste des types de fichiers autorisés à télécharger
          // list of allowed file types to Upload
          $avatarAllowedExtension = array("jpeg", "jpg", "png", "gif");
           // Get avatar Extension
           $avatarExtension = strtolower(end(explode('.', $avatarName)));
               // Obtenez une variable à partir du formulaire
              // Get variable from the form
              $id      = $_POST['itemid'];
              $name    = $_POST['name'];
              $desc    = $_POST['description'];
              $price   = $_POST['price'];
              $country = $_POST['country'];
              $status  = $_POST['status'];
              $member  = $_POST['member'];
              $cat     = $_POST['category'];
              $tags     = $_POST['tags'];

               // valide le formulaire
              // validate the form
              $formErrors = array();

              if (empty($name)){
                $formErrors[] = "$Name_cannot_be_Empty[$lang]";
              }
              if (empty($desc)){
                $formErrors[] = "$Description_cannot_be_Empty[$lang]";
              }
              if (empty($price)){
                $formErrors[] = "$Price_cannot_be_Empty[$lang]";
              }
              if (empty($country )){
                $formErrors[] = "$Country_cannot_be_Empty[$lang]";
              }
              if ($status == 0){
                $formErrors[] = "$You_must_choose_the_Status[$lang]";
              }
              if ($member == 0){
                $formErrors[] = "$You_must_choose_the_Member[$lang]";
              }
              if ($cat == 0){
                $formErrors[] = "$You_must_choose_the_Category[$lang]";
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

            // Vérifiez s'il n'y a pas d'erreur, procédez à l'opération de mise à jour
          // Check if there's no error proceed the update operation
          if (empty($formErrors)){
            $avatar = rand(0, 10000000000) . '_' . $avatarName;
            move_uploaded_file($avatarTmp, "uploads/avatars//" . $avatar);
               // Mettre à jour la base de données avec cette infos
              // Update the database with this infos
              $stmt = $con->prepare("UPDATE
                                        items
                                     SET
                                        Name = ?,
                                        Description = ?,
                                        Price = ?,
                                        Country_Made = ?,
                                        avatar = ?,
                                        Status = ?,
                                        Cat_ID = ?,
                                        Member_ID = ?,
                                        Tags = ?,
                                        Views = Views+1
                                  WHERE
                                        Item_ID = ?");
          $stmt->execute(array($name, $desc, $price, $country, $avatar, $status, $cat, $member, $tags, $id));
              // Echo Success Message

              $theMsg = "<div class='alert alert-success'> " . $stmt->rowCount() . $Record_Updated[$lang] . '</div>';
              redirectHome($theMsg,  'back');
        }
      } else {
          $theMsg =  "<p class='alert alert-danger'>".$Sorry_You_Cant_Browse_This_Page_directly[$lang]."</p>";
          redirectHome($theMsg,  'back');
        }
        echo "</div>";
   } elseif ($do == 'Delete'){ // start Delete page ========================

     echo "<h1 class='text-center'> $Delete_Item[$lang] </h1>";
    echo "<div class='container'>";

  // Vérifiez si vous obtenez l'ID de l'article de demande dans le numéro et en obtenez une valeur entière
     // Check if get request itemid in numeric & get integer value of it
    $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
    // Sélectionnez toutes les données selon cette ID
    // Select all data depend on this ID
     $check = checkItem('Item_ID', 'items', $itemid);
       // s'il existe ID aficher le formulaire
    // if there's such ID show the From
    if ($check > 0){
        $stmt = $con->prepare("DELETE FROM items WHERE Item_ID = :zid");
        $stmt->bindParam(":zid", $itemid);
        $stmt->execute();
        // Echo Success Message

  $theMsg = "<div class='alert alert-success'> " . $stmt->rowCount() . ' ' . $Record_Delete[$lang] . '</div>';
        redirectHome($theMsg,  'back');

    } else {
      $theMsg = '<div class="alert alert-danger">This ID is not Exist </div>' ;
      redirectHome($theMsg);
    }
    echo "</div>";

  } elseif ($do == 'Approve') { // Activate page ================================

    echo "<h1 class='text-center'> $Approve_Item[$lang] </h1>";
   echo "<div class='container'>";

   // Vérifiez si vous obtenez l'ID de l'article de demande dans le numéro et en obtenez une valeur entière
    // Check if get request itemid in numeric & get integer value of it
   $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
   // Sélectionnez toutes les données selon cette ID
   // Select all data depend on this ID
    $check = checkItem('Item_ID', 'items', $itemid);
   // s'il existe ID aficher le formulaire
   // if there's such ID show the From
   if ($check > 0){
       $stmt = $con->prepare("UPDATE items SET Approve = 1 WHERE Item_ID = ?");
       $stmt->execute(array($itemid));
       // Echo Success Message

  $theMsg = "<div class='alert alert-success'> " . $stmt->rowCount() . $Record_Updated[$lang] . '</div>';
  redirectHome($theMsg,  'back');

   } else {
     $theMsg = "<p class='alert alert-danger'>".$This_ID_is_not_Exist[$lang].".</p>";
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

ob_end_flush();

 ?>
