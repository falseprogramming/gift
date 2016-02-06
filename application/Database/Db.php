<?php
/*
 * Name: Database class
 * Description: Class that extends PHP Data Objects(PDO)
 */

class Database extends PDO {

    public function __construct() {
        parent:: __construct(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
    }

    /*
     * @param $table = table name where to insert data
     * @param $data = Data to insert
     */

    public function create($table, $data) {
        $kav = null;
        //Appending $kav =  $key and $value 
        // 'my_field' => 'my value varchar(100) NOT NULL'  becomes to my_field varchar(100) NOT NULL,
        //$skav = removing comma at the end
        
        foreach ($data as $key => $value) {
            $kav .= $key . $value . ',';
            $skav = substr($kav, 0, -1);
        }

        $sth = $this->prepare("CREATE TABLE $table ($skav)");
 
        $sth->execute();
    }

    public function insert($table, $data) {
        $kone = null;
        $ktwo = null;
        //Here we are appending key's only so that the key's becomes
        //INSERT INTO test (`script_name`,`start_time`,`end_time`) VALUES(:script_name,:start_time,:end_time) )
        
        foreach ($data as $key => $value) {
            $kone.= $key . '`,`';
            $skone = substr($kone, 0, -3);
            $ktwo .= $key . ',:';
            $sktwo = substr($ktwo, 0, -2);
        }
        $sth = $this->prepare("INSERT INTO $table (`$skone`) VALUES(:$sktwo)");
        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }
  
        $sth->execute();
    }
	
	
	    public function update($table, $data, $where) {
        ksort($data);

        $fieldDetails = NULL;
        foreach ($data as $key => $value) {
            $fieldDetails .= "`$key`=:$key,";
        }
        $fieldDetails = rtrim($fieldDetails, ',');

        $sth = $this->prepare("UPDATE $table SET $fieldDetails WHERE $where");

        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }

        $sth->execute();
    }
    // select statment =  $this->db->select('SELECT * FROM etc..')
    public function select($sql) {
        $sth = $this->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
    }
	
	    public function delete($table , $where, $limit = 1){
        return $this->exec("DELETE FROM $table WHERE $where LIMIT $limit");
       
    }

}