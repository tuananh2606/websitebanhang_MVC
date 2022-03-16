<?php
require_once("model.php");
require_once("connection.php");
class Product extends Model
{
	function __construct($table_name='')
	{
		parent::__construct($table_name);
	}
	
	function ProductPage($numberRecordPerPage,$where = null)
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
	
	function getProduct($curPage,$numberRecordPerPage,$where = null)
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
	// function getProductById($MaSanPham){
	// 	$sql = "SELECT * FROM sanpham WHERE MaSanPham = ".$MaSanPham;
	// 	$poduct = array();
	// 	foreach($this->conn->query($sql) as $row){
	// 		$poduct = $row;
	// 	}
	// 	return $poduct;
	// }



}