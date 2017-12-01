<?php include 'init.php'; ?>

<div class="container show-item">


<div class="row">
  <?php
  // Check if get request itemid in numeric & get integer value of it
if (isset($_GET['name'])){
  echo "<h1 class='text-center'>" . $_GET['name'] . " <i class='fa fa-gift'></i></h1>";
  $tag = $_GET['name'];
 $tagItems = getAllFrom("*", "items", "where Tags like '%$tag%'", "AND Approve = 1", "Item_ID");
  foreach ($tagItems as $item){
    echo '<div class="col-sm-6 col-md-3">';
    echo '<div class="thumbnail item-box">';
    echo '<span class="price-tag">$' . $item['Price'] . '</span>';
    echo "<img class='img-responsive img-block item-img'
    src='admin/uploads/avatars/" . $item['avatar'] . "' alt='' />";
    echo '<div class="caption">';
    echo '<h3><a href="item.php?itemid=' . $item['Item_ID'] . '">' . $item['Name'] .'</a></h3>';
    echo '<p>' . $item['Description'] . '</p>';
    echo '<div class="date">' . $item['Add_Date'] . '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
  }
} else {
  echo '<div class="alert alert-danger"> There\'s no Id </div>';
}
  ?>
</div>
</div>

<?php include $tpl . 'footer.php'; ?>
