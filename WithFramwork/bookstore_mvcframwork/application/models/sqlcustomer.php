<?php

class Sqlcustomer extends CI_Model{
	
	public function sql_c($x){
		
   $sql=$this->db->query("select * from customer c, address a where c.addressid=a.addressid and username='$x'");

		return $sql->first_row();	
	} 
	
	
	public function update_customer($data,$y){
		$this->db->where('customerid',$y);
		$this->db->update("customer",$data);
	}
	
}