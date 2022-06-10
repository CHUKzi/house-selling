<?php
$PageNum = 8;
require_once('includes/connection.php');
require_once('includes/functions.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: '. $homeURL .'?log_out=Error');
}

if (!isset($_GET['my']) OR (empty($_GET['my']))) {
  header('Location: '. $homeURL .'account.php?my=Dashboard');
}

if (isset($_POST['updateBasic'])) {
  $warnings   = array();
  $max_len_fields = array('first_name' => 50, 'last_name' =>50, 'email' => 75);
  foreach ($max_len_fields as $field => $max_len) {
    if (strlen(trim($_POST[$field])) > $max_len) {
      $warnings[] = $field . ' must be less than ' . $max_len . ' characters';
    }
  }

  if (!is_email($_POST['email'])) {
    $warnings[] = 'Email address is invalid.';
  }

  if (!($login_u['email']==$_POST['email'])) {
    $query = "SELECT * FROM users WHERE email = '{$_POST['email']}' LIMIT 1";
    $result_set = mysqli_query($connection, $query);
    if ($result_set) {
      if (mysqli_num_rows($result_set) == 1) {
        $warnings[] = 'Email address is already exists';
      }
    }
  }

  if (empty($warnings)) {

    $query = "UPDATE users SET first_name = '{$_POST['first_name']}', last_name = '{$_POST['last_name']}', email = '{$_POST['email']}' WHERE id='{$_SESSION['user_id']}'";

    $result = mysqli_query($connection, $query);

    if ($result) {
      //header( 'Location: '. $homeURL.'login.php?Registered=suces' );
      $suces = 'Your account is Updated!';
    } else {
      $errors = 'Updated failed';
    }
  }
}

if (isset($_POST['updateContact'])) {
  $warnings   = array();

  $max_len_fields = array('contact_number' => 12, 'nic' => 13, 'address' => 50);
  foreach ($max_len_fields as $field => $max_len) {
    if (strlen(trim($_POST[$field])) > $max_len) {
      $warnings[] = $field . ' must be less than ' . $max_len . ' characters';
    }
  }

  if (empty($warnings)) {
    $query = "UPDATE users SET contact_number = '{$_POST['contact_number']}', nic = '{$_POST['nic']}', province = '{$_POST['province']}', district = '{$_POST['district']}', address = '{$_POST['address']}' WHERE id='{$_SESSION['user_id']}'";
    $result = mysqli_query($connection, $query);
    if ($result) {
      //header( 'Location: '. $homeURL.'login.php?Registered=suces' );
      $suces = 'Your account is Updated!';
    } else {
      $errors = 'Updated failed';
    }
  }
}

if (isset($_POST['changePass'])) {
  $warnings   = array();

  $max_len_fields = array('newpassword' => 30, 'repassword' => 30);
  foreach ($max_len_fields as $field => $max_len) {
    if (strlen(trim($_POST[$field])) > $max_len) {
      $warnings[] = $field . ' must be less than ' . $max_len . ' characters';
    }
  }

  $cPassword = sha1($_POST['cpassword']);

  $query = "SELECT * FROM users WHERE password = '{$cPassword}' AND id = '{$_SESSION['user_id']}' LIMIT 1";
  $result_set = mysqli_query($connection, $query);

  if ($result_set) {
    if (mysqli_num_rows($result_set) == 1) {

      if ($_POST['newpassword']==$_POST['repassword']) {
        $newPassword = sha1($_POST['newpassword']);
      } else {
        $warnings[] = "New password and confirm password must be match";
      }
    } else {
      $warnings[] = "Current password is invalid";
    }

  }

  if (empty($warnings)) {
    $query = "UPDATE users SET password = '{$newPassword}' WHERE id='{$_SESSION['user_id']}'";
    $result = mysqli_query($connection, $query);
    if ($result) {
      //header( 'Location: '. $homeURL.'login.php?Registered=suces' );
      $suces = 'Your account is Updated!';
    } else {
      $errors = 'Updated failed';
    }
  }
}

//header('Location: '. $homeURL .'account.php?my=Dashboard');

