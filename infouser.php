<?php

/*
=======================================
== templates Page
=================================
*/

  ob_start(); // Output Buffering start
session_start();
    $pageTitle = 'Member';
    include 'init.php';


    // Check if get request userid in numeric & get integer value of it
   $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
   // Select all data depend on this ID
   $stmt = $con->prepare("SELECT * FROM users WHERE UserID = ?");
   // Execute Query
   $stmt->execute(array($userid));
   // Fetch The Data
   $row = $stmt->fetch();
   // the row Count
   $count = $stmt->rowCount();
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

<h1 class="text-center"> <?php echo $Profile[$lang]. ' ' . $row['Username'] ?></h1>

<div class="information block">
  <div class="container">
   <div class="row">
     <div class="col-md-2">

       <?php
       echo '<div class="containers">';
       echo "<td>";
       if (empty($row['avatar'])){
            echo "<img class='img-thumbnail img-responsive imageinfouser' src='admin/uploads/default/avatar.png' alt='image' />";
          } else {
            echo "<img class='img-thumbnail img-responsive imageinfouser' src='admin/uploads/avatars/" . $row['avatar'] . "' alt='' />";
          }
       echo  "</td>";
       echo '<div class="middle">';
       echo "<div class='text'> $row[Username] </div>";
       echo '</div>';
       echo '</div>';
        ?>
     </div>
     <div class="col-md-10">
       <div class="panel block-border">
         <div class="panel-heading panel-profile">
           <i class="fa fa-user-secret" aria-hidden="true"> </i>
           <?php echo $Informations[$lang] . ' ' . $row['Username'] ?>
           </div>
           <div class="panel-body">
             <ul class="list-unstyled">
           <li><i class="fa fa-unlock-alt fa-fw"></i> <span><?php echo $Login_Name[$lang] ?></span>: <?php echo $row['Username'] ?> </li>
           <li><i class="fa fa-envelope-o fa-fw"></i> <span><?php echo $Email[$lang] ?></span>: <?php echo $row['Email'] ?> </li>
           <li><i class="fa fa-user fa-fw"></i> <span><?php echo $Full_Name[$lang] ?></span>: <?php echo $row['FullName'] ?> </li>
           <li><i class="fa fa-calendar fa-fw"></i> <span><?php echo $Register_Date[$lang] ?></span>: <?php echo $row['Date'] ?> </li>
           <li><i class="fa fa-tags fa-fw"></i> <span><?php echo $Favourite[$lang] ?></span>: <a href="categories.php?pageid=<?php echo $cat['ID'] ?>"><?php echo $cat['Name'] ?></a></li>

           </ul>

         </div>
       </div>
     </div>

   </div>
  </div>
</div>

<div id="my-ads" class="information block">
  <div class="container">
    <div class="panel block-border">
      <div class="panel-heading panel-profile">
      <i class="fa fa-address-card" aria-hidden="true"></i>
        Items <?php echo $row['Username'] ?>
        </div>
        <div class="panel-body">
            <?php

            if (! empty(getItems('Member_ID', $row['UserID']))){
              echo '<div class="row">';
            foreach (getItems('Member_ID', $row['UserID'], 1) as $item){
              echo '<div class="col-sm-6 col-md-3">';
              echo '<div class="thumbnail item-box card">';
              if ($item['Approve'] == 0){
                echo "<span class='approve-status2'> $Waiting_Approval_you_cant_show_it[$lang]</span>";
              }
              echo '<div class="pull-right fa fa-eye" title="Views">' . ' ' . $item['Views'] . '</div>';
              echo '<span class="price-tag">$' . $item['Price'] . '</span>';
              echo "<br><img class='img-responsive img-profile' src='admin/uploads/avatars/" . $item['avatar'] . "' alt='' />";
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
           Comments <?php echo $row['Username'] ?>
        </div>
        <div class="panel-body my-comment">
          <?php
           $stmt = $con->prepare("SELECT comment FROM comments WHERE user_id = ?");
           // execute the statment
           $stmt->execute(array($row['UserID']));
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
 include $tpl . 'footer.php';
ob_end_flush();





 ?>
