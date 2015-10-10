<?php

if($_SESSION['timeout']){
if((time()-$_SESSION['timeout'])>300)
       {
       session_destroy();
       echo'
    <script type="text/javascript">
    window.alert("You have a long time to do nothing, please login again!");
     location.href="loginc";
    </script>
     ';
        }
        $_SESSION['timeout']=time();

}
?>

<html >
<head id="head">
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
   
   
//    var sc=document.createElement("script");

//    sc.type="text/javascript";
//    sc.language="javascript";
//    h.appendChild(sc);

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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="text/javascript" src="<?php echo base_url('js/jquery-1.11.1.js');?>"></script>
<!-- <link href="style.css" rel="stylesheet" type="text/css" /> -->



<script type="text/javascript">
$(document).ready(function() {

	$('.handle').on('click',function(){

		$('nav ul').toggleClass('showing');
	});



	
$('#username').on('input', function() {
    var input=$(this);
    var span=$('#l1');
    var re=/^[a-z0-9_-]{3,15}$/;
    var is_name=re.test(input.val());
    if(is_name){input.removeClass("invalid").addClass("valid");
      span.removeClass("error_show").addClass("error");

  }
    else{input.removeClass("valid").addClass("invalid");
     span.removeClass("error").addClass("error_show");

  }
});

<!--Email must be an email -->
$('#email').on('input', function() {
  var span=$('#l3');
    var input=$(this);
    var re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    var is_email=re.test(input.val());
    if(is_email){input.removeClass("invalid").addClass("valid");
  span.removeClass("error_show").addClass("error");}
    else{input.removeClass("valid").addClass("invalid");
  span.removeClass("error").addClass("error_show");}
});


$('#age').on('input', function() {
  var span=$('#l4');
    var input=$(this);
     var re=/(^[1-9]?[0-9]{1}$|^120$)/;
     var is_age=re.test(input.val());

    if(is_age){input.removeClass("invalid").addClass("valid");
  span.removeClass("error_show").addClass("error");}
    else{input.removeClass("valid").addClass("invalid");
  span.removeClass("error").addClass("error_show");}
});

$('#phone').on('input', function() {
  var span=$('#l5');
    var input=$(this);
    var re1 =/^(?:\([2-9]\d{2}\)\ ?|[2-9]\d{2}(?:\-?|\ ?))[2-9]\d{2}[- ]?\d{4}$/;
    var is_phone=re1.test(input.val());
    if(is_phone){input.removeClass("invalid").addClass("valid");
  span.removeClass("error_show").addClass("error");}
    else{input.removeClass("valid").addClass("invalid");
  span.removeClass("error").addClass("error_show");}
});

$('#address').on('input', function() {
  var span=$('#l6');
    var input=$(this);
    var is_name=input.val();
    if(is_name){input.removeClass("invalid").addClass("valid");
  span.removeClass("error_show").addClass("error");}
    else{input.removeClass("valid").addClass("invalid");
  span.removeClass("error").addClass("error_show");}
});

$('#city').on('input', function() {
  var span=$('#l7');
    var input=$(this);
    var is_name=input.val();
    if(is_name){input.removeClass("invalid").addClass("valid");
  span.removeClass("error_show").addClass("error");}
    else{input.removeClass("valid").addClass("invalid");
  span.removeClass("error").addClass("error_show");}
});

$('#state').on('input', function() {
  var span=$('#l8');
    var input=$(this);
    var is_name=input.val();
    if(is_name){input.removeClass("invalid").addClass("valid");
  span.removeClass("error_show").addClass("error");}
    else{input.removeClass("valid").addClass("invalid");
  span.removeClass("error").addClass("error_show");}
});

$('#country').on('input', function() {
  var span=$('#l9');
    var input=$(this);
    var is_name=input.val();
    if(is_name){input.removeClass("invalid").addClass("valid");
  span.removeClass("error_show").addClass("error");}
    else{input.removeClass("valid").addClass("invalid");
  span.removeClass("error").addClass("error_show");}
});

$('#zip').on('input', function() {
  var span=$('#l10');
    var input=$(this);
    var re=/^\d{5}(-\d{4})?$/;
    var is_name=re.test(input.val());
    if(is_name){input.removeClass("invalid").addClass("valid");
  span.removeClass("error_show").addClass("error");}
    else{input.removeClass("valid").addClass("invalid");
  span.removeClass("error").addClass("error_show");}
});


  $("#myform").submit(function(){

    if($('#username').hasClass('invalid')){
       return false;
    }
       
        if($('#email').hasClass('invalid')){
       return false;
    }

      if($('#age').hasClass('invalid')){
       return false;
    }



        if($('#phone').hasClass('invalid')){
 
       return false;
    }
        if($('#address').hasClass('invalid')){
 
       return false;
    }
        if($('#city').hasClass('invalid')){

       return false;
    }
        if($('#state').hasClass('invalid')){

       return false;
    }
        if($('#country').hasClass('invalid')){

       return false;
    }
        if($('#zip').hasClass('invalid')){

          return false;
    }
    
   
  });

});


