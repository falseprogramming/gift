<?php

class Gift_DB {
	
	function __construct() {
		
			$this->db = new Database();
		
	}
	
	
	public function insert() {
		
		$name = $_POST['name'];
		$price = $_POST['price'];
		
		$st = $this->db->prepare('insert into test_tbl(name,price) values(:name,:price)');
		
			$st->execute(array(
				':name' => $name,
				':price' => $price
			));
		
	}
	
	
}