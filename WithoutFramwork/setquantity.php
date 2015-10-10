<?php 
session_start();
?>

<?php
// if(!isset($_SESSION['username'])){
//             echo "<script>location.href='login.php';</script>";

//         };
       
    
     $con = mysql_connect("localhost:3306", "root", "root");
       mysql_select_db('qinghu', $con);
        $sql="select customerid from customer where username='$_SESSION[username]'";
        $data=mysql_query($sql);
        $row=mysql_fetch_array($data);
        $id=$row['customerid'];


         $sql1 = "UPDATE Cart SET qty='$_POST[qty]' where productid='$_POST[productid]' and customerid='$id'";
         mysql_query($sql1);
         $sum=0;
         $sql2="select * from Cart where customerid='$id'";
         $mydata=mysql_query($sql2);
         while($row=mysql_fetch_array($mydata)){
           $sum+=($row[productprice])*($row[qty]);
         }
              // $sql = "select * from Products, Category where productname ike '%$_POST[pn]%' and productprice>='$_POST[pf]' and productprice<='$_POST[pt]' 
              // and categoryname like '%$_POST[pc]%' and Products.categoryid=Category.categoryidl";
             
        //      $sql = "select * from Products, Category where Products.categoryid=Category.categoryid and categoryname='$_POST[pn]'";
 
         
        // $myData = mysql_query($sql,$con);
       
    echo $sum;

  
    
?>

