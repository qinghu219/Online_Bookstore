<?php


// if($_SESSION['timeout']){
// if((time()-$_SESSION['timeout'])>300)
//        {
//        session_destroy();
//        echo'
//     <script type="text/javascript">
//     window.alert("You have a long time to do nothing, please login again!");
//      location.href="loginc.php";
//     </script>
//      ';
//         }
//         $_SESSION['timeout']=time();

// }
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
<title>Web Store Theme - Contact</title>
<script type="text/javascript" src="<?php echo base_url('js/jquery-1.11.1.js');?>"></script>
<script type="text/javascript" src="js/ddsmoothmenu.js">

</script>
<script type="text/javascript">
$(document).ready(function() {

	$('.handle').on('click',function(){

		$('nav ul').toggleClass('showing');
	});
});

function clearText(field)
{
    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
}
</script>

</head>

<body id="subpage" onLoad="changeCSS()" onResize="changeThings()">


<div id="div1">
	<div id="div2">
    	<div id="site_title">
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
                    echo "NOT LOGIN";
                 }else{
                     echo "Hello, ".$_SESSION['username'];
                      };
                 
                 ?>
             </h2>
             <p style="text-align:right;"><a href="loginc?logout=1">Log Out</a></p>

                <form action="#" method="get">
                </form>
            </div>
         </div> <!-- END -->
    </div> <!-- END of header -->
    
     <div id="templatemo_menu" class="ddsmoothmenu">
     <nav>
     <ul>
            <li><a href="home">Home</a></li>
            <li><a href="product" class="selected">Product</a></li>
             <li><a href="orders" >Orders</a></li>
            <li><a href="shoppingcart" >Shopping Cart</a></li>
            <li><a href="profile">My profile</a></li> 
            <li><a href="loginc">Login</a></li>
        </ul>
    	<div class="handle">Menu<input type="image" align="right" src="<?php echo base_url('images/menu.jpeg')?>" ></div>
    </nav>
    </div> <!-- end of templatemo_menu -->
    
    <div class="cleaner h20" style="background-color:white"></div>

    <div>
      <br>
      <br>
      <br>
      <br>
    </div>

<div id="sidebar">
            <h3>Categories</h3>
            <ul class="sidebar_menu">
<?php
foreach($myData as $row)
{
echo '
 <form action="product1" method="post">
 <li><input type="submit"  id="'.$row->categoryname.'" style="width: 80px; height: 10px;" value="'.$row->categoryname.'" name="category" /></li>
 </form>';
// echo form_open("category");
// echo '<li>';
// echo form_submit(array("id"=>$row->categoryname,"name"=>"category"),$row->categoryname);
// echo '</li>';
// echo form_close();
}
?>
      </ul>     
<p>Dear customer, you can also search the name of your favorite book name.</p>
 <div id="newsletter">
                <form action="product2" method="post">
                  <input type="text" value="search bookname" name="bookname" id="email_newsletter" title="email_newsletter" onfocus="clearText(this)" onblur="clearText(this)" class="txt_field" />
                  <input type="submit" name="search" value="Search" alt="Subscribe" id="subscribebtn" title="Subscribe" class="subscribebtn"  />
                </form>
                <div class="cleaner"></div>
            </div>   
        </div> 
        


        <div id="content">
         
<?php

if(isset($_POST['category'])){
	
          
//  $sql = "select * from Products, Category where Products.categoryid=Category.categoryid and categoryname='$_POST[category]'";
//          $myData1 = mysql_query($sql,$con);
//            $today = date("Y-m-d"); 
		foreach($newdata as $row){
echo '
    <div class="col col_14 product_gallery" >
     <form action="shoppingcart2" method="post">
     <input type="hidden"  name="productid" value="'.$row->productid.'">
      <input type="hidden" id="l'.$row->productid.'" name="productprice" value="'.$row->productprice.'">
    <a href="productdetail.html"><img src="'.base_url($row->productimage).'" alt="Product 01" /></a>
                <h3>'.$row->productname.'</h3>
        <p id="p'.$row->productid.'" class="product_price">$'.$row->productprice.'</p>
      ';
		foreach( $special as $row1){

           if($row1->productid==$row->productid){
               echo '
               <script>
         document.getElementById("l'.$row->productid.'").value="'.$row1->price.'";      
         document.getElementById("p'.$row->productid.'").style="text-decoration:line-through";

             </script>
                 <p class="product_price">special price: $'.$row1->price.'</p>
                

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
	   foreach($myData1 as $row)
       {
echo '
    <div class="col col_14 product_gallery" >
     <form action="shoppingcart2" method="post">
     <input type="hidden"  name="productid" value="'.$row->productid.'">
      <input type="hidden" id="l'.$row->productid.'" name="productprice" value="'.$row->productprice.'">
    <a href="productdetail.html"><img src="'.base_url($row->productimage).'" alt="Product 01" /></a>
                <h3>'.$row->productname.'</h3>
        <p id="p'.$row->productid.'" class="product_price">$'.$row->productprice.'</p>
      ';
		foreach( $special as $row1){

           if($row1->productid==$row->productid){
               echo '
               <script>
         document.getElementById("l'.$row->productid.'").value="'.$row1->price.'";      
         document.getElementById("p'.$row->productid.'").style="text-decoration:line-through";

             </script>
                 <p class="product_price">special price: $'.$row1->price.'</p>
                

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
  // $today = date("Y-m-d"); 
   foreach ($newdata as $row)
 {

  echo '
    <div class="col col_14 product_gallery" >
     <form action="shoppingcart2" method="post">
     <input type="hidden"  name="productid" value="'.$row->productid.'">
      <input type="hidden" id="l'.$row->productid.'" name="productprice" value="'.$row->productprice.'">
    <a href="productdetail.html"><img src="'.base_url($row->productimage).'" alt="Product 01" /></a>
                <h3>'.$row->productname.'</h3>
        <p id="p'.$row->productid.'" class="product_price">$'.$row->productprice.'</p>
      ';
  
   foreach( $special as $row1)
     {
           if($row1->productid==$row->productid){
               echo '
               <script>
         document.getElementById("l'.$row->productid.'").value="'.$row1->price.'";      
         document.getElementById("p'.$row->productid.'").style="text-decoration:line-through";

             </script>
                 <p class="product_price">special price: $'.$row1->price.'</p>
                

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
    
  </body>
  </html>
  
</html>