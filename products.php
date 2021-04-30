<!DOCTYPE html>
<html lang="en">

<head>
  <title>Drink Supermarket - Products</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="images\judge.ico" />

  <link rel="stylesheet" href="font-awesome\css\font-awesome.css">
  <link rel="stylesheet" href=" css\style.css">
  <link rel="stylesheet" href=" css\products.css">

</head>

<body>

<?php
  
  include 'config.php';

  if (!isset($_SESSION)) {
    session_start();
  }

  
 //check if user hit the add to cart button
 if (isset( $_POST['addbtn'] ) ) 
 { 
    //check if session to capture cart is already defined
    if (isset($_SESSION['mycart'])) { 
     
        //get product id of all items added to session in form of an array
        $item_in_array= array_column($_SESSION['mycart'],'product_id');      
     
        //check if product id of item to be added to the cart has previously been added to cart
        if(in_array($_POST['product_id'],$item_in_array))
        {
          $index=0;
          //iterate through cart items
          foreach($_SESSION['mycart'] as $key=> $value)
          {
            //get items whose product id matches product id of item to be added to cart
            if($value["product_id"]==$_POST['product_id'])
            {
              //increment quantity by one
              $item_array=array('product_id'=>$_POST['product_id'],'qty'=> (floatval($value["qty"])+1));

              //update cart in session
              $_SESSION['mycart'][$index]=$item_array; 
            }
            $index+=1;
          }  
        }
        else
        {
          //item to be added to cart doesn't already exist in cart, hence get count of all items in cart
          $count_in_session= count($_SESSION['mycart']);

          //create array of item to be added to cart
          $item_array=array('product_id'=>$_POST['product_id'],'qty'=>1); 

          //add item to the last index of cart array
          $_SESSION['mycart'][$count_in_session]=$item_array;
        }
    }
    else
    {
        //session to hold cart doesm't exist, hence create array of item to be added to cart
        $item_array=array('product_id'=>$_POST['product_id'],'qty'=>1);

        //add item to index 0 of cart array
        $_SESSION['mycart'][0]=$item_array;
    }  
 }

?>
 

 <?php
 require_once('banner.php');
 require_once('menu.php');
 ?>


<div class="top-picks text-center">Add drinks to Cart</div>


<?php

try {
 
  //create connection to database
  $con = mysqli_connect($config['DB_HOST'],$config['DB_USERNAME'],"",$config['DB_DATABASE']);

  //confirm connection is working
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
  }

  //run query to get all drink types in db
  if($result = mysqli_query($con, "SELECT * FROM drinkmarket.drinks;")) 
  {
    $counter=0;

    while($row = $result->fetch_assoc()) 
    { 
      if(($counter % 4) == 0 || $counter==0)
      {
        echo '<div class="row fullwidth">';
        echo '<div class="col-sm-2"></div>'; 
      }
    
      echo ' <div class="col-sm-2 show-case" style="text-align: center;">';
      echo '   <img src="'. $row["Image"] .'">';
      echo '   <h2 class="text-center">'. $row["Name"] .'</h2>';  
      echo '   <p class="text-center">'. $row["Description"] .'</p>';
      echo '   <div class="text-center">';
      echo '     <i class="fa fa-star'. ($row["Rating"] > 0?'':'-o').'"></i>';
      echo '     <i class="fa fa-star'. ($row["Rating"] > 1?'':'-o').'"></i>';
      echo '     <i class="fa fa-star'. ($row["Rating"] > 2?'':'-o').'"></i>';
      echo '     <i class="fa fa-star'. ($row["Rating"] > 3?'':'-o').'"></i>';
      echo '     <i class="fa fa-star'. ($row["Rating"] > 4?'':'-o').'"></i>';
      echo '   </div>';
      echo '   <p class="text-center amount-p">£ '. $row["Cost"] .'</p>';
      echo '   <div class="text-center add-to-cart-container">';
      echo '   <form action="products.php" method="post">';
      echo '     <button type="submit" name="addbtn"  class="btn btn-danger " style="cursor:pointer; text-decoration:none">';
      echo '       Add to Cart <i class="fa fa-shopping-cart"></i>';
      echo '     </button>'; 
      echo '     <input type="hidden" name="product_id" value="'. $row["Id"] .'" />';
      echo '   </form>';
      echo '   </div>';
      echo '  </div>';

      if($counter % 4 == 0 && $counter!= 0 )
      { 
        echo '<div class="col-sm-2"></div>';
        echo '</div>';
      }

      $counter=$counter+1;
    }
  }

} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

 echo '<div class="col-sm-2"></div>';
 echo '</div></div>';
 
 
 require_once('footer.php');
?>


</body>

</html>