<?php
	function create($table, $args=null)
	{
		require_once("../connection.php");

		$header = "";
		$value = "";

		if (isset($args))
		{
			$headers = array();
			$values = array();

			foreach ($args as $key => $val)
			{
				$headers[] = $key;
				$values[] = "'$val'";
			}

			$header = implode(", ", $headers);
			$value = implode(", ", $values);
		}

		print ($conn->query("INSERT INTO `$table` ($header) VALUES ($value);") ? "true" : "false");

		$conn->close();
	}

	function read($table, $args=null)
	{
		require_once("../connection.php");

		$str = "";

		if (isset($args))
		{
			$index = 0;
			
			foreach ($args as $key => $val)
			{
				if ($index == 0)
				{
					$str .= "WHERE $key = '$val'";
				}
				else 
				{
					$str .= "AND $key = '$val'";
				}

				$index++;
			}
		}

		$result = $conn->query("SELECT * FROM `$table` $str;");

		$rows = array();
		
		while ($row = mysqli_fetch_assoc($result))
		{
			if (isset($row["password"]))
			{
				unset($row["password"]);
			}
			$rows[] = $row;
		}

		print json_encode($rows);

		$conn->close();
	}

	function update($table, $args=null)
	{
		session_start();

		require_once("../connection.php");

		$modifications = "";
		$condition = "";

		if (isset($args))
		{
			$index = 0;
			foreach ($args as $key => $val)
			{
				// SELECT FIRST ARG AS CONDITION
				if ($index == 0)
				{
					$condition = "$key = '$val'";
				}
				else if (empty($modifications))
				{
					$modifications .= "$key = '$val'";
				}
				else
				{
					$modifications .= ", $key = '$val'";
				}

				// update session password.
				if ($key == "password")
				{
					$_SESSION['password'] = $val;
				}

				$index++;
			}
		}

		print ($conn->query("UPDATE `$table` SET $modifications WHERE $condition") ? "true" : "false");

		$conn->close();
	}
?>