<?php

  ob_start(); // Output Buffering start
  session_start();
     if (isset($_SESSION['Username'])){
         $pageTitle = 'Dashboard';

         include 'init.php';

     // Nombre de derniers utilisateurs =FR
    // Number of latest users
    $numUsers = 5;
     // dernier rang d'utilisateurs =FR
    // latest Users Array
    $latestUsers = getLatest("*", "users", "UserID", $numUsers);

       $numItems = 5;
       // number of latest items
       // latest items Array
       $latestItems = getLatest("*", 'items', 'Item_ID', $numItems);

       // Number of Comments
       $numComments = 5; ?>

    <div class="home-stats">
    <div class="container text-center">
      <h1><?php echo $Dashboard[$lang];?></h1>
      <div class="row">
        <div class="col-md-3">
          <div class="stat st-member">
           <i class="fa fa-users"></i>
          <div class="info">
            <?php echo $Total_Members[$lang]; ?>
            <span><a href="members.php"><?php echo countItems('UserID', 'users') ?></a></span>
          </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="stat st-pending">
            <i class="fa fa-user-plus"></i>
          <div class="info">
            <?php echo $Pending_Members[$lang]; ?>
              <span><a href="members.php?do=Mange&page=Pending"><?php echo checkItem("RegStatus", "users", 0) ?> </a></span>
          </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="stat st-items">
            <i class="fa fa-tags"></i>
            <div class="info">
            <?php echo $Total_Items[$lang]; ?>
                <span><a href="Items.php"><?php echo countItems('Item_ID', 'items') ?></a></span>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="stat st-comment">
            <i class="fa fa-comments"></i>
           <div class="info">
            <?php echo $Total_Comments[$lang]; ?>
             <span><a href="comments.php"><?php echo countItems('C_id', 'comments') ?></a></span>
           </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<div class="latesst">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <i class="fa fa-users"></i> <?php echo $Latest_Registered_Users[$lang]; ?>
              <span class="toggle-info pull-right">
               <i class="fa fa-plus fa-lg"></i>
              </span>
            </div>
            <div class="panel-body">
              <ul class="list-unstyled latesst-users">
                <?php
                 if (! empty($latestUsers)){
                 foreach ($latestUsers as $user){
                       echo '<li>';
                       echo $user['Username'];
                       echo '<a href="members.php?do=Edit&userid=' . $user['UserID'] . '">';
                       echo '<span class="btn btn-success pull-right">';
                       echo "<i class='fa fa-edit'></i> $Edit[$lang]" ;
                if ($user['RegStatus'] == 0){
                       echo  "<a href='members.php?do=Activate&userid=" . $user['UserID'] . "'
                            class='btn btn-info pull-right activate'><i class='fa fa-check'></i> $Approve[$lang]</a>";
                            }
                       echo '</span>';
                       echo '</a>';
                       echo  '</li>';
                         }
              } else {
                      echo "<p class='nice-message2'>".$Theres_no_memeber_to_show[$lang];"</p>";
                     }
                    ?>
               </ul>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <i class="fa fa-tags"></i> <?php echo $Latest_Items[$lang];?>
              <span class="toggle-info pull-right">
               <i class="fa fa-plus fa-lg"></i>
              </span>
            </div>
            <div class="panel-body">
              <ul class="list-unstyled latesst-users">
                <?php
                    if (!empty($latestItems)){
                    foreach ($latestItems as $item){
                        echo '<li>';
                        echo $item['Name'];
                        echo '<a href="Items.php?do=Edit&itemid=' . $item['Item_ID'] . '">';
                        echo '<span class="btn btn-success pull-right">';
                        echo "<i class='fa fa-edit'></i> $Edit[$lang]";
                    if ($item['Approve'] == 0){
                        echo  "<a href='Items.php?do=Approve&itemid=" . $item['Item_ID'] . "'
                             class='btn btn-info pull-right activate'><i class='fa fa-check'></i> $Approve[$lang]</a>";
                             }
                        echo '</span>';
                        echo '</a>';
                        echo  '</li>';
                          }
                  }else {
                        echo "<p class='nice-message2'>".$Theres_No_Item_To_Show[$lang]."</p>";
                        }
                   ?>
           </ul>
            </div>
          </div>
        </div>
      </div>
      <!-- start latest comments -->
      <div class="row">
        <div class="col-sm-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <i class="fa fa-comments-o"></i>
              <?php echo $Latest_Comments[$lang];?>
              <span class="toggle-info pull-right">
               <i class="fa fa-plus fa-lg"></i>
              </span>
            </div>
            <div class="panel-body">
          <ul class="list-unstyled latesst-users">
            <?php
    // select all users except admin
     $stmt = $con->prepare("SELECT
                                  comments.*, users.Username AS Member
                             FROM
                                  comments
                             INNER JOIN
                                 users
                             ON
                                  users.UserID = comments.user_id
                              ORDER BY
                                 C_id DESC
                              LIMIT $numComments");
                      $stmt->execute();
                      $comments = $stmt->fetchAll();
                      if (!empty($comments)){
                foreach ($comments as $comment){
                  echo '<div class="comment-box">';
                  echo  '<span class="member-n">
                        <a href="members.php?do=Edit&userid=' . $comment['user_id'] . '">
                        '. $comment['Member'] . '</a></span>';
                  echo  '<p class="member-c lead">' . $comment['Comment'] . '</p>' ;
                  echo '</div>';
                }
              } else {
                echo "<p class='nice-message2'>".$Theres_No_Comments_To_Show[$lang].".</p>";
              }
                    ?>
           </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <?php
    // end Dashboard Page
         include $tpl . 'footer.php';
     }
       else {
       header('Location: index.php');
       exit();
     }
ob_end_flush();
?>
