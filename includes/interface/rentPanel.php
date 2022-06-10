<?php if ($PageNum==1){ ?>
<main role="main">

      <div class="container">
        <br>
          <div class="row">
            <!-- start 2 -->
              <div class="col-12 col-sm-3">
                  <div class="card bg-light mb-3">

                      <div class="card-header bg-primary text-white text-uppercase"><i class="fa fa-list" aria-hidden="true"></i> Catagory</div>

                        <?php
                        if (isset($_GET['District'])) {
                          //house URL
                          $reMakeURL = $homeURL."?District=".$_GET['District']."&House=";
                        } else {
                          //house URL
                          $reMakeURL = $homeURL."?House=";
                        }
                        ?>
                        <div class="card-body">

                          <div class="form-group">
                            <!-- <label for="exampleFormControlSelect1">Select By District</label> -->
                            <select class="form-control" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                              <option value=""><?php if (isset($_GET['District'])) { echo "Selected ". $_GET['District'];} else { echo "Select District"; } ?></option>
                                    <option value="?District=Kandy">Kandy</option>
                                    <option value="?District=Matale">Matale</option>
                                    <option value="?District=Nuwara Eliya">Nuwara Eliya</option>
                                    <option value="?District=Ampara">Ampara</option>
                                    <option value="?District=Batticaloa">Batticaloa</option>
                                    <option value="?District=Trincomalee">Trincomalee</option>
                                    <option value="?District=Anuradhapura">Anuradhapura</option>
                                    <option value="?District=Polonnaruwa">Polonnaruwa</option>
                                    <option value="?District=Jaffna">Jaffna</option>
                                    <option value="?District=Kilinochchi">Kilinochchi</option>
                                    <option value="?District=Mannar">Mannar</option>
                                    <option value="?District=Mullaitivu">Mullaitivu</option>
                                    <option value="?District=Vavuniya">Vavuniya</option>
                                    <option value="?District=Kurunegala">Kurunegala</option>
                                    <option value="?District=Puttalam">Puttalam</option>
                                    <option value="?District=Kegalle">Kegalle</option>
                                    <option value="?District=Ratnapura">Ratnapura</option>
                                    <option value="?District=Galle">Galle</option>
                                    <option value="?District=Hambantota">Hambantota</option>
                                    <option value="?District=Matara">Matara</option>
                                    <option value="?District=Badulla">Badulla</option>
                                    <option value="?District=Monaragala">Monaragala</option>
                                    <option value="?District=Colombo">Colombo</option>
                                    <option value="?District=Gampaha">Gampaha</option>
                                    <option value="?District=Kalutara">Kalutara</option>
                              </select>
                          </div>

                          <div class="form-check">

                            <input class="form-check-input" type="radio" name="checket" onClick="if (this.checked) { window.location = this.value; }" id="all" value="<?php echo $homeURL;?>" <?php if (!isset($_GET['House'])) { echo "checked"; }?> >
                            <label class="form-check-label" for="all">ALL</label>
                          </div>

                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="checket" onClick="if (this.checked) { window.location = this.value; }" id="house-1" value="<?php echo $reMakeURL;?>Bording" <?php if (isset($_GET['House'])) { if ($_GET['House']=="Bording") { echo "checked"; }}?> >
                            <label class="form-check-label" for="house-1">Bording House</label>

                          </div>

                          <div class="form-check">
                            <input class="form-check-input" type="radio" id="house-2" onClick="if (this.checked) { window.location = this.value; }" value="<?php echo $reMakeURL;?>Rent" <?php if (isset($_GET['House'])) { if ($_GET['House']=="Rent") { echo "checked"; } }?>>
                            <label class="form-check-label" for="house-2"> Rent House</label>

                          </div>
                      </div>

                  </div>
              </div>

              <div class="col">
                <form method="get">
                    <div class="d-flex">
                        <input class="form-control" type="text" name="search" value="<?php if (isset($_GET['search'])){echo $_GET['search'];} ?>" placeholder="Search Here...">
                        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                    </div>
                  </form>
                  <br>
                  <div class="card">
                      <div class="card-body">

                          <?php include('includes/interface/custom/RentData.php');?>

                      </div>
                  </div>
              </div>
              <!-- end center -->
          </div>
      </div>

    </main>

<?php }?>