function clearchange(){
 document.getElementById("sidebar").style.display="none";
 document.getElementById("sidebar1").style.display="block"; 

}

function clearText(field)
{
    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
}
</script>

<style>
.errormsg {
  display: block;
  width: 90%;
  height: 22px;
  line-height: 22px;
  color: #FFFFFF;
  font-weight: bold;
  background: #FF9D9D url(images/stop.gif) no-repeat 10px center;
  padding: 3px 10px 3px 40px;
  margin: 10px 0;
  border-top: 2px solid #FF0000;
  border-bottom: 2px solid #FF0000;
}

#sidebar1{

  display: none;
}

.error{
    display: none;
 
}      
 
.error_show{
    color: red;

}

input.invalid, textarea.invalid{
    border: 2px solid red;
}
 
input.valid, textarea.valid{
    border: 2px solid green;
}

</style>

</head>

<body id="subpage" onLoad="changeCSS()" onResize="changeThings()">
<?php


?>
<div id="div1">
	<div id="div2">
    	<div id="site_title">
        <!-- <h1><a href="" >books</a></h1> -->
        <h1>Book Online Store</h1>
      </div>
        
        <div id="header_right">
             <ul id="language">
                <li><a><img src="<?php echo base_url('images/usa.png')?>" alt="English" /></a></li>
            </ul>
            <div class="cleaner"></div>
            <div id="templatemo_search">

              <h2 style="display:inline"> 
                                <?php
                 
                 if(!isset($_SESSION['customerid'])){
                    echo '
                    <script>
                    window.alert("Dear customer, please login first");
                    location.href="loginc";


                    </script>
                    ';

                 }else{
                     echo "Hello, ".$_SESSION['username'];
                      };
                 
                 ?>
             </h2>
                <form action="#" method="get">
                 
                </form>
            </div>
         </div> <!-- END -->
    </div> <!-- END of header -->
    
 <div id="templatemo_menu" class="ddsmoothmenu">
     <nav>
     <ul>
            <li><a href="home">Home</a></li>
            <li><a href="product">Product</a></li>
             <li><a href="orders" >Orders</a></li>
            <li><a href="shoppingcart" >Shopping Cart</a></li>
            <li><a href="profile" class="selected">My profile</a></li> 
            <li><a href="loginc">Login</a></li>
        </ul>
    	<div class="handle">Menu<input type="image" align="right" src="<?php echo base_url('images/menu.jpeg')?>" ></div>
    </nav>
    </div> <!-- end of templatemo_menu -->
    
    <div class="cleaner h20"></div>
    <div id="templatemo_main_top"></div>


    <div id="templatemo_main">

        <div id="sidebar">
      <br>
              <br>
              <br>
              <br>
              <br>
            <form action="loginc.php" method="post">

           <table width="100%" border="0" cellpadding="0" cellspacing="2" bgcolor="#ffffff">

        <td> Password: </td>
        <td>
          <span>******</span>
         </td>
        <td></td>

      </tr>
     <tr>
        <td></td><td>
       <input type="button" value="Edit" id="editchange" name="login" class="submit_btn float_l" onclick="clearchange()">
     </td></tr>
     
    </table>
            </form>
           
   	   
</div>
      <div id="sidebar1">
      <br>
              <br>
               <p style="font-size:20px; color:red">Change Password:</p>

  <?php 
if (isset($_POST['change'])) {
      echo '
      <script>
       document.getElementById("sidebar").style.display="none";
 document.getElementById("sidebar1").style.display="block"; 
      </script>';
      echo $error;
    }
    
    
