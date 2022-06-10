<?php
$PageNum = 4;
require_once('includes/connection.php');
require_once('includes/functions.php');

if (isset($_POST['SubmitContact'])) {

  $warnings   = array();

  $max_len_fields = array('name' => 30, 'email' =>40, 'message' => 500);
   foreach ($max_len_fields as $field => $max_len) {
    if (strlen(trim($_POST[$field])) > $max_len) {
      $warnings[] = $field . ' must be less than ' . $max_len . ' characters';
    }
  }

  if (!is_email($_POST['email'])) {
    $warnings[] = 'Email address is invalid.';
  }

  if (empty($warnings)) {

    $query  = "INSERT INTO contact_us (";
    $query .= "name, email, message";
    $query .= ") VALUES (";
    $query .= " '{$_POST['name']}', '{$_POST['email']}', '{$_POST['message']}' ";
    $query .= ")";
    $result = mysqli_query($connection, $query);

    if ($result) {
      $suces = 'Your Contact Message is Send Successfully!!';

    } else {
      $errors = 'Message Send failed';
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
        <br>
          <div class="row">
              <div class="col">
                  <div class="card">
                      <div class="card-body">
                        <?php include('includes/interface/custom/Alerts.php'); ?>
                          <form method="post">
                              <div class="form-group">
                                  <label for="name">Name</label>
                                  <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" placeholder="Enter name" required>
                              </div>
                              <div class="form-group">
                                  <label for="email">Email address</label>
                                  <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
                                  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                              </div>
                              <div class="form-group">
                                  <label for="message">Message</label>
                                  <textarea class="form-control" id="message" name="message" rows="6" required></textarea>
                              </div>
                              <div class="mx-auto">
                              <button type="submit" name="SubmitContact" class="btn btn-primary text-right">Submit</button></div>
                          </form>
                      </div>
                  </div>
              </div>
              <div class="col-12 col-sm-4">
                  <div class="card bg-light mb-3">
                      <div class="card-header bg-primary text-white text-uppercase"><i class="fa fa-home"></i> Address</div>
                      <div class="card-body">
                          <p>Colombo - 07</p>
                          <p>75008 PARIS</p>
                          <p>France</p>
                          <p>Email : lesi@gmail.com</p>
                          <p>Tel. 077123456789</p>

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