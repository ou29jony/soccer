'use strict';
var app = angular
  .module('soccerApp');
app.service('Service', ['$rootScope','$resource', 'APIConfig', function ($rootScope, $resource,APIConfig) {
this.page_count=null;
  this.soccerteamstable=null;
  this.team1 = null;
  this.team2 = null;
  this.prognosis = [];
  this.page=1;
  this.against=null;
  this.result = [];
  this.resultpage_count =undefined;
  this.truevalue  =0;
  this.falsevalue =0;
return this;
}]);

