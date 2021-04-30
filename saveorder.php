<!DOCTYPE html>
<html lang="en">

<head>
  <title>Drink Supermarket - Save Order</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="images\judge.ico" />
  
  <link rel="stylesheet" href="font-awesome\css\font-awesome.css">
  <link rel="stylesheet" href=" css\style.css">
  <link rel="stylesheet" href=" css\account.css">
</head>

<body>
  
  

<?php
 include 'config.php';
 
  //start session
  if (!isset($_SESSION)) {
    session_start();
  }
 require_once('banner.php');
 require_once('menu.php');
 ?>
 

<br/>
<br/>
<br/>

<?php




  if (isset($_POST['submit'])) 
  { 
        //create connection
        $con = mysqli_connect($config['DB_HOST'],$config['DB_USERNAME'],"",$config['DB_DATABASE']);
  
        //check connection
        if (mysqli_connect_errno()) {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
          exit();
        } 
  
        // Set parameters
        // $param_fname = mysqli_real_escape_string($con, $_POST["FirstName"]);
        // $param_lname = mysqli_real_escape_string($con,$_POST["LastName"]);
        // $param_cardnumber = mysqli_real_escape_string($con,$_POST["CardNumber"]);
        // $param_cvv = mysqli_real_escape_string($con,$_POST["CVV"]);
        // $param_month = mysqli_real_escape_string($con,$_POST["TotalCost"]);
        // $param_year = mysqli_real_escape_string($con,$_POST["Year"]);

       

        $param_CustomerEmail = mysqli_real_escape_string($con, $_SESSION['user'][0]); 
        $param_OrderNumber = mysqli_real_escape_string($con,rand());      
        $param_Status = mysqli_real_escape_string($con,'PENDING');
        $param_TotalCost =0;
        $param_ItemCount=0;

        $count=0;
        if ($result = mysqli_query($con, "SELECT * FROM drinkmarket.drinks;")) 
        {  
            while($row = $result->fetch_assoc()) 
            { 
              foreach($_SESSION['mycart'] as $key=> $value)
              {
                if($value["product_id"]==$row['Id'])
                {
                  $count=$count+1;
                  $param_TotalCost+=floatval($row["Cost"])* floatval($value["qty"]);
                }
              }  
            }
        }

        $param_ItemCount = mysqli_real_escape_string($con,$count);      
        $param_TotalCost = mysqli_real_escape_string($con,$param_TotalCost);        
        $sql = "Insert into drinkmarket.Order (CustomerEmail,ItemCount,OrderNumber,Status,TotalCost) values('$param_CustomerEmail','$param_ItemCount','$param_OrderNumber','$param_Status','$param_TotalCost')";
          
        //execute query/ create new user
        if(mysqli_query($con, $sql))
        {  
          //save order details
          if ($result = mysqli_query($con, "SELECT * FROM drinkmarket.drinks;")) 
          { 
            while($row = $result->fetch_assoc()) 
            { 
              foreach($_SESSION['mycart'] as $key=> $value)
              {
                if($value["product_id"]==$row['Id'])
                {
                  $param_ItemName = mysqli_real_escape_string($con,$row["Name"]); 
                  $param_Quantity = mysqli_real_escape_string($con,$value["qty"]);   
                  $param_TotalCost =floatval($row["Cost"])* floatval($value["qty"]);
                  $sql = "Insert into drinkmarket.OrderDetails (ItemName,OrderNumber,Quantity,TotalCost) values('$param_ItemName','$param_OrderNumber','$param_Quantity','$param_TotalCost')";
                  //save order details
                  mysqli_query($con, $sql);             
                }
              }  
            }
          }
 
           //clear cart    
           $_SESSION["mycart"]=null;  
            
           echo '<br/><div class="text-center"><h1> Your order was saved successfully!</h1></div>';
        } 
        else
        {
            echo "ERROR: Could not save order $sql. " . mysqli_error($link);
        }
       
      // Close connection
      mysqli_close($con); 
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