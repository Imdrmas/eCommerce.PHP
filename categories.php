<?php include 'init.php'; ?>

<div class="container show-item">
<div class="row">

  <?php
  // Check if get request itemid in numeric & get integer value of it
 $category = isset($_GET['pageid']) && is_numeric($_GET['pageid']) ? intval($_GET['pageid']) : 0;
 $allItems = getAllFrom("*", "items", "where Cat_ID = {$category}", "AND Approve = 1", "Item_ID");




 if (! empty($allItems)){
   echo "<h1 class='text-center'> $Show_Category_Items[$lang]
     <i class='fa fa-gift' aria-hidden='true'></i></h1>";
     ?>
      <div class="row">
        <div class="searchs">
          <form action="search.php" method="post">
        <input class="search" name="search" type="search" placeholder="<?php echo $Search[$lang] ?>">
        <input class="sb-search-submit pull-left" type="submit" name="button" value="">
       <span class="fa fa-search pull-left"></span>
        </form>
        </div>
      </div>
      <?php

  foreach ($allItems as $item){
    echo '<div class="col-sm-6 col-md-3">';
    echo '<div class="thumbnail item-box card">';
   echo '<div class="pull-right fa fa-eye" title="Views">' . ' ' . $item['Views'] . '</div>';
    echo "<img class='img-responsive img-categories' src='admin/uploads/avatars/" . $item['avatar'] . "' alt='' />";
    echo '<div class="caption">';
    echo '<h3><a href="item.php?itemid=' . $item['Item_ID'] . '">' . $item['Name'] . '</a></h3>';
    echo '<p>' . $item['Description'] . '</p>';
    echo '<div class="date">' . $item['Add_Date'] . '</div>';
    echo '<span class="price-tag">$' . $item['Price'] . '</span>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
  }
  } else {
          echo "<h1 class='nice-message2 text-center'>".$Theres_No_Items_To_Show[$lang];"</h1>";
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



<?php include $tpl . 'footer.php'; ?>
