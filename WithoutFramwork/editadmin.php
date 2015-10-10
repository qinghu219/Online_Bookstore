<?php 
session_start();
?>
<html>
<head>
  <style>
 body{
    background-image: url('images/blue.jpg');
    background-repeat: no-repeat;
    /*background-position: center;*/

    }
.errormsg{
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

<script>

function backpage(){

  location.href='admin.php';  

}

function validateForm() {
    var x10 = document.getElementById("username").value;
    if (x10 == null || x10 == "") {
        alert("Username must be filled out");
        document.getElementById("username").focus();
        return false;
    }
    var x2 = document.getElementById("age").value;
    if(isNaN(x2)){
      alert("Please enter a valid age");
      document.getElementById("age").focus();
      return false;
    }

    var x3 = document.getElementById("salary").value;
    if(isNaN(x3)){
      alert("Please enter a valid salary");
      document.getElementById("salary").focus();
      return false;
    }
  }

   

</script>
  </head>
<body>
  <?php
  
$error="";

  if(!isset($_SESSION['username'])){
            echo "<script>location.href='login.php';</script>";

        };
 if(!($_SESSION['usertype']=='Administrator')){
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


         $con = mysql_connect("localhost:3306", "root", "root");
         mysql_select_db('qinghu', $con);


          if(isset($_POST['addok'])){


         $username = $_POST['username'];
         $password = $_POST['password'];
         $age=$_POST['age'];


              if (trim($username) == '') {
        $error = '<div class="errormsg">Please enter your username!</div>';
        echo "<form action ></form>";

         }else if (trim($password) == '') {
        $error = '<div class="errormsg">Please enter a password!</div>';
        }else if(preg_match("/[^\d-., ]/",$age)){
        $error = '<div class="errormsg">Please enter valid age!</div>';
        }
        else{
          
           $addquery="INSERT INTO Users(username,firstname,lastname,password,usertype,age,salary) values ('$_POST[username]','$_POST[firstname]','$_POST[lastname]','$_POST[password]','$_POST[type]','$_POST[age]','$_POST[salary]')";
          
            mysql_query($addquery,$con);
              
          echo "<script>location.href='admin.php';</script>";
       
        }


           // $usertype=$_POST([type.value]);
         
              //header("Location: admin.php")；
             // exit;

        };
 if(isset($_POST['editok'])){

           // $usertype=$_POST([type.value]);
          //  $updatequery="UPDATE Users SET username='$_POST[username]',firstname='$_POST[firstname]',lastname='$_POST[lastname]', password='$_POST[password]',usertype='$_POST[type]',age='$_POST[age],salary='$_POST[salary]' where username='$_POST[hidden]'";
        $updatequery="UPDATE Users SET username='$_POST[username]' ,firstname='$_POST[firstname]',lastname='$_POST[lastname]',password='$_POST[password]' ,age='$_POST[age]',salary='$_POST[salary]',usertype='$_POST[type]' where username='$_POST[hidden]'";

            
             mysql_query($updatequery,$con);
              echo "<script>location.href='admin.php';</script>";
              //header("Location: admin.php")；
             // exit;

        };


          if(isset($_POST['delete'])){
             $id=$_POST['userid'];
           if(empty($id)){
                echo "<script type='text/javascript'>
                window.alert('Please select a delete mark!');
                location.href='admin.php';
                </script>";

            }
            else
            {
               // echo "<h4>'$id'</h4>";
                
                $impid=implode(",",$id);
                echo $impid;
              //  echo"<h3>'$impid'</h3>";
              //  $deleteall="DELETE FROM Users where userid IN ('$impid') ";
                mysql_query("DELETE FROM Users WHERE userid IN(".$impid.")");
                 echo "<script>location.href='admin.php';</script>";
                
            }
        };  
   
      if(isset($_POST['addsubmit'])){

            $usertype=$_POST['type.value'];
             $addquery="INSERT INTO Users(username,firstname,lastname,password,usertype,age,salary) values ('$_POST[username]','$_POST[firstname]','$_POST[lastname]','$_POST[password]','$_POST[type]','$_POST[age]','$_POST[salary]')";
            mysql_query($addquery,$con);
              echo "<script>location.href='admin.php';</script>";
              //header("Location: admin.php")；
             // exit;

        };

echo $error;

        if(isset($_POST['edit'])){   
          $id=$_POST[radioname];
          if(empty($id)){
                echo "<script type='text/javascript'>
                window.alert('Please select a edit mark!');
                location.href='admin.php';
                </script>";

            }
         // echo $id;
            $sql = "select * from Users where userid='$id'";
            $myData=mysql_query($sql,$con);
            $row = mysql_fetch_array($myData);
          
        echo '<br><br><br><br>

       <form  align="center" action="editadmin.php" method="post">     
       <p align="center"><font size=40>Edit User</font></p>
        <table align="center">
        <tr><td>Username:</td><td><input type="text" id="username" name="username" value="'.$row['username'].'"></td></tr>
         <tr><td>First Name:</td><td><input type="text" id="fname" name="firstname" value="'.$row['firstname'].'"></td></tr>
        <tr><td>Last Name:</td><td><input type="text" id="lname" name="lastname" value="'.$row['lastname'].'"></td></tr>
        <tr><td>Password:</td><td><input type="password" id="password" name="password" value="'.$row['password'].'"></td></tr>
        <tr><td>Usertype:</td><td>
        <input type="radio" name="type" value="Administrator" checked>Administrator
        <input type="radio" name="type" value="Employee">Employee
        <input type="radio" name="type" value="Manager">Manager
        </td></tr>  
        <tr><td>Age:</td><td><input type="text" id="age" name="age" value="'.$row['age'].'"></td></tr>
        <tr><td>Salary:</td><td><input type="text" id="salary" name="salary" value="'.$row['salary'].'"></td></tr>
        <tr><td></td><td><input type="hidden" name="hidden" value="'.$row['username'].'"></td></tr>
        <td></td><td><input type="submit" name="editok" value="submit" onclick="validateForm()">
        <input type="button" name="goback" value="go back" onclick="backpage()"></td>
        </tr>
        </table>
    </form>
    ';

        };
        
         if(isset($_POST['add'])){   

        echo '    <br><br><br><br>';
         echo '   
       <form  align="center" action="editadmin.php" method="post"> 
         <p align="center"><font size=40>Add User</font></p>      
        <table align="center" border="0">
       
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
        <td></td><td><input type="submit" name="addok" value="submit" onclick="validateForm()"/>
        <input type="reset" name="reset" value="reset"></td>
        </tr>
        </table>
    </form>
    ';
       };
?>

</body>
</html>
