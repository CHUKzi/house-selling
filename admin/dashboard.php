<?php
$PageNum = 8;
require_once('includes/connection.php');


if (!isset($_SESSION['admin_id'])) {
    header('Location: '. $homeURL .'?log_out=Error');
}

if (!isset($_GET['my']) OR (empty($_GET['my']))) {
  header('Location: '. $homeURL .'dashboard.php?my=Dashboard');
}

if (isset($_GET['Confirmed'])) {

  $query = "UPDATE house SET adminConform = '1' WHERE id = '{$_GET['Confirmed']}'";
  $result = mysqli_query($connection, $query);

  if ($result) {
    $suces = 'Approved Successfully';


    $history_type = "Post Approved";
    $title = "Your Post Approved BY Admin";

    $query  = "INSERT INTO notification (";
    $query .= "user_id, history_type, title";
    $query .= ") VALUES (";
    $query .= "'{$_GET['UserID']}', '{$history_type}', '{$title}'";
    $query .= ")";

    $result = mysqli_query($connection, $query);



  } else {
    $errors = 'Approved failed';
  }

}

if (isset($_GET['DeletePost'])) {

  $query = "UPDATE house SET is_deleted = '1' WHERE id = '{$_GET['DeletePost']}'";
  $result = mysqli_query($connection, $query);

  if ($result) {
    $suces = 'Deleted Successfully';

    $history_type = "Post Delete";
    $title = "Your Post Deleted BY Admin. Please Check Post Content And Upload Again";

    $query  = "INSERT INTO notification (";
    $query .= "user_id, history_type, title";
    $query .= ") VALUES (";
    $query .= "'{$_GET['UserID']}', '{$history_type}', '{$title}'";
    $query .= ")";

    $result = mysqli_query($connection, $query);


  } else {
    $errors = 'Deleted failed';
  }

}