?>
              <span>
      What is your current password?
              </span>
              <br>
          
            <form action="profile" method="post">
            
           <table width="100%" border="0" cellpadding="0" cellspacing="2" bgcolor="#ffffff">
          <tr>
        <td><span style="font-size:12px">Current Password:</span></td>
        <td>
            <input name="password" size="16" value="" type="password">
         </td>
        <td></td>
        </tr>
      </table>
      <table width="100%" border="0" cellpadding="0" cellspacing="2" bgcolor="#ffffff">
       <br>
        <span>
       What is your new password?
      </span>
       <tr>
        <td><span style="font-size:12px">New Password:</span></td>
        <td>
            <input name="password1" size="16" value="" type="password">
         </td>
        <td></td>

      </tr>
      <tr>
        <td><span style="font-size:12px">Reenter Password:</span></td>
        <td>
            <input name="password2" size="16" value="" type="password">
         </td>
        <td></td>

      </tr>

     <tr>
        <td></td><td>
       <input type="submit" value="Save Changes" id="login" name="change" class="submit_btn float_l" style="display:inline">
     </td></tr>
     
    </table>
            </form>
           
       
</div>








          <div id="mycontent">
        	<h2>My Profile</h2>
            <?php
            if (isset($_POST['edit'])) {
             echo $error1; 
             }
              ?>

           
			
            <div class="cols">
            
            <div id="contact_form">
               <form  id="myform" method="post" name="contact" action="profile">
                    <label for="author">Username:</label> <input type="text" id="username" name="username" value="<?php 
                    echo $row->username;   
                    ?>"/><span style="color:red">*</span><span  id="l1" class="error">you can use 3-15 characters with a-z,0-9, underscore and hyphen!</span>
                    <div class="cleaner h10"></div>

                    <label for="email">Email:</label> <input type="text" id="email" name="email"  value="<?php 
                    echo $row->email;   
                    ?>"/><span style="color:red">*</span><span class="error" id="l3">A validate email address is required</span>
                    <div class="cleaner h10"></div>
                        
                    <label for="age">Age:</label> <input type="text" name="age" id="age"  value="<?php 
                    echo $row->age;   
                    ?>" /><span class="error" id="l4">Please enter the valid age!</span>
                    <div class="cleaner h10"></div>

                     <label for="age">Phone:</label> <input type="text" name="phone" id="phone" value="<?php 
                    echo $row->phone;   
                    ?>"/><span style="color:red">*</span><span class="error" id="l5">Please enter the valid telephone!</span>
                    <div class="cleaner h10"></div>

                     <label for="address">Adress line:</label> <input type="text" name="address" id="age" value="<?php 
                    echo $row->address;   
                    ?>"/><span style="color:red">*</span><span class="error" id="l6">This field is required</span>
                    <div class="cleaner h10"></div>

                     <label for="age">City:</label> <input type="text" name="city" id="city" value="<?php 
                    echo $row->city;   
                    ?>"/><span style="color:red">*</span><span class="error" id="l7">This field is required</span>
                    <div class="cleaner h10"></div>

                     <label for="age">State/Province:</label> <input type="text" name="state" id="state" value="<?php 
                    echo $row->state;   
                    ?>"/><span style="color:red">*</span><span class="error" id="l8">This field is required</span>
                    <div class="cleaner h10"></div>

                     <label for="age">Country:</label> <input type="text" name="country" id="country" value="<?php 
                    echo $row->country;   
                    ?>"/><span style="color:red">*</span><span class="error" id="l9">This field is required</span>
                    <div class="cleaner h10"></div>

                     <label for="age">ZIP:</label> <input type="text" name="zip" id="zip" value="<?php 
                    echo $row->zip;   
                    ?>"/><span style="color:red">*</span><span class="error" id="l10">Please enter the valid zip!</span>
                    <div class="cleaner h10"></div>
                    <input type="hidden" name="addressid" value="<?php 
                    echo $row->addressid;
                    ?>"/>

                    <input type="hidden" name="myname" value="<?php 
                    echo $row->username;
                    ?>"/>
        
					<input type="submit" value="Edit" id="submit" name="edit" class="submit_btn float_l" style="display:inline"/>

					
                </form>
            </div>
		</div>
  
      
        
        <div class="cleaner h30"></div>
        
       
            
        </div> <!-- END of content -->
        <div class="cleaner"></div>
    </div> <!-- END of main -->
      
</body>
</html>