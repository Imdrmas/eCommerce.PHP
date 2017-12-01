<?php

/*
=======================================
== categories Page
=================================
*/
  ob_start(); // Output Buffering start
  session_start();
if (isset($_SESSION['Username'])){
    $pageTitle = 'Categories';
    include 'init.php';
 $do = isset($_GET['do']) ? $_GET['do'] : 'Mange';
 if ($do == 'Mange'){ // start manges category page =========================
// Page for arrange the categories
// page pour organiser les categories
   $sort = 'ASC';
   $sort_array = array('ASC', 'DESC');
   if (isset($_GET['sort']) && in_array($_GET['sort'], $sort_array)){
     $sort = $_GET['sort'];
   }
   // Sélectionner toutes les données =FR
   // Select all data
 $stmt2 = $con->prepare("SELECT * FROM categories WHERE Parent = 0 ORDER BY Ordering $sort");
 $stmt2->execute();
  $cats = $stmt2->fetchAll();
  if (!empty($cats)){?>
<h1 class="text-center"><?php echo $Manage_Categories[$lang]; ?></h1>
<div class="container categories">
  <div class="panel panel-default">
    <div class="panel-heading">
      <i class="fa fa-edit"></i> <?php echo $Manage_Categories[$lang];?>
      <div class="option pull-right hidden-xs">
        <i class="fa fa-sort"></i> <?php echo $Ordering[$lang];?> [
        <a class="<?php if ($sort == 'ASC'){ echo 'active'; } ?>" href="?sort=ASC"><?php echo $Asc[$lang];?></a> |
        <a class="<?php if ($sort == 'DESC'){ echo 'active'; } ?>" href="?sort=DESC"><?php echo $DESC[$lang];?> </a>]
        <i class="fa fa-eye"></i> <?php echo $View[$lang]?>: [
        <span class="active" data-view="classic"><?php echo $Full[$lang];?></span> |
        <span data-view="full"><?php echo $Classic[$lang];?> </span>]
      </div>
    </div>
    <div class="panel-body">
      <?php
foreach($cats as $cat){
echo "<div class='cat'>";
echo "<div class='hidden-buttons'>";
     echo "<a href='categories.php?do=Edit&catid=" . $cat['ID'] . "' class='btn btn-primary btn-sm'><i class='fa fa-edit'></i> $Edit[$lang]</a>";
     echo "<a href='categories.php?do=Delete&catid=" . $cat['ID'] . "' class='confirm btn btn-danger btn-sm'><i class='fa fa-close'></i> $Delete[$lang]</a>";
echo "</div>";
echo "<h3>" . $cat['Name'] . '</h3>';
echo "<div class='full-view'>";
echo "<p>"; if ($cat['Description'] == ''){ echo 'This Category has no description'; } else { echo $cat['Description']; }  echo "</p>";
  if ($cat['Visibility'] == 1) { echo "<span class='visibility'><i class='fa fa-eye'></i> $Hidden[$lang] </span>"; }
  if ($cat['Allow_Comment'] == 1) { echo "<span class='commenting'><i class='fa fa-close'></i> $Comment_Disabled[$lang] </span>"; }
  if ($cat['Allow_Ads'] == 1) { echo "<span class='advertises hidden-xs'><i class='fa fa-close'></i> $Ads_Disabled[$lang] </span>"; }
echo "</div>";
// Obtenez des catégories d'enfants
// Get child categories
$childCats = getAllFrom("*", "categories", "WHERE Parent = {$cat['ID']}", "", "ID", "ASC");
if (! empty($childCats)){
  echo "<h4 class='child-head'> Child Categories</h4>";
  echo "<ul class='list-unstyled child-cats child-link'>";
  foreach ($childCats as $c){
  echo "<li>
  <a href='categories.php?do=Edit&catid=" . $c['ID'] . "'>" . $c['Name'] . "</a>
<a href='categories.php?do=Delete&catid=" . $c['ID'] . "' class='confirm show-delete'>$Delete[$lang]</a>
  </li>";
  }
  echo "</ul>";
}
echo "</div>";
echo "<hr>";
}
       ?>
    </div>
  </div>
  <a class="add-category btn btn-primary" href="categories.php?do=Add"> <i class="fa fa-plus"></i> <?php echo $New_Category[$lang];?></a>
</div>
<?php } else {
  echo '<div class="container">';
  echo "<div class='nice-message2'>$Theres_No_Category_To_Show[$lang] Show</div>";
  echo "<a href='categories.php?do=Add' class='btn btn-primary'><i class='fa fa-plus'></i> $New_Category[$lang]</a>";
  echo '</div>';
}
 ?>

<?php } elseif($do == 'Add'){ // start add page ================================= ?>
   <h1 class="text-center"><?php echo $Add_Category[$lang];?></h1>
   <div class="container">
    <form class="form-horizontal" action="?do=Insert" method="POST">
       <!-- start name field -->
       <div class="form-group form-group-lg">
      <label class="col-sm-3 control-label"><?php echo $Name[$lang]; ?></label>
      <div class="col-sm-9 col-md-6">
        <input type="text"
        name="name"
        class="form-control"
        autocomplete="off"
        required="required"
        placeholder="<?php echo $Name_Of_The_Category[$lang]; ?>">
      </div>
    </div>
      <!-- end name field -->
      <!-- start Descriptionfield -->
        <div class="form-group form-group-lg">
     <label class="col-sm-3 control-label"><?php echo $Description[$lang]; ?></label>
     <div class="col-sm-9 col-md-6">
       <input
        type="text"
        name="description"
        class="form-control"
        placeholder="<?php echo $Describe_The_Category[$lang]; ?>">
     </div>
       </div>
     <!-- end Description field -->
     <!-- start Ordering field -->
       <div class="form-group form-group-lg">
    <label class="col-sm-3 control-label"><?php echo $Ordering[$lang];?></label>
    <div class="col-sm-9 col-md-6">
      <input
       type="text"
       name="ordering"
       class="form-control"
       placeholder="<?php echo $Number_to_Arrange_The_Categories[$lang];?>">
    </div>
      </div>
    <!-- end Ordering field -->
    <!-- start parent category field -->
      <div class="form-group form-group-lg">
   <label class="col-sm-3 control-label"><?php echo $Parent[$lang];?></label>
   <div class="col-sm-9 col-md-6">
     <select name="parent">
       <option value="0"><?php echo $None[$lang];?></option>
       <?php
    $allCats = getAllFrom("*", "categories", "WHERE Parent = 0", "", "ID", "ASC");
     foreach($allCats as $cat){
       echo "<option value='" . $cat['ID'] . "'>" . $cat['Name'] . "</option>";
     }
        ?>
     </select>
   </div>
     </div>
   <!-- end parent category field -->
    <!-- start Vidibility field -->
      <div class="form-group form-group-lg">
   <label class="col-sm-3 control-label"><?php echo $ViSibility[$lang];?></label>
   <div class="col-sm-9 col-md-6">
     <div>
       <input id="vis-yes" type="radio" name="vidibility"  value="0" checked>
       <label for="vis-yes"><?php echo $Yes[$lang];?></label>
         </div>
       <div>
         <input id="vis-no" type="radio" name="vidibility" value="1">
         <label for="vis-no"><?php echo $No[$lang];?></label>
       </div>
     </div>
   </div>
   <!-- end Vidibility field -->
   <!-- start Commenting field -->
     <div class="form-group form-group-lg">
  <label class="col-sm-3 control-label"><?php echo $Commenting[$lang];?></label>
  <div class="col-sm-9 col-md-6">
    <div>
      <input id="com-yes" type="radio" name="commenting"  value="0" checked>
      <label for="com-yes"><?php echo $Yes[$lang];?></label>
        </div>
      <div>
        <input id="com-no" type="radio" name="commenting" value="1">
        <label for="com-no"><?php echo $No[$lang];?></label>
      </div>
    </div>
  </div>
  <!-- end Commenting field -->
  <!-- start Allow Ads field -->
    <div class="form-group form-group-lg">
 <label class="col-sm-3 control-label"><?php echo $Allow_Ads[$lang];?></label>
 <div class="col-sm-9 col-md-6">
   <div>
     <input id="ads-yes" type="radio" name="ads"  value="0" checked>
     <label for="ads-yes"><?php echo $Yes[$lang];?></label>
       </div>
     <div>
       <input id="ads-no" type="radio" name="ads" value="1">
       <label for="ads-no"><?php echo $No[$lang];?></label>
     </div>
   </div>
 </div>
 <!-- end Allow Ads field -->
   <!-- start submit field -->
     <div class="form-group form-group-lg">
   <div class="col-sm-offset-3 col-sm-9">
     <input type="submit" name="btn" value="<?php echo $Add_Category[$lang];?>" class="btn btn-primary btn-sm">
   </div>
    </div>
  <!-- end submit field -->
    </form>
  </div>

 <?php } elseif ($do == 'Insert'){ // start Insert category page ======================
      if ($_SERVER['REQUEST_METHOD'] == 'POST'){ ?>
         <?php echo "<div class='container'>"; ?>
        <h1 class="text-center"><?php echo $Insert_Category[$lang]; ?></h1>
        <?php
            // Obtenez une variable à partir du formulaire
            // Get variable from the form
            $name       = $_POST['name'];
            $desc       = $_POST['description'];
            $parent     = $_POST['parent'];
            $order      = $_POST['ordering'];
            $visible    = $_POST['vidibility'];
            $comment    = $_POST['commenting'];
            $ads        = $_POST['ads'];

            // validate the form
            $formErrors = array();
            if (empty($name)){
              $formErrors[] = "$Name_can_not_be_Empty[$lang]";
            }
            // Loop into Errors array et écho
           // Loop into Errors array and echo it
            foreach($formErrors as $error){
              echo '<div class="alert alert-danger">' . $error . '</div>';
            }
          // Vérifier s'il n'y a pas d'erreur, procéder à l'opération de mise à jour
         // Check if there's no error proceed the update operation
         if (empty($formErrors)){

           // vérifie si Catégorie existe dans la base de données
          // check if Category exist in database
          $check = checkItem("Name", "categories", $name);
          if ($check == 1){

            $theMsg = "<p class='alert alert-danger'>".$Sorry_This_Category_Is_Exist[$lang]."</p>";
            redirectHome($theMsg, 'back');
          } else {

        // Insérer l'information utilisateur dans la base de données
        // Insert user info in database
        $stmt = $con->prepare("INSERT INTO
                              categories(Name, Description, Parent, Ordering, Visibility, Allow_Comment, Allow_Ads)
                              VALUES(:zname, :zdesc, :zparent, :zorder, :zvisible, :zcomment, :zads) ");
          $stmt->execute(array(
            'zname'     => $name,
            'zdesc'     => $desc,
            'zparent'   => $parent,
            'zorder'    => $order,
            'zvisible'  => $visible,
            'zcomment'  => $comment,
            'zads'      => $ads
          ));

            // Echo Success Message
            $theMsg = "<div class='alert alert-success'> " . $stmt->rowCount() . ' ' . $Record_Inserted[$lang] . '</div>';
            redirectHome($theMsg, 'back');
       }
       }
      }
      else {
          echo "<div class='container'> ";
          $theMsg =  "<br><p class='alert alert-danger'>".$Sorry_You_Cant_Browse_This_Page_directly[$lang]."</p>";
          redirectHome($theMsg, 'back');
             echo "</div>";
        }
      echo "</div>";
 }
 elseif ($do == 'Edit'){ // start edit page =============================
   // Vérifiez si vous demandez catid en numeric et obtenez une valeur entière
  // Check if get request catid in numeric & get integer value of it
 $catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;
 // Sélectionner toutes les données dépendant de cette ID
 // Select all data depend on this ID
 $stmt = $con->prepare("SELECT * FROM categories WHERE ID = ?");
 // Exécuter la requête
 // Execute Query
 $stmt->execute(array($catid));
 // Récupérer les données
 // Fetch The Data
 $cat = $stmt->fetch();
 // le nombre de lignes
 // the row Count
 $count = $stmt->rowCount();
 // s'il existe un d'identité affichage Le Forme
 // if there's such ID show the Form
 if ($stmt->rowCount() > 0){ ?>
 <h1 class="text-center"><?php echo $Edit_Category[$lang]; ?></h1>
 <div class="container">
  <form class="form-horizontal" action="?do=Update" method="POST">
    <input type="hidden" name="catid" value="<?php echo $catid ?>">
     <!-- start name field -->
     <div class="form-group form-group-lg">
    <label class="col-sm-3 control-label"><?php echo $catégorie[$lang];?></label>
    <div class="col-sm-9 col-md-6">
      <input
      type="text"
      name="name"
      class="form-control"
      value="<?php echo $cat['Name'] ?>"
      required="required"
      placeholder="<?php echo $Name_Of_The_Categoryn[$lang];?>">
    </div>
  </div>
    <!-- end name field -->
    <!-- start Descriptionfield -->
      <div class="form-group form-group-lg">
   <label class="col-sm-3 control-label"><?php echo $Description[$lang];?></label>
   <div class="col-sm-9 col-md-6">
     <input
     type="text"
     name="description"
     class="form-control"
     placeholder="<?php echo $Describe_The_Category[$lang];?>"
     value="<?php echo $cat['Description'] ?>">
   </div>
     </div>
   <!-- end Description field -->
   <!-- start Ordering field -->
     <div class="form-group form-group-lg">
  <label class="col-sm-3 control-label"><?php echo $Ordering[$lang];?></label>
  <div class="col-sm-9 col-md-6">
    <input type="text" name="ordering" class="form-control"
     value="<?php echo $cat['Ordering'] ?>">
  </div>
    </div>
  <!-- end Ordering field -->
  <!-- start parent category field -->
    <div class="form-group form-group-lg">
 <label class="col-sm-3 control-label"><?php echo $Parent[$lang];?></label>
 <div class="col-sm-9 col-md-6">
   <select name="parent">
     <option value="0"><?php echo $None[$lang];?></option>
     <?php
  $allCats = getAllFrom("*", "categories", "WHERE Parent = 0", "", "ID", "ASC");
   foreach($allCats as $c){
     echo "<option value='" . $c['ID'] . "'";
     if ($cat['Parent'] == $c['ID']) {echo ' selected';}
     echo ">" . $c['Name'] . "</option>";
   }
      ?>
   </select>
 </div>
   </div>
 <!-- end parent category field -->
  <!-- start Vidibility field -->
    <div class="form-group form-group-lg">
 <label class="col-sm-3 control-label"><?php echo $ViSibility[$lang];?></label>
 <div class="col-sm-9 col-md-6">
   <div>
     <input id="vis-yes" type="radio" name="vidibility"  value="0" <?php if ($cat['Visibility'] == 0){ echo 'checked';} ?> />
     <label for="vis-yes"><?php echo $Yes[$lang];?></label>
       </div>
     <div>
       <input id="vis-no" type="radio" name="vidibility" value="1" <?php if ($cat['Visibility'] == 1){ echo 'checked';} ?> />
       <label for="vis-no"><?php echo $No[$lang];?></label>
     </div>
   </div>
 </div>
 <!-- end Vidibility field -->
 <!-- start Commenting field -->
   <div class="form-group form-group-lg">
<label class="col-sm-3 control-label"><?php echo $Commenting[$lang];?></label>
<div class="col-sm-9 col-md-6">
  <div>
    <input id="com-yes" type="radio" name="commenting"  value="0" <?php if ($cat['Allow_Comment'] == 0){ echo 'checked';} ?> />
    <label for="com-yes"><?php echo $Yes[$lang];?></label>
      </div>
    <div>
      <input id="com-no" type="radio" name="commenting" value="1" <?php if ($cat['Allow_Comment'] == 1){ echo 'checked';} ?> />
      <label for="com-no"><?php echo $No[$lang];?></label>
    </div>
  </div>
</div>
<!-- end Commenting field -->
<!-- start Allow Ads field -->
  <div class="form-group form-group-lg">
<label class="col-sm-3 control-label"><?php echo $Allow_Ads[$lang];?></label>
<div class="col-sm-9 col-md-6">
 <div>
   <input id="ads-yes" type="radio" name="ads"  value="0" <?php if ($cat['Allow_Ads'] == 0){ echo 'checked';} ?> />
   <label for="ads-yes"><?php echo $Yes[$lang];?></label>
     </div>
   <div>
     <input id="ads-no" type="radio" name="ads" value="1" <?php if ($cat['Allow_Ads'] == 1){ echo 'checked';} ?> />
     <label for="ads-no"><?php echo $No[$lang];?></label>
   </div>
 </div>
</div>
<!-- end Allow Ads field -->
 <!-- start submit field -->
   <div class="form-group form-group-lg">
 <div class="col-sm-offset-3 col-sm-9">
   <input type="submit" name="btn" value="<?php echo $Save[$lang];?>" class="btn btn-primary btn-lg">
 </div>
  </div>
<!-- end submit field -->
  </form>
</div>
<?php
// SI il n'y a pas D'ID affichage Message d'erreur
// IF there's no such ID show Error Message
} else {
  echo "<div class='container'> ";
  $theMsg = "<p class='alert alert-danger'>".$This_ID_is_not_Exist[$lang]."</p>";
  redirectHome($theMsg);
  echo "</div>";
}
 } elseif($do == 'Update'){ // Update page ===================================
   ?>
  <h1 class="text-center"><?php echo $Update_Category[$lang] ?></h1>
          <?php
   echo "<div class='container'>";
      if ($_SERVER['REQUEST_METHOD'] == 'POST'){
             // Obtenez une variable à partir du formulaire
            // Get variable from the form
            $id        = $_POST['catid'];
            $name      = $_POST['name'];
            $desc      = $_POST['description'];
            $order     = $_POST['ordering'];
            $parent     = $_POST['parent'];
            $visible   = $_POST['vidibility'];
            $comment   = $_POST['commenting'];
            $ads       = $_POST['ads'];

            // validate the form
            $formErrors = array();
            if (empty($name)){
              $formErrors[] = "$Name_can_not_be_Empty [$lang]";
            }

            // Loop into Errors array et écho
           // Loop into Errors array and echo it
            foreach($formErrors as $error){
              echo '<div class="alert alert-danger">' . $error . '</div>';
            }
          // Vérifier s'il n'y a pas d'erreur, procéder à l'opération de mise à jour
         // Check if there's no error proceed the update operation
         if (empty($formErrors)){

            // Mettre à jour la base de données avec ceux infos
            // Update the database with those infos
            $stmt = $con->prepare("UPDATE categories
                                   SET
                                    Name = ?,
                                    Description = ?,
                                    Ordering = ?,
                                    Parent = ?,
                                    Visibility = ?,
                                    Allow_Comment = ?,
                                    Allow_Ads = ?
                                     WHERE
                                    ID = ?");
            $stmt->execute(array($name, $desc, $order, $parent, $visible, $comment, $ads, $id));
            // Echo Success Message
            $theMsg = "<div class='alert alert-success'> " . $stmt->rowCount() . ' '. $Record_Updated[$lang] . '</div>';
            redirectHome($theMsg,  'back');
      }

    } else {
        $theMsg =  "<p class='alert alert-danger'>".$Sorry_You_Cant_Browse_This_Page_directly[$lang]."</p>";
        redirectHome($theMsg,  'back');
      }
      echo "</div>";
 }
 elseif ($do == 'Delete'){ // start Delete page ======================== ?>
  <h1 class="text-center"><?php echo $Delete_Category[$lang]; ?></h1>
  <?php
  echo "<div class='container'>";
    // Vérifiez si vous demandez catid en numeric et obtenez une valeur entière
   // Check if get request catid in numeric & get integer value of it
  $catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;
  // Sélectionner toutes les données dépendant de cette ID
  // Select all data depend on this ID
   $check = checkItem('ID', 'categories', $catid);
  // s'il existe un tel message d'identité
  // if there's such ID show the From
  if ($check > 0){
      $stmt = $con->prepare("DELETE FROM categories WHERE ID = :zid");
      $stmt->bindParam(":zid", $catid);
      $stmt->execute();

      // Echo Success Message
$theMsg = "<div class='alert alert-success'> " . $stmt->rowCount() . ' ' . $Record_Deleted[$lang];'</div>';
redirectHome($theMsg,  'back');

  } else {
    $theMsg = "<p class='alert alert-danger'>".$This_ID_is_not_Exist[$lang]."</p>";
    redirectHome($theMsg, 'back');
  }
  echo "</div>";
}
 include $tpl . 'footer.php';
}
else {
header('Location: index.php');
exit();
}
ob_end_flush(); ?>
