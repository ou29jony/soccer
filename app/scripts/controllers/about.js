'use strict';

/**
 * @ngdoc function
 * @name soccerApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the soccerApp
 */

angular.module('soccerApp')
  .controller('AboutCtrl', function ($scope) {
    $scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
  });

