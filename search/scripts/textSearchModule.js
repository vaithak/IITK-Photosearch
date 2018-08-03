var textSearchApp = angular.module('text-search',[]);

textSearchApp.directive('bufferedScroll', function ($parse) {
    return function ($scope, element, attrs) {
      var handler = $parse(attrs.bufferedScroll);
      element.scroll(function (evt) {
        var scrollTop    = element[0].scrollTop,
            scrollHeight = element[0].scrollHeight,
            offsetHeight = element[0].offsetHeight;


        if (scrollTop === (scrollHeight - offsetHeight)) {
          console.log("Hi");
          $scope.$apply(function () {
            handler($scope);
          });
        }
      });
    };
  });

textSearchApp.controller("textSearchController",['$scope', '$http', function($scope, $http){
  $scope.resultsNumber = 0;
  $scope.students = [];
  $scope.results = [];
  $scope.filteredResults = [];
  $scope.rawInput = "";

  $scope.increaseLimit = function () {
    if ($scope.limit < $scope.filteredResults.length) {
      $scope.limit += 15;
    }
  };

  // Retrieving data
  $http.get('../assets/data.json').then(function(response){
      $scope.students = response.data;

      // Keeping a watch on scope variables
      $scope.$watchGroup(['gender','year','bloodGroup','department','hall','rawInput','programme'], function (newValues, oldValues, scope) {

      // Filtering the students on the basis of inputs
      $scope.results = filterSearch($scope.students,newValues[0],newValues[1],newValues[2],newValues[3],newValues[4],newValues[5],newValues[6]);

      // Number of results
      $scope.resultsNumber = $scope.results.length;

      // Making array of subarrays to show
      $scope.filteredResults = showFilter($scope.results);

     }, true);

  });

}]);

// Making array of subarrays to show
function showFilter(results){
  var newArray = [];
  while (results.length > 0)
  {
    newArray.push(results.splice(0, 3));
  }
  return newArray;
}

// Filtering the students on the basis of inputs
function filterSearch(students, gender, year, bloodGroup, department, hall, rawInput, programme)
{
  var arr = [];
  var flag=0;

  // Gender check
  students.forEach(function(student){
    gender.forEach(function(g){
      if(student['g'] == g)
      {
        arr.push(student);
        flag=1;
      }
    });
  });

  // Year check
  if(arr.length==0)
  {

    if(flag==1)
    {
      return arr;
    }
    else
    {
      students.forEach(function(student){
        year.forEach(function(y){
          if(student['i'].slice(0,2) === y.slice(1,3))
          {
            arr.push(student);
            flag=1;
          }
        });
      });
    }

  }
  else
  {
    if(year.length)
    {
      var leftStud = arr;
      arr = [];
      leftStud.forEach(function(leftStudent){
        year.forEach(function(y){
          if(leftStudent['i'].slice(0,2) === y.slice(1,3))
          {
            arr.push(leftStudent);
            flag=1;
          }
        });
      });
    }

  }

  // bloodGroup check
  if(arr.length==0)
  {

    if(flag==1)
    {
      return arr;
    }
    else
    {
      students.forEach(function(student){
        bloodGroup.forEach(function(b){
          if(student['b'] == b)
          {
            arr.push(student);
            flag=1;
          }
        });
      });
    }

  }
  else
  {
    if(bloodGroup.length)
    {
      var leftStud = arr;
      arr = [];
      leftStud.forEach(function(leftStudent){
        bloodGroup.forEach(function(b){
          if(leftStudent['b'] == b)
          {
            arr.push(leftStudent);
            flag=1;
          }
        });
      });
    }

  }

  // Department Check
  if(arr.length==0)
  {

    if(flag==1)
    {
      return arr;
    }
    else
    {
      students.forEach(function(student){
        department.forEach(function(d){
          if(student['d'].slice(0,7) == d.slice(0,7))
          {
            arr.push(student);
            flag=1;
          }
        });
      });
    }

  }
  else
  {
    if(department.length)
    {
      var leftStud = arr;
      arr = [];
      leftStud.forEach(function(leftStudent){
        department.forEach(function(d){
          if(leftStudent['d'].slice(0,7) == d.slice(0,7))
          {
            arr.push(leftStudent);
            flag=1;
          }
        });
      });
    }

  }

  // hall check
  if(arr.length==0)
  {

    if(flag==1)
    {
      return arr;
    }
    else
    {
      students.forEach(function(student){
        hall.forEach(function(h){
          if(student['h'] == h)
          {
            arr.push(student);
            flag=1;
          }
        });
      });
    }

  }
  else
  {
    if(hall.length)
    {
      var leftStud = arr;
      arr = [];
      leftStud.forEach(function(leftStudent){
        hall.forEach(function(h){
          if(leftStudent['h'] == h)
          {
            arr.push(leftStudent);
            flag=1;
          }
        });
      });
    }
  }

  // programme check
  if(arr.length==0)
  {

    if(flag==1)
    {
      return arr;
    }
    else
    {
      students.forEach(function(student){
        programme.forEach(function(p){
          if(student['p'] == p)
          {
            arr.push(student);
            flag=1;
          }
        });
      });
    }

  }
  else
  {
    if(programme.length)
    {
      var leftStud = arr;
      arr = [];
      leftStud.forEach(function(leftStudent){
        programme.forEach(function(p){
          if(leftStudent['p'] == p)
          {
            arr.push(leftStudent);
            flag=1;
          }
        });
      });
    }

  }

  // rawInput check
  if(arr.length==0)
  {

    if(flag==1)
    {
      return arr;
    }
    else
    {
      if(rawInput!=="")
      {
        rawInput = rawInput.toLowerCase();
        students.forEach(function(student){

          if(student['i'].includes(rawInput) || (student['n'].toLowerCase().replace(/\s/g,'')).includes(rawInput.replace(/\s/g,'')) || student['u'].includes(rawInput))
          {
            arr.push(student);
            flag=1;
          }

        });
      }
    }

  }
  else
  {
    rawInput = rawInput.toLowerCase();
    if(rawInput !== "")
    {
      var leftStud = arr;
      arr = [];
      leftStud.forEach(function(leftStudent){

        if(leftStudent['n'].toLowerCase().replace(/\s+/g,'').includes(rawInput.replace(/\s+/g,'')) || leftStudent['i'].includes(rawInput) || leftStudent['u'].includes(rawInput))
        {
          arr.push(leftStudent);
          flag=1;
        }

      });
    }

  }

  return arr;
}
