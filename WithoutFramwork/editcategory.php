<?php 
session_start();
 ?>
<html>

<head>
<style>
 body{
    background-image: url('images/blue.jpg');
    background-repeat: repeat;
    /*background-position: center;*/

    }
 </style>
<script>

function home(){
    location.href='employee.php';

}

</script>


</head>


<body>
 <?php 

    // echo $_COOKIE["PHPSESSID"];
 
     if(!isset($_SESSION['username'])){
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
      
     // setcookie ("PHPSESSID", "", time() + 3600);



       $con = mysql_connect("localhost:3306", "root", "root");

        mysql_select_db('qinghu', $con);

        

         if(isset($_POST['updatecategory'])){
            $updatequery="UPDATE Category SET categoryname='$_POST[categoryname]',categorydesc='$_POST[categorydesc]' where categoryid='$_POST[hidden]'";
            mysql_query($updatequery);
        };
        if(isset($_POST['deletecategory'])){
            $deletequery="DELETE FROM Category WHERE categoryid='$_POST[hidden]'";
            mysql_query($deletequery,$con);
        };

          if(isset($_POST['addcategory'])){
            $addquery="INSERT INTO Category values ('$_POST[categoryname]','$_POST[categorydesc]')";
            mysql_query($addquery,$con);
        };


//$start = date('Y-m-d', strtotime(str_replace('-', '/', $_POST[startdate])));
//$end= date('Y-m-d', strtotime(str_replace('-', '/', $_POST[enddate])));
        


        

         $sql1="select * from Category";
         $myData1=mysql_query($sql1,$con);


        ?>
        <div align="left">
            <h1>Hello, <?php echo $_SESSION['username']?></h1>

        </div>
        

       

<div id="div2">

 <input type="button" name="good" value="Go Back" onclick="home()">
 <?php

        //This is about productcateory information below.
            echo "<h2 align=center>ProductCategory Information</h2>";
        echo "<table border=1 align=center>";   ?>

<?php
        echo "
        <tr>
        <th>Category Name</th>
        <th>Category Description</th>
       </tr>";

   while($row = mysql_fetch_array($myData1)) {
            echo "<form class=table align=center action=editcategory.php method=post>"; 
            echo "<tr>";
           // echo '<td><input type="checkbox" name="userid[]" value="'.$row['userid'].'"/></td>';
           // echo "<td>"."<input type=text name=userid value=".$row['userid']."></td>";
          //  echo "<td>"."<input type='text' name='categoryid' value='".$row[categoryid]."'></td>";
            echo "<td>"."<input type='textarea' name='categoryname' value='".$row[categoryname]."'></td>";
            echo "<td>"."<input type='textarea' name='categorydesc' value='".$row[categorydesc]."''></td>";
            echo "<td>"."<input type='hidden' name='hidden' value='".$row[categoryid]."'></td>";
            echo "<td>"."<input type=submit name=updatecategory value=update>".$row[categoryid]"</td>";
            echo "<td>"."<input type=submit name=deletecategory value=delete>".$row[categoryid]"</td>";
            echo "</tr>";
            echo "</form>";
           }      
       
        echo "<form class=table align=center action=editcategory.php method=post>";
        echo "<tr>";
        echo "<td><input type=textarea name=categoryname></td>";
        echo "<td><input type=textarea name=categorydesc></td>";
    
        echo "<td></td>";
        echo "<td>"."<input type=submit name=addcategory value=add>"."</td>";
        echo "</tr>";
        echo "</form>";
        echo "</table>";

?>
</div>

    

 <p style="text-align:center;"><a href="login.php?logout=1">Log Out</a></p>




  
</body>
</html>