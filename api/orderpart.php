<?php
	require_once("crud/crud.php");
	
	$method = $_SERVER['REQUEST_METHOD'];
	
	switch ($method) 
	{
		case 'PUT':
			update("orderpart", $_REQUEST);
			break;
		case 'POST':
			create("orderpart", $_REQUEST);
			break;
		case 'GET':
			read("orderpart", $_REQUEST);
			break;
		case 'DELETE':
			delete("orderpart", $_REQUEST);
			break;
	}
?>