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
							<th>Order ID</th>
							
							<?php if ($_SESSION["role"] == "admin") { ?>

                            <th>Dealer ID</th>
							<th>Dealer Name</th>

							<?php } ?>

                            <th>Order Date</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Total Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="order in orders">
                            <th scope="row">{{order.orderID}}</th>
							
							<?php if ($_SESSION["role"] == "admin") { ?>

                            <td>{{order.dealerID}}</td>
							<td>{{order.name}}</td>

							<?php } ?>

                            <td>{{order.orderDate}}</td>
                            <td>{{order.deliveryAddress}}</td>
                            <td>{{order.status}}</td>
                            <td>{{order.totalPrice}}</td>
                            <td>
                                <button type="button" class="btn btn-light" data-toggle="modal"
                                    data-target="#viewmodal">View</button>
				
								<?php if ($_SESSION["role"] == "admin") { ?>

                                <button type="button" class="btn btn-light" data-toggle="modal"
                                    data-target="#delivermodal">Deliver</button>
		
								<?php } else { ?>

                                <button type="button" class="btn btn-light" data-toggle="modal"
                                    data-target="#modifymodal">Modify</button>
                                <button type="button" class="btn btn-light" data-toggle="modal"
									data-target="#completemodal">Complete</button>
									
								<?php } ?>

                                <button type="button" class="btn btn-light" data-toggle="modal"
                                    data-target="#cancelmodal">Cancel</button>
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
                    <a href="vieworder.php">
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
                    <button type="button" class="btn btn-primary">Deliver</button>
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
                    <a href="modifyorder.php">
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
                    <button type="button" class="btn btn-primary">Complete</button>
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
                    <button type="button" class="btn btn-primary">Cancel</button>
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
			$http.get("api/orders.php").then(response => $scope.orders = response.data);
		});
	</script>
</body>

</html>