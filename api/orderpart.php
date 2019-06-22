<?php
	require_once("crud/crud.php");
	
	$method = $_SERVER['REQUEST_METHOD'];
	
	switch ($method) 
	{
		case 'PUT':
			update("OrderPart", $_REQUEST);
			break;
		case 'POST':
			create("OrderPart", $_REQUEST);
			break;
		case 'GET':
			read("OrderPart", $_REQUEST);
			break;
	}
?>