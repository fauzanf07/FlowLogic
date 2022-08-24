	$("#sign-in").click(function(){
		var username = $('#username').val();
		var newPassword = $('#newPassword').val();
		var reNewPassword = $('#retypeNewPassword').val();
		if(username!="" && newPassword!="" && reNewPassword!=""){
			if(newPassword == reNewPassword){
				$.ajax({
					url: "forgot-pswd-trans.php",
					type: "POST",
					data: {
						username: username,
						newPassword: newPassword,
						reNewPassword: reNewPassword				
					},
					cache: false,
					success: function(dataResult){
						var dataResult = JSON.parse(dataResult);
						console.log(dataResult)
						if(dataResult.statusCode==200){
							Swal.fire({
							  title: 'Good job!',
							  text: 'Changed password successfully!',
							  icon: 'success',
							  confirmButtonColor: '#23fa5c',
							})	
							$('#username').val('');
							$('#newPassword').val('');
							$('#retypeNewPassword').val('');		
						}
						else if(dataResult.statusCode==201){
							Swal.fire({
							  title: 'Error!',
							  text: 'The username or email is invalid',
							  icon: 'error',
							  confirmButtonText: 'Ok',
							  confirmButtonColor: "#d63630"
							})
						}
						else if(dataResult.statusCode==202){
							Swal.fire({
							  title: 'Error!',
							  text: 'Something is wrong',
							  icon: 'error',
							  confirmButtonText: 'Ok',
							  confirmButtonColor: "#d63630"
							})
						}
						
					}
				});
			}else{
				alert('Retype new password field doesn\'t match with the new password field !');
			}
			
		}
		else{
				alert('Please fill all the field !');
		}
	})