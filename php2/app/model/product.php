<?php
require_once("model.php");
require_once("connection.php");
class Product extends Model
{
	function __construct($table_name='')
	{
		parent::__construct($table_name);
	}
	
	function productperPage($numberRecordPerPage,$where = null)
	{
		global $conn;
		if($where === null)
		{
			$myStrSQL = "SELECT COUNT(*) as TotalRecs FROM sanpham";
		}
		else
		{
			$myStrSQL = "SELECT COUNT(*) as TotalRecs FROM sanpham WHERE ".$where;
			//var_dump($myStrSQL);
		}
		$result = mysqli_query($conn,$myStrSQL);
		$rowCount = mysqli_fetch_array($result);
		$totalRecord = $rowCount[0];
		return ceil($totalRecord / $numberRecordPerPage);
	}
	
	function getProductforPage($curPage,$numberRecordPerPage,$where = null)
	{
		global $conn;
		$startRecord = ($curPage-1)*$numberRecordPerPage;
		if($where === null)
		{
			$myStrSQL = "SELECT * FROM sanpham LIMIT $startRecord,$numberRecordPerPage";
		}
		else
		{
			$myStrSQL = "SELECT * FROM sanpham WHERE ".$where." LIMIT $startRecord,$numberRecordPerPage";
			//var_dump($myStrSQL);
		}
		$rs	  = mysqli_query($conn,$myStrSQL);
		$records = array();
		while($row = mysqli_fetch_array($rs)) {
			$record = new Entity();
			foreach($row as $key=>$value) {
				if (is_numeric($key)) continue;
				$record->$key = $value;
			}
			array_push($records,$record);
		}
		return $records;
	}

	function getProduct($orderBy, $start, $last, $where = null){
		global $conn;
		if($where === null){
			$sql = "SELECT * FROM sanpham ORDER BY ".$orderBy." desc LIMIT ".$start.",".$last;
		} 
		else {
			$sql = "SELECT * FROM sanpham WHERE ".$where." ORDER BY ".$orderBy." desc LIMIT ".$start.",".$last;
		}
		$prd = array();
		$rs = mysqli_query($conn,$sql) or die('Error query: '.mysqli_error($this->conn));
		foreach ( $rs as $value){
			$prd[] = $value;
		}
		return $prd;
	}
	
	function getProductById($MaSanPham){
		global $conn;
		$sql = "SELECT * FROM sanpham WHERE MaSanPham = ".$MaSanPham;
		$prd = array();
		$rs = mysqli_query($conn,$sql) or die('Error query: '.mysqli_error($conn));
		foreach ( $rs as $value){
			$prd = $value;
		}
		return $prd;
	}
	function getOrderById($thanhvien_id){
		global $conn;
		$sql = "SELECT * FROM donhang WHERE thanhvien_id = ".$thanhvien_id;
		$rs = mysqli_query($conn,$sql) or die('Error query: '.mysqli_error($conn));
		$records = array();
		while($row = mysqli_fetch_array($rs)) {
			$record = new Entity();
			foreach($row as $key=>$value) {
				if (is_numeric($key)) continue;
				$record->$key = $value;
			}
			array_push($records,$record);
		}
		return $records;
	}

	function saveorder($table,ENTITY $data){
		global $conn;
		$data = $data->getAll();
        $fields = array();
        $values = array();
        foreach($data as $field=>$value) {
            $fields[] = $field;
            $values[] = $value;
        }
		$fields = implode(",",$fields);
		$values = implode("','",$values);
		$sql = "INSERT INTO {$table} ({$fields}) VALUE ('{$values}')";
		print($sql);
		$rs = mysqli_query($conn,$sql);
			if ($rs){
				$id =  mysqli_insert_id($conn);
				return $id;
			}
			else
				print "Error!".mysqli_error($conn);
			// return true;
		}
}