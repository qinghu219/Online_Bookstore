<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();

class Managecart extends CI_Controller {
	public function check_cart(){
		$array = array();
		$array1=array();
		$form_data = $this->input->post();
		$productid=$this->input->post(productid);
		$productprice=$this->input->post(productprice);		
		$this->load->helper('url');
		$this->load->model('sqlcart',$productid);
		
		$data['results']=$this->sqlcart->sqlcustomer();
		if($data){
			echo '
      <script>
     alert("You have this product in your cart, please select other product!");
      location.href="product";
      </script>
    ';
		}else{
			$newrow=array(
				"productid"=>"$productid",
				"qty"=>'1',
				"customerid"=>"$_SESSION[customerid]",
				"productprice"=>"$productprice"	
			);
			$this->sqlcart->insert1(newrow);
		}
		
		
		
		$sql1="select orderid from orderdetail where productid='$_POST[productid]'";
		$mydata=mysql_query($sql1);
		$i=0;
		while($row=mysql_fetch_array($mydata)){
			$sql2="select productid from orderdetail where orderid='$row[orderid]' and productid<>'$_POST[productid]'";
			$mydata1=mysql_query($sql2);
		
			while($row1=mysql_fetch_array($mydata1)){
				// echo "this is".$row1[productid];
				$array[$i]=$row1[productid];
		
				$i++;
		
			}
		
		}
		$array1=array_unique($array);
		// print_r($array1);
		
		
		
		
		
	   
		
			
			
			
	}
		
		
		
		
	
	
	
	
}
