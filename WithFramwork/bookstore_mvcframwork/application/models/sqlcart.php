<?php
// session_start();

class Sqlcart extends CI_Model{
	public function sql_card(){
		$sql=$this->db->query("select * from card where customerid='$_SESSION[customerid]'");
		return $sql->result();
	}
	public function sql_card1(){
		$sql=$this->db->query("select * from card where customerid='$_SESSION[customerid]'");
		return $sql->row_array();
	}
	
	
	
	public function sql_address(){
		$sql=$this->db->query("select * from customer c, address a where c.addressid=a.addressid and customerid='$_SESSION[customerid]'");
		return $sql->result();
	}
	
	public function sqlall(){
		
   $sql=$this->db->query("select P.productname, C.productprice, qty,productimage,productdesc, P.productid from Cart C, Products P where  C.productid=P.productid and C.customerid='$_SESSION[customerid]'");

		return $sql->result();		
	} 
	
	
	public function sql_cart(){
	
		$sql=$this->db->query("select * from Cart C, Products P where  C.productid=P.productid and C.customerid='$_SESSION[customerid]'");
	
		return $sql->result();
	
	}
	public function sql_cart1(){
	
		$sql=$this->db->query("select * from Cart where customerid='$_SESSION[customerid]'");
	
		return $sql->result();
	
	}
	
	public function update_cart($data,$array){
	
	    $this->db->where($array);
		$this->db->update("Cart",$data);
	
	}
	
	
	
	public function update_card($data,$y){
		$this->db->where('customerid',$y);
		$this->db->update("card",$data);
	}
	public function insert_card($data){
	
		$this->db->insert("card",$data);
		return $this->db->insert_id();
	}
		
	
	public function sqlcustomer($x){
		$productid=$x;
		$sqlselect=$this->db->query("select * from Cart where productid='$productid' and customerid='$_SESSION[customerid]'");
		
		return $sqlselect->row_array();

	}
	
	public function cart_select($x,$y){
		$productid=$x;
		$sqlselect=$this->db->query("select * from Cart where productid='$productid' and customerid='$y'");
	
		return $sqlselect->result();
		}
	
	
	
	public function insert1($data){
		
		$this->db->insert("Cart",$data);
		return $this->db->insert_id();
	}
	
	public function sqldelete(){
	
		$sqlselect=$this->db->query("select * from Cart where customerid='$_SESSION[customerid]'");
		return $sqlselect->result();
		
	}

	
	public function delete_all($id){
		$this->db->where('cartid',$id);
		$this->db->delete('Cart');	
		
	}

	
	
}