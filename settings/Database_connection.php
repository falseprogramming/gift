<?php

class Database extends PDO {
	
	function __construct() {
		try {
		parent::__construct(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);
		}catch(PDOException $e){
			
			echo 'Error!' . $e->getMessage();
		}
	}
}