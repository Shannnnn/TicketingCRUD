function apiModifyTable(originalData,id,response){
    angular.forEach(originalData, function (client,key) {
        if(client.id == id){
            originalData[key] = response;
        }
    });
    return originalData;
}