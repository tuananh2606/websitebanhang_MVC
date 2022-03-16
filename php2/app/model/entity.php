<?php 
class Entity {
	var $data = array();
	function __get($field) {
		return $this->data[$field];
	}
	function __set($field, $value) {
		$this->data[$field] = $value;
	}
    function getAll() {
		return $this->data;
	}
}
?>