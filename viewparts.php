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
			<div class="col-12">
				<h1 class="display-3">Part List</h1>

				<table class="table table-striped">
					<thead>
						<tr>
							<th ng-click="sortData('partNumber')" style="cursor: pointer;">
								Part Number
                                <i class="fas fa-angle-up ml-3" ng-if="sortColumn == 'partNumber' && reverseSort"></i>
                                <i class="fas fa-angle-down ml-3" ng-if="sortColumn == 'partNumber' && !reverseSort"></i>
							</th>

							<th ng-click="sortData('partName')" style="cursor: pointer;">
								Product Name
                                <i class="fas fa-angle-up ml-3" ng-if="sortColumn == 'partName' && reverseSort"></i>
                                <i class="fas fa-angle-down ml-3" ng-if="sortColumn == 'partName' && !reverseSort"></i>
							</th>

							<th ng-click="sortData('stockPrice')" style="cursor: pointer;">
								Price
                                <i class="fas fa-angle-up ml-3" ng-if="sortColumn == 'stockPrice' && reverseSort"></i>
                                <i class="fas fa-angle-down ml-3" ng-if="sortColumn == 'stockPrice' && !reverseSort"></i>
							</th>

							<th ng-click="sortData('stockQuantity')" style="cursor: pointer;">
								Remaining Stock
                                <i class="fas fa-angle-up ml-3" ng-if="sortColumn == 'stockQuantity' && reverseSort"></i>
                                <i class="fas fa-angle-down ml-3" ng-if="sortColumn == 'stockQuantity' && !reverseSort"></i>
							</th>

							<?php 
								if ($_SESSION['role'] == "admin"){
							?>
							<th ng-click="sortData('email')" style="cursor: pointer;">
								Last Modifier
                                <i class="fas fa-angle-up ml-3" ng-if="sortColumn == 'email' && reverseSort"></i>
                                <i class="fas fa-angle-down ml-3" ng-if="sortColumn == 'email' && !reverseSort"></i>
							</th>

							<th style="width: 190px;">
								Action
							</th>

							<?php } ?>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="part in parts | orderBy:sortColumn:reverseSort">
							<th scope="row">{{part.partNumber}}</th>
							<td>{{part.partName}}</td>
							<td>{{part.stockPrice | currency}}</td>
							<td>{{part.stockQuantity}}</td>

							<?php 
								if ($_SESSION['role'] == "admin"){
							?>

							<td>{{part.email}}</td>
							<td>
								<button type="button" class="btn btn-light" data-toggle="modal"
									data-target="#editmodal" ng-click="selectPart(part.partNumber)">Edit</button>
								<button type="button" class="btn btn-light" data-toggle="modal"
									data-target="#removemodal" ng-click="selectPart(part.partNumber)">Remove</button>
							</td>
							<?php } ?>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
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
					Are you confirm to edit the part?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<form action="editpart.php" method="POST">
						<input type="submit" class="btn btn-primary" value="Edit">
						<input type="hidden" name="partNumber" ng-value="selectedPartNumber">
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="removemodal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
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
						Are you confirm to remove the selected part?
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-danger" ng-click="remove()" data-dismiss="modal">Remove</button>
				</div>
			</div>
		</div>
	</div>

	<!-- angular js -->
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
	<script>
		var app = angular.module("app", []);
		
		app.controller("controller", ($scope, $http) => {
			$scope.parts = [];

			$http.get("api/part.php?stockStatus=1").then(
				function (response)
				{					
					response.data.forEach(x => {
						$scope.parts.push(x);
					});					
				}
			);

			$scope.selectPart = (partNumber) => {
				$scope.selectedPartNumber = partNumber;
			}

			$scope.remove = () => {
				$scope.parts = $scope.parts.filter(x => x.partNumber != $scope.selectedPartNumber);
				$http.put(`api/part.php?partNumber=${$scope.selectedPartNumber}&stockStatus=0`);
			}

			// sorting

			$scope.sortColumn = "partNumber";
			$scope.reverseSort = false;

			$scope.sortData = function (column) {
				$scope.reverseSort = ($scope.sortColumn == column) ? !$scope.reverseSort : false;
				$scope.sortColumn = column;
			}
		});
	</script>
</body>

</html>