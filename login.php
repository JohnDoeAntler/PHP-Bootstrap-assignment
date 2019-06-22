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
			$_SESSION['password'] = $password;
			
			$_SESSION['email'] = $username;
			$_SESSION['firstName'] = $row['firstName'];
			$_SESSION['lastName'] = $row['lastName'];
			$_SESSION['role'] = "admin";
		} 
		else
		{
			$dealer = $conn->query("SELECT * FROM dealer WHERE dealerID='$username' AND password='$password';");

			if ($dealer->num_rows > 0)
			{
				$row = $dealer->fetch_assoc();
	
				$_SESSION['username'] = $username;
				$_SESSION['password'] = $password;

				$_SESSION['dealerID'] = $username;
				$_SESSION['name'] = $row['name'];
				$_SESSION['phoneNumber'] = $row['phoneNumber'];
				$_SESSION['address'] = $row['address'];
				$_SESSION['role'] = "dealer";
			}
		}
	
		$conn->close();

		if (isset($_SESSION['role']))
		{
			header("location: profile_a.html");
		}
		else
		{
			die("on9");
		}
	}
?>