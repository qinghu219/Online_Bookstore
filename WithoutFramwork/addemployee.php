<?php 
session_start();
?>
<html>
<head>
  
  <link href="style.css" rel="stylesheet" type="text/css" />
 <style>
 body{
    background-image: url('images/blue.jpg');
    background-repeat: no-repeat;
    /*background-position: center;*/

    }
    .errormsg{
  display: block;
  width: 90%;
  height: 22px;
  line-height: 22px;
  color: #FFFFFF;
  font-weight: bold;
  background: #FF9D9D url(images/stop.gif) no-repeat 10px center;
  padding: 3px 10px 3px 40px;
  margin: 10px 0;
  border-top: 2px solid #FF0000;
  border-bottom: 2px solid #FF0000;
}
  </style>
  <script type="text/javascript">
  function backpage(){

  location.href='employee.php';  

}

  </script>


  </head>

<body>
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



    
       $con = mysql_connect("localhost:3306", "root", "root");
       mysql_select_db('qinghu', $con);
       
       
     
    // $name = array();
     // while ($row = mysql_fetch_assoc($res) )
     // {    echo $row['categoryname'];
     //     $name[$row['categoryid']] = $row['categoryname'];
     //  };

          if(isset($_POST['addok'])){

        
         $productname = $_POST['productname'];
         $productdesc = $_POST['productdesc'];
         $categoryname = $_POST['categoryname'];
         $productimage = $_POST['productimage'];
         $productprice = $_POST['productprice'];
         $startdate = $_POST['startdate'];
         $enddate = $_POST['enddate'];
         $price = $_POST['price'];

        if (trim($productname) == '') {
        $error = '<div class="errormsg">Please enter your unique productname!</div>';

         }else if (trim($categoryname) == '') {
        $error = '<div class="errormsg">Please enter a categoryname!</div>';
        }else if(preg_match("/[^\d-., ]/",$productprice)){
        $error = '<div class="errormsg">Please enter valid product price!</div>';
        }else if(preg_match("/[^\d-., ]/",$price)){
        $error = '<div class="errormsg">Please enter valid special price!</div>';
        }
        else{

            $sql="select * from Category where categoryname='$_POST[categoryname]'";
            $myData1 = mysql_query($sql,$con);
            $row=mysql_fetch_array($myData1);
            $categoryid=$row['categoryid'];
            $addquery="INSERT INTO Products(categoryid,productname,productdesc,productimage,productprice) values
                ('$categoryid','$_POST[productname]','$_POST[productdesc]','$_POST[productimage]','$_POST[productprice]')";
            

            // $sql = "select * from Products where ";
          //$myData2 = mysql_query($addquery,$con);
            mysql_query($addquery,$con);


            $sql1="select * from Products where productname='$_POST[productname]'";
            $myData2=mysql_query($sql1,$con);
            $row1=mysql_fetch_array($myData2);
            $productid=$row1['productid'];
            $addsale="INSERT INTO Sales(productid,startdate,enddate,price) values
            ('$productid','$_POST[startdate]','$_POST[enddate]','$_POST[price]')";
            mysql_query($addsale,$con);
              echo "<script>location.href='employee.php';</script>";
              //header("Location: admin.php")；
             }
        };  




  ?>


   
     
          <br><br><br><br>   
           <?php
       echo $error;
       ?>
       <form  align="center" action="addemployee.php" method="post"> 
         <p align="center"><font size=40>Add Information</font></p>      
        <table align="center" border="0">
        <tr><td><label><span class="required">*</span>Product Name:</td><td><input type="text" id="username" name="productname" value="<?php echo $productname; ?>"></td></tr>
          <tr><td><label><span class="required">*</span>Category Name:</td><td>
          <select name="categoryname" class="sgselect scate" id="city">
          <option selected="selected" value="">--select category--</option>
         <?php 
          $sql1 = 'select categoryname from Category';
          $res = mysql_query($sql1);

         while ($row = mysql_fetch_assoc($res) )  {  ?>
          <option value="<?php echo $row[categoryname]; ?>"><?php echo $row[categoryname]; ?></option>
          <?php }  ?>
         </select></td></tr>


        <tr><td>Product Description:</td><td><textarea id="lname" cols="30" rows="10" name="productdesc"><?php echo $productdesc; ?></textarea></td></tr>
        <tr><td>Product Price:</td><td><input type="text" id="lname" name="productprice" value="<?php echo $productprice; ?>"></td></tr>
        <tr><td>Start date:</td><td><input type="text" id="lname" name="startdate" value="<?php echo $startdate; ?>"></td><td>(yyyy-mm-dd)</td></tr>
        <tr><td>End date:</td><td><input type="text" id="lname" name="enddate" value="<?php echo $enddate; ?>"></td><td>(yyyy-mm-dd)</td><tr>
        <tr><td>Special Price:</td><td><input type="text" id="lname" name="price" value="<?php echo $price; ?>"></td></tr>
        <tr><td>Product Image URL:</td><td><input type="text" id="lname" name="productimage" value="<?php echo $productimage; ?>"></td></tr>
        <td></td><td><input type="submit" name="addok" value="submit"/>
        <input type="reset" name="reset" value="reset">
        <input type="button" name="reset" value="go back" onclick="backpage()"></td>
        </tr>
        </table>
      </form>


</body>
</html>
