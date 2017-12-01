

  <section class="footer">
      <div class="col-md-offset-1 col-md-3 col-sm-6">
        <h4>Categories</h4>
        <ul class="list-unstyled least-cats">
         <?php

         $allCats = getAllFrom("*", "categories", "", "", "ID", "ASC");
         foreach ($allCats as $cat){

           echo '<li><i class="fa fa-check-circle-o" aria-hidden="true">
           </i><a href="categories.php?pageid=' . $cat['ID'] . '">
           ' . $cat['Name'] . '</a></li>';
         }
          ?>
        </ul>
      </div>
      <div class="col-md-4 col-sm-6">

     <h4>Learn More</h4>
    <ul class="list-unstyled least-cats">
      <li><i class="fa fa-check-circle-o"></i><a href="#">Home</a></li>
      <li><i class="fa fa-check-circle-o"></i><a href="#">About us</a></li>
      <li><i class="fa fa-check-circle-o"></i><a href="#">Contact us</a></li>
      <li><i class="fa fa-check-circle-o"></i><a href="#">News</a></li>
      <li><i class="fa fa-check-circle-o"></i><a href="#">Features</a></li>
      <li><i class="fa fa-check-circle-o"></i><a href="#">Blog</a></li>
      <li><i class="fa fa-check-circle-o"></i><a href="#">Store</a></li>
      <li><i class="fa fa-check-circle-o"></i><a href="#">Ask For help</a></li>
    </ul>


      </div>
    <div class="logo">
      <div class="col-md-4 col-sm-12">
        <h3>Elgadah</h3>
      <img class="img-responsive img-logo" src="admin/uploads/default/logo.png" alt="">

      <ul class="list-unstyled">
    <li><i class="fa fa-facebook-square fa-logo" aria-hidden="true"></i></li>
    <li><i class="fa fa-twitter-square fa-logo" aria-hidden="true"></i></li>
    <li><i class="fa fa-google-plus-square fa-logo" aria-hidden="true"></i></li>
    <li><i class="fa fa-instagram fa-logo" aria-hidden="true"></i></li>
      <h5>Copyright © 2017 Asmail Alfadil</h5>
      </ul>
      </div>
    </div>
  </section>

  <div class="container">

  </div>


<script src="<?php  echo $js; ?>jquery-3.2.1.min.js"></script>
<script src="<?php  echo $js; ?>jquery-ui.min.js"></script>
<script src="<?php  echo $js; ?>bootstrap.min.js"></script>
<script src="<?php  echo $js; ?>jquery.selectBoxIt.min.js"></script>
<script src="<?php  echo $js; ?>frent.js"></script>
</body>
</html>
