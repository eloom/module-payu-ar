define(["Eloom_Payment/js/cash"],function(a){return a.extend({defaults:{template:"Eloom_PayUAr/payment/pagofacil-form",code:"eloom_payments_payu_pagofacil"},initialize:function(){this._super()},isActive:function(){return!0},isInSandboxMode:function(){return window.checkoutConfig.payment.eloom_payments_payu.isInSandboxMode},isTransactionInTestMode:function(){return window.checkoutConfig.payment.eloom_payments_payu.isTransactionInTestMode},getLogoUrl:function(){return window.checkoutConfig.payment.eloom_payments_payu.url.logo}})});
