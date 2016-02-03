'use strict';
var app = angular
  .module('soccerApp');

app.factory('Team2', ['$rootScope','$resource', 'APIConfig', function ($rootScope, $resource,APIConfig) {

  return $resource(
    APIConfig.url + '/team2/:t2id',
    {t2id: '@t2id'},
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
app.factory('Team2Loader', [ 'Team2','$q','Service', function (Team2, $q,Service) {
  function Team2Loader(route) {
    if (route) {
      if (route.params.id) {
        this.id = route.params.id;
      }
      this.filterpath = route.originalPath.replace('/', '');
    }
    this.team2 = [];
    this.busy = false;
    this.page = 1;
    this.totalpages = 0;
    this.isfirstload = true;
    this.isloaded = false;
    this.adminid = false;
  }
  Team2Loader.prototype.getTeam2 = function (page) {
    var defered = $q.defer();
    var self = this;
    Team2.query({ 'searchfrom':page[0],'searchto':page[1]},
      function (response) {
       var arr = [];
        var res = response._embedded.team2;
        for(var i = 0;i < res.length;i++ ){
          arr[res[i].t2id]=res[i];
        }
        self.isloaded =true;
        self.team2 = arr;
        Service.team2 = arr;
        defered.resolve(arr);
      },
      function (data, headers) {
        defered.reject(data);

      }, self);
    return defered.promise;
  };
  return (Team2Loader);

}]);

