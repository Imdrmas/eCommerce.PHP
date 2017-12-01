<?php
     session_start();
     $noNavbar  = '';
     $pageTitle = 'Login';

     if (isset($_SESSION['Username'])){
         header('Location: dashboard.php?lang=en'); // redirect to dashboard page                                           // direct à la page d'acceuil = FR
     }
     include 'init.php';
     //include $tpl . 'header.php';
    // include 'includes/langauges/detect_language_class.php';

// Check if user coming from http post request
// Vérifiez si l'utilisateur vient de la demande post http = FR
     if ($_SERVER['REQUEST_METHOD'] == 'POST'){
       $username   = $_POST['user'];
       $password   = $_POST['pass'];
       $hashedpass = sha1($password);

      // Check if the user exist in database
      // Vérifiez si l'utilisateur existe dans la base de données = FR
      $stmt = $con->prepare("SELECT
                                 UserID, Username, Password
                             FROM
                                 users
                             WHERE
                                  Username = ?
                              AND
                                  Password = ?
                              AND
                                  GroupID = 1
                              LIMIT 1");

      $stmt->execute(array($username, $hashedpass));
      $row   = $stmt->fetch();
      $count = $stmt->rowCount();

      // if count > 0 this mean the database contain record about this username
      // si compte > 0, cela signifie que la base de données contient
      //un enregistrement sur ce nom d'utilisateur = Fr
      if ($count > 0){
        $_SESSION['Username'] = $username; // Register session Name
                                           // S'inscrire Nom de la session = FR
        $_SESSION['ID'] = $row['UserID'];  // Register session ID
                                           // Identifiant de session de registre = FR
        header('Location: dashboard.php?lang=en'); // redirect to dashboard page
                                          // rediriger vers la page du tableau de bord = FR
        exit();
      }
     }

?>



<!-- start la form de Admin -->
  <form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
    <h4 class="text-center">Admin Login</h4>
    <input class="form-control" type="text" name="user" placeholder="Username" autocomplete="off">
    <input class="form-control" type="password" name="pass" placeholder="Password" autocomplete="new-password">
    <input class="btn btn-primary btn-block" type="submit" value="Login">
  </form>
<!-- end la form de Admin -->

 <?php
     include $tpl . 'footer.php';

  ?>
