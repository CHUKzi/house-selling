<?php
$PageNum = 6;
require_once('includes/connection.php');

$query = "SELECT * FROM house WHERE adminConform = '1' AND  is_Buy IS NULL AND is_deleted IS NULL AND id='{$_GET['House']}'";
$houseiNFOS = mysqli_query($connection, $query);
$houseINFO = mysqli_fetch_assoc($houseiNFOS);

$query = "SELECT * FROM users WHERE id='{$houseINFO['by_ID']}'";
$postByUsers = mysqli_query($connection, $query);
$postByUser = mysqli_fetch_assoc($postByUsers);

if (empty($postByUser)) {
  header( 'Location: '. $homeURL.'404.php');
}


if (!isset($_SESSION['user_id'])) {

  $selected_user_contact_number = str_pad(substr($postByUser['contact_number'], -4), strlen($postByUser['contact_number']), '*', STR_PAD_LEFT);

  $em = explode("@",$postByUser['email']);
  $name = $em[0];
  $len = strlen($name);
  $showLen = floor($len/2);
  $str_arr = str_split($name);
  for($ii=$showLen;$ii<$len;$ii++){
      $str_arr[$ii] = '*';
  }
  $em[0] = implode('',$str_arr); 
  $selected_user_email_hidden = implode('@',$em);

  $ContactBtn = '';

  $Er_mg = "Please Login to View Full Contact Details";

} else {

if (empty($login_u['contact_number'] AND $login_u['province'] AND $login_u['district'] AND $login_u['address'] AND $login_u['nic'])) {

  $selected_user_contact_number = str_pad(substr($postByUser['contact_number'], -4), strlen($postByUser['contact_number']), '*', STR_PAD_LEFT);

  $em = explode("@",$postByUser['email']);
  $name = $em[0];
  $len = strlen($name);
  $showLen = floor($len/2);
  $str_arr = str_split($name);
  for($ii=$showLen;$ii<$len;$ii++){
      $str_arr[$ii] = '*';
  }
  $em[0] = implode('',$str_arr); 
  $selected_user_email_hidden = implode('@',$em);

  $ContactBtn = '';

  $Er_mg = 'Please Update Your Contact Information '.'<a href="'.$homeURL.'account.php?my=Settings">Update</a>';

  } else {

    $ContactBtn = 1;

    $selected_user_contact_number = $postByUser['contact_number'];
    $selected_user_email_hidden = $postByUser['email'];
  }

}

if (isset($_GET['addInbox'])) {
  $DefaultMessage = "Hey! I Want Know About This House";

  $query  = "INSERT INTO message (";
  $query .= "from_id, to_id, message, for_ID";
  $query .= ") VALUES (";
  $query .= "'{$_SESSION['user_id']}', '{$_GET['addInbox']}', '{$DefaultMessage}', '{$_GET['HouseID']}'";
  $query .= ")";

  $result = mysqli_query($connection, $query);

  if ($result) {
    $suces = 'Contact request Send Successfully, Saller Will Contact You Soon </br> Please Check Your Inbox. My Account ==> Inbox';
  } else {
    $errors = 'Send failed';
  }
}

