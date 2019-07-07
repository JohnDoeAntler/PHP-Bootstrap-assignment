<?php
	session_start();
	if (!isset($_SESSION["role"])){
		header("location: login.html");
	}else if ($_SESSION["role"] != "dealer"){
		header("location: profile.php");
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
                <h1 class="display-3">Place Order</h1>

                <form name="form">
                    <table id="orderpart" class="table">
                        <caption>Ordered Items</caption>
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th style="width: 100px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="orderpart in orderparts">
                                <td scope="row">{{orderpart.product.partName}}</td>
                                <td>{{orderpart.quantity}}</td>
                                <td>{{orderpart.product.stockPrice * orderpart.quantity | currency}}</td>
                                <td>
                                    <button type="button" class="btn btn-light" ng-click="removerow($index)">Remove</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
    
                    <div class="form-group">
                        <label for="product">Select Product</label>
                        <select class="custom-select" name="product" id="product" ng-model="product">
                            <option ng-repeat="p in parts" selected>{{p.partName}}</option>
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
                            placeholder="Delivery Address" ng-model="address" required>
                        <small id="helpId" class="form-text text-muted">Enter the delivery address here.</small>
                    </div>
    
                    <p>
                        Total price: {{total() | currency}}
                    </p>
    
                    <button type="button" class="btn btn-light mb-5" data-toggle="modal" data-target="#modelId">Place Order</button>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    Are you sure to place an order?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" ng-click="submit()" data-dismiss="modal">Place Order</button>
                </div>
            </div>
        </div>
    </div>

    <!-- angular js -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>

    <script>
        var app = angular.module('app', []);

        app.controller('controller', ($scope, $http) => 
        {
            $scope.parts = [];

            $http.get("api/part.php?stockStatus=1").then(response =>
            {
                $scope.parts = response.data;
            });

            $scope.orderparts = [];

            $scope.addrow = () => {
                if ($scope.product != null && $scope.quantity != null && $scope.quantity > 0)
                {
                    if (!$scope.orderparts.some(x => x.product == $scope.parts.filter(x => $scope.product == x.partName)[0]))
                    {
                        $scope.orderparts.push(
                            {
                                product: $scope.parts.filter(x => $scope.product == x.partName)[0],
                                quantity: $scope.quantity,
                            }
                        );
                    }
                }
            }

            $scope.removerow = ($index) => {
                $scope.orderparts.splice($index, 1);
            }

            $scope.total = () => !!!$scope.orderparts ? 0 : $scope.orderparts.map(x => x.product.stockPrice * x.quantity).reduce((a, b) => a + b, 0);

            $scope.submit = () =>
            {
                if (document.forms.form.reportValidity()){                    
                    // if orderpart count > 0
                    if ($scope.orderparts.length > 0){
                        // 0. “In processing”: The order was made
                        // 1. “Delivery”: The parts are delivering to the dealer
                        // 2. “Completed”: The dealer received the parts ordered
                        // 3. “Canceled”: The order is canceled by administrator

                        $http.post(`api/order.php?dealerID=<?php echo $_SESSION['username'] ?>&deliveryAddress=${$scope.address}&status=0`).then((response) =>
                        {                    
                            $http.get(`api/order.php?dealerID=<?php echo $_SESSION['username'] ?>`).then(response =>
                            {
                                let orderID = Math.max(...response.data.map(x => x.orderID));

                                $scope.orderparts.forEach(orderpart => {
                                    $http.post(`api/orderpart.php?orderID=${orderID}&partNumber=${orderpart.product.partNumber}&quantity=${orderpart.quantity}`);
                                });

                                window.location.assign(`vieworder.php?orderID=${orderID}`);
                            })
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