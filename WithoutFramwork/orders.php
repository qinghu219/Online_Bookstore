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
<link href="css/alldiv.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
<!-- <link href="style.css" rel="stylesheet" type="text/css" /> -->
<style>
  
  a{

      color: #666;
  }
</style>

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
        <ul>
            <li><a href="home.php" >Home</a></li>
            <li><a href="product.php">Product</a></li>
            <li><a href="orders.php" class="selected">Orders</a></li>
            <li><a href="shoppingcart.php">Shopping Cart</a></li>
            <li><a href="profile.php">My profile</a></li> 
            <li><a href="loginc.php">Login</a></li>
        </ul>
        <br style="clear: left" />
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
               $con = mysql_connect("localhost:3306", "root", "root");
              mysql_select_db('qinghu', $con);
                $customerid=$_SESSION['customerid'];
                    $sql1="select * from orders where customerid='$customerid'";
                $data=mysql_query($sql1);
                $rows=mysql_num_rows($data);

            
            if(isset($_GET['page'])){
                $page=$_GET['page'];
                $page=mysql_real_escape_string($page);

              }
              else{
                $page=1;
              }

            $perpage=5;
            $total_page=ceil($rows/$perpage);
            // echo $total_page;
            echo "You are on page $page of $total_page<br>";
            if($page!=1){
              echo "<a href='orders.php?page=1'><span style='color:red'>First</span></a>"." ";
              $previous=$page-1;
              echo "<a href='orders.php?page=$previous'><span style='color:red'>Previous</span></a>";
            }

             if(($page!=1)&&($page!=$total_page)){
                echo " | ";
              }

              if($page!=$total_page){
                $next=$page+1;
                 echo "<a href='orders.php?page=$next'><span style='color:red'>Next</span></a>"." ";
                 echo "<a href='orders.php?page=$total_page'><span style='color:red'>Last</span></a>"." ";
              }
              echo  "<hr><br/>";
              $x=($page-1)*$perpage;

              $sql2="select * from orders where customerid='$customerid' limit $x,$perpage";
                $data1=mysql_query($sql2);
           


          
          ?> 
			
            <div class="col col_13">
            
            <div id="contact_form">
              <?php
       // echo "<form class=table align=center action=admin.php method=post>";
       echo "<form class=table align=center action=editadmin.php method=post>"; 
       echo "<table border=0 align=center>";
      
        echo "
        <tr>
         <th>Detail</th>
        <th>orderid</th>
        <th>ordertime</th>
        <th>billing address</th>
        <th>shipping address</th>
        <th>Total cost</th>
       
        </tr>";

   while($row = mysql_fetch_array($data1)) {
            
            echo "<tr>";
             echo "<td>"."<input type=button value=detail onclick='loaddetail(".$row[orderid].")'></td>";
            // echo '<td><input type="checkbox" name="userid[]" value="'.$row['userid'].'"/></td>';
            //  echo '<td><input type="radio" name="radioname" value="'.$row['userid'].'"/></td>';
           // echo "<td>"."<input type=text name=userid value=".$row['userid']."></td>";
            echo "<td>"."<input type=text name=username size=10 value=".$row['orderid']."></td>";
            echo "<td>"."<input type=text name=firstname size=17 value='".$row[nowtime]."'></td>";
            echo "<td>"."<input type=text name=lastname size=35 value='".$row[billingaddress]."'></td>";
            echo "<td>"."<input type=text name=password size=35 value='".$row[shippingaddress]."'></td>";
            echo "<td>"."<input type=text name=usertype size=11 value=".$row['total']."></td>";

           
            // echo "<td>"."<input type=text name=salary value=".$row['salary']."></td>";

            echo "<td>"."<input type=hidden name=hidden value=".$row['username']."></td>";
            // echo "<td>"."<input type=submit name=update value=update>"."</td>";
            // echo "<td>"."<input type=submit name=delete value=delete>"."</td>";
            echo "</tr>";
           
           }
           echo"</table>";
            echo "</form>";
            echo'           
            </div> ';    
           
         mysql_close($con);
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
xmlhttp.open("POST","detail.php",true);
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