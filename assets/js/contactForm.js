/**
 * Contact form scripts
 */
;$(function(){

	$("#submit_form").submit(function()
	{	
		var data = {};

		$(this).find('input, textarea').each(function(){
			data[$(this).data('title')] = this.value;
		});

		console.log(data);

		$.ajax({
			url: "/",
			method: 'POST',
			data: {
				params: {
					mail_data: data
				},
				method: 'sendEmail'
			},
            success: function(data)
            {
                alert('Thank you! Your message has been received, usually we respond within 24 hours.');
                window.location.reload();
            }
		});

		return false;
	});
});


(function($){

    $.fn.serializeObject = function ()
    {
        "use strict";

        var result = {};
        var extend = function (i, element) {
            var node = result[element.name];

    // If node with same name exists already, need to convert it to an array as it
    // is a multi-value field (i.e., checkboxes)

            if ('undefined' !== typeof node && node !== null) {
                if ($.isArray(node)) {
                    node.push(element.value);
                } else {
                    result[element.name] = [node, element.value];
                }
            } else {
                result[element.name] = element.value;
            }
        };

        $.each(this.serializeArray(), extend);
        return result;
    };
})(jQuery);