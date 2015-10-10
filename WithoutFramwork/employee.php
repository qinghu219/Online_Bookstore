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
    background-repeat: repeat;
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
 <script>
function change(){
  location.href='addemployee.php';
}


function linkto(){
  location.href='editcategory.php';
}

 </script>




</head>
<body>
   <?php

// echo $_COOKIE["PHPSESSID"];
if (!isset($_SESSION['username'])) {
    echo "<script>location.href='login.php';</script>";
};

if(!($_SESSION['usertype']=='Employee')){
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
<p style="text-align:right;"><a href="login.php?logout=1">Log Out</a></p>

        <div align="left">
            <h1>Hello, <?php
echo $_SESSION['username']; ?></h1>

        </div>
        <div id="div1">
        <form class="search" align="center">
        ProductName<input id="pn" type="text" name="pn">&nbsp&nbsp
        ProductCategory:<input id="pc" type="text" name="pc">
        <input type="button" name="searchproduct" onclick="loadproducts();" value="search"><br>
        </form>
         <input type="button" name="link" value="link to Category " onclick="linkto();">
        <input type="button" name="add" value="  add   " onclick="change();">
       
        <form class="table" align="center" action="editemployee.php" method="post"> 
         <input type="submit" name="edit" value="  edit   "/><br>
         <input type="submit" name="delete" value="delete"/><br> 
         <input type="reset" name="clear" value=" Clear  "/>
       <div id="mydiv1"> 
       </div>
       </form>
       </div>




 <script type="text/javascript">


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
xmlhttp.open("POST","ajaxpro.php",true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 var pn = document.getElementById("pn").value;
   var pc = document.getElementById("pc").value; 
  var vars="pn="+pn+"&pc="+pc;
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





</script>
  
</body>
</html>