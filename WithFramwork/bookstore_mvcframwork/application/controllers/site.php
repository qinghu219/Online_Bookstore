<?php
session_start ();
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
define ( "XH_PARAM_INT", 0 );
define ( "XH_PARAM_TXT", 1 );
function PAPI_GetSafeParam($pi_strName, $pi_Def = "", $pi_iType = XH_PARAM_TXT) {
	if (isset ( $_GET [$pi_strName] ))
		$t_Val = trim ( $_GET [$pi_strName] );
	else if (isset ( $_POST [$pi_strName] ))
		$t_Val = trim ( $_POST [$pi_strName] );
	else
		return $pi_Def;

	// INT
	if (XH_PARAM_INT == $pi_iType) {
		if (is_numeric ( $t_Val ))
			return $t_Val;
		else
			return $pi_Def;
	}

	// String
	$t_Val = str_replace ( "&", "&amp;", $t_Val );
	$t_Val = str_replace ( "<", "&lt;", $t_Val );
	$t_Val = str_replace ( ">", "&gt;", $t_Val );
	if (get_magic_quotes_gpc ()) {
		$t_Val = str_replace ( "\\\"", "&quot;", $t_Val );
		$t_Val = str_replace ( "\\''", "&#039;", $t_Val );
	} else {
		$t_Val = str_replace ( "\"", "&quot;", $t_Val );
		$t_Val = str_replace ( "'", "&#039;", $t_Val );
	}
	return $t_Val;
}

class Site extends CI_Controller {
	

	
	
	
	public function index() {
		$this->home ();
	}
	public function home() {
		$this->load->helper ( 'url' );
		
		$this->load->model ( "sqluser" );
		$mydata1 ['mydata1'] = $this->sqluser->sqlall ();
		$this->load->view ( 'home', $mydata1 );
	}
	
	public function checkout() {
		$this->load->helper ( 'url' );
		$this->load->model ( "sqlcart" );
		 		if (isset($_POST['pay'])) {
		 			$this->load->model ( "sqlorder" );
		 			$customerid=$_SESSION['customerid'];
		 			$address=$_POST['address'];
		 			$today = date("Y-m-d H:i:s");
		 			$cardnumber=$_POST['cardnumber'];
		 			$carddate=$_POST['carddate'];
		 			
		 			$address1=$_POST['address1'];
		 			$billing=$address;
		 			$shipping=$address1;
		 			$total=$_POST['sum'];
		 			
		 			$row1=$this->sqlcart->sql_card1();
		 			if($row1){
		 				$data = array (
		 						'expiretime' => $carddate,
		 						'cardno' => $cardnumber
		 					
		 				);
		 					
		 				$this->sqlcart->update_card($data,$customerid);
		 				
		 			}else{
		 				$data = array (
		 						'customerid'=>$customerid,
		 						'expiretime' => $carddate,
		 						'cardno' => $cardnumber		
		 				);
		 				
		 				$this->sqlcart->insert_card($data);
		 			}
		 			
		 			$mydata = array (
		 					'customerid'=>$customerid,
		 					'nowtime' => $today,
		 					'billingaddress' => $billing,
		 					'shippingaddress'=>$shipping,
		 					'total'=>$total
		 			);
		 				
		 			$orderid=$this->sqlorder->insert_order($mydata);
					$carddata=$this->sqlcart->sql_cart();
		 			foreach($carddata as $row){
		 				$productid=$row->productid;
		 				$qty=$row->qty;
		 				$productprice=$row->productprice;
		 				
		 				$mydata1 = array (
		 						'orderid'=>$orderid,
		 						'productid' => $productid,
		 						'qty' => $qty,
		 						'productprice'=>$productprice
		 				);
		 					
		 				$this->sqlorder->insert_detail($mydata1);
		 			}
		 			$string=$this->sqlcart->sql_cart();
		 			foreach($string as $myrow){
		 				$cartid=$myrow->cartid;
		 				$this->sqlcart->delete_all ( $cartid );
		 			}
		 			 			
		 			echo "<script>
		 			window.alert('Congradualations! You are successful to pay this order');
    location.href='home';</script>";
       
		 			
		 			
		 		}
		 		
		 		
		 		$mydata ['mydata'] = $this->sqlcart->sqlall ();
		 		$total=$_POST['sum'];
		 		$mydata['total']=$total;
		 		$mydata['data']=$this->sqlcart->sql_address();
		 		$mydata['data2']=$this->sqlcart->sql_card();
		 	
		 				 		
 		$this->load->view ( 'checkout', $mydata);
	
	}
	
