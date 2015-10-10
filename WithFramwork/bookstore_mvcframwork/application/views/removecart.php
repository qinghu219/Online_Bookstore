<?php   
        echo '
        <table cellspacing="0" cellpadding="1">
				<tr bgcolor="#CCCCCC">
					<th  align="left">Image</th>
					<th  align="left">Description</th>
					<th align="center">Quantity</th>
					<th  align="left">Price</th>
					<th ></th>

				</tr>

        ';

        $sum = 0;
        echo ' <form action="checkout" method="post">';
        foreach ( $myData as $row ) {
        	// echo $row[productimage];
        	$sum += ($row->productprice) * ($row->qty);
        	echo '
             <tr>
                          <td><img class="myimage"  src="' . base_url ( $row->productimage ) . '" alt="image 01"/></td>
                          <td>' . $row->productdesc . '
                         <input type= "text" id="select1" size = "35" value ="' . $row->productprice . '" style="display:none;"></td>
                            <td><input type="text" id="' . $row->productid . '" name="select2" onkeyup="OnChange(this.id,this.value)"
		   onKeyPress="return isNumberKey(event)" value="' . $row->qty . '" style="width: 20px; text-align: right" /> </td>
        
                            <td>' . $row->productprice . ' </td>
                            <td><input type="button" value="Remove" name="' . $row->productid . '" onclick="onRemove(this.name);" </td>
            </tr>';
        }
        echo '
            </table>
                    <div style="float:right;  margin-top: 20px;">
        
                        Subtotal:<div id="total">' . $sum . '</div>
                        <input type="hidden" name="sum" id="sum" value="' . $sum . '"/>
                        <div class="continueshopping"><input type="submit" name="check" value="Proceed to Checkout" class="more"/></div>
                        </form>
                        <form action="shoppingcart" method="post">
                        <div class="continueshopping"><input type="submit"  id="clearall" name="clear" value="      Clear all items     " class="more"/></div>
                        </form>
           
                        <div class="continueshopping"><a href="product" class="more">Continue Shopping</a></div>
                     </div>
              ';
                       
           


  
    
?>

