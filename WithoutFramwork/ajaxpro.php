<?php 
session_start();

         // setcookie ("PHPSESSID", "", time() + 3600)
     $con = mysql_connect("localhost:3306", "root", "root");
       mysql_select_db('qinghu', $con);

      //   $sql = "select * from Products order by productid asc";
         
              $sql = "select temp.productid, productname,categoryname,productdesc,productimage,productprice,startdate,enddate,price from
              (select productid,productname,categoryname,productdesc,productimage,productprice from Products, Category where productname like '%$_POST[pn]%' 
              and categoryname like '%$_POST[pc]%' and Products.categoryid=Category.categoryid) as temp
              left join Sales on temp.productid=Sales.productid ";

              //  $sql = "select * from Products, Category where productname like '%$_POST[pn]%' 
              // and categoryname like '%$_POST[pc]%' and Products.categoryid=Category.categoryid ";
          
           // mysql_query($updatequery);
      // if(isset($_POST['productname'])){
  //    $sql="select * from Products where productname like '$_POST[productname]'";
    //$sql="select * from Products";   
     //  }    
         
        $myData = mysql_query($sql,$con);
        
     //   echo "<h2 align=center>Product Information</h2>";
        echo "<h2 align=center>Product Information</h2>";
       echo "<table border=1 align=center width=260>";
      echo "
        <tr>
        <th>delete</th>
        <th>edit</th>
        <th>Product Name</th>
        <th>Category</th>
        <th>Product Description</th>
        <th>Product Price</th>
        <th>Image</th>
        <th>Startdate</th>
        <th>Enddate</th>
        <th>Speical Price</th>  
        </tr>";

   while($row = mysql_fetch_array($myData)) {
            echo "<tr>";
            echo '<td><input type="checkbox" name="productid[]" value="'.$row['productid'].'"/></td>';
            echo '<td><input type="radio" name="radioname" value="'.$row['productid'].'"/></td>';
            echo "<td>"."<input type='text' name='productname' size='20' value='".$row[productname]."'></td>";
            echo "<td>"."<input type='text' name='categoryname' size='10'value='".$row[categoryname]."'></td>";   
            echo "<td>"."<input type='text' name='productdesc' value='".$row[productdesc]."''></td>";
            echo "<td>"."<input type='text' name='productprice' size='8' value='".$row[productprice]."'></td>";
            echo "<td>"."<input type='text' name='productimage' value='".$row[productimage]."'></td>";
            echo "<td>"."<input type='text' name='startdate' size='10' value='".$row[startdate]."'></td>";
            echo "<td>"."<input type='text' name='enddate' size='10' value='".$row[enddate]."'></td>";
            echo "<td>"."<input type='text' name='price' size='8' value='".$row[price]."'></td>";
          
          //  echo "<td>"."<img src=".$row[productimage]."></td>"; 
            echo "<td>"."<input type='hidden' name='hidden' value='".$row[productname]."'></td>";
            echo "</tr>";
           }      
    echo "</table>";
?>
