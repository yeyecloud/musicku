$(function()
	{

		$('#dataTables-example').dataTable(
			{
				"processing": true,
				"serverSide": true,
				
				"ajax":
				{
					"url": site_url+'/admincp/category/datatables_category',
					"type": "POST",
					"data": function ( d )
					{
						d.csrf_ci_music2014= $("input[name=csrf_ci_music2014]").val()
					}
				},
				"order": [[ 0, "desc" ]],
				"columns": [
					{
						"data": "cat_id"
					},
					{
						"data": "cat_name"
					},
					{
						"data": "cat_name"
					},
					{
						"data": "cat_type"
					},
					{
						"data": "cat_url"
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
//Edit Song
function edit_category(cat_id){
	window.location.assign(base_url+'admincp/category/edit/'+cat_id);
}
//Delete Category
function delete_category(cat_id,messages){
	bootbox.confirm(messages, function(result) {
  		if(result!==false){
  			var dataString={
				'cat_id':cat_id
			};
			var urlSend=site_url+'/admincp/category/count_category/';
			var data=ajax_global(dataString,urlSend);
			$('#category-del:input').val(cat_id);
			$('p#count-song-in-category').html(data.result);
			$('div#modal-delete-category').modal('show');
		}
	});
		
}




