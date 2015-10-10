<?php

         $sum=0;
   		foreach($mydata as $row){
           $sum+=($row->productprice)*($row->qty);
         }

       
    echo $sum;

  
    
?>