	public function product() {
		$this->load->helper ( 'url' );
		$this->load->model ( "sqluser" );
		$data ['myData'] = $this->sqluser->sqlcategory ();
		$data ['special'] = $this->sqluser->sql1 ();
		$data ['newdata'] = $this->sqluser->sqlproduct ();
		
		$this->load->view ( 'product', $data );
	}
	public function product1() 

	{
		$category = $_POST ['category'];
		$this->load->helper ( 'url' );
		$this->load->model ( "sqluser" );
		
		$data ['myData'] = $this->sqluser->sqlcategory ();
		$data ['special'] = $this->sqluser->sql1 ();
		
		$data ['newdata'] = $this->sqluser->sqlc ( $category );
		
		$this->load->view ( 'product', $data );
	}
	public function product2() 

	{
		$bookname = $_POST ['bookname'];
		$this->load->helper ( 'url' );
		$this->load->model ( "sqluser" );
		
		$data ['myData'] = $this->sqluser->sqlcategory ();
		$data ['special'] = $this->sqluser->sql1 ();
		
		$data ['myData1'] = $this->sqluser->sqlb ( $bookname );
		
		$this->load->view ( 'product', $data );
	}
	public function orders() {

		if (!isset($_SESSION['customerid'])) {
			echo '
      <script>
     alert("Please login first, then you can see your order!");
      location.href="loginc";
      </script>
    ';
		}
		$page = 0;
		if (isset ( $_GET ['page'] )) {
			$page = $_GET ['page'];
			$page = mysql_real_escape_string ( $page );
		} else {
			$page = 1;
		}
		
		$this->load->helper ( 'url' );
		
		$this->load->model ( "sqlorder" );
		
		$rows = $this->sqlorder->sqlall ();
		
		$x = ($page - 1) * 5;
		$data ['page'] = $page;
		
		$total_page = ceil ( $rows / 5 );
		$data ['total_page'] = $total_page;
		$data ['data1'] = $this->sqlorder->sqlsome ( $x, 5 );
		
		$this->load->view ( 'orders', $data );
	}
	public function setquantity() {
		$this->load->helper ( 'url' );
		$this->load->model('sqlcart');
		$productid = $_POST ['productid'];
		$customerid = $_SESSION ['customerid'];
		$qty=$_POST['qty'];
		$array = array('productid' => $productid, 'customerid' => $customerid);
		$data = array (
				'qty' =>$qty
		)
		;
		$this->sqlcart->update_cart($data,$array);
		$Mydata['mydata']=$this->sqlcart->sql_cart1();
		$this->load->view ( 'setquantity',$Mydata );
	}
	public function shoppingcart() {
		if (!isset($_SESSION['customerid'])) {
			echo '
      <script>
     alert("Please login first, then you can see your cart!");
      location.href="loginc";
      </script>
    ';
		}
		$this->load->helper ( 'url' );
		$this->load->model ( "sqlcart" );
		if (isset ( $_POST ['clear'] )) {
			$mydata = $this->sqlcart->sqldelete ();
			
			foreach ( $mydata as $row ) {
				$id = $row->cartid;
				$this->sqlcart->delete_all ( $id );
			}
		}
		$mydata1 ['myData'] = $this->sqlcart->sqlall ();
		
		$this->load->view ( 'shoppingcart', $mydata1 );
	}
	public function removecart() {
		$this->load->helper ( 'url' );
		$this->load->model ( "sqlcart" );
		$productid = $_POST ['productid'];
		$customerid = $_SESSION ['customerid'];
		$mydata = $this->sqlcart->cart_select ( $productid, $customerid );
		$cartid;
		
		foreach ( $mydata as $myrow ) {
			$cartid = $myrow->cartid;
			$this->sqlcart->delete_all ( $cartid );
		}
		
		$newdata ['myData'] = $this->sqlcart->sqlall ();
		
		$this->load->view ( 'removecart', $newdata );
		
		// $this->load->view('removecart');
	}
	public function shoppingcart2() {
		$productid = $_POST ['productid'];
		$productprice = $_POST ['productprice'];
		$this->load->helper ( 'url' );
		$this->load->model ( "sqlcart" );
		$customerid = $_SESSION ['customerid'];
		$rowarray = $this->sqlcart->sqlcustomer ( $productid );
		if ($rowarray) {
			echo '
      <script>
     alert("You have this product in your cart, please select other product!");
      location.href="product";
      </script>
    ';
		} else {
			$data = array (
					'productid' => $productid,
					'qty' => '1',
					'customerid' => $customerid,
					'productprice' => $productprice 
			)
			;
			$this->sqlcart->insert1 ( $data );
		}
		
		$this->load->model ( "sqlorder" );
		$mydata = $this->sqlorder->detail_id ( $productid );
		
		$i = 0;
		foreach ( $mydata as $row ) {
			$orderid = $row->orderid;
			$mydata1 = $this->sqlorder->detail_productid ( $orderid, $productid );
			foreach ( $mydata1 as $row1 ) {
				// echo "this is".$row1[productid];
				$array [$i] = $row1->productid;
				$i ++;
			}
		}
		$array1 = array_unique ( $array );
		$mydata1 ['array1'] = $array1;
		// print_r($array1);
		$this->load->model ( "sqlproduct" );
		$arrlength = sizeof($array1);
		if($arrlength>3){
			$arrlength=3;
		}
		$allarray = array ();
		for($x = 0; $x < $arrlength; $x ++) {
			$p = $array1 [$x];
			
			$data = $this->sqlproduct->product_sql ( $p );
			
			$allarray [$x] = $data;
		}
		// print_r($allarray);
		$mydata1['length']=$arrlength;
		$mydata1 ['newdata'] = $allarray;
		
		$mydata1 ['mydata'] = $this->sqlproduct->sql_sale ();
		
		$mydata1 ['myData'] = $this->sqlcart->sqlall ();
		
		$this->load->view ( 'shoppingcart', $mydata1 );
	}
	public function profile() {
		if (!isset($_SESSION['customerid'])) {
			echo '
      <script>
     alert("Please login first, then you can see your profile!");
      location.href="loginc";
      </script>
    ';
		}
		
		$this->load->helper ( 'url' );
		$this->load->model ( "sqlcustomer" );	
		$error = '';
		// error message
		$username = '';
		// sender's name
		$password = '';
		if (isset($_POST['edit'])) {
			$this->load->model ( "sqllogin" );
			$username=htmlentities($_POST['username']);
			$email=htmlentities($_POST['email']);
			$age=htmlentities($_POST['age']);
			$phone=htmlentities($_POST['phone']);
			$address=htmlentities($_POST['address']);
			$city=htmlentities($_POST['city']);
			$state=htmlentities($_POST['state']);
			$country=htmlentities($_POST['country']);
			$zip=htmlentities($_POST['zip']);
			$addressid=htmlentities($_POST['addressid']);
			$t_user = PAPI_GetSafeParam ( "username", "", XH_PARAM_TXT );
			$row1=$this->sqllogin->select_if($t_user);
			if ($row1) {
				$error1 = '<div class="errormsg">The editd username has been used! Please edit again!</div>';
				$mydata['error1']=$error1;
				$name=$_SESSION['username'];
				$mydata['row']=$this->sqlcustomer->sql_c($name);
				$this->load->view ( 'profile',$mydata);
			}
			else{
				$data = array (
						'address' => $address,
						'city' => $city,
						'state' => $state,
						'country' => $country,
						'zip' => $zip,
			
				);
			
				$this->sqllogin->update_address($data,$addressid);
				$data1 = array (
						'username' =>$username,
						'email' => $email,
						'age' => $age,
						'phone' => $phone
			
				);
				$customerid=$_SESSION['customerid'];
				$id=$this->sqllogin->update_customer($data1,$customerid);
				$_SESSION['username']=$username;
				if($id){
			
					echo "<script>
          window.alert('You have edited your profile successfully!');
          location.href='profile';</script>";
				}
					
			}

			
		}elseif (isset($_POST['change'])) {
			$this->load->model ( "sqllogin" );
			$password=$_POST['password'];
			$password1=htmlentities($_POST['password1']);
			$password2=htmlentities($_POST['password2']);
			$username=$_SESSION['username'];
			$customerid=$_SESSION['customerid'];
			$error="";
			if (trim($password) == '') {
				$error = '<div class="errormsg">Please enter your current password!</div>';
			}else{
				$t_pass = PAPI_GetSafeParam ( "password", "", XH_PARAM_TXT );
				$row1=$this->sqllogin->sql_check($username,$t_pass);
			   if(!$row1){
				$error = '<div class="errormsg">Enter your valid current password!</div>';
			} elseif ((trim($password1) == '')||(trim($password2)=='')) {
				$error = '<div class="errormsg">Please enter your new password!</div>';
			} elseif (!($password1==$password2)){
				$error = '<div class="errormsg">Please check that your passwords match and try again.</div>';
			}elseif( strlen($password1) < 6 ) {
			
				$error = '<div class="errormsg">Password needs at least 6 characters!</div>';
			}else{
				
				$data = array (
						'password' => $password1
							
				);
					
				$this->sqlcustomer->update_customer($data,$customerid);
		  echo "
          <script>
          window.alert('You have changed your password successfully!');
			
          location.href='profile';</script>";
			}
			
			}

			$mydata['error']=$error;
			$name=$_SESSION['username'];
			$mydata['row']=$this->sqlcustomer->sql_c($name);
			$this->load->view ( 'profile',$mydata);
		
		
		}else{	
				
		$name=$_SESSION['username'];
		$mydata['row']=$this->sqlcustomer->sql_c($name);
		$this->load->view ( 'profile',$mydata);
		}
		
		
}
	

