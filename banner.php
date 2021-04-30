  <!--banner-->
  <div class="navbar navbar-expand-sm bg-light navbar-light">

    <div class="row fullwidth">

      <div class="col-sm-1"> </div>

      <div class="col-sm-2">
        <a class="navbar-brand lg" href="index.php">
          <img class="logo" src="images/logo.svg">
        </a>
      </div>

      <div class="col-sm-5">
        <div class="form-inline">
          <input id="searchText" class="form-control search-text" type="text" placeholder="Find Your Drink...">
          <button class="btn btn-danger search-btn" type="button"><i class="fa fa-search"></i> </button>
        </div>
      </div>

      <div class="col-sm-3">
        <div class="row fullwidth">
        <div class="col">
            <button onclick="window.location='cart.php'" class="btn btn-danger menu-button"><i class="fa fa-shopping-cart"></i> Cart 
            <?php 
            if (isset($_SESSION['mycart'])) {   
                echo count($_SESSION['mycart']); 
            }
            else
            {
              echo '0';
            } 
            ?>
            </button>
          </div>
          <div class="col">
            <?php 
              if(!isset($_SESSION['user']) && !isset($_SESSION['admin']))
                    echo "<a class=\"btn btn-danger menu-button\"  href=\"signin.php\" ><i class=\"fa fa-user\"></i> Sign In</button></a>";
                else
                echo "<a class=\"btn btn-danger menu-button\"  href=\"index.php?option=logout\" ><i class=\"fa fa-sign-out\"></i> Logout</button></a>";
            ?>
          </div>
        
        </div>
      </div>

    </div>
  </div>