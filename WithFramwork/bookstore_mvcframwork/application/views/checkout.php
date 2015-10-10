<?php
if($total==0){
  echo '
  <script>
  alert("Please buy some product first!");
  location.href="product";
  </script>
  ';
}
?>

<html >
<head id="head">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="<?php echo base_url('js/jquery-1.11.1.js');?>"></script>
<script type="text/javascript">
$(document).ready(function() {

$('#cardnumber').on('input', function() {
    var input=$(this);
    var span=$('#l1');
     var re=/^\d{16}$/;
     var is_name=re.test(input.val());
    if(is_name){input.removeClass("invalid").addClass("valid");
      span.removeClass("error_show").addClass("error");

  }
    else{input.removeClass("valid").addClass("invalid");
     span.removeClass("error").addClass("error_show");

  }
});

$('#carddate').on('input', function() {
    var input=$(this);
    var span=$('#l3');
    var re=/(0?[1-9]|1[012])[\/\-]\d{4}$/;
    var is_name=re.test(input.val());
    if(is_name){input.removeClass("invalid").addClass("valid");
      span.removeClass("error_show").addClass("error");

  }
    else{input.removeClass("valid").addClass("invalid");
     span.removeClass("error").addClass("error_show");

  }
});

$('#ad1').on('input', function() {
    var input=$(this);
    var span=$('#l4');
    var is_name=input.val();

    if(is_name){input.removeClass("invalid").addClass("valid");
      span.removeClass("error_show").addClass("error");

  }
    else{input.removeClass("valid").addClass("invalid");
     span.removeClass("error").addClass("error_show");

  }
});

$('#ad2').on('input', function() {
    var input=$(this);
    var span=$('#l5');
    var is_name=input.val();

    if(is_name){input.removeClass("invalid").addClass("valid");
      span.removeClass("error_show").addClass("error");

  }
    else{input.removeClass("valid").addClass("invalid");
     span.removeClass("error").addClass("error_show");

  }
});

$("#myform").submit(function(){

    if($('#cardnumber').hasClass('invalid')){
       return false;
    }
   
    if($('#cardnumber').val().length==0){
      $('#cardnumber').addClass("invalid");
      $('#l1').removeClass("error").addClass("error_show");
      return false;

    }
       

      if($('#carddate').hasClass('invalid')){
       return false;
    }
     
     if($('#carddate').val().length==0){
      $('#carddate').addClass("invalid");
      $('#l3').removeClass("error").addClass("error_show");
      return false;

    }



        if($('#ad1').hasClass('invalid')){
 
       return false;
    }
        if($('#ad2').hasClass('invalid')){
 
       return false;
    }
        
    
   
  });

});
function clearText(field)
{
    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
}
</script>

<style>
.error{
    display: none;
    margin-left: 10px;
}      
 
.error_show{
    color: red;
    margin-left: 10px;
}

input.invalid, textarea.invalid{
    border: 2px solid red;
}
 
input.valid, textarea.valid{
    border: 2px solid green;
}
</style>
<script type="text/javascript">
var h=document.getElementById("head");
function changeThings(){
  var s=window.innerWidth;
  var oldlinks=document.getElementsByTagName("link");
  for(i=0;i<oldlinks.length;i++){
    oldlinks[i].parentNode.removeChild(oldlinks[i]);
  }

//     var js=document.getElementsByTagName("script");
//     js[1].parentNode.removeChild(js[1]);
  
  if(s>500){
  fornormal();

    }else{
      forsmall();
  }
 }


 function forsmall(){
    var l1=document.createElement("link");
   l1.href="<?php echo base_url('css/myalldiv.css');?>";
   l1.type="text/css";
   l1.rel="stylesheet";
   h.appendChild(l1);
}

 function fornormal(){
     var l=document.createElement("link");
     l.href="<?php echo base_url('css/alldiv.css');?>";
     l.type="text/css";
     l.rel="stylesheet";
     h.appendChild(l);
     var t=document.createElement("link");
     t.href="<?php echo base_url('css/ddsmoothmenu.css');?>";
     t.type="text/css";
     t.rel="stylesheet";
     h.appendChild(t);

  }


  function changeCSS(){

    return changeThings();
  }
 
    
</script>
</head>

<body id="subpage" onLoad="changeCSS()" onResize="changeThings()">

