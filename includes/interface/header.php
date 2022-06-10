    <header>
          
      <div class="navbar navbar-dark bg-primary box-shadow fixed-top">
        <div class="container d-flex justify-content-between">
          <a href="<?php echo $homeURL;?>" class="navbar-brand d-flex align-items-center">
            <i class="fa fa-home" aria-hidden="true"></i>
            <strong>Lesi.lk</strong>
          </a>
          <!-- login BTn -->
          <?php if (!isset($_SESSION['user_id'])) {?>
          <a href="<?php echo $homeURL;?>login.php"><button type="button" class="btn btn-outline-light"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</button></a>
          <?php } else { ?>
          <a href="<?php echo $homeURL;?>account.php?my=Dashboard"><button type="button" class="btn btn-outline-light"><i class="fa fa-user" aria-hidden="true"></i> My account</button></a>
          <?php } ?>
        </div>

      </div>
    </header>
    <br><br><br>