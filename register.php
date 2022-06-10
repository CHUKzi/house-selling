<?php
$PageNum = 7;
require_once('includes/connection.php');
require_once('includes/functions.php');

if (isset($_SESSION['user_id'])) {
    header('Location: '. $homeURL .'account.php?my=Dashboard&why=already_Signin');
}

  if (isset($_POST['submit'])) {
    $warnings   = array();
    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $email      = $_POST['email'];

    $max_len_fields = array('first_name' => 50, 'last_name' =>50, 'email' => 75, 'password' => 30, 'repassword' => 30);
    foreach ($max_len_fields as $field => $max_len) {
      if (strlen(trim($_POST[$field])) > $max_len) {
        $warnings[] = $field . ' must be less than ' . $max_len . ' characters';
      }
    }

    if (!is_email($_POST['email'])) {
      $warnings[] = 'Email address is invalid.';
    }

    $query = "SELECT * FROM users WHERE email = '{$email}' LIMIT 1";
    $result_set = mysqli_query($connection, $query);
    if ($result_set) {
      if (mysqli_num_rows($result_set) == 1) {
        $warnings[] = 'You are already Registered';
      }
    }

    if ($_POST['password']==$_POST['repassword']) {
      $password = sha1($_POST['password']);
    } else {
      $warnings[] = "password and confirm password must be match";
    }

    if (empty($warnings)) {
      $hashed_password = sha1($password);

      $query  = "INSERT INTO users (";
      $query .= "first_name, last_name, email, password, is_deleted";
      $query .= ") VALUES (";
      $query .= "'{$first_name}', '{$last_name}', '{$email}', '{$password}', '0'";
      $query .= ")";

      $result = mysqli_query($connection, $query);

      if ($result) {

        $first_name = '';
        $last_name  = '';
        $email      = '';

        header( 'Location: '. $homeURL.'login.php?Registered=suces' );
        //$suces = 'You Are Registered!!';

      } else {
        $errors = 'Registered failed';
      }
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

    <title>Lesi.lk - Official Website</title>

    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" id="stylesheet">
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
          <div class="row justify-content-center align-items-center" style="height:auto;">
              <div class="col-6">
                  <div class="card">
                      <div class="card-body">
                        <?php include('includes/interface/custom/Alerts.php'); ?>
                        
                        <form method="post">
                            <h1 class="h3 mb-3 font-weight-normal"> Sign Up</h1>
                            
                            <div class="row mb-4">
                              <div class="col">
                                <div class="form-outline">
                                  <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name" autofocus="" value="<?php if(isset($first_name)) {echo $first_name;} ?>" required>
                                </div>
                              </div>

                              <div class="col">
                                <div class="form-outline">
                                  <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name" value="<?php if(isset($last_name)) {echo $last_name;} ?>" required>
                                </div>
                              </div>
                            </div>

                            <input type="email" id="email" name="email" class="form-control" placeholder="Email address" value="<?php if(isset($email)) {echo $email;} ?>" required="">
                            <br>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="">
                            <br>
                            <input type="password" id="repassword" name="repassword" class="form-control" placeholder="Re-Enter Password" required="">
                            <br>
                            <div class="bs-example">
                                <div class="clearfix">
                                    <div class="pull-left"><button type="submit" class="btn btn-success" name="submit"><i class="fa fa-sign-in" aria-hidden="true"></i> Sign Up</button></div>
                                </div>
                            </div>

                          </form>
                            <hr>
                            <a href="login.php" class="btn btn-primary btn-block"><i class="fa fa-sign-in" aria-hidden="true"></i> Sign in Your Account</a>
                      </div>
                  </div>
              </div>
          </div>
      </div>

    </main>

    <?php
    //footer
    include('includes/interface/footer.php');?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script id="lesilk"><?php echo $script;?></script>
    <script src="assets/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js"></script>
    <script src="https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js"></script>
    <script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/holder.min.js"></script>
  </body>
</html>