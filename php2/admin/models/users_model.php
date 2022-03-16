<?php 
require_once('model.php');
require_once(ROOTDIR.'/connection.php');
class USERMODEL extends MODEL
{
	
	function __construct($table_name='')
	{
		parent::__construct($table_name);
	}
}