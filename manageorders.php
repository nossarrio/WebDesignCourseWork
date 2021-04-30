<!DOCTYPE html>
<html lang="en">

<head>
  <title>Drink Supermarket - Sign In</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="images\judge.ico" />
  
  <link rel="stylesheet" href="font-awesome\css\font-awesome.css">
  <link rel="stylesheet" href=" css\style.css">
  <link rel="stylesheet" href=" css\account.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
   


<?php

 include 'config.php';

  //start session
  if (!isset($_SESSION)) {
    session_start();
  } 

  //deny non admin access to page
  if(!$_SESSION["admin"])
  header("Location: signin_admin.php");  

  //create connection to database
  $con = mysqli_connect($config['DB_HOST'],$config['DB_USERNAME'],"",$config['DB_DATABASE']);

  //confirm connection is working
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
  }



  if ($_GET)
  {
    //check if user is trying to logout
    if ($_GET["option"]=="delivered")  
    {
        mysqli_query($con, "update drinkmarket.order set status='DELIVERED' where OrderNumber='".$_GET["ordernumber"]."'");
    } 

    if ($_GET["option"]=="delete")  
    {
      mysqli_query($con, "delete from drinkmarket.order  where OrderNumber='".$_GET["ordernumber"]."'");
    } 
  }

 ?>



<?php
 require_once('banner.php');
 require_once('menu.php');


 try {
 
 
  
  //run query to get all drink types in db
  if($result = mysqli_query($con, "SELECT * FROM drinkmarket.order;")) 
  { 
    echo '<h1>Manage Order</h1> <div class="thin-h-line"></div>';
    echo '<table   class="table table-striped table-bordered"><tr><td>Order Number</td><td>Customer Email</td><td>Total Cost</td><td>Item Count</td><td>Status</td><td></td></tr>';
    while($row = $result->fetch_assoc()) 
    {  
      echo ' <tr><td>'. $row["OrderNumber"] .'</td><td>'. $row["CustomerEmail"] .'</td><td>'. $row["TotalCost"] .'</td><td>'. $row["ItemCount"] .'</td><td>'. $row["Status"] .'</td><td>';
      echo '<a  class="btn btn-success" style="color:white; cursor:pointer" href="manageorders.php?option=delivered&ordernumber='.$row["OrderNumber"].'" >Delivered</a>';
      echo '<a  href="manageorders.php?option=delete&ordernumber='.$row["OrderNumber"].'" class="btn btn-danger" style="color:white; cursor:pointer" >Delete Order</a></td></tr>    ';
    }
    echo '</table>';
  }

} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
 ?>

 

<br/>
<br/>
<br/>
<br/><br/><br/>
<?php
require_once('footer.php');
?>

</body> 
</html>