<?php
	require_once("crud/crud.php");
	
	$method = $_SERVER['REQUEST_METHOD'];
	
	switch ($method) 
	{
		case 'PUT':
			update("Part", $_REQUEST);
			break;
		case 'POST':
			create("Part", $_REQUEST);
			break;
		case 'GET':
			read("Part", $_REQUEST);
			break;
	}
?>