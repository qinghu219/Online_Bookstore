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

function home(){
    location.href='admin.php';

}

</script>

   

</script>
  </head>
<body>
  <?php
  


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
         $firstname=$_POST['firstname'];
         $lastname=$_POST['lastname'];
         $salary=$_POST['salary'];

              if (trim($username) == '') {
        $error = '<div class="errormsg">Please enter your username!</div>';

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
 
  
      if(isset($_POST['addsubmit'])){

            $usertype=$_POST['type.value'];
             $addquery="INSERT INTO Users(username,firstname,lastname,password,usertype,age,salary) values ('$_POST[username]','$_POST[firstname]','$_POST[lastname]','$_POST[password]','$_POST[type]','$_POST[age]','$_POST[salary]')";
            mysql_query($addquery,$con);
              echo "<script>location.href='admin.php';</script>";
              //header("Location: admin.php")；
             // exit;

        };



       
        
   ?>     
       <br><br><br><br> 
       <?php
       echo $error;
       ?>

       <form  align="center" action="adduser.php" method="post"> 
         <p align="center"><font size=40>Add User</font></p>      
        <table align="center" border="0">
       
        <tr><td>Username:</td><td><input type="text" id="username" name="username" value="<?php echo $username; ?>"></td></tr>
         <tr><td>First Name:</td><td><input type="text" id="fname" name="firstname" value="<?php echo $firstname; ?>"></td></tr>
        <tr><td>Last Name:</td><td><input type="text" id="lname" name="lastname" value="<?php echo $lastname; ?>"></td></tr>
        <tr><td>Password:</td><td><input type="password" id="password" name="password" value="<?php echo $password; ?>"></td></tr>
        <tr><td>Usertype:</td><td>
        <input type="radio" name="type"value="Administrator" checked>Administrator
        <input type="radio" name="type"value="Employee">Employee
        <input type="radio" name="type" value="Manager">Manager
        </td></tr>  
        <tr><td>Age:</td><td><input type="text" id="age" name="age" value="<?php echo $age; ?>"></td></tr>
        <tr><td>Salary:</td><td><input type="text" id="salary" name="salary" value="<?php echo $salary; ?>"></td></tr>
        <td></td><td><input type="submit" name="addok" value="submit"/>
        <input type="reset" name="reset" value="reset">
        <input type="button" name="good" value="go back" onclick="home()"></td>
        </tr>
        </table>
    </form>
  

</body>
</html>
