<?php 
session_start();
 



 ?>

<html>

<head>
 <meta http-equiv="content-type" content="text/html; charset=windows-1250">
  <!-- the cascading style sheet-->
 <link href="style.css" rel="stylesheet" type="text/css" />
 
</head>


<body>
   <div id="contentForm">

    <!-- The contact form starts from here-->
    <?php

    function logout(){
      session_unset($_SESSION['timeout']);
      session_unset($_SESSION['username']);
      session_unset($_SESSION['usertype']);

    }


    if(isset($_GET['logout'])){
        logout();
      };

//    session_cache_limiter('private');
// $cache_limiter = session_cache_limiter();

/* set the cache expire to 30 minutes */


$error = '';

// error message
$username = '';

// sender's name
$password = '';

// the message itself
$spamcheck = '';

// Spam check

if (isset($_POST['send'])) {
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $spamcheck = $_POST['spamcheck'];
    
    if (trim($username) == '') {
        $error = '<div class="errormsg">Please enter your username!</div>';
    }
    
    if (trim($password) == '') {
        $error = '<div class="errormsg">Please enter a password!</div>';
    }
    if (trim($spamcheck) == '') {
        $error = '<div class="errormsg">Please enter the number for Spam Check!</div>';
    } else if (trim($spamcheck) != '5') {
        $error = '<div class="errormsg">Spam Check: The number you entered is not correct! 2 + 3 = ???</div>';
    }
    if (strlen($username) > 0 && strlen($password) > 0) {
        $sql = "select usertype from Users where
      username='$username' and password='$password'";
        $con = mysql_connect("localhost:3306", "root", "root");
        
        // if (mysqli_connect_errno()) {
        //     echo "Failed to connect to MySQL: " . mysqli_connect_error();
        // }
        mysql_select_db('qinghu', $con);
        $res = mysql_query($sql);
        if (!($row = mysql_fetch_array($res))) {
            
            //no rows retrieved
            $error = "<div class='errormsg'>Invalid login!</div>";
        }
    }
    
    if ($error == '') {
        $_SESSION['timeout']=time();
        $_SESSION['username'] = $username;
        //$_SESSION['usertype'] = $row['usertype'];
        if ($row[0] == 'Administrator') {
            echo "<script>location.href='admin.php';</script>";
            $_SESSION['usertype']=$row[0];
        } elseif ($row[0] == 'Employee') {
            echo "<script>location.href='employee.php';</script>";
            $_SESSION['usertype']=$row[0];
        } elseif ($row[0] == 'Manager') {
            echo "<script>location.href='manager.php';</script>";
            $_SESSION['usertype']=$row[0];
        }
?>

                <!-- Message sent! (change the text below as you wish)-->
                <div style="text-align:center;">
                    <h1>Congratulations!!</h1>
                    <p>Thank you <b><?php
        echo $row[0]; ?></b>, your message is sent!</p>
                </div>
                <!--End Message Sent-->


                <?php
    }
}

if (!isset($_POST['send']) || $error != '') {
?>

            <h1>My Company System:</h1>
            <!--Error Message-->
            <?php
    echo $error; ?>

            <form  method="post" name="contFrm" id="contFrm" action="">


              <label><span class="required">*</span> Username:</label>
              <input name="username" type="text" class="box" id="name" size="30" value="<?php
    echo $username; ?>" />

              
              <label><span class="required">*</span> Password: </label>
              <input name="password" type="password" class="box" id="subject" size="30" value="<?php
    echo $password; ?>" />

              
              <label><span class="required">*</span> Spam Check: <b>2 + 3=</b></label>
              <input name="spamcheck" type="text" class="box" id="spamcheck" size="4" value="<?php
    echo $spamcheck; ?>" /><br /><br />

              <!-- Submit Button-->
              <input name="send" type="submit" class="button" id="send" value="" />

          </form>

          <!-- E-mail verification. Do not edit -->
          <?php
}
?>
      

     
  </div> <!-- /contentForm -->
  
</body>
</html>
