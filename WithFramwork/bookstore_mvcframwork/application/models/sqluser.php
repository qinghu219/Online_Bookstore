<?php

class Sqluser extends CI_Model{
	
	public function sqlall(){
		$today = date("Y-m-d");
		// echo $today;
		$mysql=$this->db->query("select * from Products P, Sales S where P.productid=S.productid and S.enddate>'$today'");
		return $mysql->result();
		
	} 
	public function sqlcategory(){
		
		$mysql=$this->db->query("select * from Category");
		return $mysql->result();
	
	}
	public function sqlproduct(){
		$mysql=$this->db->query("select * from Products");
		return $mysql->result();
		
	}
	public function sqlc($data){
		$category=$data;
		$mysql=$this->db->query("select * from Products, Category where Products.categoryid=Category.categoryid and categoryname='$category'");
		return $mysql->result();
	
	}
	public function sql1(){
		$today = date("Y-m-d");
		
		$mysql=$this->db->query("select * from Products P, Sales S where P.productid=S.productid and S.enddate>'$today'");
		return $mysql->result();
	
	}
	public function sqlb($data){
		$bookname=$data;
		$mysql=$this->db->query("select * from Products where productname like '%$bookname%'");
		return $mysql->result();
	
	}
	
}