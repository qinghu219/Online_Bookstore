<?php
session_start();
?>
<html>

<head>
 <meta http-equiv="content-type" content="text/html; charset=windows-1250">
<link href="css/jquery-ui.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.11.1.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script>
$(document).ready(function() {

    $( ".datepicker" ).datepicker();

  });
  </script>


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
// if((time()-$_SESSION['timeout'])>300)
//        {
//        session_destroy();
//        echo'
//     <script type="text/javascript">
//     window.alert("You have a long time to do nothing, please login again!");
//      location.href="login.php";
//     </script>
//      ';
//         }
//         $_SESSION['timeout']=time();

 $con = mysql_connect("localhost:3306", "root", "root");
       mysql_select_db('qinghu', $con);



?>
        <div align="left">
            <h1>Hello, <?php
echo $_SESSION['username'] ?></h1>

        </div>
       
        <div id="mydiv">
        <form class="search" align="center" action="" >
           CategoryName
       <select name="categoryname" class="sgselect scate" id="cn">

          <option selected="selected" value="">--select category--</option>
         <?php 
          $sql1 = 'select categoryname from Category';
          $res = mysql_query($sql1);

         while ($row = mysql_fetch_assoc($res) )  {  ?>
          <option value="<?php echo $row[categoryname]; ?>"><?php echo $row[categoryname]; ?></option>
          <?php }  ?>
         </select>&nbsp&nbsp
       ProductName<input id="pn" type="text" name="pn">&nbsp&nbsp
        Startdate:<input id="pf" type="text" name="pf" value="" class="datepicker" size="10" readonly>
        Enddate:<input type="text" id="pt" name="pt" value="" class="datepicker" size="10" readonly>&nbsp&nbsp
        special sale:<input type="checkbox" name="special" id="sp" value="9" />
        <input type="button" name="search"  value="search" onclick="loadorder()">
        </form>
        </div>
        <div id="div1"></div>
        <div id="div2">
        </div>


<script>
function loadorder()
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


  document.getElementById("div1").innerHTML="Please Wait a minute";
    xmlhttp.onreadystatechange=function()
   {
   // window.alert(xmlhttp.readyState);
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
         {
        //window.alert(xmlhttp.readyState);
        var return_data=xmlhttp.responseText;
         document.getElementById("div1").innerHTML=return_data;
          }
  }
xmlhttp.open("POST","orderajax.php",true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 var cn=document.getElementById("cn").value;
 var pn = document.getElementById("pn").value;
 var pf = document.getElementById("pf").value;
  var pt= document.getElementById("pt").value;
  var sp;
  if(document.getElementById("sp").checked==true){
    sp=1;
   }else{
    sp=5;
   }

  var vars="categoryname="+cn+"&"+"pn="+pn+"&"+"pf="+pf+"&pt="+pt+"&special="+sp;
xmlhttp.send(vars);
}


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
      
         document.getElementById("div2").innerHTML=return_data;
   
       

          }
  }
xmlhttp.open("POST","mydetail.php",true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 var vars="orderid="+orderid;

xmlhttp.send(vars);

}


</script>


         
</body>
</html>