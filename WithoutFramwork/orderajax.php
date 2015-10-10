<?php 
session_start();
?>

<?php
if(!isset($_SESSION['username'])){
            echo "<script>location.href='login.php';</script>";

};
if(!($_SESSION['usertype']=='Employee')){
           echo "<script>location.href='login.php';</script>";

};

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



           $category=$_POST['categoryname'];
          $productname=$_POST['pn'];
          $start=$_POST['pf'];
          $end=$_POST['pt'];
          $special=$_POST['special'];

           $array=explode('/',$start);
        $array1=explode('/',$end);
        $arr1=array();
          $arr1[0]=$array1[2];
          $arr1[1]=$array1[0];
          $arr1[2]=$array1[1];
        $myarr1=implode('-',$arr1);
         $myend=$myarr1.' 23:59:59';
          $arr=array();
          $arr[0]=$array[2];
          $arr[1]=$array[0];
          $arr[2]=$array[1];
           $myarr=implode('-',$arr);
           $mystart=$myarr.' 00:00:00';


    
          if($special==5){

          if( $start=='' and $end==''){
             
              $sql="select o.orderid, nowtime, shippingaddress, sum(qty) as totalQty, o.total as totalprice from orders o,orderdetail od, Products p, Category c where productname like '%$productname%' and categoryname like '%$category%' and o.orderid=od.orderid and od.productid=p.productid and p.categoryid=c.categoryid group by orderid order by totalprice DESC";

          }else if ($start==''){
         
              $sql="select o.orderid, nowtime, shippingaddress, sum(qty) as totalQty, o.total as totalprice from orders o,orderdetail od, Products p, Category c where nowtime<='$myend' and productname like '%$productname%' and categoryname like '%$category%' and o.orderid=od.orderid and od.productid=p.productid and p.categoryid=c.categoryid group by orderid order by totalprice DESC";

          }else if ($end==''){
            
              $sql="select o.orderid, nowtime, shippingaddress, sum(qty) as totalQty, o.total as totalprice from orders o,orderdetail od, Products p, Category c where nowtime>='$mystart' and productname like '%$productname%' and categoryname like '%$category%' and o.orderid=od.orderid and od.productid=p.productid and p.categoryid=c.categoryid group by orderid order by totalprice DESC";

          }else{
          

          $sql="select o.orderid, nowtime, shippingaddress, sum(qty) as totalQty, o.total as totalprice from orders o,orderdetail od, Products p, Category c where nowtime>='$mystart'
          and nowtime<='$myend' and productname like '%$productname%' and categoryname like '%$category%' and o.orderid=od.orderid and od.productid=p.productid and p.categoryid=c.categoryid group by orderid order by totalprice DESC";
          
        }

      }else{

        if( $start=='' and $end==''){
            
              $sql="select o.orderid, nowtime, shippingaddress, sum(qty) as totalQty, o.total as totalprice from orders o,orderdetail od, Products p, Category c, Sales S where od.productid=S.productid and S.price=od.productprice and productname like '%$productname%' and categoryname like '%$category%' and o.orderid=od.orderid and od.productid=p.productid and p.categoryid=c.categoryid group by orderid order by totalprice DESC";

          }else if ($start==''){
           
              $sql="select o.orderid, nowtime, shippingaddress, sum(qty) as totalQty, o.total as totalprice from orders o,orderdetail od, Products p, Category c, Sales S where od.productid=S.productid and S.price=od.productprice and nowtime<='$myend' and productname like '%$productname%' and categoryname like '%$category%' and o.orderid=od.orderid and od.productid=p.productid and p.categoryid=c.categoryid group by orderid order by totalprice DESC";

          }else if ($end==''){
          
              $sql="select o.orderid, nowtime, shippingaddress, sum(qty) as totalQty, o.total as totalprice from orders o,orderdetail od, Products p, Category c, Sales S where od.productid=S.productid and S.price=od.productprice and nowtime>='$mystart' and productname like '%$productname%' and categoryname like '%$category%' and o.orderid=od.orderid and od.productid=p.productid and p.categoryid=c.categoryid group by orderid order by totalprice DESC";

          }else{
           

          $sql="select o.orderid, nowtime, shippingaddress, sum(qty) as totalQty, o.total as totalprice from orders o,orderdetail od, Products p, Category c, Sales S where od.productid=S.productid and S.price=od.productprice and nowtime>='$mystart'
          and nowtime<='$myend' and productname like '%$productname%' and categoryname like '%$category%' and o.orderid=od.orderid and od.productid=p.productid and p.categoryid=c.categoryid group by orderid order by totalprice DESC";
          
        }


      }
      

      




      








        $mydata=mysql_query($sql);
          echo '
            <table border=1 align=center>
              <tr>
        <th>Orderid</th>
        <th>order time</th>
        <th>Shipping address</th>
        <th>Total Quantity</th> 
        <th>Total Price</th>
        <th>Detail</th> 
        </tr>
          ';
          while($row = mysql_fetch_array($mydata)) {
            echo '
            <tr>
            <td>'.$row[orderid].'</td>
             <td>'.$row[nowtime].'</td>
             <td>'.$row[shippingaddress].'</td>
             <td>'.$row[totalQty].'</td>
             <td>'.$row[totalprice].'</td>
             <td><input type=button value=detail onclick="loaddetail('.$row[orderid].')"></td>
            </tr>

            ';
          }

            echo '
          </table>
            ';

       

        

  


  
?>

