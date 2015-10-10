<?php 
session_start();
?>

<?php
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
         
              $sql = "select * from Products, Category where productname like '%$_POST[pn]%' and productprice>='$_POST[pf]' and productprice<='$_POST[pt]' 
              and categoryname like '%$_POST[pc]%' and Products.categoryid=Category.categoryid";
          
           // mysql_query($updatequery);
      // if(isset($_POST['productname'])){
  //    $sql="select * from Products where productname like '$_POST[productname]'";
    //$sql="select * from Products";   
     //  }    
         
        $myData = mysql_query($sql,$con);
        
     //   echo "<h2 align=center>Product Information</h2>";
        echo "<h2 align=center>Product Information</h2>";
       echo "<table border=1 align=center>";

      echo "
        <tr>
        <th>Product Name</th>
        <th>Category Name</th> 
        <th>Product Description</th>
        <th>Product Price</th>
        <th>product Image</th>  
        </tr>";

   while($row = mysql_fetch_array($myData)) {
            echo "<form class=table align=center method=post>"; 
            echo "<tr>";
           // echo '<td><input type="checkbox" name="userid[]" value="'.$row['userid'].'"/></td>';
           // echo "<td>"."<input type=text name=userid value=".$row['userid']."></td>";
            echo "<td>"."<input type='textarea' name='productname' value='".$row[productname]."'></td>";
            echo "<td>"."<input type='text' name='categoryname' value='".$row[categoryname]."'></td>"; 
            echo "<td>"."<input type='textarea' name='productdesc' value='".$row[productdesc]."''></td>";
            echo "<td>"."<input type='text' name='productprice' value='".$row[productprice]."'></td>";
            echo "<td>"."<input type='text' name='productimage' value='".$row[productimage]."'></td>";

          //  echo "<td>"."<img src=".$row[productimage]."></td>";
           
            echo "<td>"."<input type='hidden' name='hidden' value='".$row[productid]."'></td>";
            echo "</tr>";
            echo "</form>";
           }      
    echo "</table>";
?>

