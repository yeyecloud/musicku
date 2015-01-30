 
//Global Ajax

function ajax_global(dataString,url_Send)
{
	
	var dataSend=$.extend(security,dataString);
	var result='';
	$.ajax(
		{
			type: "POST",
			async: false,
			cache:false,
			url: url_Send,
			data: dataSend,
			dataType: "json",
			success: function (json)
			{
				result = json;

			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				//alert("get session failed " + errorThrown);
				console.log(dataSend);
				console.log(errorThrown);
			}
		});
	return result;
};