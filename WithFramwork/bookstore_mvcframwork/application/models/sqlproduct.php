<?php
class Sqlproduct extends CI_Model{
	
	public function product_sql($x){
	
		$mysql=$this->db->query("select * from Products where productid='$x'");
		return $mysql->result();
	}
	
	
	public function sql_sale(){
		$today = date("Y-m-d");
		$mysql=$this->db->query("select * from Products P, Sales S where P.productid=S.productid and S.enddate>'$today'");
		return $mysql->result();
	}
	
}