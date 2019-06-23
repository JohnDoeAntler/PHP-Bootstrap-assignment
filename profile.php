<?php
	session_start();

	if (!isset($_SESSION["role"])){
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

	<div class="d-flex h-75">
		<div class="container my-auto">
			<div class="row justify-content-center align-items-center">
				<div class="col-10">
					<div class="container">
						<div class="row">
							<div class="col-5 h-100">
								<div class="card shadow">
									<div class="p-2">
										<img class="card-img-top" src="image/account.png" alt="">
									</div>

									<div class="card-body">
										<h4 class="card-title">
											<?php echo ($_SESSION["role"] == "admin" ? "{{firstName + \" \" + lastName}}" : "{{name}}") ?>
										</h4>
										<p class="card-text">Role:
											<?php echo ($_SESSION["role"] == "admin" ? "Administrator" : "Dealer") ?>
										</p>

										<hr>

										<a href="editprofile.php">
											<button type="button" class="btn btn-info w-100">Edit profile</button>
										</a>
									</div>
								</div>
							</div>

							<div class="col-7">
								<div class="card shadow">
									<div class="card-body">
										<h1 class="display-3">Profile</h1>

										<?php if ($_SESSION["role"] == "admin") {?>

										<form>
											<div class="form-group">
												<label for="email">Email</label>
												<input type="email" class="form-control" name="email" id="email"
													aria-describedby="emailHelpId" placeholder="Email" value="{{email}}" disabled
													required>
											</div>

											<div class="form-group">
												<label for="firstname">First Name</label>
												<input type="text" class="form-control" name="firstname" id="firstname"
													aria-describedby="helpId" placeholder="First Name" value="{{firstName}}" disabled required>
											</div>

											<div class="form-group">
												<label for="lastname">Last Name</label>
												<input type="text" class="form-control" name="lastname" id="lastname"
													aria-describedby="helpId" placeholder="Last Name" value="{{lastName}}" disabled required>
											</div>
										</form>
										
										<?php } else { ?>

										<form>
											<div class="form-group">
												<label for="name">Name</label>
												<input type="text" class="form-control" name="name" id="name"
													aria-describedby="helpId" placeholder="Name"
													value="{{name}}"
													disabled required>
											</div>

											<div class="form-group">
												<label for="phone">Phone Number</label>
												<input type="text" class="form-control" name="phone" id="phone"
													aria-describedby="helpId" placeholder="Phone Number"
													pattern="^\d{5,15}$" value="{{phoneNumber}}"
													disabled required>
											</div>

											<div class="form-group">
												<label for="address">Address</label>
												<textarea class="form-control" name="address" id="address" rows="3"
													disabled required>{{address}}</textarea>
											</div>
										</form>

										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- angular js -->
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>

	<script>
		var app = angular.module("app", []);

		app.controller("controller", ($scope, $http) => {
			if ("<?php echo $_SESSION["role"] ?>" === "admin"){
				$http.get("api/administrator.php?email=<?php echo $_SESSION["username"] ?>").then(
					(response) =>
					{
						$scope.email = response.data[0].email;
						$scope.firstName = response.data[0].firstName;
						$scope.lastName = response.data[0].lastName;
					}
				);
			}else {
				$http.get("api/dealer.php?dealerID=<?php echo $_SESSION["username"] ?>").then(
					(response) =>
					{
						$scope.name = response.data[0].name;
						$scope.phoneNumber = response.data[0].phoneNumber;
						$scope.address = response.data[0].address;
					}
				);
			}
		});
	</script>
</body>

</html>