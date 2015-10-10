<?php 
session_start();
?>

<?php
// if(!isset($_SESSION['username'])){
//             echo "<script>location.href='login.php';</script>";

//         };
       

     $con = mysql_connect("localhost:3306", "root", "root");
       mysql_select_db('qinghu', $con);

      //   $sql = "select * from Products order by productid asc";
         
              // $sql = "select * from Products, Category where productname ike '%$_POST[pn]%' and productprice>='$_POST[pf]' and productprice<='$_POST[pt]' 
              // and categoryname like '%$_POST[pc]%' and Products.categoryid=Category.categoryidl";
             
             $sql = "select * from Products, Category where Products.categoryid=Category.categoryid and categoryname='$_POST[pn]'";
 
         
        $myData1 = mysql_query($sql,$con);
           $today = date("Y-m-d"); 
        while($row = mysql_fetch_array($myData1)) {
echo '
    <div class="col col_14 product_gallery" >
     <form action="shoppingcart.php" method="post">
     <input type="hidden"  name="productid" value="'.$row[productid].'">
      <input type="hidden" id="l'.$row[productid].'" name="productprice" value="'.$row[productprice].'">
    <a href="productdetail.html"><img src="'.$row[productimage].'" alt="Product 01" /></a>
                <h3>'.$row[productname].'</h3>
        <p id="p'.$row[productid].'" class="product_price">$'.$row[productprice].'</p>
      ';
      $mysql1="select * from Products P, Sales S where P.productid=S.productid and S.enddate>'$today'";
      $mydata=mysql_query($mysql1);
      while($row1 = mysql_fetch_array($mydata)) {
           if($row1[productid]==$row[productid]){
               echo '
               <script>
         document.getElementById("l'.$row[productid].'").value="'.$row1[price].'";      
         document.getElementById("p'.$row[productid].'").style="text-decoration:line-through";

             </script>
                 <p class="product_price">special price: $'.$row1[price].'</p>
                

                 ';

           }
        }

      echo '
                <input type="submit" class="add_to_cart" name="submit" value="Add to Cart">
                </form>
    </div> 

    &nbsp
'; 
}
  
    
?>

