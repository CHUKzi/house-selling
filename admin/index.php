<?php
$PageNum = 2;
require_once('includes/connection.php');

if (isset($_SESSION['admin_id'])) {
    header('Location: '. $homeURL .'dashboard.php');
}



if (isset($_POST['submit'])) {

  $warnings = array();
  $email             =  $_POST['email'];
  $hashed_password   =  sha1($_POST['password']);

  $query = "SELECT * FROM admin WHERE email = '{$email}' AND password = '{$hashed_password}' AND is_deleted IS NULL LIMIT 1";
  $result_set = mysqli_query($connection, $query);

  if ($result_set) {
    if (mysqli_num_rows($result_set) == 1) {
      $user = mysqli_fetch_assoc($result_set);
      $_SESSION['admin_id'] = $user['id'];
      $query = "UPDATE admin SET last_login = NOW() ";
      $query .= "WHERE id = {$_SESSION['admin_id']} LIMIT 1";
      $result_set = mysqli_query($connection, $query);
      header('Location:'. $homeURL .'dashboard.php?my=Dashboard');
    } else {
      $warnings[] = 'Invalid Username / Password';
    }
  } else {
    $errors[] = 'Login failed';
  }
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://getbootstrap.com/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Lesi.lk - User Login</title>

    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.0/examples/album/album.css" rel="stylesheet">
    <!-- lesi stylesheet -->
    <link href="assets/css/lesi.css" rel="stylesheet">

  </head>

  <body>

    <?php 
    //header
    include('includes/interface/header.php');?>
    <main role="main">

      <div class="container">
          <div class="row justify-content-center align-items-center" style="height:75vh">
              <div class="col-6">
                  <div class="card">
                      <div class="card-body">
                        <?php include('includes/interface/custom/Alerts.php'); ?>
                        <form method="post">
                            <h1 class="h3 mb-3 font-weight-normal">Admin Sign in</h1>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required="" autofocus="">
                            <br>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="">
                            <br>
                            <button type="submit" class="btn btn-primary btn-block" name="submit"><i class="fa fa-sign-in" aria-hidden="true"></i> Sign in</button>

                          </form>
 
                      </div>
                  </div>
              </div>
          </div>
      </div>

    </main>

    <?php //footer
    include('includes/interface/footer.php');?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js"></script>
    <script src="https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js"></script>
    <script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/holder.min.js"></script>
  </body>
</html>
<?php mysqli_close($connection); ?>