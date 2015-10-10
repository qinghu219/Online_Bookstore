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

<html>
<head id="head">

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

// $(document).ready(function(){
// 	  $("button").click(function(){
// 	    $.post("/example/jquery/demo_test_post.asp",
// 	    {
// 	      name:"Donald Duck",
// 	      city:"Duckburg"
// 	    },
// 	    function(data,status){
// 	      alert("数据：" + data + "\n状态：" + status);
// 	    });
// 	  });
// });



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

					<h2 style="display: inline"> 
 <?php
	
	if (! isset ( $_SESSION ['customerid'] )) {
		echo '
                    <script>
                    window.alert("Dear customer, please login first");
                    location.href="loginc";


                    </script>
                    ';
	} 

	;
	?>
             </h2>
					<p style="text-align: right;">
						<a href="loginc?logout=1">Log Out</a>
					</p>

					<form action="#" method="get"></form>
				</div>
			</div>
			<!-- END -->
		</div>
		<!-- END of header -->

		 <div id="templatemo_menu" class="ddsmoothmenu">
     <nav>
     <ul>
            <li><a href="home">Home</a></li>
            <li><a href="product">Product</a></li>
             <li><a href="orders" >Orders</a></li>
            <li><a href="shoppingcart" class="selected" >Shopping Cart</a></li>
            <li><a href="profile">My profile</a></li> 
            <li><a href="loginc">Login</a></li>
        </ul>
    	<div class="handle">Menu<input type="image" align="right" src="<?php echo base_url('images/menu.jpeg')?>" ></div>
    </nav>
    </div> <!-- end of templatemo_menu -->

		<div class="cleaner h20" style="background-color: white"></div>

		<div>
			<br> <br> <br> <br>
		</div>
    <?php
				
				//
				
				// echo $myData;
				
				?>
<div id="sidebar"></div>
		<!-- END of sidebar -->



		<div id="content">

			<table cellspacing="0" cellpadding="1">
				<tr bgcolor="#CCCCCC">
					<th  align="left">Image</th>
					<th  align="left">Description</th>
					<th align="center">Quantity</th>
					<th  align="left">Price</th>
					<th ></th>

				</tr>
              <?php
														$sum = 0;
														echo ' <form action="checkout" method="post">';
														foreach ( $myData as $row ) {
															// echo $row[productimage];
															$sum += ($row->productprice) * ($row->qty);
															echo '
             <tr>
                          <td><img class="myimage"  src="' . base_url ( $row->productimage ) . '" alt="image 01"/></td> 
                          <td>' . $row->productdesc . '
                         <input type= "text" id="select1" size = "35" value ="' . $row->productprice . '" style="display:none;"></td>
                            <td><input type="text" id="' . $row->productid . '" name="select2" onkeyup="OnChange(this.id,this.value)" 
		   onKeyPress="return isNumberKey(event)" value="' . $row->qty . '" style="width: 20px; text-align: right" /> </td>
                            
                            <td>' . $row->productprice . ' </td>                 
                            <td><input type="button" value="Remove" name="' . $row->productid . '" onclick="onRemove(this.name);" </td>
            </tr>';
														}
														echo '
            </table>
                    <div style="float:right;  margin-top: 20px;">
                    
                        Subtotal:<div id="total">' . $sum . '</div>
                        <input type="hidden" name="sum" id="sum" value="' . $sum . '"/>
                        <div class="continueshopping"><input type="submit" name="check" value="Proceed to Checkout" class="more"/></div>
                        </form>
                        <form action="shoppingcart" method="post">
                        <div class="continueshopping"><input type="submit"  id="clearall" name="clear" value="      Clear all items     " class="more"/></div>
                        </form>
                     
                        <div class="continueshopping"><a href="product" class="more">Continue Shopping</a></div>
                     </div>
              ';
														
														?>                   
    </div>
				<div class="cleaner"></div>
				</div>
				<!-- END of main -->

				<div id="templatemo_footer">
					<div id="new"></div>
<?php
$array1 = array ();

if (isset ( $_POST ['submit'] )) {
	$array1 [0] = 1;
	
	if ($array1 [0]) {
		echo '<h2> Customers Who Bought This Item Also Bought:</h2>';
		
		// foreach ($newdata as $row){
		for($x = 0; $x < $length; $x ++) {
			$cool = $newdata [$x];
			foreach ( $cool as $row ) {
				echo '
    <div class="col col_13 product_gallery" >
     <form action="shoppingcart2" method="post">
     <input type="hidden"  name="productid" value="' . $row->productid . '">
      <input type="hidden" id="l' . $row->productid . '" name="productprice" value="' . $row->productprice . '">
     <a href="productdetail.html"><img src="' . base_url ( $row->productimage ) . '" alt="Product 01" /></a>
                <h3>' . $row->productname . '</h3>
        <p id="p' . $row->productid . '" class="product_price">$' . $row->productprice . '</p>
      ';
				foreach ( $mydata as $row1 ) {
					
					if ($row1->productid == $row->productid) {
						echo '
               <script>
         document.getElementById("l' . $row->productid . '").value="' . $row1->price . '";      
         document.getElementById("p' . $row->productid . '").style="text-decoration:line-through";

             </script>
                 <p class="product_price">special price: $' . $row1->price . '</p>
                

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
	}
}

// print_r($array1);

?>


 </div>

<script>
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
	xmlhttp.open("POST","setquantity",true);
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
	xmlhttp.open("POST","removecart",true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	 var vars="productid="+productid;
	xmlhttp.send(vars);
	    }






 </script>

</body>
</html>