<?php
define ("HOST","localhost");
define ("DB", "db_btl");
define ("USER", "root");
define ("PASS", "");
require_once('entity.php'); 

class Model 
{
	private $conn;
    private $table_name;
    function __construct($table_name){
		$this->conn = mysqli_connect(HOST,USER,PASS,DB) or die("Connect DB Failed");
        $this->table_name = $table_name;
    }

    function insert(Entity $data)
	{
		$data = $data->getAll();
		 //var_dump($data);
		$fields = array();
		$values = array();
		foreach($data as $field=>$value) {
			$fields[] = $field;
			$values[] = $value;
		}
		//var_dump($check);
		$fields = implode(",",$fields);
		$values = implode("','",$values);
		$myStrSQL = "INSERT INTO {$this->table_name} ({$fields}) VALUES ('{$values}')";
		//var_dump($myStrSQL);
		$insert_check = mysqli_query($this->conn,$myStrSQL);
		//show($this->conn);
		if(!$insert_check)
			return false;
        else
			return true;	
	}

	function select() {
		$myStrSQL = "SELECT * FROM {$this->table_name}";
		$rs = mysqli_query($this->conn,$myStrSQL) or die('Error query: '.mysqli_error($this->conn));
		$records = array();
		while($row = mysqli_fetch_array($rs)) {
			$record = new Entity();
			foreach($row as $key=>$value) {
				if (is_numeric($key)) continue;
				$record->$key = $value;
			}
			array_push($records,$record);
			// $record[] = $record;
		}
		return $records;
	}

	function selectbyId($field,$key)
	{
		$myStrSQL = "SELECT * FROM {$this->table_name} WHERE $field = '{$key}'";
        //print $myStrSQL;
		$rs = mysqli_query($this->conn,$myStrSQL) or die('Error query: '.mysqli_error($this->conn));
		if (mysqli_num_rows($rs) <= 0){
			return false;
		}
        else{
			$records = array();
			while($row = mysqli_fetch_array($rs)) {
			$record = new Entity();
			foreach($row as $key=>$value) {
				if (is_numeric($key)) continue;
				$record->$key = $value;
			}
			array_push($records,$record);
			// $record[] = $record;
		}
		return $records;
		}
	}
}
?>