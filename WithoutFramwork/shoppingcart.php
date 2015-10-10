<?php
session_start();

if($_SESSION['timeout']){
if((time()-$_SESSION['timeout'])>300)
       {
       session_destroy();
       echo'
    <script type="text/javascript">
    window.alert("You have a long time to do nothing, please login again!");
     location.href="loginc.php";
    </script>
     ';
        }
        $_SESSION['timeout']=time();

}
?>

<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Web Store Theme - Contact</title>
<link href="css/alldiv.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/ddsmoothmenu.js">

</script>
<script type="text/javascript">

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

</head>

<body id="subpage">


<div id="div1">
	<div id="div2">
    	<div id="site_title">
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
                 
                 if(!isset($_SESSION['customerid'])){
                    echo '
                    <script>
                    window.alert("Dear customer, please login first");
                    location.href="loginc.php";


                    </script>
                    ';

                 }else{
                     echo "Hello, ".$_SESSION['username'];
                      };
                 
                 ?>
             </h2>
             <p style="text-align:right;"><a href="loginc.php?logout=1">Log Out</a></p>

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
            <li><a href="shoppingcart.php" class="selected">Shopping Cart</a></li>
            <li><a href="profile.php">My profile</a></li> 
            <li><a href="loginc.php" >Login</a></li>
        </ul>
        <br style="clear: left" />
    </div> <!-- end of templatemo_menu -->
    
    <div class="cleaner h20" style="background-color:white"></div>

    <div>
      <br>
      <br>
      <br>
      <br>
    </div>
    <?php
    $con = mysql_connect("localhost:3306", "root", "root");
    mysql_select_db('qinghu', $con);
     $array = array();
     $array1=array();
     $name=$_SESSION['username'];
     $sql1="select * from customer where username='$name'";
     $data=mysql_query($sql1);
     $customerid='';
     
      while($row = mysql_fetch_array($data)) {
        $customerid=$row['customerid'];
        // echo $customerid;
      };

     if(isset($_POST['clear'])){
      $customerid=$_SESSION['customerid'];
      $sql2="select * from Cart where customerid='$customerid'";
      $mydata=mysql_query($sql2);
      while($row=mysql_fetch_array($mydata)){
        $sql3="delete from Cart where cartid='$row[cartid]'";
        mysql_query($sql3);

      }

     }
    if(isset($_POST['submit'])){

     $productid=$_POST[productid];
     $sqlselect="select * from Cart where productid='$productid' and customerid='$_SESSION[customerid]'";
     $data=mysql_query($sqlselect);
    if($row=mysql_fetch_array($data)){
      echo '
      <script>
     alert("You have this product in your cart, please select other product!");
      location.href="product.php";
      </script>
    ';
    }else{
      $sqlinsert="INSERT INTO Cart(productid,qty,customerid,productprice) values('$_POST[productid]','1','$_SESSION[customerid]','$_POST[productprice]')";
      mysql_query($sqlinsert);
    }

      $sql1="select orderid from orderdetail where productid='$_POST[productid]'";
      $mydata=mysql_query($sql1);
       $i=0;
      while($row=mysql_fetch_array($mydata)){
        $sql2="select productid from orderdetail where orderid='$row[orderid]' and productid<>'$_POST[productid]'";
        $mydata1=mysql_query($sql2);
       
        while($row1=mysql_fetch_array($mydata1)){
          // echo "this is".$row1[productid];
           $array[$i]=$row1[productid];

           $i++;

           }
                  
      }
      $array1=array_unique($array);
       // print_r($array1);   
  }


    $sql="select C.productprice, qty,productimage,productdesc, P.productid from Cart C, Products P where  C.productid=P.productid and C.customerid='$_SESSION[customerid]'";

   $myData=mysql_query($sql);
   // echo $myData;

  ?>
