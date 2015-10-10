<?php
session_start();
?>
<html>

<head>
 <meta http-equiv="content-type" content="text/html; charset=windows-1250">
 <style>
 button{
 background:#F0F0F0 repeat-x;
 padding-top:3px;
 border-top:1px solid #708090;
 border-right:1px solid #708090;
 border-bottom:1px solid #708090;
 border-left:1px solid #708090; 
 width:80px;
 height:auto;
 font-size:10pt;
 cursor:hand;
}


 body{
    background-image: url('images/blue.jpg');
    background-repeat: no-repeat;
    /*background-position: center;*/

    }
  #div1{

}
#div2{
    display:none;
}
#div3{
    display:none;
}

</style>

</head>
<body>
  <p style="text-align:right;"><a href="login.php?logout=1">Log Out</a></p>
   <?php

// echo $_COOKIE["PHPSESSID"];
if (!isset($_SESSION['username'])) {
    echo "<script>location.href='login.php';</script>";
};
if(!($_SESSION['usertype']=='Manager')){
           echo "<script>location.href='login.php';</script>";

        }
if((time()-$_SESSION['timeout'])>300)
       {
       session_destroy();
       echo'
    <script type="text/javascript">
    window.alert("You have a long time to do nothing, please login again!");
     location.href="login.php";
    </script>
     ';
        }
        $_SESSION['timeout']=time();





?>
        <div align="left">
            <h1>Hello, <?php
echo $_SESSION['username'] ?></h1>

        </div>
        <input type="button" class="button" value="Products" onClick="reverseIt(1)"/>&nbsp&nbsp
        <input type="button" class="button" value="Employees" onClick="reverseIt(2)"/>&nbsp&nbsp
        <input type="button" class="button" value="Special Sales" onClick="reverseIt(3)"/>
        <input type="button" class="button" value="Go to orders" onClick="gochange()"/>

        <div id="div1">
        <form class="search" align="center">
        PriceRange: from<input id="pf" type="text" name="pf" value='0'>
        to<input type="text" id="pt" name="pt" value='1000'>&nbsp&nbsp
        ProductName<input id="pn" type="text" name="pn">&nbsp&nbsp
        ProductCategory:<input id="pc" type="text" name="pc">
        <input type="button" name="searchproduct" onclick="loadproducts();" value="search">
        </form>
        <div id="mydiv1">
      
      
     
    
       </div>
       </div>
        <div id="div2">
        <!-- <form class="search" align="center" action="manager.php" method="post">
        PriceRange: from<input type="text" name="pf" value='0'>to<input type="text" name="pt" value='1000'>&nbsp&nbsp
        ProductName<input type="text" name="pn">&nbsp&nbsp
        ProductCategory:<input type="text" name="pc">
        <input type="submit" name="searchproduct" value="search">
        </form> -->
        <form class="search" align="center">
        SalaryRange: from<input id="pf1" type="text" name="pf" value='0'>$
        to<input type="text" id="pt1" name="pt" value='20000'>$ &nbsp&nbsp
        Employeetype<select id="pn1">
        <option value="">Select All</option>
       <option value="Administrator">Administrator</option>
       <option value="Employee">Employee</option>
       <option value="Manager">Manager</option>
      </select>&nbsp&nbsp</td><td>

        <input type="button" name="searchuser" onclick="loademployee();" value="search">
        </form>
        <div id="mydiv2">
     
       </div>
       </div>


        <div id="div3">
 <form class="search" align="center">
        PriceRange: from<input id="pf2" type="text" name="pf" value='0'>$
        to:<input type="text" id="pt2" name="pt" value='1000'>$
        Sale Startdate:<input id="pf3" type="text" name="pf" value='2011-1-1'>
        Enddate:<input type="text" id="pt3" name="pt" value='2015-1-1'>&nbsp&nbsp
        Productname:<input id="pn2" type="text" name="pn">&nbsp&nbsp
        Category:<input id="pc2" type="text" name="pn">&nbsp
        <input type="button" name="searchuser" onclick="loadsale();" value="search">
        </form>
     <h2 align=center>Special Sales Information</h2>
        <div id="mydiv3">
        <?php
//print_r(mysql_fetch_array($myData));
//print_r(mysql_fetch_array($myData));

//echo "<h2 align=center>Product Information</h2>";
        echo "<table border=1 align=center>";

         echo "
        <tr>
        <th>Special Sales ID</th>
        <th>Product ID</th>
        <th>Start Date</th>
        <th>End date</th>
        <th>Price</th>
       </tr>";
        ?>
      
     
    
       </div>
       </div>



 <?php
// echo "<h2 align=center>Special Sales Information</h2>";
// echo "<table border=1 align=center>";

// echo "
//         <tr>
//         <th>Special Sales ID</th>
//         <th>Product ID</th>
//         <th>Start Date</th>
//         <th>End date</th>
//         <th>Price</th>
//        </tr>";

// while ($row = mysql_fetch_array($myData2)) {
//     echo "<form class=table align=center action=employee.php method=post>";
//     echo "<tr>";
    
