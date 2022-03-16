<?php 
class ENTITY {
	private $data;
		
	function __construct() {
		$data = array();
		/*
			id 		=> 1
			title 	=> 'Lap trinh PHP'
			author  => 'Michael'
			description => 'Gioi thieu cach lap trinh php'
		*/
	}
	function __get($field) {
		return $this->data[$field];
	}
	function __set($field,$value) {
		$this->data[$field] = $value;		
	}
	function getAll() {
		return $this->data;
	}
}
/*
$book = new ENTITY(); //stdclass();
$book->id = 1;
$book->title = 'Lap trinh PHP';
$book->author  = 'Michael';
$book->description = 'Gioi thieu cach lap trinh php';

$model->insert($book);

print '<pre>';
var_dump($book);
$rs = mysql_query("SELECT * FROM book");
$books = array();
$i=0;
while($row = mysql_fetch_array($rs)) {
	$books[$i] = new ENTITY(); 
		$books[$i]->id	  = $row['id']; 
		$books[$i]->title = $row['title']; 
	$i++;
}
//Display books in view.php;	
var_dump($books);
*/
?>