'use strict';
var app = angular
  .module('soccerApp');
app.factory('Team1', ['$rootScope','$resource', 'APIConfig', function ($rootScope, $resource,APIConfig) {
  return $resource(
    APIConfig.url + '/team1/:t1id',
    {t1id: '@t1id'},
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
app.factory('Team1Loader', [ 'Team1','$q','Service', function (Team1, $q,Service) {
  function Team1Loader(route) {
    if (route) {
      if (route.params.id) {
        this.id = route.params.id;
      }
      this.filterpath = route.originalPath.replace('/', '');
    }
    this.team1 = [];
    this.busy = false;
    this.page = 1;
    this.totalpages = 0;
    this.isfirstload = true;
    this.isloaded = false;
    this.adminid = false;
  }

  Team1Loader.prototype.getTeam1 = function (page) {
    var defered = $q.defer();
    var self = this;
    Team1.query({'searchfrom':page[0],'searchto':page[1]},
      function (response) {
        var arr = [];
        var res = response._embedded.team1;
        for(var i = 0;i < res.length;i++ ){
          arr[res[i].t1id] = res[i];
        }
        self.isloaded=true;
        self.team1 = arr;
        Service.team1 = arr;
        defered.resolve(arr);
      },
      function (data, headers) {
        defered.reject(data);

      }, self);
    return defered.promise;
  };
  return (Team1Loader);

}]);

