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

                <form>
                    <table id="orderpart" class="table">
                        <caption>Ordered Items</caption>
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th style="width: 100px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="orderpart in orderparts">
                                <td scope="row">{{orderpart.product.partName}}</td>
                                <td>{{orderpart.quantity}}</td>
                                <td>
                                    <button type="button" class="btn btn-light" ng-click="removerow($index)">Remove</button>
                                </td>

                                <input type="hidden" name="orderpart[]" value="{{orderpart}}">
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
                            placeholder="Delivery Address">
                        <small id="helpId" class="form-text text-muted">Enter the delivery address here.</small>
                    </div>
    
                    <p>
                        Total price: ${{total()}}
                    </p>
    
                    <button type="submit" class="btn btn-light mb-5">Place order</button>
                </form>
            </div>
        </div>
    </div>

    <!-- angular js -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>

    <script>
        var app = angular.module('app', []);

        app.controller('controller', function ($scope) 
        {
            $scope.parts = 
            [
                {
                    partName: "Whatever",
                    stockPrice: 8.5
                },
                {
                    partName: "Toilet",
                    stockPrice: 5
                }
            ];

            $scope.orderparts = 
            [
                {
                    product: $scope.parts[0],
                    quantity : 4
                },
                {
                    product: $scope.parts[1],
                    quantity : 5
                }
            ];

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

            $scope.total = () =>
            {
                return $scope.orderparts.map(x => x.product.stockPrice * x.quantity).reduce((a, b) => a + b, 0);
            }
        });
    </script>
</body>
</html>