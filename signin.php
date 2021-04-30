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
</head>

<body>
   


<?php

 include 'config.php';

  //start session
  if (!isset($_SESSION)) {
    session_start();
  }

//check if user hit submit button on signin form
if (isset( $_POST['submit'] ) ) 
{ 
      //create connection to db
      $con = mysqli_connect($config['DB_HOST'],$config['DB_USERNAME'],"",$config['DB_DATABASE']);

      //test connection to db
      if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
      } 
    
      $sql = "SELECT * FROM drinkmarket.users where Email=? and Password=?";
        
      //execute select statement 
      if($stmt = mysqli_prepare($con, $sql)){

          //bind variables to the prepared statement as parameters
          mysqli_stmt_bind_param($stmt, "ss", $param_email, $param_password);
          
          //set values of parameters
          $param_email = trim($_POST["Email"]);
          $param_password = trim($_POST["Password"]);
          
          // Attempt to execute the prepared statement
          if(mysqli_stmt_execute($stmt))
          {
              /* store result */
              mysqli_stmt_store_result($stmt);
              
              //check if number of affected rows by the query is  greater than zero, meaning user with the specified email and password exist in the db
              if(mysqli_stmt_num_rows($stmt) >0)
              { 
                //store user email in session
                 $_SESSION['user'][0] =  $param_email; 

                 //redirect user to payment page if user already has items in cart
                 if (!isset($_SESSION['mycart']))
                    header("Location: index.php");  
                 else
                    header("Location: makepayment.php");  
              } 
              else
              {
                echo "<script>alert('Invalid credential!')</script>";
              }
          }
          else
          {
              echo "<script>alert('Oops! Something went wrong. Please try again later.')</script>";
          }

          // Close connection
          mysqli_stmt_close($stmt);
      }
}

 ?>



<?php
 require_once('banner.php');
 require_once('menu.php');
 ?>


<form action="signin.php" method="post">
 <div style="padding-left:20%; padding-right:30%;">
    <h4><b><i class="fa fa-lock"></i> SIGN IN</b></h4>
    <div class="thin-h-line"></div>
   
    <div>Email</div>
    <div>
        <input type="text" placeholder="Email" name="Email" class="form-control" required >
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
    <div class="thin-h-line"></div>
    Don't have an account? <a href="signup.php" style="text-decoration:none;"><b>Sign Up</b></a> &nbsp;&nbsp;&nbsp;  OR &nbsp;&nbsp; Sign in as <a href="signin_admin.php" style="text-decoration:none;"><b>Admin</b> </a>
    <br/> <br/>
   
    <br/> <br/>
   
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