if (isset($_GET['addFav'])) {

    if (isset($_SESSION['user_id'])) {


    $query = "SELECT * FROM favorite WHERE fav_by = '{$_SESSION['user_id']}' AND postID = '{$_GET['House']}' LIMIT 1";
    $result_set = mysqli_query($connection, $query);
    if ($result_set) {
      if (mysqli_num_rows($result_set) == 1) {
        $warnings[] = 'Already Added This house in your favorite list';
      }
    } 


    if (empty($warnings)) {
      $query  = "INSERT INTO favorite (";
      $query .= "fav_by, postID";
      $query .= ") VALUES (";
      $query .= "'{$_SESSION['user_id']}', '{$_GET['House']}'";
      $query .= ")";

      $result = mysqli_query($connection, $query);

      if ($result) {
        $suces = 'Add this House in your favorite List';
      } else {
        $errors = 'failed';
      }
    }

  } else {
    $warnings[] = 'Please Login And Continue';
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
    <!-- lesi stylesheet -->
    <link href="assets/css/view.css" rel="stylesheet">
  </head>

  <body>

    <?php 
    //header
    include('includes/interface/header.php');?>

    <main role="main">
      <div class="container">
                  <?php
                  include('includes/interface/custom/Alerts.php');
                  ?>
          <div class="card">

            <div class="container-fliud">
              <div class="wrapper row">
                <div class="preview col-md-6">
                  
                  <div class="preview-pic tab-content">
                    <div class="tab-pane active" id="pic-1"><img src="<?php echo $homeURL;?>assets/images/house/<?php echo $houseINFO['image1'];?>" /></div>
                    <div class="tab-pane" id="pic-2"><img src="<?php echo $homeURL;?>assets/images/house/<?php echo $houseINFO['image2'];?>" /></div>
                    <div class="tab-pane" id="pic-3"><img src="<?php echo $homeURL;?>assets/images/house/<?php echo $houseINFO['image3'];?>" /></div>


                  <ul class="preview-thumbnail nav nav-tabs">
                    <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="<?php echo $homeURL;?>assets/images/house/<?php echo $houseINFO['image1'];?>" /></a></li>
                    <li><a data-target="#pic-2" data-toggle="tab"><img src="<?php echo $homeURL;?>assets/images/house/<?php echo $houseINFO['image2'];?>" /></a></li>
                    <li><a data-target="#pic-3" data-toggle="tab"><img src="<?php echo $homeURL;?>assets/images/house/<?php echo $houseINFO['image3'];?>" /></a></li>
                  </ul>
                  </div>

                  
                </div>
                <div class="details col-md-6">
                  <h3 class="product-title"><?php echo $houseINFO['title']; ?></h3>

                  <div class="house-info">
                    <span class="product_info"><?php echo $houseINFO['infor'];?></span><br> 

                  </div>

                  <h4 class="price">current price: <span>LKR.<?php echo $houseINFO['price'];?></span></h4>
                  <!-- <strike class="product_discount"><span style='color:black'>Rs.8,000</span></strike>  -->
                  <div class="action">
                    <a class="btn btn-primary" data-toggle="collapse" href="#ContactInfomation" role="button" aria-expanded="false" aria-controls="ContactInfomation"><i class="fa fa-info-circle" aria-hidden="true"></i> Contact Seller</a>

                    <a href="<?php echo $homeURL;?>view.php?House=<?php echo $_GET['House'];?>&addFav=yes" class="btn btn-danger" href="#multiCollapseExample1"><span class="fa fa-heart"></span></a>
                  </div>
                  <!-- Collapse Panel Start -->
                  <div class="collapse" id="ContactInfomation">
                    <div class="card card-body">

                      <p><b>Address :</b> <?php echo $postByUser['province']." Province, ".$postByUser['district'].",".$postByUser['address'];?></br>

                      <b>Phone :</b> <?php echo $selected_user_contact_number; ?></br>
                      <b>Email Address :</b> <?php echo $selected_user_email_hidden; ?></p>

                      <?php if (isset($Er_mg)) {?>
                        <p><i class="text-danger"><?php echo $Er_mg; ?></i></p>
                      <?php } ?>
                      
                      <?php if ($ContactBtn) { ?>
                        <?php if (!($houseINFO['by_ID']==$_SESSION['user_id'])) { ?>

                      <a href="<?php echo $homeURL;?>view.php?House=<?php echo $_GET['House'];?>&addInbox=<?php echo $postByUser['id'];?>&HouseID=<?php echo $houseINFO['id'];?>"><button class="btn btn-primary"><i class="fa fa-comments-o" aria-hidden="true">
                        
                      </i> Chat with seller About this house</button></a>
                    <?php  } } ?>

                    </div>      
                  </div>
                  <!-- Collapse Panel End -->
                </div>
              </div>
              <br>

                <div class="embed-responsive embed-responsive-16by9">
                  <?php echo $houseINFO['map_fram'];?>
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