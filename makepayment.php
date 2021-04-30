
<?php
 require_once('productitem.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Drink Supermarket - Payment</title>
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

  if (!isset($_SESSION['user']))
     header("Location: signin.php");  
?>
 

 <?php
 require_once('banner.php');
 require_once('menu.php');
 ?>

 
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
            }
          }  
        }
    }
 }
  

} catch(PDOException $e) { echo "Connection failed: " . $e->getMessage();}
 
?>


<div class="top-picks text-left" style="padding-left:8%"><b><i class="fa fa-shopping-cart"></i> Paymment</b></div>
<hr style="padding:0px; width:80%"/>
<div class="row">

<div class="col-sm-1"> </div> 

<div class="col-sm-6 show-case" style="width:80%; padding-left:30px !important;  padding-right:30px !important; padding-bottom:30px !important; padding-top:30px !important; " >
     <div class="row" style="margin:0px !important; padding:10px; border-radius:5px;   width:100%; background-color:#002846; color:white; font-weight:bold;"  >
       <div class="col">
          ORDER OVERVIEW
       </div>
       <div class="col" style="text-align:right">
       <?php echo '£'. number_format($totalCost,2); ?>
       </div>
    </div>
     <div style="padding:10px; border-radius:5px;   width:100%;   margin-top:10px; margin-bottom:10px; "  > PLEASE SELECT A PAYMENT METHOD</div>
     <div style="padding:10px; border-radius:5px 5px 2px 2px;   width:100%;  border-style:ridge; border-width:1px; border-color:lightgray; margin-top:10px; font-weight:bold; "  > CRDIT / DEBIT CARD</div>
     <div style="padding:10px; border-radius:0px 0px 5px 5px;   width:100%;  border-style:ridge; border-width:1px; border-color:lightgray;  margin-bottom:10px;"  > 
      
      <form method="post" action="saveorder.php">
        <div class="row" >
            <div class="col">
            First Name
              <input type="text" placeholder="First Name" name="FirstName"  class="form-control" required >
            </div>
            <div class="col">
            Last Name
            <input type="text" placeholder="Last Name" name="LastName"  class="form-control" required >
            </div>
        </div>
        <br/>
        <div class="row" >
            <div class="col-sm-8">
            Card Number
              <input type="text" placeholder="**** **** **** **** ***" name="CardNumber"  class="form-control"  required>
            </div>
            <div class="col-sm-4">
            CVV
            <input type="text" placeholder="****" name="CVV"  class="form-control"  required>
            </div>
        </div>
        <br/>
        <div class="row" >
            <div class="col-sm-2">
              Valid Until
            </div>
            <div class="col-sm-5">
            <select   class="form-control" name="Month" required >
                  <option disabled selected >Month</option>
                  <option value="JANUARY"  >JANUARY</option>
                  <option value="FEBRUARY"  >FEBRUARY</option>
                  <option value="MARCH"  >MARCH</option>
                  <option value="APRIL"  >APRIL</option>
                  <option value="MAY"  >MAY</option>
                  <option value="JUNE"  >JUNE</option>
                  <option value="JULY"  >JULY</option>
                  <option value="AUGUST"  >AUGUST</option>
                  <option value="SEPTEMBER"  >SEPTEMBER</option>
                  <option value="OCTOBER"  >OCTOBER</option>
                  <option value="NOVEMBER"  >NOVEMBER</option>
                  <option value="DECEMBER"  >DECEMBER</option>
                </select>
            </div>
            <div class="col-sm-5">
            <select   class="form-control" bane="Year" required >
                  <option disabled selected >Year</option>
                  <option value="2021"  >2021</option>
                  <option value="2022"  >2022</option>
                  <option value="2023"  >2023</option>
                  <option value="2024"  >2024</option>
                  <option value="2025"  >2025</option>
                  <option value="2026"  >2026</option>
                  <option value="2027"  >2027</option>
                  <option value="2028"  >2028</option>
                  <option value="2029"  >2029</option>
                  <option value="2030"  >2030</option>
                  <option value="2031"  >2031</option>
                  <option value="2032"  >2032</option>
                </select>
            </div>
            </div>

            <hr style=" margin-bottom:20px; margin-top:20px;"/>
        <div class="row" >
            <div class="col">
              <button class="btn"  onclick="window.location='cart.php'" style="width:100%; cursor:pointer;">CANCEL</button>
            </div>
            <div class="col">
            <input  class="btn btn-danger" type="submit"  name="submit"  style="width:100%; cursor:pointer;" >
            </div>  
        </div>
    </form>
      </div>
   
</div>

<div class="col-sm-1"> </div>

</div>

<br/>
<?php
 require_once('footer.php');
?>

</body>

</html>