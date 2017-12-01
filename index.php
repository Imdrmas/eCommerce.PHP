<?php
     session_start();
     $pageTitle = 'Homepage';
     //include_once ('includes/langauges/detect_language_class.php');
     include 'init.php'; ?>



     <div class="container show-item">
       <div class="row">
         <div class="searchs">
           <form action="search.php" method="post">
         <input class="search" name="search" type="search" placeholder="Search...">
         <input class="sb-search-submit pull-left" type="submit" name="button" value="">
        <span class="fa fa-search pull-left"></span>
         </form>
         </div>
       </div>
     <div class="row">
       <?php
       $allItems = getAllFrom('*', 'items', 'where Approve = 1', '', 'Item_ID');
       foreach ($allItems as $item){
         echo '<div class="col-sm-6 col-md-3">';
         echo '<div class="thumbnail item-box card">';
         echo '<div class="pull-right fa fa-eye" title="Views">' . ' ' . $item['Views'] . '</div>';
         echo '<span class="price-tag">$' . $item['Price'] . '</span>';
         echo "<img class='img-responsive ' src='admin/uploads/avatars/" . $item['avatar'] . "' alt='' />";
         echo '<div class="caption">';
         echo '<h3><a href="item.php?itemid=' . $item['Item_ID'] . '">' . $item['Name'] .'</a></h3>';
         echo '<p>' . $item['Description'] . '</p>';
         echo '<div class="date">' . $item['Add_Date'] . '</div>';
         echo '</div>';
         echo '</div>';
         echo '</div>';
       }


       ?>
     </div>
     </div>




  <div id="mySidenav" class="sidenav hidden-xs">
<a href="http://localhost/userprofile/index.php" target="_blank" id="about">Group</a>
  <a href="#" id="blog">Blog</a>
  <a href="#" id="projects">Projects</a>
  <a href="#" id="contact">Contact</a>
  </div>

<?php
     include $tpl . 'footer.php';

  ?>