if (isset($_POST['uploadPost'])) {

  $warnings   = array();
  $image1    = '';
  $image2    = '';
  $image3    = '';

  $image1    = $_FILES["image1"]["name"];
  $image2    = $_FILES["image2"]["name"];
  $image3    = $_FILES["image3"]["name"];


  if (!empty($image1)) {
    $filename     = uniqid() . "-" . time();
    $extension    = strtolower(pathinfo( $_FILES["image1"]["name"], PATHINFO_EXTENSION ));
    $basename1     = $filename . "." . $extension;
    $source       = $_FILES["image1"]["tmp_name"];
    $destination  = "assets/images/house/{$basename1}";
    $extensions_arr = array('jpeg' , 'jpg', 'png');
    if( in_array($extension,$extensions_arr) ){
      move_uploaded_file($source, $destination);
    } else {
        $warnings[] = 'File <b>EXTENSION</b> is not support, check file extension is <b>JPEG OR JPG</b>';
    } 
  } else {
    $warnings[] = 'Thumbnail is required';
  }


  if (!empty($image2)) {
    $filename     = uniqid() . "-" . time();
    $extension    = strtolower(pathinfo( $_FILES["image2"]["name"], PATHINFO_EXTENSION ));
    $basename2     = $filename . "." . $extension;
    $source       = $_FILES["image2"]["tmp_name"];
    $destination  = "assets/images/house/{$basename2}";
    $extensions_arr = array('jpeg' , 'jpg', 'png');
    if( in_array($extension,$extensions_arr) ){
      move_uploaded_file($source, $destination);
    } else {
        $warnings[] = 'File <b>EXTENSION</b> is not support, check file extension is <b>JPEG OR JPG</b>';
    } 
  } else {
    $warnings[] = 'Images is required';
  }

  if (!empty($image3)) {
    $filename     = uniqid() . "-" . time();
    $extension    = strtolower(pathinfo( $_FILES["image3"]["name"], PATHINFO_EXTENSION ));
    $basename3     = $filename . "." . $extension;
    $source       = $_FILES["image3"]["tmp_name"];
    $destination  = "assets/images/house/{$basename3}";
    $extensions_arr = array('jpeg' , 'jpg', 'png');
    if( in_array($extension,$extensions_arr) ){
      move_uploaded_file($source, $destination);
    } else {
        $warnings[] = 'File <b>EXTENSION</b> is not support, check file extension is <b>JPEG OR JPG</b>';
    } 
  } else {
    $warnings[] = 'Images is required';
  }

  $max_len_fields = array('title' => 40, 'infor' => 500);
  foreach ($max_len_fields as $field => $max_len) {
    if (strlen(trim($_POST[$field])) > $max_len) {
      $warnings[] = $field . ' must be less than ' . $max_len . ' characters';
    }
  }

  if (empty($warnings)) {

    $infor = nl2br(strip_tags($_POST['infor']));

    $query  = "INSERT INTO house (";
    $query .= "by_ID, type, title, price, infor, map_fram, image1, image2, image3";
    $query .= ") VALUES (";
    $query .= "'{$_SESSION['user_id']}', '{$_POST['houseType']}', '{$_POST['title']}', '{$_POST['price']}', '{$infor}', '{$_POST['map_fram']}', '{$basename1}', '{$basename2}', '{$basename3}' ";
    $query .= ")";

    $result = mysqli_query($connection, $query);

    if ($result) {
      //header( 'Location: '. $homeURL.'login.php?Registered=suces' );
      $suces = 'Upload Successfully!!';

    } else {
      $errors = 'Post failed';
    }
  }
}



