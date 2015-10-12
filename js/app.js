var myApp = angular.module("sliderApp",['ngRoute','bootstrapLightbox']);
myApp.config(function($routeProvider)
{
	$routeProvider
	.when('/slider',
	{
	templateUrl:'templates/sliderForm.html',
	controller:'formController'
	})
	.when('/slider_image',
	{
	templateUrl:'templates/templateurl.html',
	controller:'slider_imageController'
	})
});
myApp.controller("formController", function($scope,$http)
{
	 $scope.stepsModel = [];
	   $scope.path1 = [];

		$scope.imageUpload = function(event){
         var files = event.target.files; //FileList object
    	console.log(files);

  $scope.file = [];
angular.forEach(files ,function(value, key){

	$scope.file.push(value.name);
	}, $scope.file);

         for (var i = 0; i < files.length; i++) {
             var file = files[i];

                 var reader = new FileReader();
                 reader.onload = $scope.imageIsLoaded; 
                 var path=reader.readAsDataURL(file);

         }

    }

    $scope.imageIsLoaded = function(e){
        $scope.$apply(function() {
            $scope.stepsModel.push(e.target.result);
			$scope.path1.push(e.target.result);

        });
    }

	$scope.url = "api/submit.php";
	$scope.submitImage=function()
	{

	$http.post($scope.url,{
		"noImages" : $scope.images,
		"file":$scope.file,
		"path":$scope.path1
			}).success(function(data,status){
		$scope.data=data;
		$scope.status=status;
		$scope.result=data;
		location.href="#/slider_image";
	});

	}

});

myApp.controller("slider_imageController", function($scope,$http,Lightbox) {
    $scope.myInterval = 1000;
    $http.get("api/getImages.php").success(function (data) {
        $scope.status=status;
        $scope.result = [];

        var ix = 0;
        for (ix; ix < data.length; ix++) {
            temp = {
                url: '/mnt/backup/home/ssipolya/public_html/Angular Js/image_slider/js/image/' + data[ix];
            }
            $scope.result.push(temp);
        }

        $scope.openLightboxModal = function (index) {
            Lightbox.openModal($scope.result, index);
        });
    });
});
