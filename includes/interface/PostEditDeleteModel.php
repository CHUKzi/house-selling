<!-- Modal -->
<div class="modal fade" id="DeleteConformedPanel-<?php echo $House['id'];?>">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content">
      <div class="modal-body">

        <h5 class="modal-title text-center">You Want to Delete?</h5><br>
        <div class="text-center">
          <img src="<?php echo $homeURL;?>assets/images/house/<?php echo $House['image1'];?>" alt="House thumbnail" width="175"><br><br>
            <a href="<?php echo $homeURL;?>account.php?my=Advertisements&Delete_Post=<?php echo $House['id'];?>"><button type="button" class="btn btn-danger">Yes</button></a>
          <button type="button" class="btn btn-primary" class="close" data-dismiss="modal" aria-label="Close">No</button>
        </div>

      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="removeFav-<?php echo $House['id'];?>">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content">
      <div class="modal-body">

        <h5 class="modal-title text-center">You Want to Remove?</h5><br>
        <div class="text-center">
          <img src="<?php echo $homeURL;?>assets/images/house/<?php echo $House['image1'];?>" alt="House thumbnail" width="175"><br><br>
            <a href="<?php echo $homeURL;?>account.php?my=Favorite&RmFav=<?php echo $House['id'];?>"><button type="button" class="btn btn-danger">Yes</button></a>
          <button type="button" class="btn btn-primary" class="close" data-dismiss="modal" aria-label="Close">No</button>
        </div>

      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="EditPanel-<?php echo $House['id'];?>">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title"><?php echo $House['title'];?> /// <?php echo $House['time'];?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
  

<form method="post" enctype="multipart/form-data">

  <input type="text" id="title" name="title" class="form-control" placeholder="Post Title" value="<?php echo $House['title'];?>" required><br>



<div1>
  <img src="assets/images/house/<?php echo $House['image1'];?>" width="200">
  <input type="hidden" name="imag1" value="<?php echo $House['image1'];?>">
</div1>
<img id="Eimage1" width="200"/>

  <div>
    <label for="image1" class="form-label">Post Thumbnail</label>
    <input class="form-control" type="file" id="Eimage1" name="image1" onchange="EditloadFile1(event)">
  </div>

<div2>
  <img src="assets/images/house/<?php echo $House['image2'];?>" width="200">
  <input type="hidden" name="imag2" value="<?php echo $House['image2'];?>">
</div2>
<img id="Eimage2" width="200"/>

  <div>
    <label for="images2" class="form-label">Add More images</label>
    <input class="form-control" type="file" id="Eimages2" name="image2" onchange="EditloadFile2(event)">
  </div>

<div3>
  <img src="assets/images/house/<?php echo $House['image3'];?>" width="200">
  <input type="hidden" name="imag3" value="<?php echo $House['image3'];?>">
</div3>
<img id="Eimage3" width="200"/>
  <div>
    <label for="image3" class="form-label">Add More images</label>
    <input class="form-control" type="file" id="Eimage3" name="image3" onchange="EditloadFile3(event)">
  </div>


  <br>

   <div class="row mb-4">
     <div class="col">
       <div class="form-outline">

        <select class="form-control" name="houseType" required>

          <?php if ($House['type']=="bording") {?><option value="bording">Already Chosen "Bording" House Type</option> 
          <?php } else { ?><option value="rent">Already Chosen "Rent" House Type</option> 
          <?php } ?>
         
          <option value="bording">Bording House</option>
          <option value="rent">Rent House</option>
        </select>

      </div>
    </div>

    <div class="col">
      <div class="form-outline">
        <input type="Number" id="price" name="price" class="form-control" placeholder="Price (LKR)" name="price" value="<?php echo $House['price'];?>" required>
      </div>
    </div>
  </div>


  <div class="form-group">
    <label for="infor">Description (0 - 500 Characters)</label>
    <textarea class="form-control" id="infor" rows="3" name="infor" required><?php echo $House['infor'];?></textarea>
  </div>

  <div class="form-group">
    <label for="map_fram">Location : Google Embed a map</label>
    <textarea class="form-control" id="map_fram" rows="3" name="map_fram" placeholder="<?php echo htmlentities('<iframe src="<YOUR CODE>"></iframe>')?>" required><?php echo $House['map_fram'];?></textarea>
  </div>

  <div class="bs-example">
    <div class="clearfix">
        <input type="hidden" name="postID" value="<?php echo $House['id'];?>">
        <div class="pull-left"><button type="submit" class="btn btn-primary" name="EditPost"><i class="fa fa-upload" aria-hidden="true"></i> Edit Post</button></div>
      </div>
  </div>

</form>


      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="isSellPanel-<?php echo $House['id'];?>">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content">
      <div class="modal-body">

        <h5 class="modal-title text-center">This House Sold??</h5><br>
        <div class="text-center">
          <img src="<?php echo $homeURL;?>assets/images/house/<?php echo $House['image1'];?>" alt="House thumbnail" width="175"><br><br>
            <a href="<?php echo $homeURL;?>account.php?my=Advertisements&is_sold=<?php echo $House['id'];?>"><button type="button" class="btn btn-danger">Yes</button></a>
          <button type="button" class="btn btn-primary" class="close" data-dismiss="modal" aria-label="Close">No</button>
        </div>

        <p class="text-danger">If you say <b>"YES"</b>customers can't see see your House. And Also You can't Change Back to Sale Your house Again</p><p>If your House is not Sole yet, Please Say "NO"</p>

      </div>
    </div>
  </div>
</div>