'use strict';
var app = angular
  .module('soccerApp');
app.factory('Against', ['$rootScope','$resource', 'APIConfig', function ($rootScope, $resource,APIConfig) {
  return $resource(
    APIConfig.url + '/against/:aid',
    {aid: '@aid'},
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
app.factory('AgainstLoader', [ 'Against','$q','Service', function (Against, $q,Service) {
  this.againsttable=[];
  function AgainstLoader(route) {
    if (route) {
      if (route.params.id) {
        this.id = route.params.id;
      }
      this.filterpath = route.originalPath.replace('/', '');
    }
    this.against = [];
    this.busy = false;
    this.page = 1;
    this.totalpages = 0;
    this.isfirstload = true;
    this.isloaded = false;
    this.adminid = false;
  }

  AgainstLoader.prototype.getAgainst = function (scteamsid) {
    var defered = $q.defer();
    var self = this;
    Against.query({ 'search': scteamsid},
      function (response) {
        var arr = [];

        var res = response._embedded.against;
        for(var i = 0; i < res.length; i++ ){
          if(arr[res[i].scteamsid]== undefined){
            arr[res[i].scteamsid]=[];
          }
          arr[res[i].scteamsid].push(res[i]) ;
        }
        self.against =arr;
        self.isloaded=true;
        Service.against = arr;
        defered.resolve(arr);
        return defered.promise;
      },
      function (data, headers) {
        defered.reject(data);
        return defered.promise;
      }, self);
    return defered.promise;
  };
  return (AgainstLoader);
}]);

