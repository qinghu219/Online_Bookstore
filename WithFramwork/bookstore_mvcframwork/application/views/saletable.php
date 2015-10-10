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
         $sql = "select * from Products, Category,Sales where productname like '%$_POST[pn2]%' and categoryname like '%$_POST[pc2]%' 
         and productprice>='$_POST[pf2]' and productprice<='$_POST[pt2]' 
         and startdate>='$_POST[pf3]' and enddate<='$_POST[pt3]'
        and Products.categoryid=Category.categoryid and Products.productid=Sales.productid";
          
        
      // if(isset($_POST['productname'])){
  //    $sql="select * from Products where productname like '$_POST[productname]'";
    //$sql="select * from Products";   
     //  }    
         
        $myData = mysql_query($sql,$con);
         // and startdate>='$_POST[pf3]' and enddate='$_POST[pt3]'
     //   echo "<h2 align=center>Product Information</h2>";
       echo "<table border=1 align=center>";

      echo "
        <tr>
         <th>Product Name</th> 
         <th>Category Name</th>
        <th>Product Price</th>
        <th>Product Description</th>
        <th>Sale Startdate</th>
        <th>Sale Enddate</th>
        <th>Sale price</th>
        </tr>";

   while($row = mysql_fetch_array($myData)) {
            echo "<form class=table align=center method=post>"; 
            echo "<tr>";
           // echo '<td><input type="checkbox" name="userid[]" value="'.$row['userid'].'"/></td>';
           // echo "<td>"."<input type=text name=userid value=".$row['userid']."></td>";
             echo "<td>"."<input type='textarea' name='productname' value='".$row[productname]."'></td>";
             echo "<td>"."<input type='text' name='categoryname' value='".$row[categoryname]."'></td>";
            echo "<td>"."<input type='text' name='productprice' value='".$row[productprice]."'></td>";
            echo "<td>"."<input type='text' name='productimage' value='".$row[productdesc]."'></td>";
            echo "<td>"."<input type='text' name='productimage' value='".$row[startdate]."'></td>";
            echo "<td>"."<input type='text' name='productimage' value='".$row[enddate]."'></td>";
            echo "<td>"."<input type='text' name='productimage' value='".$row[price]."'></td>";

          //  echo "<td>"."<img src=".$row[productimage]."></td>";
           
            echo "<td>"."<input type='hidden' name='hidden' value='".$row[productid]."'></td>";
            echo "</tr>";
            echo "</form>";
           }      
    echo "</table>";
?>
