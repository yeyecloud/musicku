$(function()
	{
		//Email
		$('#email:input').on('blur',function()
			{
				if(validateEmail($(this).val())==false)
				{
					$(this).notify($(this).attr('data-notify'),'error');
					$(this).focus();
					return false;
				}
				var dataString=
				{
					'email':$(this).val()
				};
				var urlSend=site_url+'/admincp/user/auto_user/';
				var data=ajax_global(dataString,urlSend);
				if(data.status==false)
				{
					$(this).notify(data.messages,'warring');
					$(this).focus();
					return false;
				}
				if(data.status==true)
				{
					$('#username:input').val(data.messages);
					$('#check_email:input').val(1);
				}
			});
		//Check Username
		$('#username:input').on('blur',function()
			{
				var dataString=
				{
					'UserName':$(this).val()
				};
				var urlSend=site_url+'/admincp/user/check_username/';
				var data=ajax_global(dataString,urlSend);
				if(data.result===true)
				{
					$('#check_username:input').val(1);
					return false;
				}else
				{
					$('#username:input').notify($('#check_username:input').attr('data-notify'),'warring');
					return false;
				}
			});
		//Random Password
		$('#random_password:button').on('click',function()
			{
				var r_password = randomString(8, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
				$('#password:input').val(r_password);
			});
		//Submit AddUser
		$('#submit-addUser:button').on('click',function()
			{
				var sEmail=$('#email:input');
				var sUsername=$('#username:input');
				var sPassword=$('#password:input');
				var sFirst_name=$('#first_name:input');
				var sLast_name=$('#last_name:input');
				if(validateEmail(sEmail.val())!=true)
				{
					sEmail.focus();
					sEmail.notify(sEmail.attr('data-notify'),'error');
					return false;
				}
				if(sUsername.val()==false)
				{
					sUsername.focus();
					sUsername.notify(sUsername.attr('data-notify'),'error');
					return false;
				}
				if($('#check_email:input').val()==0)
				{
					sEmail.focus();
					sEmail.notify($('#check_email:input').attr('data-notify'),'warring');
					return false;
				}
				if($('#check_username:input').val()==0)
				{
					sUsername.focus();
					sUsername.notify($('#check_username:input').attr('data-notify'),'warring');
					return false;
				}
				if(sPassword.val()==false)
				{
					sPassword.focus();
					sPassword.notify(sPassword.attr('data-notify'),'error');
					return false;
				}
				if(sFirst_name.val()==false)
				{
					sFirst_name.focus();
					sFirst_name.notify(sFirst_name.attr('data-notify'),'error');
					return false;
				}
				if(sLast_name.val()==false)
				{
					sLast_name.focus();
					sLast_name.notify(sLast_name.attr('data-notify'),'error');
					return false;
				}
				if($('#member:input').prop('checked')==true)
				{
					var Groups=2;
				}else
				{
					var Groups=1;
				}
				var dataString=
				{
					'Email'	:sEmail.val(),
					'UserName':sUsername.val(),
					'Password':sPassword.val(),
					'First_name':sFirst_name.val(),
					'Last_name':sLast_name.val(),
					'Groups':Groups
				};
				var urlSend=site_url+'/admincp/user/add_User/';
				var data=ajax_global(dataString,urlSend);
				if(data.status===true)
				{
					$("form").trigger('reset');
					toastr.success(data.messages);
				}else
				{
					toastr.success(data.messages);
				}
				return false;
			});

	});
function validateEmail(email)
{
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}
function randomString(length, chars)
{
	var result = '';
	for (var i = length; i > 0; --i) result += chars[Math.round(Math.random() * (chars.length - 1))];
	return result;
}
