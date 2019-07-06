<?php
	session_start();
	if (!isset($_SESSION["role"])){
		header("location: login.html");
	}else if ($_SESSION["role"] != "admin"){
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
	
	<div class="container my-5">
		<div class="row">
			<div class="col">
				<h1 class="display-3">Add Part</h1>

				<form name="form">
					<div class="form-group">
					  <label for="name">Product Name</label>
					  <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="Name" ng-model="partName" required>
					  <small id="helpId" class="form-text text-muted">Enter your product name here.</small>
					</div>

					<div class="form-group">
					  <label for="price">Price</label>
					  <input type="text" class="form-control" name="price" id="price" aria-describedby="helpId" placeholder="Price" ng-model="stockPrice" required>
					  <small id="helpId" class="form-text text-muted">Enter the price here.</small>
					</div>

					<div class="form-group">
					  <label for="quantity">Quantity</label>
					  <input type="number" class="form-control" name="quantity" id="quantity" aria-describedby="helpId" placeholder="Quantity" ng-model="stockQuantity" required>
					  <small id="helpId" class="form-text text-muted">Enter the quantity here.</small>
					</div>

					<button type="button" class="btn btn-light" data-toggle="modal" data-target="#editmodal">Add part</button>
				</form>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Confirmation</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
				</div>
				<div class="modal-body">
					Are you confirm to add part?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" ng-click="add()" data-dismiss="modal">Add Part</button>
				</div>
			</div>
		</div>
	</div>

    <!-- angular js -->
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
	
	<script>
		var app = angular.module("app", []);
		app.controller("controller", ($scope, $http) => {
			$scope.add = () => {
				if (document.forms.form.reportValidity())
				{
					$http.post(`api/part.php?partName=${$scope.partName}&stockQuantity=${$scope.stockQuantity}&stockPrice=${$scope.stockPrice}&stockStatus=1&email=<?php echo $_SESSION["username"]?>`).then(
						function (response)
						{
							window.location.assign(`viewparts.php`);
						}
					);
				}
			}
		});
	</script>
</body>
</html>