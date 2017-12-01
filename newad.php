<?php
ob_start(); // Output Buffering start
     session_start();
     $pageTitle = 'Create New Item';
     include 'init.php';
if (isset($_SESSION['user'])){
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

  // Upload variables
  $avatarName  = $_FILES['avatar']['name'];
  $avatarSize  = $_FILES['avatar']['size'];
  $avatarTmp   = $_FILES['avatar']['tmp_name'];
  $avatarType  = $_FILES['avatar']['type'];

  // list of allowed file typed to Upload
  $avatarAllowedExtension = array("jpeg", "jpg", "png", "gif");
   // Get avatar Extension
   $explode = explode(".", $avatarName);
   $avatarExtension = end($explode);

  $formErrors = array();
  $name       = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
  $desc       = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
  $price      = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
  $country    = filter_var($_POST['country'], FILTER_SANITIZE_STRING);
  $status     = filter_var($_POST['status'], FILTER_SANITIZE_NUMBER_INT);
  $category   = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
  $tags       = filter_var($_POST['tags'], FILTER_SANITIZE_STRING);

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
   // Check if there's no error proceed the update operation
   if (empty($formErrors)){
     $avatar = rand(0, 10000000000) . '_' . $avatarName;
     move_uploaded_file($avatarTmp, "admin/uploads/avatars//" . $avatar);

   // Insert userinfo in database
   $stmt = $con->prepare("INSERT INTO
                         items(Name, Description, Price, Country_Made, avatar, Status, Add_Date, Cat_ID, Member_ID, Tags)
                         VALUES(:zname, :zdesc, :zprice, :zcountry, :zavatar, :zstatus, now(), :zcat, :zmember, :ztags) ");
     $stmt->execute(array(
       'zname'     => $name,
       'zdesc'     => $desc,
       'zprice'    => $price,
       'zcountry'  => $country,
       'zavatar'   => $avatar,
       'zstatus'   => $status,
       'zcat'      => $category,
       'zmember'   => $_SESSION['uid'],
       'ztags'     => $tags


     ));
       // Echo Success Message
       echo "<div class='container'><br>";
       $theMsg = "<div class='alert alert-success'> " . $stmt->rowCount() . ' ' . $Item_Added[$lang] .'</div>';
       redirectHome($theMsg, 'back');
       echo "</div>";
  }
}

      ?>

<h1 class="text-center"> <?php echo $Create_New_Item[$lang] ?> <i class="fa fa-pencil" aria-hidden="true"></i></h1>
<div class="create-ad">
  <div class="container">
    <div class="panel block-border">
      <div class="panel-heading panel-profile">
        <i class="fa fa-unsorted"></i>
        <?php echo $Create_New_Item[$lang] ?>
        </div>
        <div class="panel-body">
        <div class="row">
         <div class="col-md-8">
           <form class="form-horizontal main-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
              <!-- start name field -->
              <div class="form-group form-group-lg">
             <label class="col-sm-3 control-label"><?php echo $Name[$lang] ?></label>
             <div class="col-sm-9 col-md-9">
               <input
               pattern=".{4,}"
               title="<?php echo $This_Field_Required_At_Least_Characters[$lang] ?>"
                type="text"
                name="name"
                class="form-control live"
                required="required"
                placeholder="<?php echo $Name_Of_The_Item[$lang] ?>"
                data-class=".live-title">
             </div>
           </div>
             <!-- end name field -->
             <!-- start Description field -->
             <div class="form-group form-group-lg">
            <label class="col-sm-3 control-label"><?php echo $Description[$lang] ?></label>
            <div class="col-sm-9 col-md-9">
              <input
               pattern=".{10,40}"
               title="This field Must Be between 10 & 40 Characters"
               type="text"
               name="description"
               class="form-control live"
               required="required"
               placeholder="<?php echo $Description_of_the_item[$lang] ?>"
               data-class=".live-desc">
            </div>
          </div>
            <!-- end Description field -->
            <!-- start Price field -->
            <div class="form-group form-group-lg">
           <label class="col-sm-3 control-label"><?php echo $Price[$lang] ?></label>
           <div class="col-sm-9 col-md-9">
             <input
              type="text"
              name="price"
              class="form-control live"
              required="required"
              placeholder="<?php echo $Price_of_the_item[$lang] ?>"
              data-class=".live-price">
           </div>
           </div>
           <!-- end Price field -->
           <!-- start Country field -->
           <div class="form-group form-group-lg">
          <label class="col-sm-3 control-label"><?php echo $Country[$lang] ?></label>
          <div class="col-sm-9 col-md-9">
            <input
             pattern=".{2,}"
             title="<?php echo $This_Field_Must_Be_Least_Characters[$lang] ?>"
             type="text"
             name="country"
             class="form-control"
             required="required"
             placeholder="<?php echo $Country_of_Mede[$lang]?>">
          </div>
          </div>
          <!-- end Country field -->
          <!-- start User Avatar field -->
            <div class="form-group form-group-lg">
         <label class="col-sm-3 control-label"><?php echo $Image[$lang] ?></label>
         <div class="col-sm-9 col-md-9">
           <input type="file" name="avatar" class="form-control" required="required">
         </div>
          </div>
         <!-- end User Avatar field -->
          <!-- start Status field -->
          <div class="form-group form-group-lg">
         <label class="col-sm-3 control-label"><?php echo $Status[$lang] ?></label>
         <div class="col-sm-9 col-md-9">
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
        <!-- start Categories field -->
        <div class="form-group form-group-lg">
       <label class="col-sm-3 control-label"><?php echo $Categories[$lang]; ?></label>
       <div class="col-sm-9 col-md-9">
         <select name="category">
           <option value="0">...</option>
           <?php
           $cats = getAllFrom('*', 'categories', 'where Parent = 0', '', 'ID');
            foreach ($cats as $cat){
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
       <div class="col-sm-9 col-md-9">
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
            <input type="submit" name="btn" value="<?php echo $Add_Item[$lang] ?>" class="btn btn-success">
          </div>
           </div>
         <!-- end submit field -->
           </form>
         </div>
         <div class="col-md-4">
            <div class="thumbnail item-box live-preview">
              <span class="price-tag">
                $<span class="live-price">0</span>
              </span>
              <img class="img-responsive img-thumbnail img-default" src="admin/uploads/default/imgs.png" alt="image">
              <div class="caption">
                <h3 class="live-title"><?php echo $Title[$lang] ?></h3>
                <p class="live-desc"><?php echo $Description[$lang] ?></p>
              </div>
            </div>
         </div>
        </div>
        <!-- start loopiong throught errors -->
  <?php if (! empty($formErrors)){
    foreach ($formErrors as $error){
      echo '<div class="alert alert-danger">' . $error . '</div>';
    }
  } ?>
      <!-- end loopiong throught errors -->
      </div>
    </div>
  </div>
</div>

<?php } else{
header('Location: login.php');
       exit();
}
     include $tpl . 'footer.php';
ob_end_flush();
  ?>
