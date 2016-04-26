angular.module('ccbApp', ["isteven-multi-select"], function($interpolateProvider) {
    $interpolateProvider.startSymbol('%');
    $interpolateProvider.endSymbol('%');
}).controller('ApplicationController', ['$scope', '$http', '$element', function($scope, $http, $element) {
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


    $scope.showCategory = function(){
        $http.get("/category")
            .then(
            function (response) {

                $scope.category = response.data;

            },
            function (error) {
                $scope.error1 = JSON.stringify(error);
            }
        )
    }


    $scope.saveCategory = function() {
        console.log('the data must save', $scope.selected_category);
        var selectedCategory = $scope.selected_category;

        for (var i = 0; i < selectedCategory.length; ++i) {
            $http.post("/set-category/" + selectedCategory[i].code).then(function(response) {
                console.log("res", response);
            });
              
        }
       
    }



    $scope.filterReport = function() {
        var agencies = "";
        var regions = "";
        var provinces = "";
        var category = "";

        angular.forEach($scope.selected_agencies, function(value, key) {
            agencies = agencies + value.code  + ";";
        });

        angular.forEach($scope.selected_regions, function(value, key) {
            regions = regions + value.code  + ";";
        });

        angular.forEach($scope.selected_provinces, function(value, key) {
            provinces = provinces + value.code  + ";";
        });
        angular.forEach($scope.selected_category, function(value, key) {
            category = category + value.code  + ";";
        });
        console.log(category);
        
        $scope.agency_input = agencies;
        $scope.region_input = regions;
        $scope.province_input = provinces;
        $scope.province_input = category;
        $('#startDate').val($('#reportrange').data('daterangepicker').startDate.format('YYYY-MM-DD'));
        $('#endDate').val($('#reportrange').data('daterangepicker').endDate.format('YYYY-MM-DD'));

    }
    
    $scope.agencies = $scope.showAllAgencies();
    $scope.regions = $scope.showRegions();
    $scope.provinces = $scope.showProvinces();
    $scope.category = $scope.showCategory();

    

    $scope.resetDirective = function(e) {
        // reset data;
        var item = {};
        for (var i = 0; i < $scope.category.length; ++i) {
            item = $scope.category[i];
            item.ticked = false;
        }
  
    }


}]);