<div id="sidebar">
           
        </div> <!-- END of sidebar -->
        


    <div id="content">
    
          <table width="700px" cellspacing="0" cellpadding="5">
                      <tr bgcolor="#CCCCCC">
                          <th width="220" align="left">Image </th> 
                          <th width="180" align="left">Description </th> 
                            <th width="100" align="center">Quantity </th> 
                          <th width="60" align="right">Price </th> 
                          <!-- <th width="60" align="right">Total </th>  -->
                          <th width="90"> </th>
                            
                      </tr>
              <?php
              $sum=0;
                 echo ' <form action="checkout.php" method="post">';
              while($row = mysql_fetch_array($myData)) {
                // echo $row[productimage];
                  $sum+=$row[productprice]*$row[qty];
              echo '
             <tr>
                          <td><img src="'.$row[productimage].'" alt="image 01"/></td> 
                          <td>'.$row[productdesc].'
                         <input type= "text" id="select1" size = "35" value ="'.$row[productprice].'" style="display:none;"></td>
                            <td align="center"><input type="text" id="'.$row[productid].'" name="select2" onkeyup="OnChange(this.id,this.value)" onKeyPress="return isNumberKey(event)" value="'.$row[qty].'" style="width: 20px; text-align: right" /> </td>
                            
                            <td align="right">'.$row[productprice].' </td>                 
                            <td align="center"><input type="button" value="Remove" name="'.$row[productid].'" onclick="onRemove(this.name);" </td>
            </tr>';
            }
            echo '
            </table>
                    <div style="float:right; width: 215px; margin-top: 20px;">
                    
                        Subtotal:<div id="total">'.$sum.'</div>
                        <input type="hidden" name="sum" id="sum" value="'.$sum.'"/>
                        <div class="continueshopping"><input type="submit" name="check" value="Proceed to Checkout" class="more"/></div>
                        </form>
                        <form action="shoppingcart.php" method="post">
                        <div class="continueshopping"><input type="submit"  id="clearall" name="clear" value="      Clear all items     " class="more"/></div>
                        </form>
                     
                        <div class="continueshopping"><a href="product.php" class="more">Continue Shopping</a></div>
                     </div>
              ';
           
              ?>                   
    </div>
        <div class="cleaner"></div>
    </div> <!-- END of main -->

 <div id="templatemo_footer">
  <div id="new" >
 
</div>
<?php
if($array1[0]){
  echo '<h2> Customers Who Bought This Item Also Bought:</h2>';
}
$arrlength=3;
for($x=0;$x<$arrlength;$x++) {
  $productid=$array1[$x];
  $sql4="select * from Products where productid='$productid'";
  $newdata=mysql_query($sql4);
      while($row=mysql_fetch_array($newdata)){
       echo '
    <div class="col col_13 product_gallery" >
     <form action="shoppingcart.php" method="post">
     <input type="hidden"  name="productid" value="'.$row[productid].'">
      <input type="hidden" id="l'.$row[productid].'" name="productprice" value="'.$row[productprice].'">
    <a href="productdetail.html"><img src="'.$row[productimage].'" alt="Product 01" /></a>
                <h3>'.$row[productname].'</h3>
        <p id="p'.$row[productid].'" class="product_price">$'.$row[productprice].'</p>
      ';
      $mysql1="select * from Products P, Sales S where P.productid=S.productid and S.enddate>'$today'";
      $mydata=mysql_query($mysql1);
      while($row1 = mysql_fetch_array($mydata)) {
           if($row1[productid]==$row[productid]){
               echo '
               <script>
         document.getElementById("l'.$row[productid].'").value="'.$row1[price].'";      
         document.getElementById("p'.$row[productid].'").style="text-decoration:line-through";

             </script>
                 <p class="product_price">special price: $'.$row1[price].'</p>
                

                 ';

           }
        }

      echo '
                <input type="submit" class="add_to_cart" name="submit" value="Add to Cart">
                </form>
    </div> 

    &nbsp
'; 
        }

  
}



// print_r($array1);


?>


 </div>






    <script>
function loadcategory(id)
{
  var pn=id;
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }


  document.getElementById("content").innerHTML="Please Wait a minute";
    xmlhttp.onreadystatechange=function()
   {
    //window.alert(xmlhttp.readyState);
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
         {
        //window.alert(xmlhttp.readyState);
        var return_data=xmlhttp.responseText;
         document.getElementById("content").innerHTML=return_data;
          }
  }
xmlhttp.open("POST","setquantity.php",true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 var vars="pn="+pn;
xmlhttp.send(vars);
}

function OnChange(id,qty){
   var productid=id;
   var quantity=qty;
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }


  document.getElementById("total").innerHTML="Please Wait a minute";
    xmlhttp.onreadystatechange=function()
   {
    //window.alert(xmlhttp.readyState);
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
         {
        //window.alert(xmlhttp.readyState);
        var return_data=xmlhttp.responseText;
         document.getElementById("total").innerHTML=return_data;
         document.getElementById("sum").value=return_data;
          }
  }
xmlhttp.open("POST","setquantity.php",true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 var vars="productid="+productid+"&qty="+quantity;
xmlhttp.send(vars);
    }



function onRemove(id){
   var productid=id;
 
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  //document.getElementById("remove").innerHTML="";
    xmlhttp.onreadystatechange=function()
   {
    //window.alert(xmlhttp.readyState);
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
         {
        //alert(xmlhttp.readyState);
        var return_data=xmlhttp.responseText;
         document.getElementById("content").innerHTML=return_data;
          }
  }
xmlhttp.open("POST","removecart.php",true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 var vars="productid="+productid;
xmlhttp.send(vars);
    }






    </script>

  </body>
</html>