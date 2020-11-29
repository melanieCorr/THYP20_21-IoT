var app = angular.module('myApp', []);
app.controller('customersCtrl', function($scope, $http, $interval) {
   $http.get("./get_data.php")
   .then(function (response) {$scope.reading = response.data;});
   $http.get("./get_avg_data.php")
   .then(function (response) {$scope.average = response.data;});
   $interval(function(){
		$http.get("./get_data.php")
	   	.then(function (response) {$scope.reading = response.data;});
	   $http.get("./get_avg_data.php")
	   .then(function (response) {$scope.average = response.data;});
	},5000);
});