app.controller('AdminController', function($scope,$http){

  $scope.pools = [];

});

app.controller('ClientController', function(dataFactory,$scope,$http){

  $scope.data = [];
  $scope.libraryTemp = {};
  $scope.totalClientsTemp = {};
    $scope.currentClient = -1;
  $scope.totalClients = 0;
  $scope.pageChanged = function(newPage) {
    getResultsPage(newPage);
  };

  getResultsPage(1);
  function getResultsPage(pageNumber) {
      if(! $.isEmptyObject($scope.libraryTemp)){
          dataFactory.httpRequest('/clients?search='+$scope.searchText+'&page='+pageNumber).then(function(data) {
            $scope.data = data.data;
            $scope.totalClients = data.total;
          });
      }else{
        dataFactory.httpRequest('/clients?page='+pageNumber).then(function(data) {
          $scope.data = data.data;
          $scope.totalClients = data.total;
        });
      }
  }

  $scope.searchDB = function(){
      if($scope.searchText.length >= 3){
          if($.isEmptyObject($scope.libraryTemp)){
              $scope.libraryTemp = $scope.data;
              $scope.totalClientsTemp = $scope.totalClients;
              $scope.data = {};
          }
          getResultsPage(1);
      }else{
          if(! $.isEmptyObject($scope.libraryTemp)){
              $scope.data = $scope.libraryTemp ;
              $scope.totalClients = $scope.totalClientsTemp;
              $scope.libraryTemp = {};
          }
      }
  }

  $scope.saveAdd = function(){
    dataFactory.httpRequest('clients','POST',{},$scope.form).then(function(data) {
      $scope.data.push(data);
      $(".modal").modal("hide");
    });
  }

  $scope.saveAddContact = function(){
      $scope.form.client_id = $scope.currentClient;
    dataFactory.httpRequest('contacts','POST',{},$scope.form).then(function(data) {
      $scope.data.push(data);
      $(".modal").modal("hide");
    });
  }

  $scope.edit = function(id){
    dataFactory.httpRequest('clients/'+id+'/edit').then(function(data) {
    	console.log(data);
      	$scope.form = data;
    });
  }

  $scope.show = function(id){
    dataFactory.httpRequest('clients/'+id+'/edit').then(function(data) {
    	console.log(data);
      	$scope.form = data;
    });

    dataFactory.httpRequest('contacts').then(function(data) {
    	console.log(data);
      	$scope.contacts = data;
    });
  }

  $scope.add = function(id){
    $scope.currentClient = id;
  }

  $scope.saveEdit = function(){
    dataFactory.httpRequest('clients/'+$scope.form.id,'PUT',{},$scope.form).then(function(data) {
      	$(".modal").modal("hide");
        $scope.data = apiModifyTable($scope.data,data.id,data);
    });
  }

  $scope.remove = function(client,index){
    var result = confirm("Are you sure delete this client?");
   	if (result) {
      dataFactory.httpRequest('clients/'+client.id,'DELETE').then(function(data) {
          $scope.data.splice(index,1);
      });
    }
  }

  $scope.removeContact = function(contact,index){
    var result = confirm("Are you sure delete this contact?");
   	if (result) {
      dataFactory.httpRequest('contacts/'+contact.id,'DELETE').then(function(data) {
          $scope.data.splice(index,1);
          $(".modal").modal("hide");
      });
    }
  }

});