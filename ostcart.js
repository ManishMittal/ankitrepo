angular.module('starter.services')
.factory('ostcartService', function($rootScope) {
  'use strict';
	
  $rootScope.ostCart = [];
  var service = {
    addToCart: function (product) {

	  var prodInCart = false;
	  $rootScope.ostCart.forEach(function(prod, index){
		if (prod.id === product.id) {  prodInCart = prod;	  return; }
	  });

	  if (prodInCart) {
		service.addOneProduct(prodInCart);
	  } else {

		var tpro = {id:product.id,quantity:product.quantity};
		tpro.purchaseQuantity = 0;
		tpro.realQty = product.quantity;
		service.addOneProduct(tpro);
		$rootScope.ostCart.push(tpro);
	  }
    },
	 addOneProduct: function (product) {
		--product.quantity;
		++product.purchaseQuantity;

		if(product.quantity<=0){
			angular.element(document.querySelector('#cartbtn_'+product.id)).addClass("ng-hide");
			angular.element(document.querySelector('#nostock_'+product.id)).removeClass("ng-hide");
		}
    },
	 removeOneProduct: function (product) {
		$rootScope.ostCart.forEach(function(prod, index){
			if (prod.id === product.model) {
			  ++prod.quantity;
			  --prod.purchaseQuantity;
			}
		});
    },
	 setRemove: function (product) {
		$rootScope.ostCart.forEach(function(prod, index){
			if (prod.id === product.model) {
			  prod.quantity=prod.realQty;
			  prod.purchaseQuantity=0;
			}
		});
		 
    },
	 remvoeProduct(product){
			$rootScope.ostCart.forEach(function(prod, i){
				if (product.id === prod.id) {
				  $rootScope.ostCart.splice(i, 1);
				}
			});
	},
	 checkProductAvailability:function(){
		   console.log($rootScope.ostCart);
			$rootScope.ostCart.forEach(function(prod, i){
				if (prod.quantity<=0) {
				    angular.element(document.querySelector('#cartbtn_'+prod.id)).addClass("ng-hide");
					angular.element(document.querySelector('#nostock_'+prod.id)).removeClass("ng-hide");
				}else{
					angular.element(document.querySelector('#cartbtn_'+prod.id)).removeClass("ng-hide");
					angular.element(document.querySelector('#nostock_'+prod.id)).addClass("ng-hide");
				}
			});
	}
  };

  return service;
});


//waze