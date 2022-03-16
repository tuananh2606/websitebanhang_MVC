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
            return print "Error!".mysqli_error($this->conn);
        else
            return mysqli_insert_id($this->conn);
	}
	function update(Entity $data, Entity $change){
        $data = $data->getAll();
        $fields = array();
        $values = array();
        foreach($data as $field=>$value) {
            $fields[] = $field;
            $values[] = $value;
        }
		
        $change = $change->getAll();
        $fields1 = array();
        $values1 = array();
        $i=0;
		foreach($change as $field=>$value){
            $fields1[] = $field;
            $values1[] = $value;
			$myStrSQL = "UPDATE {$this->table_name} SET $fields1[$i]='{$values1[$i]}' WHERE $fields[0] = '{$values[0]}'";
            $rs = mysqli_query($this->conn,$myStrSQL);
            $i++;
        }
            if (!$rs)
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

	function selectbyid($fields,$key)
	{
		$myStrSQL = "SELECT * FROM {$this->table_name} WHERE $fields = '{$key}'";
        //print $myStrSQL;
        $rs = mysqli_query($this->conn,$myStrSQL);
		if (mysqli_num_rows($rs) <= 0){
			return false;
		}
        else{
			$record = new Entity();
			while($row = mysqli_fetch_array($rs)) {
				foreach($row as $key=>$value) {
					if (is_numeric($key)) 
							continue;
					$record->$key = $value;
				}

			}
			return $record;
		}
	}
}
?>