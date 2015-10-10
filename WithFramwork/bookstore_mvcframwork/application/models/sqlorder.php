<?php
class Sqlorder extends CI_Model{
	
	public function sqlsome($t,$y){
		$x=$t;
		$perpage=$y;
		$mysql=$this->db->query("select * from orders where customerid='$_SESSION[customerid]' limit $x,$perpage");
		return $mysql->result();
	}
	public function sqlall(){
		
		$mysql=$this->db->query("select * from orders where customerid='$_SESSION[customerid]'");
		$data=$mysql->result();
		//$data=mysql_query($sql1);
		
	 //  return mysql_num_rows($data);
		
		
		return $this->db->affected_rows($data);
	}
	
	public function sqldetail1($x){
		$orderid=$x;
		$mysql=$this->db->query("select * from orders where orderid='$orderid'");
		return $mysql->result();
		
	}
	
	public function sqldetail2($y){
		$orderid=$y;
		$sql=$this->db->query("select p.productname, d.qty, d.productprice from orders o,orderdetail d,Products p where o.orderid='$orderid' and o.orderid=d.orderid and d.productid=p.productid");
		return $sql->result();	
	}
	
	public function detail_id($y){
		$productid=$y;
		$sql=$this->db->query("select orderid from orderdetail where productid='$productid'");
		return $sql->result();
	}
	public function detail_productid($x,$y){
		
		$sql=$this->db->query("select productid from orderdetail where orderid='$x' and productid<>'$y'");
		return $sql->result();
	}
	
	public function insert_order($data){
		$this->db->trans_start();
		$this->db->insert("orders",$data);
		$insert_id = $this->db->insert_id();
		$this->db->trans_complete();
		return  $insert_id;
	}
	public function insert_detail($data){
		$this->db->insert("orderdetail",$data);
		
	}
	
	
	
}
	
	