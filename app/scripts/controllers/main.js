'use strict';

/**
 * @ngdoc function
 * @name soccerApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the soccerApp
 */
var app = angular.module('soccerApp');
app
  .controller('MainCtrl', ['$scope', '$q', 'Soccerteam', 'Against', 'SoccerteamLoader', 'AgainstLoader', 'Team1Loader', 'Team2Loader', 'ResultLoader', '$route', 'Service',
    function ($scope, $q, Soccerteam, Against, SoccerteamLoader, AgainstLoader, Team1Loader, Team2Loader, ResultLoader, $route, Service) {
      $scope.soccerteam = new SoccerteamLoader($route.current);
      $scope.against = new AgainstLoader($route.current);
      $scope.team1 = new Team1Loader($route.current);
      $scope.team2 = new Team2Loader($route.current);
      $scope.result = new ResultLoader($route.current);
      $scope.page = Service.page;
      $scope.prognosis = Service.prognosis;
      $scope.alltable =false;
      $scope.firstid = $scope.soccerteam.firstid;
      $scope.page_count = $scope.soccerteam.page_count;
      $scope.soccerteamstable = $scope.soccerteam.soccerteam;
      $scope.resulttable = $scope.result.result;
      $scope.againsttable = $scope.against.against;
      $scope.team2isloaded =false;
      $scope.team1isloaded =false;
      $scope.truevalue  = Service.truevalue;
      $scope.falsevalue = Service.falsevalue;

      $scope.setValue=function(value,r,p){

        $scope.obj = {};

        if( Service.result!== undefined && Service.result[value]!==undefined){
          $scope.obj.rf = Service.result[value].result.split(':')[0];
          $scope.obj.rs = Service.result[value].result.split(':')[1];
          if(Service.prognosis[value] !== undefined){
            $scope.obj.pt1 = Service.prognosis[value].team1;
            $scope.obj.pt2 = Service.prognosis[value].team2;
          }
        }


        return $scope.obj;
      };
      $scope.setTrue = function (q) {


        angular.forEach(Service.prognosis,function(value,index){


        });
      };
      $scope.setResult=function(){
        var promise4 = $scope.result.getResult();
        promise4.then(function(v){
          $scope.resulttable=v;
          Service.resulttable=v;

        });
      };
      $scope.setPage = function (number) {
        if (($scope.page + number) > 0 && ($scope.page + number) <= $scope.soccerteam.page_count) {
          $scope.page = $scope.page + number;
          Service.page = $scope.page;
        }
      };
      $scope.getSoccerteam = function (page) {
        var defered = $q.defer();
        $scope.soccerteam.getSoccerteam(page).then(function (response) {
        //  $scope.page_count = response.page_count;
          defered.resolve(response);
        });
        return defered.promise;
      };
      $scope.getAgainst = function (id) {
        var defered = $q.defer();
        $scope.against.getAgainst(id).then(function (response) {
          defered.resolve(response);
        });
        return defered.promise;
      };
      $scope.getTeam1 = function (id) {
        var defered = $q.defer();
        $scope.team1.getTeam1(id).then(function (response) {
          defered.resolve(response);
        });
        return defered.promise;
      };
      $scope.getTeam2 = function (id) {
        var defered = $q.defer();
        $scope.team2.getTeam2(id).then(function (response) {
          defered.resolve(response);
        });
        return defered.promise;
      };
      $scope.getResult = function (page) {
        var maxpage =0;
        var defered = $q.defer();
        if(Service.resultpage_count ) {
          maxpage = Service.resultpage_count ;
          page = maxpage-page+1;
        }

        $scope.result.getResult(page).then(function (response) {
          Service.result = response ;
          $scope.resulttable = Service.result;
          console.log(Service.result,'Service.resulttable');
          defered.resolve(response);
        });
        return defered.promise;
      };
      $scope.algo = function (team1, team2, id) {

        var point1=0, point2=0, oldpoint1=0, oldpoint2=0,pt1=0,pt2=0,against1=0,against2= 0,ag1= 0,ag2=0;

        if (team1.points !== 0) {
          point1 = team1.points * 100 / (team1.points + team2.points);
        } else {
          point1 = 0;
        }
        if (team2.points !== 0) {
          point2 = team2.points * 100 / (team1.points + team2.points);
        } else {
          point2 = 0;
        }

        if (team1.oldpoints !== 0) {
          oldpoint1 = team1.oldpoints * 100 / (team1.oldpoints + team2.oldpoints);
        } else {
          oldpoint1 = 0;
        }
        if (team2.oldpoints !== 0) {
          var oldpoint2 = team2.oldpoints * 100 / (team1.oldpoints + team2.oldpoints);
        } else {
          oldpoint2 = 0;
        }

        angular.forEach(Service.against[id],function(value,index){
          var result = value.result.split(':');
          if(result[0] > result[1]){
            if(value.team1===team1.name) {
              against1 = against1 + 2;
              if (result[0] - result[1] > 1) {
                against1 = against1 + 1;
              }
            }
            if(value.team1===team2.name) {
              against2 = against2 + 2;
              if (result[0] - result[1] > 1) {
                against2 = against2 + 1;
              }
            }
          }else {
            if (result[0] < result[1]) {
              if(value.team2===team2.name){
                against2=against2+3;
                if(result[2] - result[0] > 1){
                  against2 =   against2+1;
                }
              }
              if(value.team2===team1.name){
                against1=against1+3;
                if(result[2] - result[0] > 1){
                  against1 =   against1+1;
                }
              }

            }
            if(result[0] === result[1]){
              if(value.team1 == team1.name){
                against1=against1+1;
                against2=against2+2;
              }
              if(value.team1 == team2.name){
                against2=against2+1;
                against1=against1+2;
              }
            }
          }
        });


        if(against1 !==0 ){
          ag1 = against1*100/(against1 + against2);
        }
        if(against2 !== 0 ){
         ag2 = against2*100/(against1 + against2);
       }

        if( point1 !== 0 || oldpoint1 !== 0 ){
          pt1 = (point1 + oldpoint1)*3/10 ;
          if( ag1 !== 0){
            pt1 = pt1 + ag1*4/10;
          }
          pt1  = Math.round(pt1);
        }else{
          pt1 =0;
        }
        if( point2 !==0 || oldpoint2 !== 0) {
          pt2 = (point2 + oldpoint2)*3/10 ;
          if( ag2 !== 0){
            pt2 = pt2 + ag2*4/10;
          }
          pt2 = Math.round(pt2);
        }else{
          pt2 = 0;
        }

        $scope.prognosis[id] = {'team1': pt1, 'team2': pt2};
        Service.prognosis = $scope.prognosis;

      };
      $scope.abs = function(num) {
        return Math.abs(num);
      };
      $scope.loadfirst = function (page) {
       //  var promise4 = $scope.getResult(page);
        var promise1 = $scope.soccerteam.getSoccerteam(page);
        $q.all([promise1]).then(function (Soccerteam){
         $scope.soccerteamstable = Soccerteam[0];
          var tema1ids =  [$scope.soccerteamstable[0].team1id,$scope.soccerteamstable[Soccerteam[0].length-1].team1id];
          var tema2ids =  [$scope.soccerteamstable[0].team2id,$scope.soccerteamstable[Soccerteam[0].length-1].team2id];
          var promise2 = $scope.team1.getTeam1(tema1ids);
         var promise3 = $scope.team2.getTeam2(tema2ids);

          $q.all([promise2, promise3]).then(function (all){
           $scope.team1table = all[0];
           $scope.team2table=all[1];

           var against = $scope.getAgainst($scope.soccerteamstable[0].id);
          against.then(function(v){
            $scope.againsttable = v;
            angular.forEach(Service.soccerteamstable, function (value) {
              var team1 =  $scope.team1table[value.team1id];
              var team2 =  $scope.team2table[value.team2id];
              if(team1!== undefined && team2!==undefined ){
                $scope.algo(team1, team2,value.id);
              }
            });
          });
          });
        });
      };
    }]);

app.filter('ordinari', function () {
  return function(input,char){
    if(input > 65){
      var char = input;

      return char;
    }

  }
});
