<?php
$PageNum = 5;
require_once('includes/connection.php');

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
        <div class="row py-lg-5">
          <div class="col-lg-6 col-md-8 mx-auto">

            <h1 class="fw-light">About Lesi.lk</h1>
              <p class="fs-5 text-muted">Lesi.lk is one place that has made a turning point in commercialization.Lesi.lk provide you with a browsing facility for houses, apartments, annexes and lands. And with marketing facility for any kind of property

              Lesi.lk will electronically assist landladies / landlords in managing the boarding houses. The system will streamline the operation of the boarding houses 
              which will improve the operational efficiency & overall experience of the tenats .The said project will electronically assist landladies / landlords in 
              managing the boarding houses. The system will streamline the operation of the boarding houses 
              which will improve the operational efficiency & overall experience of the tenats..</p>
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