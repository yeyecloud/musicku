$(function()
	{
		//Signup
		$('#signin:button').on('click',function()
			{
				
				var semail=$('#email:input');
				var email=semail.val();

				var spassword=$('#password:input');
				var password=spassword.val();

				
				if(validateEmail(email)!=true)
				{
					semail.notify(semail.attr('data-notify'),'error');
					return false;
				}
				if(password=='')
				{
					spassword.notify(spassword.attr('data-notify'),'error');
					return false;
				}
				if($('#remember:input').prop('checked')==true){
					var remember=true;
				}else{
					var remember=false;
				}
				var csrf=$("input[name=csrf_ci_music2014]").val();
				var dataString=
				{
					csrf_ci_music2014:csrf,
					remember:remember,
					email:email,
					password:password
				};
				$.ajax(
					{
						type: "POST",
						async: false,
						url: site_url+"/user/login/login_user/",
						data: dataString,
						//dataType: "json",
						success: function (msg)
						{
							if(msg==1 || msg===true){
								window.location.assign(base_url);
								return false;
							}
							
							if(msg!==true)
							{
								toastr.error(msg);
							}
						},
						error: function (jqXHR, textStatus, errorThrown)
						{
							//alert("get session failed " + errorThrown);
							console.log(jqXHR);
						}
					});
				return false;
			});
	});
function validateEmail(email)
{
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}