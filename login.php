<?php
      session_start();
      $pageTitle = 'Login';
      if (isset($_SESSION['user'])){
        header('Location: profile.php');
      }
     include 'init.php'; ?>
<?php
// Check if User coming from http post request
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  if (isset($_POST['login'])){
  $user = $_POST['username'];
  $pass = $_POST['password'];
  $hashedPass = sha1($pass);

  // check if the user exist in database
  $stmt = $con->prepare("SELECT
                        UserID, Username, Password
                        FROM
                        users
                        WHERE
                        Username = ?
                        AND Password = ?");
  $stmt->execute(array($user, $hashedPass));
  $get = $stmt->fetch();
  $count = $stmt->rowCount();

  // if Count > 0 this mean the database contain record about this username
  if ($count > 0){
    $_SESSION['user'] = $user; // register session name
    $_SESSION['uid'] = $get['UserID']; // register USer Id in session
    header('Location: profile.php'); // redirect to dashboard page
    exit();
  }
} else {
   $formErrors = array();
   $username = $_POST['username'];
   $password = $_POST['password'];
   $password2 = $_POST['password2'];
   $email    = $_POST['email'];

   if (isset($username)){
     $filterdUser = filter_var($username, FILTER_SANITIZE_STRING);
     if (strlen($filterdUser) < 4){
       $formErrors[] = "$Username_Must_Be_Between_Characters[$lang]";
     }
     if (strlen($filterdUser) > 8){
       $formErrors[] = "$Username_Must_Be_Between_Characters[$lang]";
     }
   }
   if (isset($password) && isset($password2)){

     if (empty($password)){
       $formErrors[] = "$Sorry_Password_Cant_Be_Empty[$lang]";
     }
      if (sha1($password) !== sha1($password2)){
          $formErrors[] = "$Sorry_Password_Is_Not_Match[$lang]";
        }
   }
   if (isset($email)){
     $filterdEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
     if (filter_var($filterdEmail, FILTER_VALIDATE_EMAIL) != true){
       $formErrors[] = "$Sorry_Email_Cant_Be_Empty_Or_Not_Valid[$lang]";
     }
   }
   // Check if there's no error proceed the user add
   if (empty($formErrors)){
     // Check if user exist in database
     $check = checkItem("Username", "users", $username);
     if ($check == 1){
       $formErrors[] = "$Sorry_This_User_IS_Exists[$lang]";
     } else {
       // insert userinfo in database
       $stmt = $con->prepare("INSERT INTO
                              users(Username, Password, Email, RegStatus, Date)
                              VALUES(:zuser, :zpass, :zmail, 0, now())");
      $stmt->execute(array(
        'zuser' => $username,
        'zpass' => sha1($password),
        'zmail' => $email
      ));
      // echo success message
      $succesMsg = "$Congrats_You_Are_Now_Registrd_User[$lang]";
     }
   }
}
}
?>
<div class="container login-page">
  <!--start login form  -->
  <h1 class="text-center"><span class="selected" data-class="login"><?php echo $Login[$lang] ?>
  </span> | <span data-class="signup"><?php echo $Signup[$lang] ?></span></h1>
  <form class="login" action="<?php echo $_SERVER['PHP_SELF']  ?>" method="POST">
    <div class="input-container">
     <input class="form-control inputs"
     type="text"
     name="username"
     autocomplete="off"
     placeholder="<?php echo $Type_your_username[$lang] ?>"
     required="required">
   </div>
   <div class="input-container">
     <input class="form-control inputs"
     type="password"
     name="password"
     autocomplete="new-password"
     placeholder="<?php echo $Type_your_password[$lang] ?>"
     required="required">
 </div>
     <input class="btn btn-primary btn-block"
     name="login"
     type="submit"
     value="<?php echo $Login[$lang] ?>">
  </form>
    <!--end login form  -->
      <!--start signup form  -->
  <form class="signup" action="<?php echo $_SERVER['PHP_SELF']  ?>" method="POST">
    <div class="input-container">
     <input class="form-control inputs"
     type="text"
     name="username"
     autocomplete="off"
     placeholder="<?php echo $Type_your_username[$lang] ?>"
     pattern=".{4,}"
     title="Username Must Be 4 Characters" required>
 </div>
<div class="input-container">
     <input class="form-control inputs"
     type="password"
     name="password"
     autocomplete="new-password"
     placeholder="<?php echo $Type_complex_password[$lang] ?>"
     minlength="4" required>
 </div>
     <input class="form-control"
     type="password"
     name="password2"
     autocomplete="new-password"
     placeholder="<?php echo $Type_password_again[$lang] ?>"
     minlength="4" required>
    <div class="input-container">
     <input class="form-control inputs"
     type="email"
     name="email"
     placeholder="<?php echo $Your_Email_Appear_in_Your_Profile[$lang] ?>" required>
   </div>
     <input class="btn btn-success btn-block" name="signup" type="submit" value="<?php echo $Signup[$lang] ?>">
  </form>
    <!--end signup form  -->

    <div class="text-center the-errors">
<?php if (! empty($formErrors)){
  foreach ($formErrors as $error){
    echo '<div class="msg error alert-danger">' . $error . '</div>';
  }
} if (isset($succesMsg)){
  echo '<div class="msg success">' . $succesMsg . '</div>';
}

 ?>
    </div>
</div>
<?php include $tpl . 'footer.php'; ?>
