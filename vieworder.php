<?php
	session_start();
	if (!isset($_SESSION["role"])){
		header("location: login.html");
	}else if (!isset($_GET["orderID"])){
		header("location: vieworders.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index Page</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Default CSS file -->
    <link rel="stylesheet" href="css/default.css">
</head>
<body ng-app="app" ng-controller="controller">
    <div ng-include="'template/navbar.php'"></div>

    <div class="container mt-5">
        <div class="row">
            <div class="col">
				<h1 class="display-3">View Order</h1>
				
				<?php if ($_SESSION["role"] == "admin") { ?>
					
				<div class="form-group">
				  <label for="dealerId">Dealer ID</label>
				  <input type="text" class="form-control" name="dealerId" id="dealerId" placeholder="Dealer ID" ng-model="dealerID" readonly>
				</div>

				<?php } ?>

                <table class="table">
                    <caption>Ordered Items</caption>
                    <thead>
                        <tr>
                            <th>Product Name</th>
							<th>Quantity</th>
							<th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
						<tr ng-repeat="orderpart in orderparts">
							<td scope="row">{{orderpart.product.partName}}</td>
							<td>{{orderpart.quantity}}</td>
							<td>{{orderpart.product.stockPrice * orderpart.quantity | currency}}</td>
						</tr>
                    </tbody>
                </table>

                <div class="form-group mt-5">
                  <label for="address">Delivery Address</label>
                  <input type="text" class="form-control" name="address" id="address" aria-describedby="helpId" placeholder="Delivery Address" ng-model="address" readonly>
				</div>

				<div class="form-group">
				  <label for="date">Date</label>
				  <input type="text" class="form-control" name="date" id="date" aria-describedby="helpId" placeholder="Date" value="03/05/2019" ng-model="timestamp" readonly>
				</div>

                <p>
                    Total price: {{total() | currency}}
                </p>
            </div>
        </div>
    </div>

    <!-- angular js -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>

	<script>
		var app = angular.module("app", []);

		app.controller("controller", ($scope, $http) =>
		{
			$http.get("api/part.php").then(response =>
			{
				$scope.parts = response.data;

				$http.get("api/orderpart.php?orderID=<?php echo $_GET['orderID'] ?>").then(response =>
				{
					$scope.orderparts = response.data.map(function(orderpart){
						return {
							product: $scope.parts.filter(x => x.partNumber === orderpart.partNumber)[0],
							quantity: orderpart.quantity
						};
					});
				});
			});

			$http.get("api/order.php?orderID=<?php echo $_GET['orderID'] ?>").then(response =>
			{
				let order = response.data[0];

				$scope.dealerID = order.dealerID;
				$scope.address = order.deliveryAddress;
				$scope.timestamp = order.orderDate;				
			});

			$scope.total = () => !!!$scope.orderparts ? 0 : $scope.orderparts.map(x => x.product.stockPrice * x.quantity).reduce((a, b) => a + b, 0);
		});
	</script>
</body>
</html>