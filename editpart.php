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
<body ng-app="">
	<div ng-include="'template/navbar.php'"></div>
	
	<div class="container my-5">
		<div class="row">
			<div class="col">
				<h1 class="display-3">Edit Part</h1>

				<form>
					<div class="form-group">
					  <label for="name">Product Name</label>
					  <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="Name" value="Whatever">
					  <small id="helpId" class="form-text text-muted">Enter your product name here.</small>
					</div>

					<div class="form-group">
					  <label for="price">Price</label>
					  <input type="number" class="form-control" name="price" id="price" aria-describedby="helpId" placeholder="Price" value="8.5">
					  <small id="helpId" class="form-text text-muted">Enter the price here.</small>
					</div>

					<div class="form-group">
					  <label for="quantity">Quantity</label>
					  <input type="text" class="form-control" name="quantity" id="quantity" aria-describedby="helpId" placeholder="Quantity" value="30">
					  <small id="helpId" class="form-text text-muted">Enter the quantity here.</small>
					</div>

					<div class="form-group">
						<label for="status">Status</label>
						<select class="custom-select" name="status" id="status">
							<option selected>Available</option>
							<option>Unavailable</option>
						</select>
					</div>

					<button type="submit" class="btn btn-light">Edit part</button>
				</form>
			</div>
		</div>
	</div>

    <!-- angular js -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
</body>
</html>