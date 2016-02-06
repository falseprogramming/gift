<?php

class Init {

    function __construct() {
        $this->GPE = new Gift_PDF_Exec();
        $this->login = new Login();
        //$this->dbAction = new Gift_DB();

        $param = isset($_GET['p']) ? $_GET['p'] : '';

        switch ($param) {

            case 'index':
                $this->index();
                break;
            case 'doPdf':
                $this->doPdf();
                break;
            case 'insert':
                $this->insert();
                break;
            case 'login':
                $this->login();
                break;
            default:
                $this->index();
        }
    }

    public function index() {
        include labels();
        require ('templates/pages/index.php');
        require ('templates/forms/gift_form.php');
    }

	public function ready(){
		
		$dbInsert;
	  require 'templates/pages/ready.php';
		
	}

    public function doPdf() {

       $this->GPE->PDF_DO();
        
          $selectDesign = $_POST['selectDesign'];
		
			if($selectDesign == 'default') {
				
				header('location:index.php?p=doPdf&action=default');
				
			}

		
		$dbInsert = $this->dbAction->insert();
        $selectDesign = $_POST['selectDesign'];
		
			$ackc = array();
			$selectDesignValues = array(
					array_change_key_case('Default' => 'default',$ackc)
				
			);
        	if($selectDesign == $selectDesignValues['Default']) {
        		$this->ready();
				
        	}
			
			if($selectDesign == $selectDesignValues['Birthday']) {
				
				$this->ready();
			}
        
        require 'templates/pages/ready.php';
        $this->dbAction->insert();
    }

    public function insert() {
        $this->dbAction->insert();
    }
    
    public function login(){
        
        $this->login->login();
    }

}