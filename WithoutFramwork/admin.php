<?php 
session_start();
 ?>
<html>
<head>
 <meta http-equiv="content-type" content="text/html; charset=windows-1250">
 <style type="text/css">
#div2{
    display:none;
}
#div1{
    display:none;
}
 body{
    background-image: url('images/blue.jpg');
    background-repeat: no-repeat;
    /*background-position: center;*/
    }
 </style>

 

</head>
<body>
 <?php 

    // echo $_COOKIE["PHPSESSID"];
 
        if(!isset($_SESSION['username'])){
            echo "<script>location.href='login.php';</script>";

        };
        if(!($_SESSION['usertype']=='Administrator')){

           echo "<script>
           window.alert('Invalid login');
           location.href='login.php';</script>";

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

        // if (mysqli_connect_errno()) {
        //     echo "Failed to connect to MySQL: " . mysqli_connect_error();
        // }
       // if(!$con){
       //  die("Can not connect:".mysql_error();
       // }
        mysql_select_db('qinghu', $con);
       
         $sql = "select * from Users order by userid asc";
        $myData = mysql_query($sql,$con);
        ?>
        <div align="left">
            <h1>Hello, <?php echo $_SESSION['username']?></h1>

        </div>
        <?php
       // echo "<form class=table align=center action=admin.php method=post>";
       echo "<form class=table align=center action=editadmin.php method=post>"; 
       echo "<table border=1 align=center>";
      
        echo "
        <tr>
        <th>delete</th>
        <th>edit</th>
        <th>username</th>
        <th>firstname</th>
        <th>lastname</th>
        <th>password</th>
        <th>usertype</th>
        <th>age</th>
        <th>salary</th>
        </tr>";

   while($row = mysql_fetch_array($myData)) {
            
            echo "<tr>";
            echo '<td><input type="checkbox" name="userid[]" value="'.$row['userid'].'"/></td>';
             echo '<td><input type="radio" name="radioname" value="'.$row['userid'].'"/></td>';
           // echo "<td>"."<input type=text name=userid value=".$row['userid']."></td>";
            echo "<td>"."<input type=text name=username value=".$row['username']."></td>";
            echo "<td>"."<input type=text name=firstname value=".$row['firstname']."></td>";
            echo "<td>"."<input type=text name=lastname value=".$row['lastname']."></td>";
            echo "<td>"."<input type=text name=password value=".$row['password']."></td>";
            echo "<td>"."<input type=text name=usertype value=".$row['usertype']."></td>";
            echo "<td>"."<input type=text name=age value=".$row['age']."></td>";
            echo "<td>"."<input type=text name=salary value=".$row['salary']."></td>";

            echo "<td>"."<input type=hidden name=hidden value=".$row['username']."></td>";
            // echo "<td>"."<input type=submit name=update value=update>"."</td>";
            // echo "<td>"."<input type=submit name=delete value=delete>"."</td>";
            echo "</tr>";
           
           }
           echo"</table>";
            echo '
            <div align="center">
            <input type="submit" name="delete" value="Delete Marked"/>
            <input type="reset" name="clear" value="Clear Marked"/>
             <input type="submit" name="edit" value="edit"/>
           
            '; 
            echo "</form>";
            echo'
             <input type="button" name="add" value="add" onclick="change()"/>           
            </div> ';    
           
         mysql_close($con);




 ?>
 
 <!-- <div id="div1">
        <br>
        <br>
        <br>
     <form  align="center" action="editadmin.php" method="post">
        <table align="center" border="1">
        <tr><td>Username:</td><td><input type="text" id="username" name="username"></td></tr>
         <tr><td>First Name:</td><td><input type="text" id="fname" name="firstname"></td></tr>
        <tr><td>Last Name:</td><td><input type="text" id="lname" name="lastname"></td></tr>
        <tr><td>Password:</td><td><input type="password" id="password" name="password"></td></tr>
        <tr><td>Usertype:</td><td>
        <input type="radio" name="type"value="Administrator" checked>Administrator
        <input type="radio" name="type"value="Employee">Employee
        <input type="radio" name="type" value="Manager">Manager
        </td></tr>  
        <tr><td>Age:</td><td><input type="text" id="age" name="age"></td></tr>
        <tr><td>Salary:</td><td><input type="text" id="salary" name="salary"></td></tr>
        <td></td><td><input type="submit" name="add" value="submit"></td>
        </tr>
        </table>
    </form>
</div>

<div id="div2">
        <br>
        <br>
        <br>
     <form  align="center" action="admin.php" method="post">
        <table align="center" border="1">
        <tr><td>Username:</td><td><input type="text" name="username"></td></tr>
         <tr><td>First Name:</td><td><input type="text" name="firstname"></td></tr>
        <tr><td>Last Name:</td><td><input type="text" name="lastname"></td></tr>
        <tr><td>Password:</td><td><input type="password" name="password"></td></tr>
        <tr><td>Usertype:</td><td>
        <input type="radio" name="type"value="Administrator" checked>Administrator
        <input type="radio" name="type"value="graduate">Employee
        <input type="radio" name="type" value="PHD">Manager
        </td></tr>  
        <tr><td>Age:</td><td><input type="text" id="age"></td></tr>
        <tr><td>Salary:</td><td><input type="text" id="salary"></td></tr>
        <td></td><td><input type="submit" name="add" value="add"></td>
        </tr>
        </table>
    </form>

 </div> -->



 <p style="text-align:center;"><a href="login.php?logout=1">Log Out</a></p>

  <script>

function addshow(){
    document.getElementById("div1").style.display="block";
     document.getElementById("div2").style.display="none";
}
function addshow(){
    document.getElementById("div1").style.display="none";
     document.getElementById("div2").style.display="block";
}
function change(){
    location.href='adduser.php';
}
 </script>
</body>
</html>
