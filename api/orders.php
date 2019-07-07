<?php 
	require_once("../connection.php");

	$str = "";

	if (isset($_GET["dealerID"])){
		$str = "AND d.dealerID = '".$_GET["dealerID"]."'";
	}

	$result = $conn->query("SELECT *, SUM(p.stockPrice * op.quantity) AS 'totalPrice' FROM `order` o, `orderpart` op, `part` p, `dealer` d WHERE o.orderID = op.orderID AND op.partNumber = p.partNumber AND d.dealerID = o.dealerID $str GROUP BY o.orderID;");
	
	$rows = array();
	
	while ($row = mysqli_fetch_assoc($result))
	{
		$rows[] = $row;
	}

	print json_encode($rows, JSON_NUMERIC_CHECK);

	$conn->close();
?>