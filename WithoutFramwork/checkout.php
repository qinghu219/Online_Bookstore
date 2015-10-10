<?php
session_start();
$total=$_POST[sum];

if($total==0){
  echo '
  <script>
  alert("Please buy some product first!");
  location.href="product.php";
  </script>
  ';
}

$today = date("Y-m-d H:i:s"); 


$customerid=$_SESSION['customerid'];
if (isset($_POST['pay'])) {
   $address=$_POST['address'];
   $cardnumber=$_POST['cardnumber'];
   $carddate=$_POST['carddate'];

    $address1=$_POST['address1'];
   $billing=$address;
    $shipping=$address1;
     $total=$_POST[sum];

         $con = mysql_connect("localhost:3306", "root", "root");
              mysql_select_db('qinghu', $con);

                $mycard="select * from card where customerid='$customerid'";
                $mydata=mysql_query($mycard);
                $row1=mysql_fetch_array($mydata);
                if($row1){
                  $updatecard="UPDATE card set expiretime='$carddate', cardno='$cardnumber' where customerid='$customerid'";
                  mysql_query($updatecard);
                }else{
                  $insertcard="INSERT INTO card(customerid,expiretime,cardno) values('$customerid','$carddate','$cardnumber')";
                  mysql_query($insertcard);
                }


         $insertsql="INSERT INTO orders(customerid,nowtime,billingaddress,shippingaddress,total) values('$customerid','$today','$billing','$shipping','$total')";
         mysql_query($insertsql);
         $query1="select last_insert_id() from orders";
         $data=mysql_query($query1);
         $row=mysql_fetch_array($data);
         $orderid=$row[0];

         $carsql="select * from Cart where customerid='$customerid'";
          $cardata=mysql_query($carsql);
         while($row = mysql_fetch_array($cardata)) {
          $productid=$row['productid'];
          $qty=$row['qty'];
          $productprice=$row['productprice'];
       $insertsql2="INSERT INTO orderdetail(orderid,productid,qty,productprice) values('$orderid','$productid','$qty','$productprice')";
        mysql_query($insertsql2);
      }
     $sql1="select cartid from Cart where customerid='$customerid'";
     $string1=mysql_query($sql1);
     while($myrow=mysql_fetch_array($string1)){
      $deletesql="delete from Cart where cartid='$myrow[cartid]'";         
      mysql_query($deletesql);
      }



  
    echo "<script>
    window.alert('Congradualations! You are successful to pay this order');
    location.href='home.php';</script>";
             
  };



?>

<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/alldiv.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
<!-- <link href="style.css" rel="stylesheet" type="text/css" /> -->

<script type="text/javascript" src="js/jquery-1.11.1.js"></script>


</script>
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
                <form action="#" method="get">
                 
                </form>
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
            <?php 

               $con = mysql_connect("localhost:3306", "root", "root");
              mysql_select_db('qinghu', $con);

            $sql1="select * from customer c, address a where c.addressid=a.addressid and customerid='$_SESSION[customerid]'";
                $data=mysql_query($sql1);
                $row=mysql_fetch_array($data);
       
              
          
          ?> 
			
            <div class="col col_13">
            
            <div id="contact_form">
               <form method="post" id="myform" name="contact" action="checkout.php">
                    <p>Please edit your address information.</p>
        
                     <label for="address" style="font-size:13px;">Billing Address:</label> 
                     <input type="text" name="address" id="ad1" size="60px" value="<?php 
                    echo $row['address'].', '.$row['city'].', '.$row['state'].', '.$row['country'].', '.$row['zip'];   
                    ?>" /><span  id="l4" class="error">please enter your billing address!</span>
                    
                    <div class="cleaner h10"></div>


                    <label for="address" style="font-size:13px;">Shipping Address:</label>
                    <input type="text" name="address1" id="ad2"  size="60px" value="<?php 
                    echo $row['address'].', '.$row['city'].', '.$row['state'].', '.$row['country'].', '.$row['zip'];   
                    ?>" /> <span  id="l5" class="error">please enter your shipping number!</span>
                    <div class="cleaner h10"></div>
                    <input type="hidden" name="addressid" value="<?php 
                    echo $row['addressid'];
                    ?>"/>
                     <div class="cleaner h10"></div>
                    <label for="address" style="font-size:20px;">Total Cost: $<?php 
                    echo $total;
                    ?></label>
                     <input type="hidden" name="sum" id="sum" value="<?php 
                    echo $total;
                    ?>"/>
                    <input type="hidden" name="myname" value="<?php 
                    echo $row['username'];
                    ?>"/>
                    <?php
           $sql2="select * from card where customerid='$_SESSION[customerid]'";
                $data2=mysql_query($sql2);
                $row1=mysql_fetch_array($data2);          

                    ?>
                     <table style="border:1px solid #CCCCCC;" width="100%">
                <tr>
                    <td height="80px"> <img src="images/master.jpeg" alt="paypal" /></td>
                    <td width="300px;" style="padding: 0px 20px;">card number:<span  id="l1" class="error">invalid number!</span><input type="text" id="cardnumber" name="cardnumber"  size="40px;" value="<?php echo $row1['cardno']; ?>"/>(16 digit numbers)
                    </td>
                </tr>
                <tr hieght="40px">
                  
                  <td style="padding: 0px 20px;">expire date:<input type="text" id="carddate" name="carddate" value="<?php echo $row1[expiretime]; ?>"/>(mm/yyyy)<span  id="l3" class="error">invalid date!</span></td>
              <td><input type="submit" value="Pay" id="submit" name="pay" class="submit_btn float_l" style="display:inline" onclick=""/>&nbsp&nbsp
                  <input type="button" value="Back" id="back" name="back" class="submit_btn float_l" onclick="goback()" style="display:inline" onclick=""/></td>
                </tr>
                
               </table>					
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
    <script>
    function goback(){
      location.href="shoppingcart.php";

    }
    </script>
      
</body>
</html>