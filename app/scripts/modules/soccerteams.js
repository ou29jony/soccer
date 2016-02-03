'use strict';
var app = angular
  .module('soccerApp');
app.factory('Soccerteam', ['$rootScope','$resource', 'APIConfig', function ($rootScope, $resource,APIConfig) {
  return $resource(
    APIConfig.url + '/soccerteams/:id',
    {id: '@id'},
    {
      'query': {method: 'GET', isArray: false},
      'save': {method: 'POST', headers: {'Content-Type': 'application/json'}},
      'update': {method: 'PUT'},
      'setapproved': {method: 'PATCH'},
      'edit': {method: 'PATCH'},
      'delete': {'method': 'DELETE'}
    },
    {isArray: false}
  );
}]);
app.factory('SoccerteamLoader', [ 'Soccerteam','$q','Service', function (Soccerteam, $q,Service) {
  function SoccerteamLoader(route) {
    if (route) {
      if (route.params.id) {
        this.id = route.params.id;
      }
      this.filterpath = route.originalPath.replace('/', '');
    }
    this.bool =false;
    this.soccerteam = [];
    this.busy = false;
    this.page = 1;
    this.totalpages = 0;
    this.isfirstload = true;
    this.isloaded = false;
    this.adminid = false;
    this.page;
    this.firstid;
    this.obj = {};
  }
  SoccerteamLoader.prototype.getSoccerteam = function (page) {
    var defered = $q.defer();
    var self = this;
    Soccerteam.query({'page': page},
        function (response) {
          self.soccerteam = response._embedded.soccerteams;
          self.page_count =  response.page_count;
          self.firstid = self.soccerteam[0].id;
          Service.page_count =  response.page_count;
          Service.soccerteamstable = response._embedded.soccerteams;
          self.isloaded = true;
          defered.resolve(self.soccerteam);
        },
        function (data, headers) {
          defered.reject(data);
        }, self);
    return defered.promise;
  };
  return (SoccerteamLoader);
}]);

