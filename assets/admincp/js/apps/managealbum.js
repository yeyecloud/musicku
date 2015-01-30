$(function()
	{

		$('#dataTables-example').dataTable(
			{
				"processing": true,
				"serverSide": true,
				
				"ajax":
				{
					"url": site_url+'/admincp/album/datatables_album',
					"type": "POST",
					"data": function ( d )
					{
						d.csrf_ci_music2014= $("input[name=csrf_ci_music2014]").val()
					}
				},
				"order": [[ 0, "desc" ]],
				"columns": [
					{
						"data": "al_id"
					},
					{
						"data": "al_name"
					},
					{
						"data": "al_url"
					},
					{
						"data": "al_description"
					},
					
					{
				     	 "data": "actions",
				     	 "bSearchable": false,
				     	 "bSortable": false
				    },
				],
				
			});
		//Ajax Delete Category
		$('#submit-delete-category:button').on('click',function(){
			var CategoryDel=$('#category-del:input').val();
			var CategoryConvert=$('select#category').val();
			if(CategoryDel==CategoryConvert){
				toastr.error($('#category-del:input').attr('data-notify'));
				$('select#category').focus();
				return false;
			}
			var dataString={
				'CategoryDel':CategoryDel,
				'CategoryConvert':CategoryConvert
			};
			var urlSend=site_url+'/admincp/category/delete_category/';
			var data=ajax_global(dataString,urlSend);
			if(data.result==true){
				window.location.reload();
			}
			return false;
		});
			
	});

//Edit album
function edit_album(al_id){
	window.location.assign(base_url+'admincp/album/edit/'+al_id);
}
//Remove Album
function delete_album(al_id,msg){
	bootbox.confirm(msg, function(result) {
  		if(result!==false){
  			var dataString={
				'al_id':al_id
			};
			var urlSend=site_url+'/admincp/album/ajaxdeletealbum/';
			var data=ajax_global(dataString,urlSend);	
			if(data.status==true){
				window.location.reload();
			}
		}
	});
}
function manage_song_in_album(al_id){
	
	var dataString={
		'al_id'	:al_id
	};
	var urlSend=site_url+'/admincp/album/ajaxmanagesonginalbum/';
	var data=ajax_global(dataString,urlSend);
	if(data.status==false || data.html==false){
		$('ul#ul-content-song').html('<p class="text-center">No Song.</p>');
	}else{
		$('ul#ul-content-song').html(data.html);
	}
	$('div#modal-manage-song-in-album').modal('show');
	return false;
}
function delete_song_in_album(s_id,al_id,msg){
	bootbox.confirm(msg, function(result) {
  		if(result!==false){
  			var dataString={
				's_id':s_id,
				'al_id':al_id
			};
			var urlSend=site_url+'/admincp/album/ajaxdeletesonginalbum/';
			var data=ajax_global(dataString,urlSend);	
			console.log(data);
			if(data.status==true){
				$('li#li-song-'+s_id).animateCSS('zoomOut',function (){
         			$(this).remove();
     			});
			}
		}
	});
}

