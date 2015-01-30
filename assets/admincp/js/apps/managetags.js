$(function()
	{

		$('#side-menu').metisMenu();
		$('#dataTables-example').dataTable(
			{
				"processing": true,
				"serverSide": true,

				"ajax":
				{
					"url": site_url+"/admincp/tags/datatables_tags/",
					"type": "POST",
					"data": function ( d )
					{
						d.csrf_ci_music2014= $("input[name=csrf_ci_music2014]").val()
					}
				},
				"order": [[ 0, "desc" ]],
				"columns": [

					{
						"data": "t_id"
					},
					{
						"data": "t_tags"
					},

					{
						"data": "actions",
						"bSearchable": false,
						"bSortable": false

					},
				],

			});
		//Check Tags
		$('#tags_name:input').on('blur',function(){
			var st_id=$('#t_id:input');
			if($(this).val()==false){
				$(this).notify($(this).attr('data-notify'),'error');
				$(this).focus();
				return false;
			}
			var dataString={
				't_id':st_id.val(),
				't_tags':$(this).val()
			};
			var urlSend=site_url+'/admincp/tags/check_tags/';
			var data=ajax_global(dataString,urlSend);
			if(data.status==false){
				$(this).notify($(this).attr('data-notify-exist'),'warring');
				$(this).focus();
				return false;
			}
			
		});
		//Submit delete
		$('#submit-edit-tags:button').on('click',function()
			{
				var st_id=$('#t_id:input');
				var st_tags=$('#tags_name:input');
				if(st_tags.val()==false){
					st_tags.notify(st_tags.attr('data-notify'),'error');
					st_tags.focus();
					return false;
				}
				var dataString={
				't_id':st_id.val(),
				't_tags':st_tags.val()
				};
				var urlSend=site_url+'/admincp/tags/check_tags/';
				var data=ajax_global(dataString,urlSend);
				if(data.status==false){
					st_tags.notify(st_tags.attr('data-notify-exist'),'warring');
					st_tags.focus();
					return false;
				}
				var dataString2={
					't_id':st_id.val(),
					't_tags':st_tags.val()	
				};
				var urlSend2=site_url+'/admincp/tags/update_tags/';
				var data2=ajax_global(dataString2,urlSend2);
				if(data2.status==true){
					window.location.reload();
				}
				
			});

	});
//Edit Tags
function edit_tags(t_id)
{
	var dataString={
		't_id':t_id
	};
	var urlSend=site_url+'/admincp/tags/select_tags/';
	var data=ajax_global(dataString,urlSend);
	$('#tags_name:input').val(data.t_tags);
	$('#t_id:input').val(t_id);
	$('div#modal-edit-tags').modal('show');
}
//Delete Tags
function delete_tags(t_id)
{
	bootbox.confirm($('#notify_delete:input').val(), function(result)
		{
			if(result==true)
			{
				var dataString=
				{
					't_id':t_id
				};
				var urlSend=site_url+'/admincp/tags/delete_tags/';
				var data=ajax_global(dataString,urlSend);
				if(data.status==true)
				{
					window.location.reload();
				}
			}
		});
}


