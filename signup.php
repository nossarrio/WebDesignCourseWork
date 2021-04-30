<!DOCTYPE html>
<html lang="en">

<head>
  <title>Drink Supermarket - Sign Up</title>
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

  //start session;
  if (!isset($_SESSION)) {
    session_start();
  }


//check if user hit the the submit button on form
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
      $param_fname = mysqli_real_escape_string($con, $_POST["FirstName"]);
      $param_lname = mysqli_real_escape_string($con,$_POST["LastName"]);
      $param_email = mysqli_real_escape_string($con,$_POST["Email"]);
      $param_password = mysqli_real_escape_string($con,$_POST["Password"]);
    
       $sql = "Insert into drinkmarket.users (FirstName,LastName,Email,Password) values('$param_fname','$param_lname','$param_email','$param_password')";
        
      //execute query/ create new user
      if(mysqli_query($con, $sql))
      {
          //sign in user automatically
          $_SESSION['user'][0]=  $param_email; 

          //redirect user to payment page if user already has items in cart
          if (!isset($_SESSION['mycart']))
            header("Location: index.php");  
          else
            header("Location: makepayment.php");  
      } 
      else
      {
          echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
      }
     
    // Close connection
    mysqli_close($con); 
}

 ?>



<?php
 require_once('banner.php');
 require_once('menu.php');
 ?>


<form action="signup.php" method="post">
 <div style="padding-left:20%; padding-right:30%;">
    <h4><b><i class="fa fa-edit"></i> SIGN Up</b></h4>
    <div class="thin-h-line"></div>
    <div>First Name</div>
    <div>
        <input type="text" placeholder="First Name" name="FirstName" class="form-control" required >
    </div>
    <br/>
    <div>Last Name</div>
    <div>
        <input type="text" placeholder="Last Name" name="LastName" class="form-control" required >
    </div>
    <br/>
    <div>Email</div>
    <div>
        <input type="text" placeholder="Email" name="Email" class="form-control"  required >
    </div>
    <br/>
    <div>Password</div>
    <div>
        <input type="password" placeholder="******" name="Password"  class="form-control" required >
    </div>
    <br/>
    <button type="submit" name="submit"  class="btn btn-danger">Submit</button>
    <br/>
    <br/>
    Already have an account? <a href="signin.php" style="text-decoration:none;"><b>Sign In</b></a> 
</div>  
</form>

<br/>
<br/>
<br/>
<br/><br/><br/>
<?php
require_once('footer.php');
?>

</body> 
</html>