if (isset($_POST['EditPost'])) {

  $warnings   = array();
  $image1    = '';
  $image2    = '';
  $image3    = '';

  $image1    = $_FILES["image1"]["name"];
  $image2    = $_FILES["image2"]["name"];
  $image3    = $_FILES["image3"]["name"];


  if (!empty($image1)) {
    $filename     = uniqid() . "-" . time();
    $extension    = strtolower(pathinfo( $_FILES["image1"]["name"], PATHINFO_EXTENSION ));
    $basename1     = $filename . "." . $extension;
    $source       = $_FILES["image1"]["tmp_name"];
    $destination  = "assets/images/house/{$basename1}";
    $extensions_arr = array('jpeg' , 'jpg', 'png');
    if( in_array($extension,$extensions_arr) ){
      move_uploaded_file($source, $destination);
    } else {
        $warnings[] = 'File <b>EXTENSION</b> is not support, check file extension is <b>JPEG OR JPG</b>';
    } 
  } else {
    $basename1 = $_POST['imag1'];
  }


  if (!empty($image2)) {
    $filename     = uniqid() . "-" . time();
    $extension    = strtolower(pathinfo( $_FILES["image2"]["name"], PATHINFO_EXTENSION ));
    $basename2     = $filename . "." . $extension;
    $source       = $_FILES["image2"]["tmp_name"];
    $destination  = "assets/images/house/{$basename2}";
    $extensions_arr = array('jpeg' , 'jpg', 'png');
    if( in_array($extension,$extensions_arr) ){
      move_uploaded_file($source, $destination);
    } else {
        $warnings[] = 'File <b>EXTENSION</b> is not support, check file extension is <b>JPEG OR JPG</b>';
    } 
  } else {
    $basename2 = $_POST['imag2'];
  }

  if (!empty($image3)) {
    $filename     = uniqid() . "-" . time();
    $extension    = strtolower(pathinfo( $_FILES["image3"]["name"], PATHINFO_EXTENSION ));
    $basename3     = $filename . "." . $extension;
    $source       = $_FILES["image3"]["tmp_name"];
    $destination  = "assets/images/house/{$basename3}";
    $extensions_arr = array('jpeg' , 'jpg', 'png');
    if( in_array($extension,$extensions_arr) ){
      move_uploaded_file($source, $destination);
    } else {
        $warnings[] = 'File <b>EXTENSION</b> is not support, check file extension is <b>JPEG OR JPG</b>';
    } 
  } else {
    $basename3 = $_POST['imag3'];
  }

  $max_len_fields = array('title' => 40, 'infor' => 500);
  foreach ($max_len_fields as $field => $max_len) {
    if (strlen(trim($_POST[$field])) > $max_len) {
      $warnings[] = $field . ' must be less than ' . $max_len . ' characters';
    }
  }

  if (empty($warnings)) {

    $infor = nl2br(strip_tags($_POST['infor']));

    $query = "UPDATE house SET title = '{$_POST['title']}', image1 = '{$basename1}', image2 = '{$basename2}', image3 = '{$basename3}', type = '{$_POST['houseType']}', price = '{$_POST['price']}', infor = '{$_POST['infor']}', map_fram = '{$_POST['map_fram']}' WHERE by_ID='{$_SESSION['user_id']}' AND id = '{$_POST['postID']}'";
    $result = mysqli_query($connection, $query);

    if ($result) {
      //header( 'Location: '. $homeURL.'login.php?Registered=suces' );
      $suces = 'Updated Successfully!!';

    } else {
      $errors = 'Post Updated failed';
    }
  }
}

if (isset($_GET['Delete_Post'])) {

  $query = "UPDATE house SET is_deleted = '1' WHERE by_ID='{$_SESSION['user_id']}' AND id = '{$_GET['Delete_Post']}'";
  $result = mysqli_query($connection, $query);

  if ($result) {
    $suces = 'Your Post Delete Successfully!!';
  } else {
    $errors = 'Post Delete failed';
  }
}

if (isset($_GET['is_sold'])) {

  $query = "UPDATE house SET is_Buy = '1' WHERE by_ID='{$_SESSION['user_id']}' AND id = '{$_GET['is_sold']}'";
  $result = mysqli_query($connection, $query);

  if ($result) {
    $suces = 'Your house has been put up for sold Successfully!!</br>Now customers can not see see it';
  } else {
    $errors = 'Updated failed';
  }
}

if (isset($_POST['SubmitMessage'])) {

  $query  = "INSERT INTO message (";
  $query .= "from_id, to_id, message";
  $query .= ") VALUES (";
  $query .= "'{$_SESSION['user_id']}', '{$_GET['MessageUser']}', '{$_POST['message']}'";
  $query .= ")";

  $result = mysqli_query($connection, $query);

  if ($result) {
    $suces = 'Message Send Successfully!!';
  } else {
    $errors = 'Send failed';
  }
}

if (isset($_GET['RmFav'])) {
  
  $query = "DELETE FROM favorite WHERE fav_by='{$_SESSION['user_id']}' AND id = '{$_GET['RmFav']}'";
  $result = mysqli_query($connection, $query);

  if ($result) {
    $suces = 'Removed From Favorite!!';
  } else {
    $errors = 'failed';
  }

}

