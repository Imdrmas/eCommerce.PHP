<?php
include_once ('includes/langauges/detect_language_class.php');
 ?>
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
      <a class="navbar-brand" href="dashboard.php"><?php echo "<p>".$Elgadah[$lang]."</p>"; ?></a>
    </div>
    <div class="collapse navbar-collapse" id="app-nav">
      <ul class="nav navbar-nav">
        <li><a href="categories.php"><?php echo "<p>".$Categories[$lang]."</p>"; ?></a></li>
        <li><a href="Items.php"><?php echo "<p>".$Items[$lang]."</p>"; ?></a></li>
        <li><a href="members.php"><?php echo "<p>".$Members[$lang]."</p>"; ?></a></li>
        <li><a href="comments.php"><?php echo "<p>".$Comments[$lang]."</p>"; ?></a></li>
    </ul>
<!--start Change language  -->
        <div class="btn-group changeClo">
  <button type="button" class="btn btn-default dropdown-toggle"
  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Change language">
    <img src="uploads/default/language.jpg" class="language-img">
  </button>
  <ul class="dropdown-menu english" id="changeColor">
    <li class="dropdown-header">Change language</li>
    <li class="change-href">
      <a title="English" href="?lang=en">
      <img src="uploads/default/en_english.png" class="flagfrench-img"><span> English</span></a>
    </li>
    <li class="change-href">
      <a id="french" title="Français" href="?lang=fr">
      <img src="uploads/default/fr_french.png" class="flagfrench-img"><span> Français</span></a>
    </li>
    <li class="change-href">
      <a id="french" title="Arabic" href="?lang=ar" class="inverse-arabic">
      <img src="uploads/default/arabic.png" class="flagfrench-img"><span> العربية</span></a>
    </li>
  </ul>
</div>
<!--end Change language  -->

  <!-- start dropdown-menu -->
      <ul class="nav navbar-nav navbar-right nonborder">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $Admin[$lang]; ?><span class="caret"></span></a>
          <ul class="dropdown-menu">
              <li><a href="../index.php?lang=en" target="_blank"><?php echo "<p>".$Visit_Shop[$lang]."</p>"; ?></a></li>
                <li><a href="http://localhost/userprofile/index.php" target="_blank"><?php echo "<p>".$GropAdmin[$lang]."</p>"; ?></a></li>
            <li><a href="members.php?do=Edit&userid=<?php echo $_SESSION['ID'] ?>"><?php echo "<p>".$Edit_Profile[$lang]."</p>"; ?></a></li>
            <li><a href="logout.php"><?php echo "<p>".$Logout[$lang]."</p>"; ?></a></li>
          </ul>
        </li>
      </ul>

      <!-- end dropdown-menu -->
    </div>
  </div>
</nav>
<style>
</style>
