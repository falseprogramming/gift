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
        
        
       
        require 'templates/pages/ready.php';
       
    }

    public function insert() {
        $this->dbAction->insert();
    }
    
    public function login(){
        
        $this->login->login();
    }

}