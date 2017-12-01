<?php
include_once ('includes/langauges/detect_language_class.php');
 ?>
 <?php ob_start(); // Output Buffering start  ?>
 <div class="upper-bar">
   <div class="container">
     <?php

     if (isset($_SESSION['user'])){
       $getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
       $getUser->execute(array($sessionUser));
       $info = $getUser->fetch();

       echo "<td>";
       if (empty($info['avatar'])){
            echo "<img class='my-image img-thumbnail img-circle' src='admin/uploads/default/avatar.png' alt='image' />";
          } else {
            echo "<img class='my-image img-thumbnail img-circle' src='admin/uploads/avatars/" . $info['avatar'] . "' alt='' />";
          }
       echo  "</td>";

?>
        <div class="btn-group my-info">
          <span class="btn btn-success btn-md dropdown-toggle" data-toggle="dropdown">
              <?php echo $Welcome[$lang] . ' ' . $sessionUser ?>
              <span class="caret"></span>
          </span>
          <ul class="dropdown-menu">
          <li><a href="profile.php"><?php echo $My_Profile[$lang] ?></a></li>
          <li><a href="newad.php"><?php echo $New_Item[$lang] ?></a></li>
          <li><a href="profile.php#my-ads"><?php echo $My_Items[$lang] ?></a></li>
          <li><a href="logout.php"><?php echo $Logout[$lang] ?></a></li>
          </ul>
        </div>
       <?php

     } else {
       ?>
       <a href="login.php">
       <span class="pull-right"><?php echo $Login[$lang] ?>/ <?php echo $Signup[$lang] ?></span>
       </a>
   <?php   } ?>

   </div>
 </div>
 <nav class="navbar navbar-inverse">
   <div class="container">
     <!-- Brand and toggle get grouped for better mobile display -->
     <div class="navbar-header">
       <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-nav" aria-expanded="false">
         <span class="sr-only">Toggle navigation</span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
       </button>
       <a class="navbar-brand navbar-left" href="index.php?lang=en"><?php echo $Elgadah[$lang]; ?></a>
     </div>
     <div class="collapse navbar-collapse" id="app-nav">
       <ul class="nav navbar-nav navbar-left">
        <?php
        $allCats = getAllFrom("*", "categories", "WHERE Parent = 0", "", "ID", "ASC");
        foreach ($allCats as $cat){
          echo '<li><a href="categories.php?pageid=' . $cat['ID'] . '">
          ' . $cat['Name'] . '</a></li>';
        }
         ?>

       </ul>
       <!--start Change language  -->
               <div class="btn-group changeClo pull-right">
         <button type="button" class="btn btn-default dropdown-toggle"
         data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Change language">
           <img src="admin/uploads/default/language.jpg" class="language-img">
         </button>
         <ul class="dropdown-menu english" id="changeColor">
           <li class="dropdown-header">change language</li>
           <li class="change-href">
             <a title="English" href="?lang=en">
             <img src="admin/uploads/default/en_english.png" class="flagfrench-img"><span> English</span></a>
           </li>
           <li class="change-href">
             <a id="french" title="Français" href="?lang=fr">
             <img src="admin/uploads/default/fr_french.png" class="flagfrench-img"><span> Français</span></a>
           </li>
           <li class="change-href">
             <a id="french" title="Arabic" href="?lang=ar" class="inverse-arabic">
             <img src="admin/uploads/default/arabic.png" class="flagfrench-img"><span> العربية</span></a>
           </li>
         </ul>
       </div>
       <!--end Change language  -->
     </div>
   </div>
 </nav>
