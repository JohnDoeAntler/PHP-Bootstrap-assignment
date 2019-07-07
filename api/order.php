<?php
	require_once("crud/crud.php");
	
	$method = $_SERVER['REQUEST_METHOD'];
	
	switch ($method) 
	{
		case 'PUT':
			update("order", $_REQUEST);
			break;
		case 'POST':
			create("order", $_REQUEST);
			break;
		case 'GET':
			read("order", $_REQUEST);
			break;
	}
?>