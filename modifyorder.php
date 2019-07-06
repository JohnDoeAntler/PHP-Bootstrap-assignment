<?php
	session_start();
	if (!isset($_SESSION["role"])){
		header("location: login.html");
	}else if (!isset($_GET["orderID"]) || $_SESSION["role"] == "admin"){
		header("location: vieworders.php");
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modify Order Page</title>

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
                <h1 class="display-3">Modify Order</h1>

                <form name="form">
                    <table id="orderpart" class="table">
                        <caption>Ordered Items</caption>
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th style="width: 100px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="orderpart in orderparts">
                                <td scope="row">{{orderpart.product.partName}}</td>
                                <td>{{orderpart.quantity}}</td>
                                <td>{{orderpart.quantity * orderpart.product.stockPrice | currency}}</td>
                                <td>
                                    <button type="button" class="btn btn-light" ng-click="removerow($index)">Remove</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
    
                    <div class="form-group">
                        <label for="product">Select Product</label>
                        <select class="custom-select" name="product" id="product" ng-model="product">
                            <option ng-repeat="p in parts">{{p.partName}}</option>
                        </select>
                    </div>
    
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="text" class="form-control" name="quantity" id="quantity" aria-describedby="helpId"
                            placeholder="Quantity" ng-model="quantity">
                        <small id="helpId" class="form-text text-muted">Enter the order item quantity here.</small>
                    </div>
    
                    <button type="button" class="btn btn-light" ng-click="addrow()">Add product into order</button>
    
                    <div class="form-group my-5">
                        <label for="address">Delivery Address</label>
                        <input type="text" class="form-control" name="address" id="address" aria-describedby="helpId"
                            placeholder="Delivery Address" ng-model="address">
                        <small id="helpId" class="form-text text-muted">Enter the delivery address here.</small>
                    </div>
    
                    <p>
                        Total price: {{total() | currency}}
                    </p>
    
                    <button type="button" class="btn btn-light mb-5" ng-click="submit()">Modify Order</button>
                </form>
            </div>
        </div>
    </div>

    <!-- angular js -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>

    <script>
        var app = angular.module('app', []);

        app.controller('controller', function ($scope, $http) 
        {
			$http.get("api/part.php").then(response =>
			{
                $scope.parts = response.data;                

				$http.get("api/orderpart.php?orderID=<?php echo $_GET['orderID'] ?>").then(response =>
				{
                    $scope.orderparts = response.data.map(function(orderpart)
                    {
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

				$scope.address = order.deliveryAddress;	
			});

            $scope.addrow = () => {
                if ($scope.product != null && $scope.quantity != null)
                {
                    if (!$scope.orderparts.some(x => x.product == $scope.parts.filter(x => $scope.product == x.partName)[0]))
                    {
                        $scope.orderparts.push(
                            {
                                product: $scope.parts.filter(x => $scope.product == x.partName)[0],
                                quantity: $scope.quantity
                            }
                        );
                    }
                }
            }

            $scope.removerow = ($index) => {
                $scope.orderparts.splice($index, 1);
            }

            $scope.total = () => $scope.orderparts.map(x => x.product.stockPrice * x.quantity).reduce((a, b) => a + b, 0);

            $scope.submit = () => 
            {
                if (document.forms.form.reportValidity()){                    
                    // if orderpart count > 0
                    if ($scope.orderparts.length > 0){
                        // 0. “In processing”: The order was made
                        // 1. “Delivery”: The parts are delivering to the dealer
                        // 2. “Completed”: The dealer received the parts ordered
                        // 3. “Canceled”: The order is canceled by administrator

                        $http.put(`api/order.php?orderID=<?php echo $_GET["orderID"] ?>&deliveryAddress=${$scope.address}`).then((response) =>
                        {
                            $http.delete(`api/orderpart.php?orderID=<?php echo $_GET["orderID"] ?>`);

                            $scope.orderparts.forEach(orderpart => 
                            {
                                $http.post(`api/orderpart.php?orderID=<?php echo $_GET["orderID"] ?>&partNumber=${orderpart.product.partNumber}&quantity=${orderpart.quantity}`).then(response =>{
                                    window.location.assign(`vieworder.php?orderID=${orderID}`);
                                });
                            });
                        });
                    }else {
                        alert("No any single ordered parts has been found.");
                    }
                }
            }
        });
    </script>
</body>
</html>