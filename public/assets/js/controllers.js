var crunzUi = angular.module('CrunzUi');

crunzUi.controller('CrunzUiController', function ($scope) {

    $scope.actions    = window.actions;
    $scope.csrf_token = window.csrf_token;

});
