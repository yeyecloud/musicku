$(function()
	{

		$('#side-menu').metisMenu();
		$('#dataTables-example').dataTable(
			{
				"processing": true,
				"serverSide": true,
				
				"ajax":
				{
					"url": site_url+"/admincp/user/manage_User_Table/",
					"type": "POST",
					"data": function ( d )
					{
						d.csrf_ci_music2014= $("input[name=csrf_ci_music2014]").val()
					}
				},
				"order": [[ 0, "desc" ]],
				"columns": [
					
					{
						"data": "id"
					},
					{
						"data": "username"
					},
					{
						"data": "email"
					},
					{
						"data": "first_name"
					},
					{
						"data": "last_name"
					},
					{
						"data": "phone"
					},
					{
				     	 "data": "actions",
				     	 "bSearchable": false,
				     	 "bSortable": false
						
				    },
				],
				
			});
			
	});
//Edit Song
function edit_song(s_id){
	window.location.assign(base_url+'admincp/editsong/index/'+s_id);
}
//Delete Song
function delete_user(u_id,msg){
	bootbox.confirm(msg, function(result) {
  		if(result!==false){
			var dataString={
				u_id:u_id
			};
			var urlSend=site_url+'/admincp/user/delete_user/';
			var data=ajax_global(dataString,urlSend);
			if(data.status==true){
				window.location.reload();
			}
		}
	});	
}
//Reset Password 

function reset_password_user(id){
	var messages=$('#notify_reset_password:input').val();
	bootbox.confirm(messages, function(result) {
  		if(result!==false){
			var r_password = randomString(8, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
			var dataString={
				'id':id,
				'Password':r_password	
			};
			var urlSend=site_url+'/admincp/user/reset_password/';
			var data=ajax_global(dataString,urlSend);
			if(data.status===true){
				bootbox.alert(data.messages, function() {
				 	
				});
			}else{
				toastr.error(data.messages);
			}
		}
	});	
}

function randomString(length, chars)
{
	var result = '';
	for (var i = length; i > 0; --i) result += chars[Math.round(Math.random() * (chars.length - 1))];
	return result;
}

