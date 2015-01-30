$(function()
	{

		$('#dataTables-example').dataTable(
			{
				"processing": true,
				"serverSide": true,
				
				"ajax":
				{
					"url": site_url+'/admincp/settings/datatables_adminmanagenotify',
					"type": "POST",
					"data": function ( d )
					{
						d.csrf_ci_music2014= $("input[name=csrf_ci_music2014]").val()
					}
				},
				"order": [[ 0, "desc" ]],
				"columns": [
					{
						"data": "set_notify_id"
					},
					{
						"data": "set_notify_content"
					},
					{
				     	 "data": "actions",
				     	 "bSearchable": false,
				     	 "bSortable": false
				    },
				],
				
			});
		
			
	});

//Delete Category
function delete_notify(set_id,msg){
	bootbox.confirm(msg, function(result) {
  		if(result!==false){
  			var dataString={
				'notify_id':set_id
			};
			var urlSend=site_url+'/admincp/settings/delete_notify/';
			var data=ajax_global(dataString,urlSend);
			if(data.status==true){
				window.location.reload();
			}
		}
	});
		
}




