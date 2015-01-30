$(function()
	{

		$('#side-menu').metisMenu();
		$('#dataTables-example').dataTable(
			{
				"processing": true,
				"serverSide": true,

				"ajax":
				{
					"url": site_url+"/admincp/singer/datatables_singer/",
					"type": "POST",
					"data": function ( d )
					{
						d.csrf_ci_music2014= $("input[name=csrf_ci_music2014]").val()
					}
				},
				"order": [[ 0, "desc" ]],
				"columns": [

					{
						"data": "si_id"
					},
					{
						"data": "si_name"
					},
					{
						"data": "si_url"
					},
					{
						"data": "actions",
						"bSearchable": false,
						"bSortable": false

					},
				],

			});
		//Auto Singer
		$.get(site_url+'/cglobal/collection_singer_json', function(data)
			{
				$("#singer-song:input").typeahead(
					{
						source:data,
					});
			},'json');
		//Submit delete
		$('#submit-delete-singer:button').on('click',function()
			{
				var ssi_id=$('#singer-del:input');
				var si_id=ssi_id.val();
				var sSingerName=$('#singer-song:input');
				var SingerName=sSingerName.val();
				if(SingerName==false)
				{
					sSingerName.focus();
					sSingerName.notify(sSingerName.attr('data-notify'),'error');
					return false;
				}
				var dataString=
				{
					'SingerName':SingerName,
					'si_id':si_id
				};
				var urlSend=site_url+'/admincp/singer/delete_singer/';
				var data=ajax_global(dataString,urlSend);
				if(data.status==false)
				{
					$('#singer-song:input').focus();
					$('#singer-song:input').notify(data.messages,'error');
					return false;
				}else
				{
					window.location.reload();
				}
			});

	});
//Edit Song
function edit_singer(si_id)
{
	window.location.assign(base_url+'admincp/singer/edit/'+si_id);
}
//Delete Song
function delete_singer(si_id)
{
	var dataString=
	{
		'si_id':si_id
	};
	var urlSend=site_url+'/admincp/singer/total_song_from_singer/';
	var data=ajax_global(dataString,urlSend);
	$('p#count-song-in-singer').html(data.total);
	$('#singer-del:input').val(si_id);

	$('div#modal-delete-singer').modal('show');
}


