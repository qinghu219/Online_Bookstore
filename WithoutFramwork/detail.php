<?php 
session_start();
?>

<?php
   
     $con = mysql_connect("localhost:3306", "root", "root");
       mysql_select_db('qinghu', $con);
        $mysql="select * from orders where orderid='$_POST[orderid]'";

        $sql="select * from orders,orderdetail where orders.orderid='$_POST[orderid]' and orders.orderid=orderdetail.orderid";
        $data=mysql_query($mysql);
        //$row=mysql_fetch_array($data);
        $id=$row['customerid'];

        echo '
          
         <table align="center" width="700px" cellspacing="0" cellpadding="5">
             <th>My order</th>
        ';

              while($row = mysql_fetch_array($data)) {
         echo '
            <tr><td>Orderid:</td><td>'.$row[orderid].'</td></tr>
            <tr><td>Billing Address:</td><td>'.$row[billingaddress].'</td></tr>
            <tr><td>Shipping Address:</td><td>'.$row[shippingaddress].'</td></tr>
            <tr><td>Total Cost:</td><td>'.$row[total].'</td></tr>
            <tr></tr>
        
         ';                  

            }
        $mysql="select p.productname, d.qty, d.productprice from orders o,orderdetail d,Products p where o.orderid='$_POST[orderid]' and o.orderid=d.orderid and d.productid=p.productid";
        $data=mysql_query($mysql);
        while ($row=mysql_fetch_array($data)){
          echo '
           <tr><td>Product name:</td><td>'.$row[productname].'</td></tr>
            <tr><td>Unit Price:</td><td>'.$row[productprice].'</td></tr>
            <tr><td>Quantity:</td><td>'.$row[qty].'</td></tr>  
            <tr></tr>
           ';
        }

          echo '<tr><td><input type="button" value="Go Back" onclick="goback()" /></td><td></td></tr>';   
          echo '</table>';
?>

