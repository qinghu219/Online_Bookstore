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

 
	  
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="<?php echo base_url('js/jquery-1.11.1.js');?>"></script>
<!-- <link href="style.css" rel="stylesheet" type="text/css" /> -->
<style>
  
  a{

      color: #666;
  }
</style>

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
     <nav>
     <ul>
            <li><a href="home">Home</a></li>
            <li><a href="product">Product</a></li>
             <li><a href="orders" class="selected" >Orders</a></li>
            <li><a href="shoppingcart" >Shopping Cart</a></li>
            <li><a href="profile">My profile</a></li> 
            <li><a href="loginc">Login</a></li>
        </ul>
    	<div class="handle">Menu<input type="image" align="right" src="<?php echo base_url('images/menu.jpeg')?>" ></div>
    </nav>
    </div> <!-- end of templatemo_menu -->
    
    <div class="cleaner h20"></div>
    <div id="templatemo_main_top"></div>


    <div id="templatemo_main" style="display:block">
    	
          <div id="content2" style="display:none">
            <h2>My order<h2>
          </div>
          <div id="content1">
        	<h2>My Orders</h2>
      

            <?php 

            echo "You are on page $page of $total_page<br>";
            if($page!=1){
              echo "<a href='orders?page=1'><span style='color:red'>First</span></a>"." ";
              $previous=$page-1;
              echo "<a href='orders?page=$previous'><span style='color:red'>Previous</span></a>";
            }

             if(($page!=1)&&($page!=$total_page)){
                echo " | ";
              }

              if($page!=$total_page){
                $next=$page+1;
                 echo "<a href='orders?page=$next'><span style='color:red'>Next</span></a>"." ";
                 echo "<a href='orders?page=$total_page'><span style='color:red'>Last</span></a>"." ";
              }
              echo  "<hr><br/>";
              
              
              
//               $x=($page-1)*$perpage;

//               $sql2="select * from orders where customerid='$customerid' limit $x,$perpage";
//                 $data1=mysql_query($sql2);
           


          
          ?> 
			
            <div class="col col_13">
            
            <div id="contact_form">
              <?php
       // echo "<form class=table align=center action=admin.php method=post>";
       echo "<form class=table align=center action=editadmin method=post>"; 
       echo "<table border=1>";
      
        echo "
        <thead>
		<tr>
         <th>Detail</th>
        <th>orderid</th>
        <th>ordertime</th>
        <th>billing address</th>
        <th>shipping address</th>
        <th>Total cost</th>
       
        </tr>
		</thead>";
	foreach ($data1 as $row){
//    while($row = mysql_fetch_array($data1)) {
            
            echo "<tr>";
             echo "<td>"."<input type=button value=detail class=detail onclick='loaddetail(".$row->orderid.")'></td>";
            // echo '<td><input type="checkbox" name="userid[]" value="'.$row['userid'].'"/></td>';
            //  echo '<td><input type="radio" name="radioname" value="'.$row['userid'].'"/></td>';
           // echo "<td>"."<input type=text name=userid value=".$row['userid']."></td>";
            echo "<td>".$row->orderid."</td>";
            echo "<td>".$row->nowtime."</td>";
            echo "<td>".$row->billingaddress."</td>";
            echo "<td>".$row->shippingaddress."</td>";
            echo "<td>".$row->total."</td>";

            echo "</tr>";
           
           }
           echo"</table>";
            echo "</form>";
            echo'           
            </div> ';    
           
       
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
function loaddetail(x){
  var orderid=x;


 
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
        //window.alert(xmlhttp.readyState);
        var return_data=xmlhttp.responseText;
         document.getElementById("content2").innerHTML=return_data;
         document.getElementById("content2").style="display:block";
         document.getElementById("content1").style="display:none";

          }
  }
xmlhttp.open("POST","detail",true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 var vars="orderid="+orderid;

xmlhttp.send(vars);

}
 
function goback(){

         document.getElementById("content1").style="display:block";
         document.getElementById("content2").style="display:none";
  
}



</script>


      
</body>
</html>