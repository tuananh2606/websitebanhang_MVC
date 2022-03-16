<?php
define ("HOST","localhost");
define ("DB", "db_btl");
define ("USER", "root");
define ("PASS", "");
require_once('entity.php'); 

class MODEL {
	private $conn;
	private $table_name;
	
	function __construct($table_name) {
		$this->conn = mysqli_connect(HOST,USER,PASS,DB) or die("Connect DB Failed");		
		//mysqli_query($conn,'SET NAMES utf8');
		$this->table_name = $table_name;
	}

	function select() {
		$myStrSQL = "SELECT * FROM {$this->table_name}";
		$rs = mysqli_query($this->conn,$myStrSQL) or die('Error query: '.mysqli_error($this->conn));
		$records = array();
		while($row = mysqli_fetch_array($rs)) {
			$record = new ENTITY();
			foreach($row as $key=>$value) {
				if (is_numeric($key)) continue;
				$record->$key = $value;
			}
			array_push($records,$record);
			// $record[] = $record;
		}
		return $records;
	}
	function selectby($fields,$key)
	{
		$myStrSQL = "SELECT * FROM {$this->table_name} WHERE $fields = '{$key}'";
        //print $myStrSQL;
        $rs = mysqli_query($this->conn,$myStrSQL);
		if (mysqli_num_rows($rs) <= 0){
			return false;
		}
        else{
			$row = mysqli_fetch_array($rs);
		}
		return $row;
	}
	function insert(ENTITY $data) {
		//var_dump($new_record);
		//Duyệt tất cả các thuộc tính đã gán vào đối tượng ENTITY
		$data = $data->getAll();
		//var_dump($new_record);return;
		$fields = array();
		$values = array();
		foreach($data as $field=>$value) {
			$fields[] = $field;
			$values[] = $value;
		}
		$fields = implode(",",$fields);
		$values = implode("','",$values);
		$myStrSQL = "INSERT INTO {$this->table_name} ({$fields}) VALUES ('{$values}')";
		// var_dump($myStrSQL);return;
		$insert_check = mysqli_query($this->conn,$myStrSQL);
		if (!$insert_check)
			print "Error!".mysqli_error($this->conn);
		else
			return mysqli_insert_id($this->conn);
			// return true;
	}
	function update(ENTITY $data, ENTITY $change){
        $data = $data->getAll();
        $fields = array();
        $values = array();
        foreach($data as $field=>$value) {
            $fields[] = $field;
            $values[] = $value;
        }
        $sqlCheck = "SELECT * FROM {$this->table_name} WHERE $fields[0] = {$values[0]}";
        $check = mysqli_query($this->conn,$sqlCheck);

        if (mysqli_num_rows($check) <= 0){
            return false;
        }
        else{
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
    }
	function deletebyid(ENTITY $data, $key) {
		$data = $data->getAll();
            $fields = array();
            foreach($data as $field=>$value) {
                $fields[] = $field;
            }

            $sqlCheck = "SELECT * FROM {$this->table_name} WHERE $fields[0] = '{$key}'";
            $check = mysqli_query($this->conn,$sqlCheck);
            
            if (mysqli_num_rows($check) <= 0){
                return false;
            }
            else{
                $myStrSQL = "DELETE FROM {$this->table_name} WHERE $fields[0] = '{$key}'";
                $delete_check = mysqli_query($this->conn,$myStrSQL);
                if (!$delete_check)
                    return false;
                else
                    return true;
            }
        }
}
?>