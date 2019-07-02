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

    <div class="d-flex h-75">
        <!-- This page is dedicated for dealer registration. -->
        <div class="container my-auto">
            <div class="row justify-content-center align-items-center">
                <div class="col-8">
                    <div class="card shadow">
                        <div class="card-body">
                            <h1 class="display-3">Edit Profile</h1>

                            <form name="form">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-6">
                                            <?php if ($_SESSION["role"] == "admin"){ ?>

                                            <div class="form-group">
                                                <label for="username">Email</label>
                                                <input type="email" class="form-control" name="username" id="username"
                                                    aria-describedby="usernameHelpId" placeholder="Email" ng-model="email" readonly required>
                                                <small id="usernameHelpId" class="form-text text-muted">Please enter your email address.</small>
                                            </div>

                                            <?php } else { ?>

                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="text" class="form-control" name="username" id="username"
                                                    aria-describedby="usernameHelpId" placeholder="Username" ng-model="dealerID" readonly required>
                                                <small id="usernameHelpId" class="form-text text-muted">Please enter your username.</small>
                                            </div>

                                            <?php } ?>

                                            <div class="form-group">
                                                <label for="oldPassword">Old Password</label>
                                                <input type="password" class="form-control" name="oldPassword" id="oldPassword" placeholder="Old Password" minlength="8" maxlength="32" ng-model="oldPassword" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="newPassword">New Password</label>
                                                <input type="password" class="form-control" name="newPassword" id="newPassword" placeholder="New Password" minlength="8" maxlength="32" ng-model="newPassword">
                                            </div>

                                            <div class="form-group">
                                                <label for="confirm">Confirm Password</label>
                                                <input type="password" class="form-control" name="confirm" id="confirm" placeholder="Confirm Password" minlength="8" maxlength="32" ng-model="confirm">
                                            </div>

                                            <button type="button" class="btn btn-light w-100 mb-3" ng-click="saveChanges()">Save Changes</button>
                                        </div>

                                        <div class="col-6 border-left">
                                            <?php if ($_SESSION["role"] == "admin"){ ?>

                                            <div class="form-group">
                                                <label for="firstName">First Name</label>
                                                <input type="text" class="form-control" name="firstName" id="firstName"
                                                    aria-describedby="helpId" placeholder="Name" ng-model="firstName" required>
                                                <small id="helpId" class="form-text text-muted">Your name here.</small>
                                            </div>

                                            <div class="form-group">
                                                <label for="lastName">Last Name</label>
                                                <input type="text" class="form-control" name="lastName" id="lastName"
                                                    aria-describedby="helpId" placeholder="Name" ng-model="lastName" required>
                                                <small id="helpId" class="form-text text-muted">Your name here.</small>
                                            </div>

                                            <?php } else { ?>

                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" name="name" id="name"
                                                    aria-describedby="helpId" placeholder="Name" ng-model="name"
                                                    required>
                                                <small id="helpId" class="form-text text-muted">Your name here.</small>
                                            </div>

                                            <div class="form-group">
                                                <label for="phoneNumber">Phone Number</label>
                                                <input type="text" class="form-control" name="phoneNumber"
                                                    id="phoneNumber" aria-describedby="helpId"
                                                    placeholder="Phone Number" pattern="^\d{5,15}$" ng-model="phoneNumber"
                                                    required>
                                                <small id="helpId" class="form-text text-muted">Phone number
                                                    here.</small>
                                            </div>

                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <textarea class="form-control" name="address" id="address" rows="3" ng-model="address" required></textarea>
                                            </div>

                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </form>
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

                $scope.saveChanges = () => {
                    if (document.forms.form.reportValidity()){
                        if (!!!$scope.newPassword || $scope.newPassword == $scope.confirm){
                            $http.get(`api/checkPasswordVaildity.php?password=${$scope.oldPassword}`).then(
                                (response) => 
                                {
                                    if (response.data == "true"){
                                        var str = !!$scope.newPassword ? `&password=${$scope.newPassword}` : "";

                                        $http.put(`api/administrator.php?email=${$scope.email}${str}&firstName=${$scope.firstName}&lastName=${$scope.lastName}`).then(
                                            (response) => 
                                            {
                                                window.location.href = "profile.php";
                                            }
                                        );
                                    }
                                }
                            );
                        }
                    }
                }
			}else {
				$http.get("api/dealer.php?dealerID=<?php echo $_SESSION["username"] ?>").then(
					(response) =>
					{
                        $scope.dealerID = response.data[0].dealerID;
						$scope.name = response.data[0].name;
						$scope.phoneNumber = response.data[0].phoneNumber;
						$scope.address = response.data[0].address;
					}
				);

                $scope.saveChanges = () => {
                    if (document.forms.form.reportValidity()){
                        if (!!!$scope.newPassword || $scope.newPassword == $scope.confirm){
                            $http.get(`api/checkPasswordVaildity.php?password=${$scope.oldPassword}`).then(
                                (response) => 
                                {
                                    if (response.data == "true"){
                                        var str = !!$scope.newPassword ? `&password=${$scope.newPassword}` : "";
                                        
                                        $http.put(`api/dealer.php?dealerID=${$scope.dealerID}${str}&name=${$scope.name}&phoneNumber=${$scope.phoneNumber}&address=${$scope.address}`).then(
                                            (response) => 
                                            {
                                                window.location.href = "profile.php";
                                            }
                                        );
                                    }
                                }
                            );
                        }
                    }
                }
			}
        });
    </script>
</body>

</html>