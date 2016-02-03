'use strict';

/**
 * @ngdoc overview
 * @name soccerApp
 * @description
 * # soccerApp
 *
 * Main module of the application.
 */
angular
  .module('soccerApp', [
    'ngRoute',
    'ngResource'
  ])
  .config(function ($routeProvider) {
    $routeProvider
      .when('/', {
        templateUrl: 'views/main.html',
        controller: 'MainCtrl'
      }) .when('/pages/:page', {
        url:'/pages/:page',
        templateUrl: 'views/pages.html',
        controller: 'MainCtrl'
      })
      .when('/about', {
        templateUrl: 'views/about.html',
        controller: 'AboutCtrl'
      })
      .otherwise({
        redirectTo: '/'
      });
  });
