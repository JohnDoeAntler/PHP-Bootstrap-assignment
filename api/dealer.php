<?php
	require_once("crud/crud.php");
	
	$method = $_SERVER['REQUEST_METHOD'];
	
	switch ($method) 
	{
		case 'PUT':
			update("dealer", $_REQUEST);
			break;
		case 'POST':
			create("dealer", $_REQUEST);
			break;
		case 'GET':
			read("dealer", $_REQUEST);
			break;
	}
?>