<?php
	require_once("crud/crud.php");
	
	$method = $_SERVER['REQUEST_METHOD'];
	
	switch ($method) 
	{
		case 'PUT':
			update("Administrator", $_REQUEST);
			break;
		case 'POST':
			create("Administrator", $_REQUEST);
			break;
		case 'GET':
			read("Administrator", $_REQUEST);
			break;
	}
?>