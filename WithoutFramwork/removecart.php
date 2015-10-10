<?php 
session_start();
?>

<?php
   
     $con = mysql_connect("localhost:3306", "root", "root");
       mysql_select_db('qinghu', $con);

        $sql="select * from customer where username='$_SESSION[username]'";
        $data=mysql_query($sql);
        $row=mysql_fetch_array($data);
        $id=$row['customerid'];
        
        $sqlselect="select * from Cart where productid='$_POST[productid]' and customerid='$id'";
        
        $mydata=mysql_query($sqlselect);
        $myrow=mysql_fetch_array($mydata);
        $cartid=$myrow['cartid'];
        $mysql="DELETE FROM Cart where cartid='$cartid'";
        // $sql1 = "UPDATE Cart SET qty='$_POST[qty]' where productid='$_POST[productid]' and customerid='$id'";
       $judge=mysql_query($mysql);
       if($judge==1){



       $sql="select * from Cart C, Products P where  C.productid=P.productid and C.customerid='$id'";

       $myData=mysql_query($sql);
        echo '
         <table width="700px" cellspacing="0" cellpadding="5">
                      <tr bgcolor="#CCCCCC">
                          <th width="220" align="left">Image </th> 
                          <th width="180" align="left">Description </th> 
                            <th width="100" align="center">Quantity </th> 
                          <th width="60" align="right">Price </th> 
                          <th width="90"> </th>
                       </tr>

        ';

        $sum=0;
         echo ' <form action="checkout.php" method="post">';
              while($row = mysql_fetch_array($myData)) {
                // echo $row[productimage];
                  $sum+=$row[productprice]*$row[qty];
              echo '
             <tr>
                          <td><img src="'.$row[productimage].'" alt="image 01"/></td> 
                          <td>'.$row[productdesc].'
                         <input type= "text" id="select1" size = "35" value ="'.$row[productprice].'" style="display:none;"></td>
                            <td align="center"><input type="text" id="'.$row[productid].'" name="select2" onkeyup="OnChange(this.id,this.value)" onKeyPress="return isNumberKey(event)" value="'.$row[qty].'" style="width: 20px; text-align: right" /> </td>
                            
                            <td align="right">'.$row[productprice].' </td>                 
                            <td align="center"><input type="button" value="Remove" name="'.$row[productid].'" onclick="onRemove(this.name);" </td>
            </tr>';
            }
      }


             echo '
            </table>
                    <div style="float:right; width: 215px; margin-top: 20px;">
                    
                        Subtotal:<div id="total">'.$sum.'</div>
                        <input type="hidden" name="sum" id="sum" value="'.$sum.'"/>
                        <div class="checkout"><input type="submit"  name="check" value="Proceed to Checkout" class="more"/></div>
                        </form>
                        <form action="shoppingcart.php" method="post">
                        <div class="checkout"><input type="submit"  id="clearall" name="clear" value="       Clear all items      " class="more"/></div>
                        </form>
                     
                        <div class="continueshopping"><a href="product.php" class="more">Continue Shopping</a></div>
                     </div>
              ';
           
                       
           


  
    
?>

