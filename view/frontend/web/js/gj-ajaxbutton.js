define([
    'jquery',
    'Magento_Catalog/js/catalog-add-to-cart'
], function($){
    "use strict";
    function main(config, element) {
        var $element = $(element),
            AjaxUrl = config.AjaxUrl,
            AjaxData = config.AjaxData,
            AjaxButtonId = config.AjaxButtonId;
            $.ajax({
                context: '#gj-ajaxbutton-wrapper-' + AjaxButtonId,
                url: AjaxUrl,
                type: "POST",
                data: {ajaxdata:AjaxData}
            }).done(function (data) {
                
                $(this).html(data.output);
                if($("form[data-role=tocart-form]").length > 0) {
                    $("form[data-role=tocart-form]").catalogAddToCart();
                }

                if($("#customproduct").length > 0) {
                    $("#gj-ajaxbutton-wrapper-" + AjaxButtonId).on("submit", "#customproduct", function () {
                      setTimeout(function(){
                          $.when($('#customproduct form').fadeOut(400))
                           .then(function(){
                              $('#customproduct').html('<span><i style="color: green; font-size: 24px;">&#10004;</i></span>');
                           });
                      }, 2000)
                    });
                }

                return true;
            });
    };
    return main;
});
