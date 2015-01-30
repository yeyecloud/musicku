$(function()
	{
		$('div#div-modal-admincp-login').animateCSS('bounceIn',function (){
         	$("#email:input").focus();
     	});
		$("a#login").on('click',function()
			{
				var semail=$("#email:input");
				var spassword=$("#password:input");
				//Var login
				var email=semail.val();
				var password=spassword.val();
				if(validateEmail(email)!=true)
				{
					semail.focus();
					return false;
				}
				if(password=='')
				{
					spassword.focus();
					return false;
				}
				if($('#remember:input').prop('checked')==true)
				{
					var remember=true;
				}else
				{
					var remember=false;
				}
				
				var dataString=
				{
					remember:remember,
					email:email,
					password:password
				};
				var urlSend=site_url+"/admincp/login/login_admin/";
				var data=ajax_global(dataString,urlSend);
				if(data.status==false){
					if(data.actions=='lock'){
						toastr.error($('a#login').attr('data-notify'));
						return false;
					}else{
						toastr.error(data.messages);
						return false;
					}
				}else{
					window.location.assign(base_url+'admincp/settings');
					return false;
				}
				return false;
			});
	});
