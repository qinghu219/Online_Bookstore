<?php
session_start();


 function logout(){
      // session_unset($_SESSION['timeout']);
      session_unset($_SESSION['username']);
      session_unset($_SESSION['customerid']);
      session_unset($_SESSION['timeout']);

    }


    if(isset($_GET['logout'])){
        logout();
      };
?>

<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/alldiv.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
<!-- <link href="style.css" rel="stylesheet" type="text/css" /> -->

<script type="text/javascript" src="js/jquery-1.11.1.js"></script>
<script type="text/javascript">
$(document).ready(function() {

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

$('#password').on('input', function() {
  var span=$('#l2');
    var input=$(this);
    var re=/^[0-9A-Za-z]{6,}$/;
    var is_name=re.test(input.val());
    if(is_name){input.removeClass("invalid").addClass("valid");
  span.removeClass("error_show").addClass("error");}
    else{input.removeClass("valid").addClass("invalid");
  span.removeClass("error").addClass("error_show");}
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


  $("#form1").submit(function(){

    if(!$('#username').hasClass('valid')){
      $('#username').addClass("invalid");
      $('#l1').removeClass("error").addClass("error_show");
       return false;
    }
        if(!$('#password').hasClass('valid')){
           $('#password').addClass("invalid");
      $('#l2').removeClass("error").addClass("error_show");

       return false;
    }
        if(!$('#email').hasClass('valid')){
           $('#email').addClass("invalid");
      $('#l3').removeClass("error").addClass("error_show");
       return false;
    }

      if($('#age').hasClass('invalid')){
       return false;
    }



        if(!$('#phone').hasClass('valid')){
           $('#phone').addClass("invalid");
      $('#l5').removeClass("error").addClass("error_show");
       return false;
    }
        if(!$('#address').hasClass('valid')){
           $('#address').addClass("invalid");
      $('#l6').removeClass("error").addClass("error_show");
       return false;
    }
        if(!$('#city').hasClass('valid')){
           $('#city').addClass("invalid");
      $('#l7').removeClass("error").addClass("error_show");
       return false;
    }
        if(!$('#state').hasClass('valid')){
           $('#state').addClass("invalid");
      $('#l8').removeClass("error").addClass("error_show");
       return false;
    }
        if(!$('#country').hasClass('valid')){
           $('#country').addClass("invalid");
      $('#l9').removeClass("error").addClass("error_show");
       return false;
    }
        if(!$('#zip').hasClass('valid')){
           $('#zip').addClass("invalid");
           $('#l10').removeClass("error").addClass("error_show");
          return false;
    }
    
   
  });








});



ddsmoothmenu.init({
	mainmenuid: "templatemo_menu", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})
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

</head>

<body id="subpage">
<?php
$error = '';
// error message
$username = '';
// sender's name
$password = '';

if (isset($_POST['login'])) {
    
    $username = $_POST['username'];
    $password = $_POST['password'];

      if (trim($username) == '') {
        $error = '<div class="errormsg">Please enter username!</div>';
    }
    
    if (trim($password) == '') {
        $error = '<div class="errormsg">Please enter a password!</div>';
    }
    if (strlen($username) > 0 && strlen($password) > 0) {
        $sql = "select customerid from customer where
       username='$username' and password='$password'";
        $con = mysql_connect("localhost:3306", "root", "root");
         
        mysql_select_db('qinghu', $con);
        $res = mysql_query($sql);
        $row=mysql_fetch_array($res);
        if (!$row) {
            //no rows retrieved
            $error = "<div class='errormsg'>Invalid login!</div>";
        }else{
            $_SESSION['customerid']=$row['customerid'];
          }

          
    }


    if ($error == '') {
        // $_SESSION['timeout']=time();
        $_SESSION['username'] = $username;
        $_SESSION['timeout']=time();
        //$_SESSION['usertype'] = $row['usertype'];
        
            echo "<script>location.href='home.php';</script>";
        }
}

if (isset($_POST['register'])) {
  $username=$_POST['username'];
   $password=$_POST['password'];
   $email=$_POST['email'];
   $age=$_POST['age'];
   $phone=$_POST['phone'];
   $address=$_POST['address'];
   $city=$_POST['city'];
   $state=$_POST['state'];
   $country=$_POST['country'];
   $zip=$_POST['zip'];



     $con = mysql_connect("localhost:3306", "root", "root");
       mysql_select_db('qinghu', $con);
        $selectsql="select * from customer where username='$_POST[username]'";
        $data=mysql_query($selectsql);
        $row1=mysql_fetch_array($data);
      if ($row1) {
        $error1 = '<div class="errormsg">The username has been used!</div>';
             }
        else{
           $add="INSERT INTO address(address,city,state,country,zip) values ('$address','$city','$state','$country','$zip')";
           mysql_query($add,$con);
           $query1="Select last_insert_id() from address";
           $data=mysql_query($query1);
           $row=mysql_fetch_array($data);
           $addressid=$row[0];

           $addquery="INSERT INTO customer(username,password,email,age,phone,addressid) values ('$_POST[username]','$_POST[password]','$_POST[email]','$_POST[age]','$phone','$addressid')";
          
            mysql_query($addquery,$con);
              
          echo "<script>
          window.alert('You have registered successfully! Please login now!');
          location.href='loginc.php';</script>";
       
        }



};
?>





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
                <form action="#" method="get">
                 
                </form>
            </div>
         </div> <!-- END -->
    </div> <!-- END of header -->
    
<div id="templatemo_menu" class="ddsmoothmenu">
     <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="product.php">Product</a></li>
             <li><a href="orders.php" >Orders</a></li>
            <li><a href="shoppingcart.php" >Shopping Cart</a></li>
            <li><a href="profile.php">My profile</a></li> 
            <li><a href="loginc.php " class="selected">Login</a></li>
        </ul>
        <br style="clear: left" />
    </div> <!-- end of templatemo_menu -->
    
    <div class="cleaner h20"></div>
    <div id="templatemo_main_top"></div>


    <div id="templatemo_main" style="display:block">
    	
        <div id="sidebar">
           
   	    <h3>Login</h3>
         <?php
    echo $error; 
    ?>
            <form action="loginc.php" method="post">
           <table width="100%" border="0" cellpadding="0" cellspacing="2" bgcolor="#ffffff">
      <tr> 
        <td width="83"> Username: </td>
        <td width="115"> <input name="username" size="16" value="" type="text"></td>
      </tr>
      <tr> 
        <td> Password: </td>
        <td> <input name="password" size="16" value="" type="password"> </td>
        <td></td>

      </tr>
     <tr>
        <td></td><td>
       <input type="submit" value="Send" id="login" name="login" class="submit_btn float_l">
     </td></tr>
     
    </table>
            </form>
</div>



        
        <div id="content">
        	<h2>Register</h2>
            <?php
            echo $error1; 
             ?>
			
            <div class="cols">
            
            <div id="contact_form">
               <form id="form1" name="contact" action="loginc.php"  method="post">
                    
                    <label for="author">Username:</label> <input type="text" id="username" name="username"  /><span style="color:red">*</span><span  id="l1" class="error">you can use 3-15 characters with a-z,0-9, underscore and hyphen!</span>
                    <div class="cleaner h10"></div>

                     <label for="password">Password:</label> <input type="password" id="password" name="password"  /><span style="color:red">*</span><span id="l2" class="error">password has at least 6 characters!</span>
                    <div class="cleaner h10"></div>

						
                    <label for="email">Email:</label> <input type="text" id="email" name="email"  /><span style="color:red">*</span><span class="error" id="l3">A validate email address is required</span>
                    <div class="cleaner h10"></div>
                        
                    <label for="age">Age:</label> <input type="text" id="age" name="age"  /><span class="error" id="l4">Please enter the valid age between 1 to 120 !</span>
                    <div class="cleaner h10"></div>

                     <label for="phone">Phone:</label> <input type="text" id="phone" name="phone" /><span style="color:red">*</span><span class="error" id="l5">Please enter the valid telephone!</span>
                    <div class="cleaner h10"></div>

                     <label for="address">Adress line:</label> <input type="text" name="address" id="address" /><span style="color:red">*</span><span class="error" id="l6">This field is required</span>
                    <div class="cleaner h10"></div>

                     <label for="age">City:</label> <input type="text" name="city" id="city"  /><span style="color:red">*</span><span class="error" id="l7">This field is required</span>
                    <div class="cleaner h10"></div>

                     <label for="age">State/Province:</label> <input type="text" name="state" id="state"  /><span style="color:red">*</span><span class="error" id="l8">This field is required</span>
                    <div class="cleaner h10"></div>

                     <label for="age">Country:</label> <input type="text" name="country" id="country" /><span style="color:red">*</span><span class="error" id="l9">This field is required</span>
                    <div class="cleaner h10"></div>

                     <label for="age">ZIP:</label> <input type="text" name="zip" id="zip"/><span style="color:red">*</span><span class="error" id="l10">Please enter the valid zip!</span>
                    <div class="cleaner h10"></div>
        
    
					<input type="submit" value="Send" id="submit" name="register" class="submit_btn float_l"/><br><br>
					<input type="reset" value="Reset" id="reset" name="reset" class="submit_btn float_l"/>
					
                </form>
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
      
</body>
</html>