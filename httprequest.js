 angular.module('starter.services')
.factory('progressService', function($ionicLoading) {

  //-----------------------------------------------
  //Show and hide progress indicator for loading actions

  var service = {
    showLoader: function(text) {
      if (!text) text = '<ion-spinner icon="spiral"></ion-spinner>';
      $ionicLoading.show({template: text});
    },

    hideLoader: function() {
      $ionicLoading.hide();
    }
  };

  return service;
});

