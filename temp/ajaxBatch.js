var aBatch = function(config)
{
	if(!config.url)
	{
		throw "Request URL required!";
	}

	var instance = {};	
	var priv = {};
	priv.batchRows = []; // array
	priv.processOn = true; // bool
	priv.processCallback = config.clbk || function(){};
	priv.counter;
	priv.jsonInput;
	priv.rowsPerR = config.rowsPerR || 20;
	priv.reqPerSend = config.reqPerSend || 5;
	priv.url = config.url;

	instance.getBatchCount = function()
	{
		return priv.batchRows.length;
	}

	priv.createControls = function()
	{
		priv.jsonInput = $("<input>")
		.attr("type",'file')
		.change(function(evt)
		{
			var files = evt.target.files; // FileList object

            // Loop through the FileList
            for (var i = 0, f; f = files[i]; i++)
            {
                var reader = new FileReader();
               
                reader.onload = (function(theFile)
                {                    
                    return function(e)
                    {
                    	try{
                    		var json = JSON.parse(reader.result);	
                    	}catch(e)
                    	{
                    		throw "Invalid JSON file!";
                    	}

                    	if(config.prepareData)
                    	{
                    		json = json.map(config.prepareData);

                    		if(config.startFrom)
                    		{
                    			json = json.slice(config.startFrom,json.length);
                    		}

                    		priv.startLen = json.length;
                    	}
                    	
                    	priv.batchRows = json;
                        priv.processBatchItem();
                    };
                })(f);

                reader.readAsText(f);
            }
        });

        priv.counter = $("<div>")
        .hide()
        .css("height", "20px")
        .css("width","100%")
        .css("border", "1px solid #ccc");

        priv.counterPerc = $("<div>")
        .css("text-align", "center")
        .height(20)
        .css("color","white")
        .css("background","#3C91B3");

        priv.counter.append(priv.counterPerc);

        priv.stop = $("<button>")
        .html("Stop process")
        .click(function()
        {
        	instance.stopProcess();
        });

        $("body")
        	.append(priv.jsonInput)
        	.append(priv.stop)
        	.append(priv.counter);
	}

	priv.processBatchItem = function()
	{
		if(priv.processOn && priv.batchRows.length > 0)
		{
			priv.counter.show();
			var calls = [];

			for(var gk = 0; gk < priv.reqPerSend; gk++)
			{
				var rows = [];

				for(var zr = 0; zr < priv.rowsPerR; zr++)
				{
					rows.push(priv.batchRows.shift());
				}

				calls.push($.post(config.url, {batchRows: rows}));
			}

			console.log(config.reqPerSend + " ajaxBatch requests sended");

	        return $.when.apply(this, calls).then(function()
	        {    
	            var loadedData = arguments;
	            var rowsLeft = parseInt(priv.startLen - priv.batchRows.length);
	            var rowsTotal = priv.startLen;

	            priv.counterPerc
	            	.html(rowsLeft + " / " + priv.startLen)
	            	.css("width", rowsLeft / rowsTotal * 100 + "%");

	            priv.processCallback(loadedData);
	            priv.processBatchItem();
				console.info('ajaxBatch Request complete');
       		}); 		
		}
	}

	instance.stopProcess = function()
	{
		priv.processOn = false;
	}

	instance.continueProcess = function()
	{
		priv.processOn = true;
		priv.processBatchItem();
	}

	priv.createControls();

	return instance;
};