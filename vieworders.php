<?php
	session_start();

	if (!isset($_SESSION["role"]))
	{
		header("location: login.html");
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

    <!-- custom font -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>

<body ng-app="app" ng-controller="controller">
    <div ng-include="'template/navbar.php'"></div>

    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h1 class="display-3">Order List</h1>

                <table class="table table-striped">
                    <thead>
                        <tr>
							<th ng-click="sortData('orderID')" style="cursor: pointer;">
                                Order ID
                                <i class="fas fa-angle-up ml-3" ng-if="sortColumn == 'orderID' && reverseSort"></i>
                                <i class="fas fa-angle-down ml-3" ng-if="sortColumn == 'orderID' && !reverseSort"></i>
                            </th>
							
							<?php if ($_SESSION["role"] == "admin") { ?>

                            <th ng-click="sortData('dealerID')" style="cursor: pointer;">
                                Dealer ID
                                <i class="fas fa-angle-up ml-3" ng-if="sortColumn == 'dealerID' && reverseSort"></i>
                                <i class="fas fa-angle-down ml-3" ng-if="sortColumn == 'dealerID' && !reverseSort"></i>
                            </th>

							<th ng-click="sortData('name')" style="cursor: pointer;">
                                Dealer Name
                                <i class="fas fa-angle-up ml-3" ng-if="sortColumn == 'name' && reverseSort"></i>
                                <i class="fas fa-angle-down ml-3" ng-if="sortColumn == 'name' && !reverseSort"></i>
                            </th>

							<?php } ?>

                            <th ng-click="sortData('orderDate')" style="cursor: pointer;">
                                Order Date
                                <i class="fas fa-angle-up ml-3" ng-if="sortColumn == 'orderDate' && reverseSort"></i>
                                <i class="fas fa-angle-down ml-3" ng-if="sortColumn == 'orderDate' && !reverseSort"></i>
                            </th>

                            <th ng-click="sortData('deliveryAddress')" style="cursor: pointer;">
                                Address
                                <i class="fas fa-angle-up ml-3" ng-if="sortColumn == 'deliveryAddress' && reverseSort"></i>
                                <i class="fas fa-angle-down ml-3" ng-if="sortColumn == 'deliveryAddress' && !reverseSort"></i>
                            </th>

                            <th ng-click="sortData('status')" style="cursor: pointer;">
                                Status
                                <i class="fas fa-angle-up ml-3" ng-if="sortColumn == 'status' && reverseSort"></i>
                                <i class="fas fa-angle-down ml-3" ng-if="sortColumn == 'status' && !reverseSort"></i>
                            </th>

                            <th ng-click="sortData('totalPrice')" style="cursor: pointer;">
                                Total Price
                                <i class="fas fa-angle-up ml-3" ng-if="sortColumn == 'totalPrice' && reverseSort"></i>
                                <i class="fas fa-angle-down ml-3" ng-if="sortColumn == 'totalPrice' && !reverseSort"></i>
                            </th>

                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="order in orders | orderBy:sortColumn:reverseSort">
                            <th scope="row">{{order.orderID}}</th>
							
							<?php if ($_SESSION["role"] == "admin") { ?>

                            <td>{{order.dealerID}}</td>
							<td>{{order.name}}</td>

							<?php } ?>

                            <td>{{order.orderDate}}</td>
                            <td>{{order.deliveryAddress}}</td>
                            <td ng-switch on="order.status">
                                <p ng-switch-when="0">In-processing</p>
                                <p ng-switch-when="1">Delivery</p>
                                <p ng-switch-when="2">Completed</p>
                                <p ng-switch-when="3">Cancelled</p>
                            </td>
                            <td>{{order.totalPrice | currency}}</td>
                            <td>
                                <button type="button" class="btn btn-light" data-toggle="modal"
                                    data-target="#viewmodal" ng-click="selectedOrder(order.orderID)">View</button>
				
								<?php if ($_SESSION["role"] == "admin") { ?>

                                <button type="button" class="btn btn-light" data-toggle="modal"
                                    data-target="#delivermodal" ng-click="selectedOrder(order.orderID)">Deliver</button>
		
								<?php } else { ?>

                                <button type="button" class="btn btn-light" data-toggle="modal"
                                    data-target="#modifymodal" ng-click="selectedOrder(order.orderID)">Modify</button>

                                <button type="button" class="btn btn-light" data-toggle="modal"
									data-target="#completemodal" ng-click="selectedOrder(order.orderID)">Complete</button>
									
								<?php } ?>

                                <button type="button" class="btn btn-light" data-toggle="modal"
                                    data-target="#cancelmodal" ng-click="selectedOrder(order.orderID)">Cancel</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="viewmodal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you confirm to view selected order?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a ng-href="vieworder.php?orderID={{selectedOrderID}}">
                        <button type="button" class="btn btn-primary">View</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
				
	<?php if ($_SESSION["role"] == "admin") { ?>

    <!-- Modal -->
    <div class="modal fade" id="delivermodal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you confirm to deliver selected order?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" ng-click="deliver()" data-dismiss="modal">Deliver</button>
                </div>
            </div>
        </div>
	</div>
		
	<?php } else { ?>
	
    <!-- Modal -->
    <div class="modal fade" id="modifymodal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        Are you confirm to cancel selected order?
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a ng-href="modifyorder.php?orderID={{selectedOrderID}}">
                        <button type="button" class="btn btn-primary">Modify</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="completemodal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you confirm to complete selected order?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" ng-click="complete()" data-dismiss="modal">Complete</button>
                </div>
            </div>
        </div>
    </div>
		
	<?php } ?>

    <!-- Modal -->
    <div class="modal fade" id="cancelmodal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you confirm to cancel selected order?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" ng-click="cancel()" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
	</div>

    <!-- angular js -->
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
	
	<script>
		var app = angular.module("app", []);

		app.controller("controller", ($scope, $http) =>
		{			
            $http.get("api/orders.php<?php if ($_SESSION["role"] == "dealer") echo "?dealerID=".$_SESSION["username"]; ?>").then(response => $scope.orders = response.data);

            $scope.selectedOrder = (orderID) => $scope.selectedOrderID = orderID;

			$scope.deliver = () => {
                // if the order status is in pending stage.
                if ($scope.orders.filter(x => x.orderID == $scope.selectedOrderID)[0].status == 0){
                    // update the status to delivery
                    $http.put(`api/order.php?orderID=${$scope.selectedOrderID}&status=1`);
                    // real time update the ui interface
                    $scope.orders.filter(x => x.orderID == $scope.selectedOrderID)[0].status = 1;

                    // remove the stock quantity that the order purchased.
                    $http.get(`api/orderpart.php?orderID=${$scope.selectedOrderID}`).then(response => {
                        response.data.forEach(x => {
                            $http.put(`api/part.php?partNumber=${x.partNumber}&stockQuantity=!stockQuantity-${x.quantity}`);
                        });
                    });
                }else {
                    alert("You are not permitted to delivery a non-in-progressing order.");
                }
			}

            $scope.complete = () => {
                // if the order status is in delivery stage.
                if ($scope.orders.filter(x => x.orderID == $scope.selectedOrderID)[0].status == 1){
                    $http.put(`api/order.php?orderID=${$scope.selectedOrderID}&status=2`);
                    $scope.orders.filter(x => x.orderID == $scope.selectedOrderID)[0].status = 2;
                } else {
                    alert("You are not permitted to complete a non-delivery order.");
                }
            }

            $scope.cancel = () => {
                // if the order status is in pending stage.
                if ($scope.orders.filter(x => x.orderID == $scope.selectedOrderID)[0].status == 0){
                    $http.put(`api/order.php?orderID=${$scope.selectedOrderID}&status=3`);
                    $scope.orders.filter(x => x.orderID == $scope.selectedOrderID)[0].status = 3;
                } else {
                    alert("You are not permitted to cancel a non-in-progressing order.");
                }
            }

            // sorting

            $scope.sortColumn = "orderID";
            $scope.reverseSort = false;

            $scope.sortData = function (column) {
                $scope.reverseSort = ($scope.sortColumn == column) ? !$scope.reverseSort : false;
                $scope.sortColumn = column;
            }
		});
	</script>
</body>

</html>