<?php
     session_start();
     $pageTitle = 'Show Items';

     include 'init.php';
   include_once ('includes/langauges/detect_language_class.php');
  // Check if get request item is number & get its integer value
 $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
  // select All data depend on this id
   $stmt = $con->prepare("SELECT
                            items.*,
                            categories.Name AS category_name,
                            users.Username, users.UserID, items.avatar As Avatars
                        FROM
                           items
                        INNER JOIN
                           categories
                        ON
                           categories.ID = items.Cat_ID
                        INNER JOIN
                           users
                        ON
                        users.UserID = items.Member_ID
                        WHERE
                           Item_ID = ?
                        AND
                         Approve = 1");
  // execute Query
  $stmt->execute(array($itemid));
  $count = $stmt->rowCount();
  if ($count > 0){
  // fetch the data
  $item = $stmt->fetch();
?>
<h1 class="text-center"><?php echo $item['Name'] ?></h1>
<div class="container">
  <div class="row">
   <div class="col-md-3">
     <?php echo "<img class='img-responsive img-block item-img card'
     src='admin/uploads/avatars/" . $item['Avatars'] . "' alt='' />"; ?>
    <h4 class="text-center views"> Views: <?php  echo $item['Views']; ?></h4>
   </div>
   <div class="col-md-9 item-info">
   <h3 class="title-desc-item"><i class="fa fa-audio-description" aria-hidden="true"></i><?php echo $Informations_Item[$lang] ?></h3>
   <p class="lead description-item"><?php echo $item['Description'] ?></p>
   <ul class="list-unstyled">
   <li>
     <i class="fa fa-calendar fa-fw"></i>
     <span><?php echo $Added_Date[$lang] ?></span> : <?php echo $item['Add_Date'] ?>
   </li>
   <li>
     <i class="fa fa-money fa-fw"></i>
     <span><?php echo $Price[$lang] ?></span> : $<?php echo $item['Price'] ?>
   </li>
   <li>
     <i class="fa fa-building fa-fw"></i>
     <span><?php echo $Made_In[$lang] ?></span> : <?php echo $item['Country_Made'] ?>
   </li>
   <li>
     <i class="fa fa-tags fa-fw"></i>
     <span><?php echo $Category[$lang] ?></span> : <a href="categories.php?pageid=<?php echo $item['Cat_ID'] ?>"><?php echo $item['category_name'] ?></a>
   </li>
   <li>
     <i class="fa fa-user fa-fw"></i>
  <?php
  echo "<span> $Added_By[$lang] </span> : <a href='infouser.php?&userid=" . $item['UserID'] . "'>". $item['Username'] . "</a>";
   ?>
   </li>
   <li>
     <i class="fa fa-link fa-fw"></i>
     <span><?php echo $Tags[$lang] ?></span> :
     <?php
      $allTags = explode(",", $item['Tags']);
      foreach ($allTags as $tag){
        $tag = str_replace(' ', '', $tag);
        $lowertag = strtolower($tag);
        if (! empty($tag)){
        echo "<a href='tags.php?name={$lowertag}' class='tags-items'>" . $tag . '</a> ';
      }
      }
      ?>
   </li>
    </ul>
   </div>
 </div>
 <hr class="custom-hr">
 <?php if (isset($_SESSION['user'])){ ?>
 <!-- start add comment -->
<div class="row">
  <div class="col-md-offset-3 col-md-5">
    <div class="add-comment">
    <h3><?php echo $Add_Your_Comment[$lang] ?></h3><br>
    <form action="<?php echo $_SERVER['PHP_SELF'] . '?itemid=' . $item['Item_ID'] ?>" method="POST">
      <textarea class="form-control" name="comment" required></textarea>
      <input class="btn btn-success" type="submit" value="<?php echo $Add_Comment[$lang]?>">
    </form>
    <?php
     if ($_SERVER['REQUEST_METHOD'] == 'POST'){


       $formErrors = array();
       $comment   = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
       $itemid    = $item['Item_ID'];
       $userid    = $_SESSION['uid'];

       if (isset($comment )){
         $filterdUser = filter_var($comment, FILTER_SANITIZE_STRING);
         if (strlen($comment) < 4){
           $formErrors[] = "$The_Message_Must_Be_Between_Characters[$lang]";
         }
         if (strlen($comment ) > 60){
           $formErrors[] = "$The_Message_Must_Be_Between_Characters[$lang]";
         }
       }
       foreach($formErrors as $error){
         echo '<br><div class="alert alert-danger">' . $error . '</div>';
       }
       if (empty($formErrors)){

    if (! empty($comment)){
      $stmt = $con->prepare("INSERT INTO
                    comments(Comment, Status, Comment_date, item_id, user_id)
                    VALUES(:zcomment, 0, NOW(), :zitemid, :zuserid)");
          $stmt->execute(array(
            'zcomment' => $comment,
            'zitemid'  => $itemid,
            'zuserid'  => $userid
          ));
          if ($stmt){
            echo "<br><div class='alert alert-success'> $Comment_Added[$lang] </div>";
          }
    }
    } else {
        echo "<div class='alert alert-danger'> $You_Must_Add_Comment[$lang] </div>";
    }
     }
     ?>
    </div>
  </div>
</div>
 <!-- end add comment -->
 <?php } else {
   echo "<div class='msg-no-show'><a href='login.php'> $Login[$lang] </a> $Or[$lang] <a href='login.php'> $Register[$lang] </a>  $To_Add_Comments[$lang]</div>";
 } ?>
 <hr class="custom-hr">
 <?php
// Selcet All users except admin
$stmt = $con->prepare("SELECT
                         comments.*, users.Username AS Member, users.avatar AS Avatar
                    FROM
                        comments
                   INNER JOIN
                        users
                    ON
                       users.UserID = comments.user_id
                     WHERE
                       item_id = ?
                     AND
                       Status = 1
                     ORDER BY
                     C_id DESC");
  // execute the statment
  $stmt->execute(array($item['Item_ID']));
  // assign to variable
  $comments = $stmt->fetchAll(); ?>


   <?php
   foreach ($comments as $comment){ ?>
  <div class="comment-box">
    <div class="row">
     <div class=" col-md-2 text-center card">
       <?php echo "<img class='img-responsive img-circle img-block my-img '
       src='admin/uploads/avatars/" . $comment['Avatar'] . "' alt='' />"; ?>
      <?php
      echo  '<span class="member-n">
            <a href="infouser.php?do=Edit&userid=' . $comment['user_id'] . '">
            '. $comment['Member'] . '</a></span>';
      ?>
     </div>
     <div class="col-md-10">
       <p class="lead"><?php echo $comment['Comment'] ?></p>
       </div>
    </div>
  </div>
   <hr class="custom-hr">
  <?php }  ?>
</div>

<?php
$stmt = $con->prepare("UPDATE items SET Views = Views+1 WHERE Item_ID = ?");
$stmt->execute(array($itemid));
 ?>


<?php } else {
  echo '<div class="container">';
  echo "<br><div class='alert alert-danger'>$Theres_NoSuchIDOrThisItemIsAwaitingApproval[$lang]</div>";
  echo '</div>';
}
 include $tpl . 'footer.php';
  ?>
