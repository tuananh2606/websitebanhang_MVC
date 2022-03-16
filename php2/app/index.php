<?php
	define("ROOTDIR", substr(__FILE__,0,strlen(__FILE__)-strlen('index.php')-1));
	$controller = filter_input(INPUT_GET,"controller");
	if (empty($controller)) $controller = "index";
	
	
	$controller_name = $controller . "_controller";
	require_once("./controllers/{$controller_name}.php");
	$controllerObj = new $controller_name();
	$controllerObj->run();

?>