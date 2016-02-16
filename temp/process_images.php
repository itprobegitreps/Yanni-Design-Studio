<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="ajaxBatch.js"></script>
	<script>
	var batch = true;
	var page_cnt = 12;

	function send()
	{
		if(batch === true)
		{
			console.log("send");
			$.get("/?processThumbs=Y&page=" + page_cnt, {},function(data)
			{
				console.log(data);

				page_cnt++;
				if(data.cnt == 20)
				{
					console.log("next page");
					send();
				}else{
					alert("OLOLOO WORK DONE!!!!");
				}
			}, 'json');
		}
	}
	
	</script>
</head>
<body>
	
</body>
</html>