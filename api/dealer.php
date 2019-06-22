<?php
	require_once("crud/crud.php");
	
	$method = $_SERVER['REQUEST_METHOD'];
	
	switch ($method) 
	{
		case 'PUT':
			update("Dealer", $_REQUEST);
			break;
		case 'POST':
			create("Dealer", $_REQUEST);
			break;
		case 'GET':
			read("Dealer", $_REQUEST);
			break;
	}
?>