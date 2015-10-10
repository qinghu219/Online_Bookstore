<?php
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
<head id="head">

 
	  
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
             <p style="text-align:right; right-margin:5px"><a href="loginc?logout=1">Log Out</a></p>

                <form action="#" method="get">
                </form>
            </div>
         </div> <!-- END -->
    </div> <!-- END of header -->
    
   <div id="templatemo_menu" class="ddsmoothmenu">
     <nav>
     <ul>
            <li><a href="home" class="selected">Home</a></li>
            <li><a href="product">Product</a></li>
             <li><a href="orders" >Orders</a></li>
            <li><a href="shoppingcart" >Shopping Cart</a></li>
            <li><a href="profile">My profile</a></li> 
            <li><a href="loginc" >Login</a></li>
        </ul>
    	<div class="handle">Menu<input type="image" align="right" src="<?php echo base_url('images/menu.jpeg')?>" ></div>
    </nav>
    </div> <!-- end of templatemo_menu -->
    
    <div class="cleaner h20" style="background-color:white"></div>

    <div id="templatemo_middle">
     <!--  <img src="images/templatemo_image_01.png" alt="Image 01" /> -->
      <h1>Book Online Store</h1>
        <p> Welcome to Book online Store. now there are many books that are the special sales. You also can brows all books in the books page! Have a good day!</p>
        <a href="product" class="buy_now">Browse all Books</a>
        <br>
        <br>
        <p>The special sales book are as follows:</p>
    </div> 


<div id="sidebar">
</div> <!-- END of sidebar -->
        


        <div id="content">             
<?php
//  print_r($mydata1);
  foreach ($mydata1 as $row)
 {
  echo '
  <div class="col col_14 product_gallery" >
     <form action="shoppingcart2" method="post">
     <input type="hidden" name="productid" value="'.$row->productid.'">
     <input type="hidden" name="productprice" value="'.$row->price.'">
   <a href="productdetail.html"><img src="'.base_url($row->productimage).'" alt="Product 01" /></a>
                <h3>'.$row->productname.'</h3>
                <p class="product_price">special price: $'.$row->price.'</p>
                <input type="submit" class="add_to_cart" name="submit" value="Add to Cart">
                </form>
    </div> 

    &nbsp
'; 
}
?>       
       
        </div> <!-- END of content -->
        <div class="cleaner"></div>
    </div> <!-- END of main -->   
  </body>
  
  
  </html>
</html>