if (empty($login_u['contact_number'] AND $login_u['province'] AND $login_u['district'] AND $login_u['address'] AND $login_u['nic'])) {
$warnings[] = 'Please Update Your Contact Information '.'<a href="'.$homeURL.'account.php?my=Settings">Update</a>';
$warningClose = false;

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
            <!-- start 2 -->
              <div class="col-12 col-sm-3">

              <div class="list-group">
                <a href="<?php echo $homeURL;?>account.php?my=Dashboard" class="list-group-item list-group-item-action <?php if ($_GET['my']=="Dashboard") { ?>active<?php } ?>"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a>
                <a href="<?php echo $homeURL;?>account.php?my=Advertisements" class="list-group-item list-group-item-action <?php if ($_GET['my']=="Advertisements") { ?>active<?php } ?>"><i class="fa fa-bullhorn" aria-hidden="true"></i> My Advertisements</a>
                <a href="<?php echo $homeURL;?>account.php?my=Notification" class="list-group-item list-group-item-action <?php if ($_GET['my']=="Notification") { ?>active<?php } ?>"><i class="fa fa-bell" aria-hidden="true"></i> Notification</a>

                <a href="<?php echo $homeURL;?>account.php?my=inbox" class="list-group-item list-group-item-action <?php if ($_GET['my']=="inbox") { ?>active<?php } ?>"><i class="fa fa-envelope" aria-hidden="true"></i> inbox</a>


                <a href="<?php echo $homeURL;?>account.php?my=Favorite" class="list-group-item list-group-item-action <?php if ($_GET['my']=="Favorite") { ?>active<?php } ?>"><i class="fa fa-heart" aria-hidden="true"></i> Favorite</a>
                <a href="<?php echo $homeURL;?>account.php?my=Settings" class="list-group-item list-group-item-action <?php if ($_GET['my']=="Settings") { ?>active<?php } ?>"><i class="fa fa-cogs" aria-hidden="true"></i> Account Settings</a>
                <a href="<?php echo $homeURL;?>account.php?my=logout" class="list-group-item list-group-item-action bg-danger text-white" data-toggle="modal" data-target="#ConformedPanel"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
              </div>
              </div>

              <div class="col">

                  <?php
                  include('includes/interface/custom/Alerts.php');
                  ?>
                  <div class="card">
                      <div class="card-body">

                        <?php if ($_GET['my']=="Dashboard") { ?>  
                        <p class="h6"><i class="fa fa-user" aria-hidden="true"></i> Hello <?php echo $login_u['first_name'];?>!</p>
                        <p><i class="fa fa-clock-o" aria-hidden="true"></i> <i>Last Login : <?php echo $login_u['last_login']; ?></i></p>
                        <hr>
                        <?php } ?>

                        <?php if ($_GET['my']=="Dashboard" OR $_GET['my']=="Advertisements") { if (empty($warnings)) {?>


                          <div class="card">
                            <div class="card-body">
                              <center>
                                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-plus" aria-hidden="true"></i> Create New Post</button>
                              </center>
                            </div>
                          </div>
                          <br>

                        <?php } ?> 


                        <p class="h4">My Advertisements</p><hr>
                        <?php include('includes/interface/custom/RentData.php');?>
                        <?php } ?>

                        <?php if ($_GET['my']=="Notification") { ?>
                          <p class="h4"><i class="fa fa-bell" aria-hidden="true"></i> Notifications</p><hr>

                          <?php
                            $query = "SELECT * FROM notification WHERE user_id = '{$_SESSION['user_id']}' ORDER BY time DESC";

                            $notifications = mysqli_query($connection, $query);
                            $row_results=mysqli_num_rows ($notifications);
                            if ($notifications) {
                            while ($notification = mysqli_fetch_assoc($notifications)) {?>

                            <p><i class="fa fa-history" aria-hidden="true"></i> <span class="bg-warning text-white rounded"><?php echo $notification['history_type'];?></span> <b><?php echo $notification['title'];?></b><br><i><span class="font-weight-bold"><?php echo $notification['time'];?></span></i> </p><hr>

                          <?php } } if ($row_results == 0) { ?>

                          <center>
                            <i class="fa fa-bell text-primary" aria-hidden="true" style="font-size:150px;"></i>
                            <br><p class="h2">No Notification Yet</p>
                          </center>

                          <?php } } ?>



<?php if ($_GET['my']=="inbox") { ?>

<p class="h4"><i class="fa fa-envelope" aria-hidden="true"></i> Inbox</p><hr>


            <div class="row">
              <div class="col-12 col-sm-4">


<div class="list-group">

  <?php

    $query = "SELECT * FROM message GROUP BY from_id HAVING to_id = '{$_SESSION['user_id']}' ORDER BY time DESC";
    $InboxMessageUsers = mysqli_query($connection, $query);
    $row_results=mysqli_num_rows ($InboxMessageUsers);

    if ($InboxMessageUsers) {
    while ($InboxMessageUser = mysqli_fetch_array($InboxMessageUsers)) {


    if ($InboxMessageUser['from_id'] == $_SESSION['user_id']) {

        $query = "SELECT * FROM users WHERE id='{$InboxMessageUser['to_id']}' LIMIT 1";
        $MessageUserInfo = mysqli_query($connection, $query);
        $MUI = mysqli_fetch_assoc($MessageUserInfo);

    } else  {

        $query = "SELECT * FROM users WHERE id='{$InboxMessageUser['from_id']}' LIMIT 1";
        $MessageUserInfo = mysqli_query($connection, $query);
        $MUI = mysqli_fetch_assoc($MessageUserInfo);

    }

  ?>



  <a href="<?php echo $homeURL;?>account.php?my=inbox&MessageUser=<?php echo $MUI['id'];?>" class="list-group-item list-group-item-action <?php if ($_GET['MessageUser']==$MUI['id']) { ?>active<?php } ?>">
    <img src="<?php echo $homeURL;?>assets/images/users/user.png" alt="user images" class="rounded" width="32">

     <?php echo $MUI['first_name']." ".$MUI['last_name']; ?>

   </a>



  <?php } } if (empty($MUI)) {echo '<center><li class="list-group-item">No Inbox Messages Yet</li></center>'; }  ?>



</div>

            </div>

              <div class="col">
                <div class="card">
                  <div class="card-body">


<?php if (!isset($_GET['MessageUser'])) { ?>

<center>
  <i class="fa fa-envelope text-primary" aria-hidden="true" style="font-size:150px;"></i>
  <p class="h2">Message System</p>
  <p><i class="fa fa-lock" aria-hidden="true"></i> This messages is designed to be inaccessible to third parties</p>
  <hr>
  <p>Dev By Alex Lanka</p>
</center>

<?php } else { $MessageUSER = $_GET['MessageUser']; ?>

<div class="ex1">

  <?php
    $query = "SELECT * FROM message WHERE from_id = '{$_GET['MessageUser']}' AND to_id = '{$_SESSION['user_id']}' OR from_id = '{$_SESSION['user_id']}' ORDER BY time LIMIT 1";
    $results_message = mysqli_query($connection, $query);
    $set_result_message = mysqli_fetch_assoc($results_message);

    if ($set_result_message) {

    $query = "SELECT * FROM message WHERE from_id ='{$_SESSION['user_id']}' OR from_id = '{$_GET['MessageUser']}'";
    $message_Datas = mysqli_query($connection, $query);
    if ($message_Datas) {
    while ($message_Data = mysqli_fetch_assoc($message_Datas)) { if (isset($message_Data['for_ID'])) {

    $query = "SELECT * FROM house WHERE id='{$message_Data['for_ID']}'";
    $Adimage1 = mysqli_query($connection, $query);
    $GetImage1 = mysqli_fetch_assoc($Adimage1);

    echo '<img class="rounded mx-auto d-block" src="assets/images/house/'.$GetImage1['image1'].'" width="200"></br>';

    }?>

    <div class="from-message">
      <p class="<?php if ($_SESSION['user_id']==$message_Data['from_id']) {  echo "text-right"; } else { echo "text-left"; } ?>" role="alert"><?php echo $message_Data['message']; ?>&nbsp;&nbsp;</p><hr>
    </div>


  <?php } }?> 

    <div id="ChatDown"></div>

</div>


<div class="text-right">
  <a href="#ChatDown"><button type="button" class="btn btn-primary btn-sm"><i class="fa fa-angle-down" aria-hidden="true"></i></button></a>
</div>
<br>



<form method="post">
    <div class="d-flex">
        <input class="form-control" type="text" name="message" placeholder="Type a message">
        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit" name="SubmitMessage"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send</button>
                      
    </div>
</form>

  <?php } else {  ?>
  <i class='fas fa-comment-slash'></i>

  <p class="h3 text-danger text-center"><i><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size:150px; color: red;"></i> <br>Something is Wrong</i></p>

  <?php } ?>

<?php } ?>




                  </div>

                </div>
              </div>
            </div>

<?php } ?>


                          <?php if ($_GET['my']=="Favorite") {?>
                          <p class="h4">My Favorite</p><hr>
                          <?php include('includes/interface/custom/RentData.php');?>


                          <?php } ?>

                          <?php if ($_GET['my']=="Settings"){

                            $query = "SELECT * FROM users WHERE id='{$_SESSION['user_id']}'";
                            $login = mysqli_query($connection, $query);
                            $login_u = mysqli_fetch_assoc($login);

                          ?>

                          <form method="post">
                            <h1 class="h3 mb-3 font-weight-normal"><i class="fa fa-info-circle" aria-hidden="true"></i> Basic Infomations</h1>
                            
                            <div class="row mb-4">
                              <div class="col">
                                <div class="form-outline">
                                  <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name" value="<?php if(isset($login_u['first_name'])) {echo $login_u['first_name'];} ?>" required>
                                </div>
                              </div>

                              <div class="col">
                                <div class="form-outline">
                                  <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name" value="<?php if(isset($login_u['last_name'])) {echo $login_u['last_name'];} ?>" required>
                                </div>
                              </div>
                            </div>

                            <input type="email" id="email" name="email" class="form-control" placeholder="Email address" value="<?php if(isset($login_u['email'])) {echo $login_u['email'];} ?>" required="">
                            <br>

                            <div class="bs-example">
                                <div class="clearfix">
                                    <div class="pull-left"><button type="submit" class="btn btn-primary" name="updateBasic"><i class="fa fa-refresh" aria-hidden="true"></i> Update</button></div>
                                </div>
                            </div>
                            <br>

                            </form>
                            <hr>

                            <h1 class="h3 mb-3 font-weight-normal"><i class="fa fa-phone" aria-hidden="true"></i> Contact Information</h1>

                            <form method="post">
                            
                            <div class="row mb-4">
                              <div class="col">
                                <div class="form-outline">
                                  <input type="text" id="contact_number" name="contact_number" class="form-control" placeholder="Contact Number" value="<?php if(isset($login_u['contact_number'])) {echo $login_u['contact_number'];} ?>" required>
                                </div>
                              </div>

                              <div class="col">
                                <div class="form-outline">
                                  <input type="text" id="nic" name="nic" class="form-control" placeholder="NIC" value="<?php if(isset($login_u['nic'])) {echo $login_u['nic'];} ?>" required>
                                </div>
                              </div>
                            </div>

                            <div class="row mb-4">
                              <div class="col">
                                <div class="form-outline">
                                  <select class="form-control" name="province" required>

                                    <?php if(isset($login_u['province'])) { ?> <option value="<?php echo $login_u['province']; ?>">Selected "<?php echo $login_u['province']; ?>" Province</option> <?php  } else { ?><option selected disabled>Choose Province...</option><?php } ?>

                                    <option value="Southern">Southern</option>
                                    <option value="Western">Western</option>
                                    <option value="Central">Central</option>
                                    <option value="Eastern">Eastern</option>
                                    <option value="North Central">North Central</option>
                                    <option value="Northern">Northern</option>
                                    <option value="North Western">North Western</option>
                                    <option value="Sabaragamuwa">Sabaragamuwa</option>
                                    <option value="Uva">Uva</option>
                                  </select>
                                </div>
                              </div>

                              <div class="col">
                                <div class="form-outline">
                                  <select class="form-control" name="district">

                                    <?php if(isset($login_u['district'])) { ?> <option value="<?php echo $login_u['district']; ?>">Selected "<?php echo $login_u['district']; ?>" district</option> <?php  } else { ?><option selected disabled>Choose District</option><?php } ?>

                                    <option value="Kandy">Kandy</option>
                                    <option value="Matale">Matale</option>
                                    <option value="Nuwara Eliya">Nuwara Eliya</option>
                                    <option value="Ampara">Ampara</option>
                                    <option value="Batticaloa">Batticaloa</option>
                                    <option value="Trincomalee">Trincomalee</option>
                                    <option value="Anuradhapura">Anuradhapura</option>
                                    <option value="Polonnaruwa">Polonnaruwa</option>
                                    <option value="Jaffna">Jaffna</option>
                                    <option value="Kilinochchi">Kilinochchi</option>
                                    <option value="Mannar">Mannar</option>
                                    <option value="Mullaitivu">Mullaitivu</option>
                                    <option value="Vavuniya">Vavuniya</option>
                                    <option value="Kurunegala">Kurunegala</option>
                                    <option value="Puttalam">Puttalam</option>
                                    <option value="Kegalle">Kegalle</option>
                                    <option value="Ratnapura">Ratnapura</option>
                                    <option value="Galle">Galle</option>
                                    <option value="Hambantota">Hambantota</option>
                                    <option value="Matara">Matara</option>
                                    <option value="Badulla">Badulla</option>
                                    <option value="Monaragala">Monaragala</option>
                                    <option value="Colombo">Colombo</option>
                                    <option value="Gampaha">Gampaha</option>
                                    <option value="Kalutara">Kalutara</option>
                                  </select>

                                </div>
                              </div>
                            </div>

                            <input type="text" id="address" name="address" class="form-control" placeholder="Home Address" value="<?php if(isset($login_u['address'])) {echo $login_u['address'];} ?>" required="">
                            <br>
                            <div class="bs-example">
                                <div class="clearfix">
                                    <div class="pull-left"><button type="submit" class="btn btn-primary" name="updateContact"><i class="fa fa-refresh" aria-hidden="true"></i> Update</button></div>
                                </div>
                            </div>
                            <br>
                            <hr>

                          </form>

                            <h1 class="h3 mb-3 font-weight-normal"><i class="fa fa-key" aria-hidden="true"></i> Change Password</h1>
                          <form method="post">
                            <input type="password" id="password" name="cpassword" class="form-control" placeholder="Current password" required="">
                            <br>
                            <input type="password" id="newpassword" name="newpassword" class="form-control" placeholder="New Password" required="">
                            <br>
                            <input type="password" id="repassword" name="repassword" class="form-control" placeholder="Re-Enter New Password" required="">
                            <br>
                            <div class="bs-example">
                                <div class="clearfix">
                                    <div class="pull-left"><button type="submit" class="btn btn-primary" name="changePass"><i class="fa fa-pencil" aria-hidden="true"></i> Change Password</button></div>
                                </div>
                            </div>

                          </form>


                        <?php } ?>


                      </div>
                  </div>
              </div>
              <!-- end center -->
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

<div class="modal fade bd-example-modal-lg" id="exampleModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title"><i class="fa fa-plus" aria-hidden="true"></i> New Post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
  

<form method="post" enctype="multipart/form-data">

  <input type="text" id="title" name="title" class="form-control" placeholder="Post Title" required><br>

<img id="image1" width="200"/>
  <div>
    <label for="image1" class="form-label">Post Thumbnail</label>
    <input class="form-control" type="file" id="image1" name="image1" onchange="loadFile1(event)" required>
  </div>

<img id="image2" width="200"/>
  <div>
    <label for="images2" class="form-label">Add More images</label>
    <input class="form-control" type="file" id="images2" name="image2" onchange="loadFile2(event)" required>
  </div>
<img id="image3" width="200"/>
  <div>
    <label for="image3" class="form-label">Add More images</label>
    <input class="form-control" type="file" id="image3" name="image3" onchange="loadFile3(event)" required>
  </div>


  <br>

   <div class="row mb-4">
     <div class="col">
       <div class="form-outline">

        <select class="form-control" name="houseType" required>
          <option> Choose Your House</option> 
          <option value="bording">Bording House</option>
          <option value="rent">Rent House</option>
        </select>

      </div>
    </div>

    <div class="col">
      <div class="form-outline">
        <input type="Number" id="price" name="price" class="form-control" placeholder="Price (LKR)" name="price" required>
      </div>
    </div>
  </div>


  <div class="form-group">
    <label for="infor">Description (0 - 500 Characters)</label>
    <textarea class="form-control" id="infor" rows="3" name="infor" required></textarea>
  </div>

  <div class="form-group">
    <label for="map_fram">Location : Google Embed a map</label>
    <textarea class="form-control" id="map_fram" rows="3" name="map_fram" placeholder="<?php echo htmlentities('<iframe src="<YOUR CODE>"></iframe>')?>" required></textarea>
  </div>

  <div class="bs-example">
    <div class="clearfix">
        <div class="pull-left"><button type="submit" class="btn btn-primary" name="uploadPost"><i class="fa fa-upload" aria-hidden="true"></i> Upload</button></div>
      </div>
  </div>

</form>


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