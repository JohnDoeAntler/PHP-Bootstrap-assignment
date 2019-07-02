<?php 
	require_once("../connection.php");

	$result = $conn->query("SELECT *, SUM(p.stockPrice * op.quantity) AS 'totalPrice' FROM `order` o, `orderpart` op, `part` p, `dealer` d WHERE o.orderID = op.orderID AND op.partNumber = p.partNumber AND d.dealerID = o.dealerID GROUP BY o.orderID;");

	$rows = array();
	
	while ($row = mysqli_fetch_assoc($result))
	{
		$rows[] = $row;
	}

	print json_encode($rows);

	$conn->close();
?>