if (isset($_GET['DeleteMessage'])) {

  $query = "UPDATE contact_us SET is_deleted = '1' WHERE id = '{$_GET['DeleteMessage']}'";
  $result = mysqli_query($connection, $query);

  if ($result) {
    $suces = 'Deleted Successfully';
  } else {
    $errors = 'Deleted failed';
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
        <br>
          <div class="row">
            <!-- start 2 -->
            <div class="col-12 col-sm-3">
              <div class="list-group">
                <a href="<?php echo $homeURL;?>dashboard.php?my=Dashboard" class="list-group-item list-group-item-action <?php if ($_GET['my']=="Dashboard") { ?>active<?php } ?>"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a>
                <a href="<?php echo $homeURL;?>dashboard.php?my=Advertisements" class="list-group-item list-group-item-action <?php if ($_GET['my']=="Advertisements") { ?>active<?php } ?>"><i class="fa fa-bullhorn" aria-hidden="true"></i> Users Advertisements</a>

                <a href="<?php echo $homeURL;?>dashboard.php?my=inbox" class="list-group-item list-group-item-action <?php if ($_GET['my']=="inbox") { ?>active<?php } ?>"><i class="fa fa-envelope" aria-hidden="true"></i> Messages</a>


                <a href="<?php echo $homeURL;?>dashboard.php?my=logout" class="list-group-item list-group-item-action bg-danger text-white" data-toggle="modal" data-target="#ConformedPanel"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
              </div>
            </div>

            <div class="col">
            <?php include('includes/interface/custom/Alerts.php');?>
                <div class="card">
                    <div class="card-body">

                        <?php if ($_GET['my']=="Dashboard") { ?>  

                        <p class="h6"><i class="fa fa-user" aria-hidden="true"></i> Hello Admin <?php echo $login_u['first_name']." ". $login_u['last_name'];?>!</p>
                        <p><i class="fa fa-clock-o" aria-hidden="true"></i> <i>Last Login : <?php echo $login_u['last_login']; ?></i></p>
                        <hr>

                        <center><p class="h2"> Welcome to Admin Dashboard </p><img src="assets/images/DpGP.gif" width="300"> </center>

                        <?php } ?>

                        <?php if ($_GET['my']=="Advertisements") { ?>  

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Thumbnail</th>
      <th scope="col">Title</th>
      <th scope="col">Upload Date</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
<?php
    $query = "SELECT * FROM house WHERE is_deleted IS NULL ORDER BY time DESC";
    $AllPosts = mysqli_query($connection, $query);
    $row_results=mysqli_num_rows ($AllPosts);
    $cnt = 1;
    if ($AllPosts) {
    while ($Post = mysqli_fetch_array($AllPosts)) {
?>

    <tr>
      <th scope="row"><?php echo $cnt;?></th>
      <th><img src="../assets/images/house/<?php echo $Post['image1'];?>" width="100"></th>
      <td><?php echo $Post['title'];?></td>
      <td><?php echo $Post['time'];?></td>

      <td>
<?php if(isset($Post['adminConform'])) { ?>
        <button type="button" class="btn btn-outline-success btn-sm" disabled><i class="fa fa-check" aria-hidden="true"></i> Confirmed</button>

  <?php } else { ?>


<a href="<?php echo $homeURL;?>dashboard.php?my=Advertisements&Confirmed=<?php echo $Post['id'];?>&UserID=<?php echo $Post['by_ID'];?>"><button type="button" class="btn btn-outline-secondary btn-sm" onclick="return confirm('Post Confirmed');"><i class="fa fa-check" aria-hidden="true"></i> Pending..</button></a>

    
  <?php }  ?>

  <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#viewPanel-<?php echo $Post['id'];?>"><i class="fa fa-eye" aria-hidden="true"></i> View </button>

  <a href="<?php echo $homeURL;?>dashboard.php?my=Advertisements&DeletePost=<?php echo $Post['id'];?>&UserID=<?php echo $Post['by_ID'];?>"><button type="button" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are You Sure?');"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button></a>

        

      </td>
    </tr>

<div class="modal fade bd-example-modal-lg" id="viewPanel-<?php echo $Post['id'];?>">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title"><?php echo $Post['title'];?> /// <?php echo $Post['time'];?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <center><img src="../assets/images/house/<?php echo $Post['image1'];?>" width="500"></center><br>
        <center><img src="../assets/images/house/<?php echo $Post['image2'];?>" width="250">
        <img src="../assets/images/house/<?php echo $Post['image3'];?>" width="250"></center>
  


        <p class="h2">House Type : <?php echo ucfirst($Post['type']);?> House</p><br>
        <p><?php echo $Post['infor'];?> House</p><br>

        <center><p><?php echo $Post['map_fram'];?> House</p></center><br>

        <p class="h2 text-right">LKR . <?php echo $Post['price'];?></p>


      </div>

    </div>
  </div>
</div>

<?php $cnt++; }  } ?>

  </tbody>
</table>

                        <?php } ?>

                        <?php if ($_GET['my']=="inbox") { ?>  


<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email Address</th>
      <th scope="col">Date & Time</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
<?php
    $query = "SELECT * FROM contact_us WHERE is_deleted IS NULL ORDER BY time DESC";
    $AllMessages = mysqli_query($connection, $query);
    $row_results=mysqli_num_rows ($AllMessages);
    $cnt = 1;
    if ($AllMessages) {
    while ($Message = mysqli_fetch_array($AllMessages)) {
?>

    <tr>
      <th scope="row"><?php echo $cnt;?></th>
      <td><?php echo $Message['name'];?></td>
      <td><?php echo $Message['email'];?></td>
      <td><?php echo $Message['time'];?></td>
      <td>


  <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#viewPanel-<?php echo $Message['id'];?>"><i class="fa fa-eye" aria-hidden="true"></i> View </button>

  <a href="<?php echo $homeURL;?>dashboard.php?my=inbox&DeleteMessage=<?php echo $Message['id'];?>"><button type="button" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are You Sure?');"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button></a>
        
      </td>
    </tr>

<div class="modal fade bd-example-modal-lg" id="viewPanel-<?php echo $Message['id'];?>">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title"><?php echo $Message['name'];?> /// <?php echo $Message['time'];?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <p><b>Email Address : </b><?php echo $Message['email'];?></p>
        <p class="h3">Contact Message</p>

        <p><?php echo $Message['message'];?></p>

      </div>

    </div>
  </div>
</div>

<?php $cnt++; }  } ?>

  </tbody>
</table>


                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Modal -->
<div class="modal fade" id="ConformedPanel">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content">
      <div class="modal-body">

        <h5 class="modal-title text-center">Are you sure?</h5>
        <div class="text-center">
            <a href="<?php echo $homeURL;?>logout.php"><button type="button" class="btn btn-danger">Yes</button></a>
          <button type="button" class="btn btn-primary" class="close" data-dismiss="modal" aria-label="Close">No</button>
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js"></script>
    <script src="https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js"></script>
    <script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/holder.min.js"></script>
  </body>
</html>