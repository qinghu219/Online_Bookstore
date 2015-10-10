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
                    echo "NOT LOGIN";
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
            <li><a href="product.php" class="selected">Product</a></li>
            <li><a href="orders.php" >Orders</a></li>
            <li><a href="shoppingcart.php">Shopping Cart</a></li>
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
     $sql="select * from Category";
    $myData=mysql_query($sql);
?>

<div id="sidebar">
            <h3>Categories</h3>
            <ul class="sidebar_menu">
<?php
while($row = mysql_fetch_array($myData)) {
echo '
 <form action="product.php" method="post">
 <li><input type="submit"  id="'.$row[categoryname].'" style="width: 80px; height: 10px;" value="'.$row[categoryname].'" name="category" /></li>
 </form>';
}
?>
      </ul>     
<p>Dear customer, you can also search the name of your favorite book name.</p>
 <div id="newsletter">
                <form action="product.php" method="post">
                  <input type="text" value="search bookname" name="bookname" id="email_newsletter" title="email_newsletter" onfocus="clearText(this)" onblur="clearText(this)" class="txt_field" />
                  <input type="submit" name="search" value="Search" alt="Subscribe" id="subscribebtn" title="Subscribe" class="subscribebtn"  />
                </form>
                <div class="cleaner"></div>
            </div>   
        </div> 
        


        <div id="content">
         
<?php

if(isset($_POST['category'])){
          
 $sql = "select * from Products, Category where Products.categoryid=Category.categoryid and categoryname='$_POST[category]'";
 
         
        $myData1 = mysql_query($sql,$con);
           $today = date("Y-m-d"); 
        while($row = mysql_fetch_array($myData1)) {
echo '
    <div class="col col_14 product_gallery" >
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


}else if(isset($_POST['search'])){
    $productname=$_POST['bookname'];

  $sql = "select * from Products where productname like '%$productname%'";
 
         
        $myData1 = mysql_query($sql,$con);
           $today = date("Y-m-d"); 
        while($row = mysql_fetch_array($myData1)) {
echo '
    <div class="col col_14 product_gallery" >
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

else{
 $mysql="select * from Products";
  $mydata1=mysql_query($mysql);
   $today = date("Y-m-d"); 
  while($row = mysql_fetch_array($mydata1)) {

  echo '
    <div class="col col_14 product_gallery" >
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
?>       
       
        </div> <!-- END of content -->
        <div class="cleaner"></div>
    </div> <!-- END of main -->
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
xmlhttp.open("POST","setcategory.php",true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 var vars="pn="+pn;
xmlhttp.send(vars);
}



    </script>

  </body>
</html>