//     // echo '<td><input type="checkbox" name="userid[]" value="'.$row['userid'].'"/></td>';
//     // echo "<td>"."<input type=text name=userid value=".$row['userid']."></td>";
//     echo "<td>" . "<input type='text' name='specialid' value='" . $row[specialid] . "'></td>";
//     echo "<td>" . "<input type='textarea' name='productid' value='" . $row[productid] . "'></td>";
    
//     // echo "<td>"."<input type='textarea' name='startdate' value='".date('m/d/y',strtotime($row[startdate]))."''></td>";
//     echo "<td>" . "<input type='textarea' name='startdate' value='" . $row[startdate] . "''></td>";
//     echo "<td>" . "<input type='textarea' name='enddate' value='" . $row[enddate] . "''></td>";
    
//     // echo "<td>"."<input type='textarea' name='enddate' value='".date('m/d/y',strtotime($row[enddate]))."''></td>";
//     echo "<td>" . "<input type='text' name='price' value='" . $row[price] . "''></td>";
    
//     echo "<td>" . "<input type='hidden' name='hidden' value='" . $row[specialid] . "'></td>";
    
//     echo "<td>" . "<input type=submit name=updatesale value=update>" . "</td>";
//     echo "<td>" . "<input type=submit name=deletesale value=delete>" . "</td>";
//     echo "</tr>";
//     echo "</form>";
// }

// echo "<form class=table align=center action=employee.php method=post>";
// echo "<tr>";
// echo "<td></td>";
// echo "<td><input type=text name=1></td>";
// echo "<td><input type=text name=2></td>";
// echo "<td><input type=text name=3></td>";
// echo "<td><input type=text name=4></td>";

// echo "<td></td>";
// echo "<td>" . "<input type=submit name=addsale value=add>" . "</td>";
// echo "</tr>";
// echo "</form>";
// echo "</table>";

// $date = '2012-12-30';
//echo date('d-m-Y', strtotime($date));
?>




 <p style="text-align:center;"><a href="login.php?logout=1">Log Out</a></p>




 <script type="text/javascript">
function reverseIt(x) {
    d1 = document.getElementById("div1");
    d2 = document.getElementById("div2");
    d3=document.getElementById("div3");
    var t=x;
    if (t==1) {
        d1.style.display = "block";
        d2.style.display = "none";
        d3.style.display="none";

    } else if (t==2){
       // window.alert("Ll");
        d1.style.display = "none";
        d2.style.display = "block";
        d3.style.display="none";
    } else if(t==3){
        d1.style.display="none";
        d2.style.display="none";
        d3.style.display="block";
    }
}

function loadproducts()
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }


  document.getElementById("mydiv1").innerHTML="Please Wait a minute";
    xmlhttp.onreadystatechange=function()
   {
    //window.alert(xmlhttp.readyState);
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
         {
        //window.alert(xmlhttp.readyState);
        var return_data=xmlhttp.responseText;
         document.getElementById("mydiv1").innerHTML=return_data;
          }
  }
xmlhttp.open("POST","protable.php",true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 var pn = document.getElementById("pn").value;
 var pf = document.getElementById("pf").value;
  var pt= document.getElementById("pt").value;
   var pc = document.getElementById("pc").value; 
  var vars="pn="+pn+"&"+"pf="+pf+"&pt="+pt+"&pc="+pc;
xmlhttp.send(vars);
}

function loademployee()
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }


  document.getElementById("mydiv2").innerHTML="Please Wait a minute";
    xmlhttp.onreadystatechange=function()
   {
    //window.alert(xmlhttp.readyState);
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
         {
        //window.alert(xmlhttp.readyState);
        var return_data=xmlhttp.responseText;
         document.getElementById("mydiv2").innerHTML=return_data;
          }
  }
xmlhttp.open("POST","usertable.php",true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 var pn = document.getElementById("pn1").value;
 var pf = document.getElementById("pf1").value;
  var pt= document.getElementById("pt1").value;
  var vars="pn="+pn+"&pf="+pf+"&pt="+pt;
xmlhttp.send(vars);
}

function loadsale()
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }


  document.getElementById("mydiv3").innerHTML="Please Wait a minute";
    xmlhttp.onreadystatechange=function()
   {
    //window.alert(xmlhttp.readyState);
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
         {
        //window.alert(xmlhttp.readyState);
        var return_data=xmlhttp.responseText;
         document.getElementById("mydiv3").innerHTML=return_data;
          }
  }
xmlhttp.open("POST","saletable.php",true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 var pf2 = document.getElementById("pf2").value;
 var pt2 = document.getElementById("pt2").value;
  var pf3= document.getElementById("pf3").value;
  var pt3 = document.getElementById("pt3").value;
 var pn2 = document.getElementById("pn2").value;
  var pc2= document.getElementById("pc2").value;
  var vars="pf2="+pf2+"&pt2="+pt2+"&pf3="+pf3+"&pt3="+pt3+"&pn2="+pn2+"&pc2="+pc2;
xmlhttp.send(vars);
}

function gochange(){
  location.href="searchorder.php";
}




</script>
  
</body>
</html>