	public function loginc() {	
		$error = '';
		// error message
		$username = '';
		// sender's name
		$password = '';
		$error1 = '';
		
		$this->load->helper ( 'url' );
		
		if (isset ( $_POST ['login'] )) {
			$this->load->model ( "sqllogin" );
			$username = $_POST ['username'];
			$password = $_POST ['password'];
			
			if (trim ( $username ) == '') {
				$error = '<div class="errormsg">Please enter username!</div>';
			}elseif (trim ( $password ) == '') {
				$error = '<div class="errormsg">Please enter a password!</div>';
			
			}elseif(strlen ( $username ) > 0 && strlen ( $password ) > 0) {
				
				$t_user = PAPI_GetSafeParam ( "username", "", XH_PARAM_TXT );
				$t_pwd = PAPI_GetSafeParam ( "password", "", XH_PARAM_TXT );
				
				$row = $this->sqllogin->sql_check ($t_user,$t_pwd );
				
				if (! $row) {
					// no rows retrieved
					$error = "<div class='errormsg'>Invalid login!</div>";
				} else {
					$_SESSION ['customerid'] = $row ['customerid'];
				}
				
				if ($error == '') {
					 $_SESSION['timeout']=time();
					$_SESSION['username'] = $username;
             echo "<script>location.href='home';</script>";
				}
			}
		
			$alldata['error']=$error;
		
			$this->load->view ( 'loginc',$alldata);
		}elseif(isset($_POST['register'])){
			$this->load->model ( "sqllogin" );
			$username=htmlentities($_POST['username']);
			$password=htmlentities($_POST['password']);
			$email=htmlentities($_POST['email']);
			$age=htmlentities($_POST['age']);
			$phone=htmlentities($_POST['phone']);
			$address=htmlentities($_POST['address']);
			$city=htmlentities($_POST['city']);
			$state=htmlentities($_POST['state']);
			$country=htmlentities($_POST['country']);
			$zip=htmlentities($_POST['zip']);
			$t_user = PAPI_GetSafeParam ( "username", "", XH_PARAM_TXT );
			$row1=$this->sqllogin->select_if($t_user);
			if ($row1) {
				$error1 = '<div class="errormsg">The username has been used!</div>';
				$alldata['error1']=$error1;
				
				$this->load->view ( 'loginc',$alldata);
			}
			else{
				$data = array (
						'address' => $address,
						'city' => $city,
						'state' => $state,
						'country' => $country,
						'zip' => $zip,
						
				);
				$addressid=$this->sqllogin->insert_address( $data );
				$data1 = array (
						'username' =>$username,
						'password' => $password,
						'email' => $email,
						'age' => $age,
						'phone' => $phone,
						'addressid' => $addressid,
				
				);					
				$id=$this->sqllogin->insert_customer($data1);
				if($id){
				
				echo "<script>
          window.alert('You have registered successfully! Please login now!');
          location.href='loginc';</script>";
				}
				 
			}
				
			
		}else{
			$this->load->view ( 'loginc');
			
		}
		
	}
	public function category() {
		$this->load->helper ( 'url' );
		
		$this->load->model ( 'sqluser' );
		
		$this->sqluser->sqlcategory ();
		
		$this->load->view ( 'product' );
		
		// $this->load->model("");
	}
	public function detail() {
		$this->load->helper ( 'url' );
		$this->load->model ( 'sqlorder' );
		
		$orderid = $_POST ['orderid'];
		
		$data ['mydata1'] = $this->sqlorder->sqldetail1 ( $orderid );
		
		$data ['mydata2'] = $this->sqlorder->sqldetail2 ( $orderid );
		
		$this->load->view ( 'detail', $data );
	}
}
