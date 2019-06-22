<?php
	require_once("crud/crud.php");
	
	$method = $_SERVER['REQUEST_METHOD'];
	
	switch ($method) 
	{
		case 'PUT':
			update("Order", $_REQUEST);
			break;
		case 'POST':
			create("Order", $_REQUEST);
			break;
		case 'GET':
			read("Order", $_REQUEST);
			break;
	}
?>