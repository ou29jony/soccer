'use strict';
var app = angular
  .module('soccerApp');
app.factory('Result', ['$rootScope','$resource', 'APIConfig', function ($rootScope, $resource,APIConfig) {
  return $resource(
    APIConfig.url + '/result/:id',
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
app.factory('ResultLoader', [ 'Result','$q','Service', function (Result, $q,Service) {
  function ResultLoader(route) {
    if (route) {
      if (route.params.id) {
        this.id = route.params.id;
      }
      this.filterpath = route.originalPath.replace('/', '');
    }
    this.result = [];
    this.busy = false;
    this.page = 1;
    this.totalpages = 0;
    this.isfirstload = true;
    this.isloaded = false;
    this.adminid = false;
  }
  ResultLoader.prototype.getResult = function (page) {
    var defered = $q.defer();
    var self=this;
    if(page >0 ){
      console.log(page,'page');
    Result.query({ 'page': page},
      function (response) {Service.resultpage_count = response.page_count;
        Result.result=response;
        var arr =[];
        var res = response._embedded.result;
        for(var i=0; i < res.length;i++){
          if(Service.result[res[i].scteamsid]==undefined){
            Service.result[res[i].scteamsid]={};
          }
          Service.result[res[i].scteamsid]=res[i];
        }
        self.result = Service.result;
        self.isloaded = true;
        defered.resolve(Service.result);
      },
      function (data, headers) {
        defered.reject(data);
      }, self);
  }else{
      defered.resolve(Service.result);
    }

    return defered.promise;
  };
  return (ResultLoader);
}]);

