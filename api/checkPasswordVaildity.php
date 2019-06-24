<?php

	session_start();

	if (isset($_GET["password"]) && $_SESSION["password"] == $_GET["password"]){
		echo "true";
	}else {
		echo "false";
	}

?>