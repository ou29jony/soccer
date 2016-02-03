'use strict';
var app = angular
  .module('soccerApp');
app.factory('APIConfig',['$rootScope', function($rootScope) {
  var sharedService = {};
  sharedService = {
    'access_token':'',
    'refresh_token': '',
    'url': 'http://api.dabuladze.php53.srdev.net'
  };
  return sharedService;
}]);


