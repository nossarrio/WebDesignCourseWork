<!DOCTYPE html>
<html lang="en">

<head>
  <title>Drink Supermarket - Product Info</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="images\judge.ico" />

  <link rel="stylesheet" href="font-awesome\css\font-awesome.css">
  <link rel="stylesheet" href=" css\style.css">
  <link rel="stylesheet" href=" css\products.css">

</head>

<body>


  <!--banner-->
  <div class="navbar navbar-expand-sm bg-light navbar-light">

    <div class="row fullwidth">

      <div class="col-sm-1"> </div>

      <div class="col-sm-2">
        <a class="navbar-brand lg" href="index.html">
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
            <a class="btn btn-danger menu-button"  href="account.html" ><i class="fa fa-user"></i> Account</button></a>
          </div>
          <div class="col">
            <button class="btn btn-danger menu-button"><i class="fa fa-shopping-cart"></i> £ 0.00</button>
          </div>
        </div>
      </div>

    </div>
  </div>


  <!--menu-->
  <div class="menu">
    <div class=row>
      <div class="col-sm-1">

      </div>
      <div class="col-sm-1">
        <a class="menu-link" href="products.php?category=wine"> <i class="fa fa-circle"></i> Wine</a>
      </div>
      <div class="col-sm-1">
        <a class="menu-link" href="products.php?category=beer"> <i class="fa fa-circle"></i> Beer</a>
      </div>
      <div class="col-sm-1">
        <a class="menu-link" href="products.php?category=spirits"> <i class="fa fa-circle"></i> Spirits</a>
      </div>
      <div class="col-sm-1">
        <a class="menu-link" href="products.php?category=mixers"> <i class="fa fa-circle"></i> Mixers</a>
      </div>
      <div class="col-sm-1">
        <a class="menu-link" href="products.php?category=barware"> <i class="fa fa-circle"></i> Barware</a>
      </div>
      <div class="col-sm-1">
        <a class="menu-link" href="products.php?category=gifts"> <i class="fa fa-circle"></i> Gifts</a>
      </div>
      <div class="col-sm-1">
        <a class="menu-link" href="products.php?category=more"> <i class="fa fa-circle"></i> More</a>
      </div>
    </div>
  </div>




<?php
  

try {
 
  $con = mysqli_connect("localhost","root","","drinkmarket");
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
  }

  if ($result = mysqli_query($con, "SELECT * FROM drinkmarket.drinks where Id='".$_GET['product']."';")) 
  {  
    while($row = $result->fetch_assoc()) 
    { 
      echo '<h1 class="top-picks text-center">Enter Quantity</h1>';

      echo '<div class="row fullwidth">';
      echo '<div class="col"></div>';       
    
      echo ' <div class="col show-case" style="text-align: center;">';
      echo '   <img src="'. $row["Image"] .'">';  
      echo '   <br> <br>';
      echo '   <h3 class="text-center">'. $row["Name"] .'</h3>';
      echo '   <br>';
      echo '   <div class="text-center">';
      echo '     <i class="fa fa-star"></i>';
      echo '     <i class="fa fa-star"></i>';
      echo '     <i class="fa fa-star"></i>';
      echo '     <i class="fa fa-star"></i>';
      echo '     <i class="fa fa-star"></i>';
      echo '   </div>';
      echo '   <p class="text-center amount-p">£ '. $row["Cost"] .'</p>';

      echo '   Quantity: <input type="number" value="1" style="width:50px;"></input>';
      echo '   <br><br>';
      echo '   <div class="text-center add-to-cart-container">';
      echo '     <a href="products.php?category='.    $_GET['category'].'&product=' . $row["Id"] .'" class="btn btn-danger" style="cursor:pointer; text-decoration:none">';
      echo '       SUBMIT ';
      echo '     </a>';
      echo '   </div>';
      echo '  </div>';
  
       
      echo '<div class="col"></div>';
      echo '</div>';
     
    }
  }

} catch(PDOException $e) 
{
  echo "Connection failed: " . $e->getMessage();
}

  

?>

<br><br>
 
  <!--footer-->
  <div class="footer">
    NEWSLETTER
    <br>
    <div class="form-inline">
      <table class="fullwidth">
        <tr>
          <td>
            <input id="searchText" class="form-control "   type="text" placeholder="Enter Your Email">
            <button class="btn btn-danger search-btn" type="button"><i class="fa fa-envelope"></i> Subscribe </button>
          </td>
          <td>
            <table>
              <tr>
                <td> </td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </table>

          </td>
        </tr>
      </table>
    </div>
  </div>

</body>



</html>