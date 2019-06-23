<?php
	require_once("connection.php");

	session_start();

	$username = $_POST['username'];
	$password = $_POST['password'];

	if (isset($username) && isset($password))
	{
		$admin = $conn->query("SELECT * FROM administrator WHERE email='$username' AND password='$password';");

		if ($admin->num_rows > 0)
		{
			$row = $admin->fetch_assoc();

			$_SESSION['username'] = $username;

			$_SESSION['role'] = "admin";
		} 
		else
		{
			$dealer = $conn->query("SELECT * FROM dealer WHERE dealerID='$username' AND password='$password';");

			if ($dealer->num_rows > 0)
			{
				$row = $dealer->fetch_assoc();
	
				$_SESSION['username'] = $username;

				$_SESSION['role'] = "dealer";
			}
		}
	
		$conn->close();

		if (isset($_SESSION['role']))
		{
			header("location: profile.php");
		}
		else
		{
			die("on9");
		}
	}
?>