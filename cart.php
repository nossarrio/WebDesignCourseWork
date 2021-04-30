
<?php
 require_once('productitem.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Drink Supermarket -  My Cart</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="images\judge.ico" />

  <link rel="stylesheet" href="font-awesome\css\font-awesome.css">
  <link rel="stylesheet" href=" css\style.css">
  <link rel="stylesheet" href=" css\products.css">

</head>

<body>

<?php
  if (!isset($_SESSION)) {
    session_start();
  }
    
  if (isset( $_POST['remove'] ) ) 
  { 
      foreach($_SESSION['mycart'] as $key=> $value)
      {
        if($value["product_id"]==$_POST['product_id'])
        {
          unset($_SESSION['mycart'][$key]);          
        }
      }  
  }

  if (isset( $_POST['save'] ) ) 
  { 
      $index=0;
      foreach($_SESSION['mycart'] as $key=> $value)
      {
        if($value["product_id"]==$_POST['product_id'])
        {
          $item_array=array('product_id'=>$_POST['product_id'],'qty'=>$_POST['quantity']);
          $_SESSION['mycart'][$index]=$item_array;
         // echo "<script>alert('Quantity updated');</script>";
        }
        $index+=1;
      }  
  }
  
?>
 

 <?php
 require_once('banner.php');
 require_once('menu.php');
 ?>


<!-- <div style="padding:10px; border-radius:5px; margin-left:8%; width:80%; background-color:#dca935" class="btn-danger">Item already added to cart</div> -->


<div class="top-picks text-left" style="padding-left:8%"><b><i class="fa fa-shopping-cart"></i> My Cart</b></div>
<hr style="padding:0px; width:80%"/>
<div class="row">

<div class="col-sm-1"> </div>

<div class="col-sm-5">

<?php

try {
 
  $totalCost=0;
  $con = mysqli_connect($config['DB_HOST'],$config['DB_USERNAME'],"",$config['DB_DATABASE']);

  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
  }

  if (isset($_SESSION['mycart'])) 
  {
    if(count($_SESSION['mycart'])==0) 
        echo '<h3>Cart is empty</h3>';  
  

    if ($result = mysqli_query($con, "SELECT * FROM drinkmarket.drinks;")) 
    {  
        while($row = $result->fetch_assoc()) 
        { 
          foreach($_SESSION['mycart'] as $key=> $value)
          {
            if($value["product_id"]==$row['Id'])
            {
              $totalCost+=floatval($row["Cost"])* floatval($value["qty"]);
              ProductItem($row["Name"], $row["Description"], $row["Image"],$row["Rating"],$row["Cost"],$row["Id"],$value["qty"] ); 
            }
          }  
        }
    }
 }
 else
   echo '<h3>Cart is empty</h3>';  

} catch(PDOException $e) { echo "Connection failed: " . $e->getMessage();}
 
?>

</div>

<div class="col-sm-1"> </div>

<div class="col-sm-3 show-case" style="padding:50px !important;" >
<b>PRICE DETAILS</b>
  <hr/>
  Price ( <?php 
            if (isset($_SESSION['mycart'])) {   
                echo count($_SESSION['mycart']); 
            }
            else
            {
              echo '0';
            } 
            ?> Items)

<b style="margin-left:80px;">£ <?php echo number_format($totalCost,2) ?></b>

<br/>
Delivery Charges <span style="color:green;"><b style="margin-left:68px;">FREE</b></span>
<hr/>
Amount Payable <b style="margin-left:65px;">£ <?php echo  number_format($totalCost,2) ?></b>
<br/><br/>
  <a  href="makepayment.php" class="btn btn-danger " style="cursor:pointer; text-decoration:none">
          Make Payment 
  </a> 
</div>


</div>


<?php
 require_once('footer.php');
?>

</body>

</html>