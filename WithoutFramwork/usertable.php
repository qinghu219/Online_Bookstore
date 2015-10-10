<?php 
session_start();
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


         // setcookie ("PHPSESSID", "", time() + 3600)
     $con = mysql_connect("localhost:3306", "root", "root");
       mysql_select_db('qinghu', $con);

      //   $sql = "select * from Products order by productid asc";
         
              $sql = "select * from Users where usertype like '%$_POST[pn]%'  
              and salary>='$_POST[pf]' and salary<='$_POST[pt]'";
          
           // mysql_query($updatequery);
      // if(isset($_POST['productname'])){
  //    $sql="select * from Products where productname like '$_POST[productname]'";
    //$sql="select * from Products";   
     //  }    
         
        $myData = mysql_query($sql,$con);
        
     //   echo "<h2 align=center>Product Information</h2>";
        echo "<h2 align=center>Employee Information</h2>";
       echo "<table border=1 align=center>";
      // echo $sql;

      echo "
        <tr>
        <th>username</th>
        <th>firstname</th>
        <th>lastname</th>
        <th>password</th>
        <th>usertype</th>
        <th>age</th>
        <th>salary</th>

        </tr>";

   while($row = mysql_fetch_array($myData)) {
            echo "<form class=table align=center method=post>"; 
            echo "<tr>";
           // echo '<td><input type="checkbox" name="userid[]" value="'.$row['userid'].'"/></td>';
           // echo "<td>"."<input type=text name=userid value=".$row['userid']."></td>";
          echo "<td>"."<input type=text name=username value=".$row['username']."></td>";
            echo "<td>"."<input type=text name=firstname value=".$row['firstname']."></td>";
            echo "<td>"."<input type=text name=lastname value=".$row['lastname']."></td>";
            echo "<td>"."<input type=text name=password value=".$row['password']."></td>";
            echo "<td>"."<input type=text name=usertype value=".$row['usertype']."></td>";
            echo "<td>"."<input type=text name=age value=".$row['age']."></td>";
            echo "<td>"."<input type=text name=salary value=".$row['salary']."></td>";
            echo "</tr>";
            echo "</form>";
           }      
    echo "</table>";
?>
