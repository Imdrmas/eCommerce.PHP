<?php
     session_start();
     $pageTitle = 'Profile';
     include 'init.php';

     $do = isset($_GET['do']) ? $_GET['do'] : 'Mange';

     if ($do == 'Mange'){

if (isset($_SESSION['user'])){
  $getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
  $getUser->execute(array($sessionUser));
  $info = $getUser->fetch();
      ?>
      <?php
        // Check if get request userid in numeric & get integer value of it
        $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
          // Select all data depend on this ID
         $stmt = $con->prepare("SELECT * FROM categories WHERE prefer = 0");
         // Execute Query
         $stmt->execute(array($userid));
         // Fetch The Data
         $cat = $stmt->fetch();
         // the row Count
         $count = $stmt->rowCount(); ?>

<h1 class="text-center"><?php echo $My_Profile[$lang]; ?> <i class="fa fa-user-md" aria-hidden="true"></i></h1>
<div class="information block">
  <div class="container">
    <div class="panel block-border">
      <div class="panel-heading panel-profile">
        <i class="fa fa-user-secret" aria-hidden="true"></i>
          <?php echo $My_information[$lang]; ?>
        </div>
        <div class="panel-body">
          <ul class="list-unstyled">
        <li><i class="fa fa-unlock-alt fa-fw"></i> <span><?php echo $Login_Name[$lang]; ?></span>: <?php echo $info['Username'] ?> </li>
        <li><i class="fa fa-envelope-o fa-fw"></i> <span><?php echo $Email[$lang]; ?></span>: <?php echo $info['Email'] ?> </li>
        <li><i class="fa fa-user fa-fw"></i> <span><?php echo $Full_Name[$lang]; ?></span>: <?php echo $info['FullName'] ?> </li>
        <li><i class="fa fa-calendar fa-fw"></i> <span><?php echo $Register_Date[$lang]; ?></span>: <?php echo $info['Date'] ?> </li>
        <li><i class="fa fa-tags fa-fw"></i> <span><?php echo $Favourite[$lang]; ?></span>: <a href="categories.php?pageid=<?php echo $cat['ID'] ?>"><?php echo $cat['Name'] ?></a></li>
        </ul>
<?php
    echo  "<a href='profile.php?do=Edit&userid=" . $info['UserID'] . "' class='btn btn-success'>
          <i class='fa fa-edit'></i> $Edit_Info[$lang]</a>";
      echo "<a href='profile.php?do=Delete&userid=" . $info['UserID'] . "' class='btn btn-danger confirm'>
      <i class='fa fa-close'></i> $Delete[$lang]</a>";
        ?>

      </div>
    </div>
  </div>
</div>
<div id="my-ads" class="information block">
  <div class="container">
    <div class="panel block-border">
      <div class="panel-heading panel-profile">
      <i class="fa fa-address-card" aria-hidden="true"></i>
        <?php echo $My_Items[$lang]; ?>
        </div>
        <div class="panel-body">
            <?php
            if (! empty(getItems('Member_ID', $info['UserID']))){
              echo '<div class="row">';
            foreach (getItems('Member_ID', $info['UserID'], 1) as $item){
              echo '<div class="col-sm-6 col-md-3">';
              echo '<div class="thumbnail item-box card">';
              if ($item['Approve'] == 0){
                echo "<span class='approve-status'> $Waiting_Approval[$lang]</span>";
              }
              echo '<div class="pull-right fa fa-eye" title="Views">' . ' ' . $item['Views'] . '</div>';
              echo '<span class="price-tag">$' . $item['Price'] . '</span>';
              echo "<br><img class='img-responsive img-profile ' src='admin/uploads/avatars/" . $item['avatar'] . "' alt='' />";
              echo '<div class="caption">';
              echo '<h3><a href="item.php?itemid=' . $item['Item_ID'] . '">' . $item['Name'] .'</a></h3>';
              echo '<p>' . $item['Description'] . '</p>';
              echo '<div class="date">' . $item['Add_Date'] . '</div>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
            }
            echo '</div>';
          } else {
            echo "<div class='msg-no-show'> $Sorry_Theres_No_Items_To_Show_Create[$lang] <a href='newad.php'> $New_Ad[$lang] </a></div>";
          }
            ?>
      </div>
    </div>
  </div>
</div>
<div class="information block">
  <div class="container">
    <div class="panel block-border">
      <div class="panel-heading panel-profile">
        <i class="fa fa-comments" aria-hidden="true"></i>
          <?php echo $Latest_comments[$lang]; ?>
        </div>
        <div class="panel-body my-comment">
          <?php
           $stmt = $con->prepare("SELECT comment FROM comments WHERE user_id = ?");
           // execute the statment
           $stmt->execute(array($info['UserID']));
           // assign to variable
           $comments = $stmt->fetchAll();
           if (! empty($comments)){
             foreach ($comments as $comment){
               echo '<p class="lead">' . $comment['comment'] . '</p>';
               }
             } else{
            echo "<div class='msg-no-show'> $Theres_No_Comments_To_Show[$lang] </div>";
           }
           ?>
      </div>
    </div>
  </div>
</div>
<?php
} else{
header('Location: login.php');
       exit();
}
} elseif ($do == 'Edit'){ // start edit page =============================

  // Check if get request userid in numeric & get integer value of it
 $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
 // Select all data depend on this ID
 $stmt = $con->prepare("SELECT * FROM users WHERE UserID = ? LIMIT 1");
 // Execute Query
 $stmt->execute(array($userid));
 // Fetch The Data
 $row = $stmt->fetch();
 // the row Count
 $count = $stmt->rowCount();
 // if there's such ID show the From
 if ($stmt->rowCount() > 0){
   // IF there's no such ID show Error Message

 ?>
   <h1 class="text-center"><?php echo $Edit_Informations[$lang]; ?></h1>
   <div class="container">
    <form class="form-horizontal" action="?do=Update" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="userid" value="<?php echo $userid ?>">
       <!-- start Username field -->
       <div class="form-group form-group-lg">
      <label class="col-sm-3 control-label"><?php echo $Username[$lang]; ?></label>
      <div class="col-sm-9 col-md-6">
        <input
        type="text"
        name="username"
        class="form-control"
        value="<?php echo $row['Username'] ?>"
        autocomplete="off"
        required="required">
      </div>
    </div>
      <!-- end Username field -->
      <!-- start Password field -->
        <div class="form-group form-group-lg">
     <label class="col-sm-3 control-label"><?php echo $Password[$lang]; ?></label>
     <div class="col-sm-9 col-md-6">
       <input type="hidden" name="oldpassword" value="<?php echo $row['Password'] ?>" >
       <input
       type="password"
       name="newpassword"
       class="form-control"
       autocomplete="new-password"
       placeholder="<?php echo $Leave_blank_if_you_dont_want_to_change[$lang]; ?>">
     </div>
       </div>
     <!-- end Username field -->
     <!-- start Email field -->
       <div class="form-group form-group-lg">
    <label class="col-sm-3 control-label"><?php echo $Email[$lang]; ?></label>
    <div class="col-sm-9 col-md-6">
      <input
      type="email"
      name="email"
      value="<?php echo $row['Email'] ?>"
      class="form-control"
      required="required">
    </div>
      </div>
    <!-- end Email field -->
    <!-- start FullName field -->
      <div class="form-group form-group-lg">
   <label class="col-sm-3 control-label"><?php echo $Full_Name[$lang]; ?></label>
   <div class="col-sm-9 col-md-6">
     <input
     type="text"
     name="full"
     value="<?php echo $row['FullName'] ?>"
     class="form-control"
     required="required">
   </div>
    </div>
   <!-- end FullName field -->
   <!-- start User Avatar field -->
     <div class="form-group form-group-lg">
  <label class="col-sm-3 control-label"><?php echo $User_Avatar[$lang]; ?></label>
  <div class="col-sm-9 col-md-6">
    <input
    type="file"
    name="avatar"
    class="form-control"
    required="required">
  </div>
   </div>
  <!-- end User Avatar field -->
   <!-- start submit field -->
     <div class="form-group form-group-lg">
   <div class="col-sm-offset-3 col-sm-9">
     <input
     onclick="updatedata();"
     id="update"
     type="submit"
     name="btn"
     value="<?php echo $Save[$lang]; ?>"
     class="btn btn-primary btn-md">
   </div>
    </div>
  <!-- end submit field -->
    </form>
  </div>
<?php

// IF there's no such ID show Error Message
} else {
  echo "<div class='container'> ";
  $theMsg = "<br> <div class='alert alert-danger'> $This_ID_is_not_Exist[$lang] </div>" ;
  redirectHome($theMsg);
  echo "</div>";
}
}
elseif($do == 'Update'){ // Update page ===================================
 echo "<h1 class='text-center'> $Update_Member[$lang] </h1>";
 echo "<div class='container'>";
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

          // Get variable from the form
          $id    = $_POST['userid'];
          $user  = $_POST['username'];
          $email = $_POST['email'];
          $name  = $_POST['full'];
           // Password Trick
           $pass = '';
           $pass = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);

          // validate the form
          $formErrors = array();

          if (strlen($user) < 4){
            $formErrors[] = "$Usernam_cant_be_less[$lang]";
          }
          if (strlen($user) > 20){
            $formErrors[] = "$Username_cannot_be_more[$lang]";
          }
          if (empty($user)){
            $formErrors[] = "$Username_can_not_be_Empty[$lang]";
          }
          if (empty($name)){
            $formErrors[] = "$Full_Name_cannot_be_Empty[$lang]";
          }
          if (empty($email)){
            $formErrors[] = "$Email_cannot_be_Empty[$lang]";
          }
         // Loop into Errors array and echo it
          foreach($formErrors as $error){
             echo '<div class=" alert alert-danger">' . $error . '</div>';
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
          $theMsg =  "<div class='alert alert-danger'> $Sorry_This_User_Is_Exist[$lang]</div>";
          redirectHome($theMsg,  'back');
        } else {

      // Check if there's no error proceed the update operation
      if (empty($formErrors)){
        $avatar = rand(0, 10000000000) . '_' . $avatarName;
        move_uploaded_file($avatarTmp, "admin/uploads/avatars//" . $avatar);

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


          //Echo Success Message
          echo "<div class='alert alert-success'> " . $stmt->rowCount() . ' ' . $Informations_Edited_Login_to_Enjoy[$lang] . '</div>';
         header("Refresh:1; url=logout.php");
         exit();



    }
  }
  }
   else {
      $theMsg =  "<div class='alert alert-danger'> $Sorry_You_Cant_Browse_This_Page_directly[$lang] </div>";
      redirectHome($theMsg,  'back');


    }   echo "</div>";
}
elseif ($do == 'Delete'){ // start Delete page ========================

  echo "<h1 class='text-center'> $Delete_Member[$lang] </h1>";
 echo "<div class='container'>";
  // Check if get request userid in numeric & get integer value of it
 $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
 // Select all data depend on this ID
  $check = checkItem('userid', 'users', $userid);

 // if there's such ID show the From
 if ($check > 0){
     $stmt = $con->prepare("DELETE FROM users WHERE UserID = :zuser");
     $stmt->bindParam(":zuser", $userid);
     $stmt->execute();

     // Echo Success Message
     echo "<div class='alert alert-danger'> " . $stmt->rowCount() . $Record_Deleted[$lang] . '</div>';
   header("Refresh:1; url=logout.php");
   exit();

 } else {
   $theMsg = "<div class='alert alert-danger'> $This_ID_is_not_Exist[$lang] </div>" ;
   redirectHome($theMsg);
 }
 echo "</div>";

}
     include $tpl . 'footer.php';

  ?>
