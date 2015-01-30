$(function()
	{

		$('#side-menu').metisMenu();
		$('#dataTables-example').dataTable(
			{
				"processing": true,
				"serverSide": true,
				
				"ajax":
				{
					"url": site_url+"/admincp/song/datatables_song/",
					"type": "POST",
					"data": function ( d )
					{
						d.csrf_ci_music2014= $("input[name=csrf_ci_music2014]").val()
					}
				},
				"order": [[ 0, "desc" ]],
				"columns": [
					//{ "bSearchable": false },
					{
						"data": "s_id"
					},
					{
						"data": "s_name"
					},
					{
						"data": "cat_name"
					},
					{
						"data": "s_type"
					},
					{
						"data": "s_url"
					},
					{
						"data": "email"
					},
					{
				     	 "data": "actions",
				     	 "bSearchable": false,
				     	 "bSortable": false
						// "defaultContent": "<button>Edit</button>"
				    },
				],
				
			});
			//Submit add to album
			$('#button-submit-admincp-add-to-album:button').on('click',function(){
				var s_id=$('#s_id:input').val();
				var al_id=$('select#select-id-album').val();
				var dataString={
					'al_id':al_id,
					's_id':s_id
				};
				var urlSend=site_url+'/admincp/album/addsongtoalbum/';
				var data=ajax_global(dataString,urlSend);
				console.log(data);
				if(data.status==false){
					toastr.error(data.messages);
					return false;
				}else{
					toastr.success(data.messages);
					$('div#div-modal-admincp-add-to-album').modal('hide');
					return false;
				}
				return false;
			});
			
	});
//Edit Song
function edit_song(s_id){
	window.location.assign(base_url+'admincp/song/edit/'+s_id);
}
//Delete Song
function delete_song(s_id,msg){
	bootbox.confirm(msg, function(result) {
  		if(result!==false){
			var dataString={
				s_id:s_id
			};
			var urlSend=site_url+'cglobal/delete_song/';
			var data=ajax_global(dataString,urlSend);
			if(data.result==true){
				window.location.reload();
			}
		}
	});	
}
//Add to album
function addToAlbum(s_id){
	$('div#div-modal-admincp-add-to-album').modal('show');
	$('#s_id:input').val(s_id);
	return false;
}
//Submit add album


//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function()
	{
		$(window).bind("load resize", function()
			{
				topOffset = 50;
				width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
				if (width < 768)
				{
					$('div.navbar-collapse').addClass('collapse')
					topOffset = 100; // 2-row-menu
				} else
				{
					$('div.navbar-collapse').removeClass('collapse')
				}

				height = (this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height;
				height = height - topOffset;
				if (height < 1) height = 1;
				if (height > topOffset)
				{
					$("#page-wrapper").css("min-height", (height) + "px");
				}
			})
	})




