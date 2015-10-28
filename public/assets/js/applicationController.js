angular.module('ccbApp', ["isteven-multi-select"], function($interpolateProvider) {
    $interpolateProvider.startSymbol('%');
    $interpolateProvider.endSymbol('%');
}).controller('ApplicationController', ['$scope', '$http', function($scope, $http) {
	$scope.showAllAgencies = function() {
        $http.get("/agencies")
            .then(
            function (response) {

                $scope.agencies = response.data;

            },
            function (error) {
                $scope.error1 = JSON.stringify(error);
            }
        )
    }

    $scope.showRegions = function(){
    	$http.get("/regions")
            .then(
            function (response) {

                $scope.regions = response.data;

            },
            function (error) {
                $scope.error1 = JSON.stringify(error);
            }
        )
    }

    $scope.showProvinces = function(){
    	$http.get("/provinces")
            .then(
            function (response) {

                $scope.provinces = response.data;

            },
            function (error) {
                $scope.error1 = JSON.stringify(error);
            }
        )
    }

    $scope.filterReport = function() {
        var agencies = "";
        var regions = "";
        var provinces = "";

        angular.forEach($scope.selected_agencies, function(value, key) {
            agencies = agencies + value.code  + ";";
        });

        angular.forEach($scope.selected_regions, function(value, key) {
            regions = regions + value.code  + ";";
        });

        angular.forEach($scope.selected_provinces, function(value, key) {
            provinces = provinces + value.code  + ";";
        });
        
        $scope.agency_input = agencies;
        $scope.region_input = regions;
        $scope.province_input = provinces;
        $('#startDate').val($('#reportrange').data('daterangepicker').startDate.format('YYYY-MM-DD'));
        $('#endDate').val($('#reportrange').data('daterangepicker').endDate.format('YYYY-MM-DD'));

    }
    
    $scope.agencies = $scope.showAllAgencies();
    $scope.regions = $scope.showRegions();
    $scope.provinces = $scope.showProvinces();
}]);