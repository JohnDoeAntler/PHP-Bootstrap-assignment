<?php
	require_once("crud/crud.php");
	
	$method = $_SERVER['REQUEST_METHOD'];
	
	switch ($method) 
	{
		case 'PUT':
			update("part", $_REQUEST);
			break;
		case 'POST':
			create("part", $_REQUEST);
			break;
		case 'GET':
			read("part", $_REQUEST);
			break;
	}
?>