<div id="div1">
	<div id="div2">
    	<div id="site_title">
        <!-- <h1><a href="" >books</a></h1> -->
        <h1>Book Online Store</h1>
      </div>
        
        <div id="header_right">
            <ul id="language">
                <li><a><img src="images/usa.png" alt="English" /></a></li>
            </ul>
            <div class="cleaner"></div>
            <div id="templatemo_search">

              <h2 style="display:inline"> 
                 <?php
                 
                 if(!isset($_SESSION['username'])){
                    echo "NOT LOGIN";
                 }else{
                     echo "Hello, ".$_SESSION['username'];
                      };
                 
                 ?>
             </h2>
            </div>
         </div> <!-- END -->
    </div> <!-- END of header -->
    
<div id="templatemo_menu" class="ddsmoothmenu">

        <br style="clear: left" />
    </div> <!-- end of templatemo_menu -->
    
    <div class="cleaner h20"></div>
    <div id="templatemo_main_top"></div>


    <div id="templatemo_main" style="display:block">
    	
        <div id="sidebar">
           
   	   
</div>
          <div id="content">
        	<h2>My order</h2>			
            <div class="col col_13">  
             <span id="direct1">products in the cart:</span><input type="image" src="<?php echo base_url('images/cart.png')?>">:         
            <div id="contact_form">
               <form method="post" id="myform" name="contact" action="checkout">

                   
                    <table border="1">
                    <tr><td>productname</td><td>quantity</td><td>price</td></tr>
                      <?php

						foreach ($mydata as $myrow){
                          echo '
                        <tr>
                        <td>'.$myrow->productname.'</td><td>'.$myrow->qty.'</td><td>'.$myrow->productprice.'</td>
                        </tr>

                          ';

                        }

                      ?>
                      
                    </table> 


                    <p>Please edit your address information.</p>
                    <?php
                     
             foreach($data as $row){         
                    ?>
        
                     <label for="address" style="font-size:13px;">Billing Address:</label> 
                     <input type="text" name="address" id="ad1" size="60px" value="<?php 
                    echo $row->address.', '.$row->city.', '.$row->state.', '.$row->country.', '.$row->zip;   
                    ?>" /><span  id="l4" class="error">please enter your billing address!</span>
                    
                    <div class="cleaner h10"></div>


                    <label for="address" style="font-size:13px;">Shipping Address:</label>
                    <input type="text" name="address1" id="ad2"  size="60px" value="<?php 
                     echo $row->address.', '.$row->city.', '.$row->state.', '.$row->country.', '.$row->zip;
                    ?>" /> <span  id="l5" class="error">please enter your shipping number!</span>
                    <div class="cleaner h10"></div>
                    <input type="hidden" name="addressid" value="<?php 
                    echo $row->addressid;
                    ?>"/>
                     <div class="cleaner h10"></div>
                    <label for="address" style="font-size:20px;">Total Cost: $<?php 
                    echo $total;
                    ?></label>
                     <input type="hidden" name="sum" id="sum" value="<?php 
                    echo $total;
                    ?>"/>
                    <input type="hidden" name="myname" value="<?php 
                    echo $row->username;
                    ?>"/>
                    <?php
                    }
                           
				foreach($data2 as $row1){
                    ?>
                     <table style="border:1px solid #CCCCCC;" width="100%">
                <tr>
                    <td height="80px"> <img src="<?php echo base_url('images/master.jpeg') ?>" alt="paypal" /></td>
                    <td width="250px;" style="padding: 0px 20px;">card number:<span  id="l1" class="error">invalid number!</span><input type="text" class="input_field" id="cardnumber" name="cardnumber"  size="40px;" value="<?php echo $row1->cardno; ?>"/>(16 digit numbers)
                    </td>
                </tr>
                <tr hieght="40px">
                  
                  <td style="padding: 0px 20px;">expire date:<input type="text" id="carddate" name="carddate" value="<?php echo $row1->expiretime; ?>"/>(mm/yyyy)<span  id="l3" class="error">invalid date!</span></td>
              <td><input type="submit" value="Pay" id="submit" name="pay" class="submit_btn float_l" style="display:inline" onclick=""/>&nbsp&nbsp
                  <input type="button" value="Back" id="back" name="back" class="submit_btn float_l" onclick="goback()" style="display:inline" onclick=""/></td>
                </tr>
                
               </table>					
                </form>
                <?php 
                }
                ?>
            </div>
		</div>
        <div class="col col_13">
        	<!-- <h5>Location One</h5> -->
            
            <div class="cleaner divider"></div>
			
			<div class="cleaner h30"></div>
			
<!--             <h5>Location Two</h5>
             -->
        </div>
        
        <div class="cleaner h30"></div>
        
       
            
        </div> <!-- END of content -->
        <div class="cleaner"></div>
    </div> <!-- END of main -->
    <script>
    function goback(){
      location.href="shoppingcart";

    }
    </script>
      
</body>
</html>