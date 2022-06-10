<div class="row">

<?php if ($PageNum==1 OR $PageNum==8) {

if ($PageNum==1) {

  if (isset($_GET['District'])) {
    
    $query = "SELECT house.*,users.* FROM house INNER JOIN users ON house.by_ID = users.id WHERE adminConform ='1' AND district = '{$_GET['District']}' AND is_Buy IS NULL AND house.is_deleted IS NULL ORDER BY house.time DESC";

    if (isset($_GET['House'])) {

      $query = "SELECT house.*,users.* FROM house INNER JOIN users ON house.by_ID = users.id WHERE adminConform ='1' AND type = '{$_GET['House']}' AND district = '{$_GET['District']}' AND is_Buy IS NULL AND house.is_deleted IS NULL ORDER BY house.time DESC";
    }
  } else {

    if (isset($_GET['House'])) {

      $query = "SELECT * FROM house WHERE adminConform ='1' AND type = '{$_GET['House']}' AND is_Buy IS NULL AND is_deleted IS NULL ORDER BY time DESC";

    } else {

      $query = "SELECT * FROM house WHERE adminConform ='1' AND is_Buy IS NULL AND is_deleted IS NULL ORDER BY time DESC";

    }

    if (isset($_GET['search'])) {
     
      $query = "SELECT * FROM house WHERE  (title LIKE '%{$_GET['search']}%' OR type LIKE '%{$_GET['search']}%') AND adminConform ='1' AND is_Buy IS NULL AND is_deleted IS NULL ORDER BY time DESC";
    }

  }

} if ($PageNum==8) { if ($_GET['my']=="Dashboard" OR $_GET['my']=="Advertisements") {

  $query = "SELECT * FROM house WHERE by_ID = '{$_SESSION['user_id']}' AND is_deleted IS NULL";

  }
} if ($PageNum==8) { if ($_GET['my']=="Favorite") {

  $query = "SELECT house.*, favorite.* FROM house INNER JOIN favorite ON house.id = favorite.postID WHERE is_Buy IS NULL AND fav_by = '{$_SESSION['user_id']}' AND adminConform = '1' AND is_deleted IS NULL";
  }
}

$Houses = mysqli_query($connection, $query);
$row_results=mysqli_num_rows ($Houses);
if ($Houses) {
while ($House = mysqli_fetch_assoc($Houses)) {?>

<div class="col-md-4">
<div class="card mb-4 box-shadow">
<img class="card-img-top" src="<?php echo $homeURL;?>assets/images/house/<?php echo $House['image1'];?>" alt="House thumbnail">
<div class="card-body">
<p class="h4"><?php echo $House['title'];?></p>
<p class="card-text"><?php echo mb_strimwidth($House['infor'] , 0, 70, "...");?></p>
<div class="d-flex justify-content-between align-items-center">
<div class="btn-group">
<a href="<?php echo $homeURL;?>view.php?House=<?php echo $House['id'];?>"><button type="button" class="btn btn-outline-primary">View</button></a>    
</div>
<small class="text-muted"><?php $d=strtotime($House['time']); echo date("M d , D W", $d);?></small>
</div>

<?php if (isset($_SESSION['user_id']) AND isset($_GET['my']) AND $_GET['my']=="Favorite" AND $House['fav_by']==$_SESSION['user_id']) {?>
<hr>
<button type="button" class="btn btn-outline-danger btn-sm" title="Remove" data-toggle="modal" data-target="#removeFav-<?php echo $House['id'];?>"><i class="fa fa-remove"></i> Remove</button>

<?php } ?>

<?php if (isset($_SESSION['user_id'])) { if ($House['by_ID']==$_SESSION['user_id']) { if (isset($_GET['my'])) { if ($_GET['my']=="Advertisements") { ?>

<hr>
<button type="button" class="btn btn-outline-success btn-sm" title="edit" data-toggle="modal" data-target="#EditPanel-<?php echo $House['id'];?>"><i class="fa fa-pencil" aria-hidden="true"></i></button>

<button type="button" class="btn btn-outline-danger btn-sm" title="delete" data-toggle="modal" data-target="#DeleteConformedPanel-<?php echo $House['id'];?>"><i class="fa fa-trash" aria-hidden="true"></i></button>

<?php if (!isset($House['is_Buy']) AND  isset($House['adminConform'])) { ?>

<button type="button" class="btn btn-outline-primary btn-sm" title="Set Sold House" data-toggle="modal" data-target="#isSellPanel-<?php echo $House['id'];?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i></button>

<?php } ?>
<!-- HERE -->
<hr>
<?php if (isset($House['adminConform'])) { ?>
<button type="button" class="btn btn-outline-success btn-sm" title="Confirmed" disabled><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Confirmed</button>

  <?php if (isset($House['is_Buy'])) { ?>


<button type="button" class="btn btn-outline-info btn-sm" title="Sold House" disabled><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Sold</button>

<?php } } else {  ?>

<button type="button" class="btn btn-outline-secondary btn-sm" title="Not Confirmed" disabled><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;Pending..</button>

<?php } } } } } ?>

</div>
</div>
</div>

<?php include('includes/interface/PostEditDeleteModel.php'); //Delete Edit?>

<?php }  } if ($row_results == 0) { echo '<div class="card-body"><center><img src="assets/images/noResults.gif" width="600"></center></div>';
}  }//END MESSAGE ?>

</div>