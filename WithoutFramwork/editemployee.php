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
  </style>
<script type="text/javascript">
function validate(){
  pro=document.getElementById('productname').value;
  if(pro==''||pro==null){
    window.alert('please enter your productname');
    document.getElementById('productname').focus();
    return false;
  }
  pro1=document.getElementById('categoryname').value;
  if(pro1==''||pro1==null){
    window.alert('please enter your categoryname');
    document.getElementById('productname').focus();
    return false;
  }
}

function backpage(){
  location.href="employee.php";
}


</script>



  </head>
<body>
  <?php
  


  if(!isset($_SESSION['username'])){
            echo "<script>location.href='login.php';</script>";

        };



         $con = mysql_connect("localhost:3306", "root", "root");
         mysql_select_db('qinghu', $con);


          if(isset($_POST['addok'])){

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
             // exit;

        };
 if(isset($_POST['editok'])){

           // $usertype=$_POST([type.value]);
          //  $updatequery="UPDATE Users SET username='$_POST[username]',firstname='$_POST[firstname]',lastname='$_POST[lastname]', password='$_POST[password]',usertype='$_POST[type]',age='$_POST[age],salary='$_POST[salary]' where username='$_POST[hidden]'";
       // $updatequery="UPDATE Users SET username='$_POST[username]' ,firstname='$_POST[firstname]',lastname='$_POST[lastname]',password='$_POST[password]' ,age='$_POST[age]',salary='$_POST[salary]',usertype='$_POST[type]' where username='$_POST[hidden]'";
        
        $name=$_POST['categoryname'];
        $mysql="select * from Category where categoryname='$name'";
        $mydata=mysql_query($mysql,$con);
        $row=mysql_fetch_array($mydata);

        $categoryid=$row['categoryid'];
       // echo $categoryid;
       // echo $_POST['categoryname'];
        $updateproduct="UPDATE products SET productname='$_POST[productname]',categoryid='$categoryid',productdesc='$_POST[productdesc]',
                       productprice='$_POST[productprice]', productimage='$_POST[productimage]' where productid='$_POST[hidden]'";  
             mysql_query($updateproduct,$con);

        $updatesale="UPDATE Sales SET startdate='$_POST[startdate]', enddate='$_POST[enddate]',price='$_POST[price]' where productid='$_POST[hidden]'";
              mysql_query($updatesale,$con);
              echo "<script>location.href='employee.php';</script>";
              //header("Location: admin.php")；
             // exit;

        };


          if(isset($_POST['delete'])){
             $id=$_POST['productid'];
           
            if(empty($id)){
                echo "<script type='text/javascript'>
                window.alert('Please select at least a delete mark!');
                location.href='employee.php';
                </script>";

            }
            else
            {
               // echo "<h4>'$id'</h4>";
                
                $impid=implode(",",$id);
               // echo $impid;
              //  echo"<h3>'$impid'</h3>";
              //  $deleteall="DELETE FROM Users where userid IN ('$impid') ";
                mysql_query("DELETE FROM Products WHERE productid IN(".$impid.")");
                 echo "<script>location.href='employee.php';</script>";
                
            }
        };  
   
 if(isset($_POST['addsubmit'])){

            $usertype=$_POST['type.value'];
             $addquery="INSERT INTO Users(username,firstname,lastname,password,usertype,age,salary) values ('$_POST[username]','$_POST[firstname]','$_POST[lastname]','$_POST[password]','$_POST[type]','$_POST[age]','$_POST[salary]')";
            mysql_query($addquery,$con);
              echo "<script>location.href='admin.php';</script>";
              //header("Location: admin.php")；
             // exit;

        };



        if(isset($_POST['edit'])){   
          $id=$_POST[radioname];
          if(empty($id)){
                echo "<script type='text/javascript'>
                window.alert('Please select a edit mark!');
                location.href='employee.php';
                </script>";

            }
         // echo $id;
            $sql = "select * from Products where productid='$id'";
            $myData=mysql_query($sql,$con);
            $row = mysql_fetch_array($myData);
          // echo $row[productname];
           $categoryid=$row[categoryid];
           $mysql="select * from Sales where productid='$id'";
           $myData1=mysql_query($mysql,$con);
           $line=mysql_fetch_array($myData1);
         //  echo $line[startdate];

           $newsql="select * from Category where categoryid='$categoryid'";
           $myData2=mysql_query($newsql,$con);
           $newline=mysql_fetch_array($myData2);
         //  echo $newline['categoryname'];



        echo '<br><br><br><br>

       <form  align="center" action="editemployee.php" method="post" onclick="return validate()">     
       <p align="center"><font size=40>Edit Information</font></p>
        <table align="center">
        <tr><td><span class="required">*</span>Product Name:</td><td><input type="text" id="productname" name="productname" value="'.$row['productname'].'"></td></tr>
         <tr><td><span class="required">*</span>Category Name:</td><td><input type="text" id="categoryname" name="categoryname" value="'.$newline['categoryname'].'"></td></tr>


        <tr><td>Product Description:</td><td><textarea cols="30" rows="10" id="lname" name="productdesc">'.$row['productdesc'].'</textarea></td></tr>
        <tr><td>Product Price:</td><td><input type="text" id="productprice" name="productprice" value="'.$row['productprice'].'"></td></tr>
        <tr><td>Start date:</td><td><input type="text" id="startdate" name="startdate" value="'.$line['startdate'].'"></td><td><span class=required>(yyyy-mm-dd)</span></td></tr>
        <tr><td>End Date:</td><td><input type="text" id="enddate" name="enddate" value="'.$line['enddate'].'"></td><td><span class=required>(yyyy-mm-dd)</span></td></tr>
        <tr><td>Special Price:</td><td><input type="text" id="price" name="price" value="'.$line['price'].'"></td></tr>
        <tr><td>product Image URL:</td><td><input type="text" id="productimage" name="productimage" value="'.$row['productimage'].'"></td></tr>    
        <tr><td>product Image Show:</td><td><img src="'.$row['productimage'].'"/></td></tr>
        <tr><td></td><td><input type="hidden" name="hidden" value="'.$row['productid'].'"></td></tr>
        <td></td><td><input type="submit" name="editok" value="submit">
        <input type="button" name="editright" value="go back" onclick="backpage()">
        </td>
        </tr>
        </table>
    </form>
    ';

        };
        
       
?>

</body>
</html>
