jQuery(function($)
{
	$(".delete_btn").click(function()
	{
		if(confirm('Delete current item?'))
		{
			return true;
		}else{
			return false;
		}
	});

	setTimeout(function()
	{
		if(window.location.href.indexOf("upload.php?paged=") != -1)
		{
			return false;
			jQuery("#bulk-action-selector-top").val("applywatermark");
			jQuery("#cb-select-all-1").click();

			if(parseInt(localStorage.getItem("watermarkPage")) == parseInt(jQuery("#current-page-selector").val()))
			{
				window.location.href = jQuery(".tablenav-pages a.next-page").attr("href");
			}else{
				if(parseInt(localStorage.getItem("watermarkPage")) < parseInt(jQuery("#current-page-selector").val()))
				{
					var log = $("<div>").css({    "line-height": "90px","position":"fixed","z-index":10, "top": 40, "right":40, "width":"300px","color":"red", background:"white", "font-size":"80px", "height": 200}).html("WORK ON " + parseInt(jQuery("#current-page-selector").val()))
					
					$("#wpbody-content").append(log);
					localStorage.setItem("watermarkPage", parseInt(jQuery("#current-page-selector").val()));
					jQuery("#doaction").click();	
				}				
			}
		}
	}, 3500);


	// Listening on body mutation and if wp_uploader added - click on the second btn
	if(window.WebKitMutationObserver)
	{
		var observer = new WebKitMutationObserver(function (mutations) {
		  mutations.forEach(attrModified);
		});	
	}else{
		var observer = new MutationObserver(function (mutations) {
		  mutations.forEach(attrModified);
		});	
	}

	var wrap = $("body");

	observer.observe(wrap[0], { attributes: false, childList:true, subtree: true});

	function attrModified(mutation) 
	{
		
		if(mutation.addedNodes && mutation.addedNodes[0] && mutation.addedNodes[0].id && mutation.addedNodes[0].id.indexOf("__wp-uploader") != -1)
		{
			jQuery(mutation.addedNodes[0]).find(".media-menu-item").eq(1).click();
		}
	}
});

