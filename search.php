
<?php
session_start();
    $pageTitle = 'Search';
    include 'init.php';



if(isset($_POST['button'])){    //trigger button click
  $search = $_POST['search'];
  $stmt = $con->prepare("select * from items where Name like '%{$search}%' || Description like '%{$search}%' ");
  $stmt->execute();
  // assigner à la variable
  // assign to variable
  $items = $stmt->fetchAll();

if (! empty($items)){
    ?>

        <div class="container show-item">
        <div class="row">
          <h1 class="text-center"> <?php echo $Result_of_search [$lang] ?> <i class="fa fa-search-minus hidden-xs" aria-hidden="true"></i></h1>
          <?php
          foreach ($items as $item){
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
<?php
} else {
     echo "<div class='container'> ";
     $theMsg =  "<br><p class='alert alert-danger'>" . $Sorry_No_result[$lang] . "</p>";
     redirectHome($theMsg);
        echo "</div>";
   }
}


?>
<?php
     include $tpl . 'footer.php';

  ?>
