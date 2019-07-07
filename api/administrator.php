<?php
	require_once("crud/crud.php");
	
	$method = $_SERVER['REQUEST_METHOD'];
	
	switch ($method) 
	{
		case 'PUT':
			update("administrator", $_REQUEST);
			break;
		case 'POST':
			create("administrator", $_REQUEST);
			break;
		case 'GET':
			read("administrator", $_REQUEST);
			break;
	}
?>