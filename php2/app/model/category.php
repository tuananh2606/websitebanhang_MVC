<?php
require_once("connection.php");
require_once("model.php");
class Category extends Model
{
    function __construct($table_name='') {
		parent::__construct($table_name);
	}
}
?>