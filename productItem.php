 <?php
    function ProductItem($Name,$Description,$Image,$Rating,$Cost,$Id,$qty)
    { 
      $html=" 
      <form action=\"cart.php\" method=\"post\">     
      <div class=\"row  show-case2\">
      <div class=\"col-sm-1\"></div>
      <div class=\"col-sm-2\">  <img src=\"$Image\">  </div>
      <div class=\"col-sm-4\">  
      <p class=\"text-left\" style=\"font-size:30px; font-weight:bold;\">$Name</p>  
      <p class=\"text-left\">$Description</p> 
      <div class=\"text-left\">    
      <i class=\"fa fa-star". ($Rating > 0?'':'-o'). "\"></i>
      <i class=\"fa fa-star". ($Rating > 1?'':'-o'). "\"></i>
      <i class=\"fa fa-star". ($Rating > 2?'':'-o'). "\"></i>
      <i class=\"fa fa-star". ($Rating > 3?'':'-o'). "\"></i>
      <i class=\"fa fa-star". ($Rating > 4?'':'-o'). "\"></i>
      </div>
      <p class=\"text-left amount-p\">£ $Cost</p>
      <div class=\"text-left add-to-cart-container\" style=\" padding-left:0px; padding-top:0px;\">
     
        <button type=\"submit\" name=\"remove\"  class=\"btn btn-danger \" style=\"cursor:pointer; text-decoration:none\">
          Remove   <i class=\"fa fa-trash\"></i>
        </button> 
        <button type=\"submit\" name=\"save\"  class=\"btn btn-success \" style=\"cursor:pointer; text-decoration:none\">
        Save Item  <i class=\"fa fa-save\"></i>
      </button> 
        <input type=\"hidden\" name=\"product_id\" value=\"$Id\" />   
      </div>
      </div>
      <div class=\"col-sm-3 text-left\" style=\"margin-left:20px;\"> 
        <b>Quantity</b>
       <input name=\"quantity\" type=\"number\" value=\"$qty\" style=\"width:100px; font-size:30px;\" /> 
     
      </div>
      </div>      
      </form>   "; 
      echo $html;
    }

    ?>