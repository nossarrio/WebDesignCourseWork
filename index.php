<!DOCTYPE html>
<html lang="en">

<head>
  <title>Drink Supermarket</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="images\judge.ico" />

  <link rel="stylesheet" href="font-awesome\css\font-awesome.css">
  <link rel="stylesheet" href="css\index.css">
  <link rel="stylesheet" href=" css\style.css">

</head>

<body>

<!-- 
//todo:
//search
//filter by category
//create database and tables 
//import records
//read connectionstring from file 
//code cleanup
//take all style to css file
-->

<?php
 if (!isset($_SESSION)) {
  session_start();
 }

 if ($_GET)
 {
   //check if user is trying to logout
   if ($_GET["option"]=="logout")  
   {
     //clear session to log user out 
     session_destroy();
     header("Location: index.php");  
   } 
 }
 

 require_once('banner.php');
 require_once('menu.php');
 ?>


<!--sub menu-->
<div class="row fullwidth">

    <div class="col-sm-2"> 
    </div>

      <div class="col-sm-2 sub-menu"> 
        <i  class="fa fa-truck fa-2x comp-color" ></i>
        <span class="sub-menu-item-text">DELIVERY INFO</span>              
      </div>

      <div class="col-sm-2 sub-menu">
        <i   class="fa fa-mobile-phone fa-2x comp-color" ></i>
        <span class="sub-menu-item-text">CONTACT US</span>              
      </div>

      <div class="col-sm-2 sub-menu">
        <i  class="fa fa-envelope fa-2x comp-color" ></i>
        <span class="sub-menu-item-text">GET OFFERS</span>              
      </div>

      <div class="col-sm-2 sub-menu">
        <i  class="fa fa-gift fa-2x comp-color" ></i>
        <span class="sub-menu-item-text">SHOP & BRAND</span>              
      </div>

      <div class="col-sm-2">
           
      </div>

</div>
 
 
<!--display-->
<div class="row fullwidth">
      <div class="col-sm-8">
        <div class="row fullwidth" >    
            <div class="col-sm-1" ></div>    
            <div class="col-sm-10" >                    
                <div class="petition-story-container">                  
                  <div class="row">
                    <div class="col">
                      <img  src="images/mothers-day-img.jpg">
                    </div>                
                  </div> 
                </div>   
            </div>          
            <div class="col-sm-1" ></div>
          </div>
      </div>

      <div class="col-sm-3">
       <img src="images\salesAndoffers.jpg">
       <br><br>
       <img src="images\black.jpg">
      </div>
</div>

<?php
require_once('footer.php');
?>
</body>

 


</html>