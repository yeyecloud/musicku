$(function()
	{

		//Signup
		$('#signup:button').on('click',function()
			{
				var sfirst_name=$('#first_name:input');
				var first_name=sfirst_name.val();

				var slast_name=$('#last_name:input');
				var last_name=slast_name.val();

				var semail=$('#email:input');
				var email=semail.val();

				var spassword=$('#password:input');
				var password=spassword.val();

				var spassword_confirm=$('#password_confirm:input');
				var password_confirm=spassword_confirm.val();

				if(first_name=='')
				{
					sfirst_name.notify(sfirst_name.attr('data-notify'),'error');
					return false;
				}
				if(last_name=='')
				{
					slast_name.notify(slast_name.attr('data-notify'),'error');
					return false;
				}
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
				if(password_confirm=='' || password_confirm!=password)
				{
					spassword_confirm.notify(spassword_confirm.attr('data-notify'),'error');
					return false;
				}
				var csrf=$("input[name=csrf_ci_music2014]").val();
				var dataString=
				{
					csrf_ci_music2014:csrf,
					first_name:first_name,
					last_name:last_name,
					email:email,
					password:password,
					password_confirm:password_confirm
				};
				$.ajax(
					{
						type: "POST",
						async: false,
						url: site_url+"/user/register/creat_user/",
						data: dataString,
						//dataType: "json",
						success: function (msg)
						{
							if(msg==1 || msg===true){
								window.location.assign(base_url+'sign-in');
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