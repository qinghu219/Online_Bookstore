<?php

class Sqllogin extends CI_Model{
	
	public function sql_check($x,$y){
		$mysql="select customerid from customer where username=? and password=?";
       $sql=$this->db->query($mysql,array($x,$y));
		return $sql->row_array();	
	} 
	
	public function select_if($x){
	
		$sql=$this->db->query("select * from customer where username='$x'");
	
		return $sql->row_array();
	}
	
	
	
	
	
	
	public function insert_address($data){
	
		$this->db->insert("address",$data);
		return $this->db->insert_id();
	}
	
	
	
	public function update_address($data,$y){
		$this->db->where('addressid',$y);
		$this->db->update("address",$data);
	}
	
	
	
	public function insert_customer($data){
	
		$this->db->insert("customer",$data);
		return $this->db->insert_id();
	}
	
	public function update_customer($data, $x){
		$this->db->where('customerid',$x);
		$this->db->update("customer",$data);
		return true;
	}
}
