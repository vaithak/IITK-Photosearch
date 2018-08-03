var photoSearchApp = angular.module('photo-search',[]);

photoSearchApp.controller("photoSearchController",['$scope', '$http', function($scope,$http){
  $scope.results = [];
  $scope.resultsNumber = $scope.results.length;
  $scope.getImageResults = function(data) {

      $http({
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        url: "requestImage.php",
        data: data
      }).then(function(response){
        $scope.results = response['data']['images'][0]['candidates'];
        $scope.check = response;
        $http.get('../assets/data.json').then(function(response){
            $scope.students = response.data;
            $scope.filteredResults = [];

            $scope.results.forEach(function(result){
              $scope.students.forEach(function(student){
                if(student['i'] && student['u'])
                {
                  if(result['subject_id'].includes(student['i']) || result['subject_id'].includes(student['u']))
                  {

                    if($scope.filteredResults.indexOf(student) === -1)
                    {
                      $scope.filteredResults.push(student);
                    }

                  }
                }
              });
            });

            $scope.resultsNumber = $scope.filteredResults.length;
        });
      });

    };

}]);
