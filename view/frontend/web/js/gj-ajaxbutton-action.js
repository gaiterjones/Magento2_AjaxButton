define([
    'jquery'
], function($){
    "use strict";
    function main(config, element) {
        var $element = $(element),
            AjaxUrl = config.AjaxUrl,
            AjaxData = config.AjaxData,
            AjaxButtonId = config.AjaxButtonId;
            $("#gj-ajaxbutton-wrapper-" + AjaxButtonId).on("click", ".gj-ajaxbutton", function () {
                event.preventDefault();
                    $.ajax({
                        context: '#gj-ajaxbutton-wrapper-' + AjaxButtonId,
                        url: AjaxUrl,
                        data: {ajaxdata:AjaxData},
                        type: "POST",
                        beforeSend: function () {
                            $('#gj-ajaxbutton-wrapper-' + AjaxButtonId).trigger('processStart');
                        }
                    }).done(function (response) {
                        $(this).trigger('processStop');
                        if (typeof response.output.html !== 'undefined')
                        {
                            $(this).html(response.output.html);
                            // cart update!
                            require('Magento_Customer/js/customer-data').reload();

                        } else {
                            $(this).html('Error - no data returned!');
                        }
                        return true;
                    });
            });

    };
    return main;
});
