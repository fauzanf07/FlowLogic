
	function signIn(){
		$( ".sign-in-pop-up" ).css( "display", "block" );
	}
	$("#close").click(function(){
		$(".sign-in-pop-up").css("display","none");
	});

	$("#submit").click(function(){
		var email = $('#inputEmail').val();
		var name = $('#inputName').val();
		var username = $('#inputUsername').val();
		var password = $('#inputPassword').val();
		if(email!="" && name!="" && username!="" && password!=""){
			$.ajax({
				url: "sign-up.php",
				type: "POST",
				data: {
					email: email,
					name: name,
					username: username,
					password: password				
				},
				cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					console.log(dataResult)
					if(dataResult.statusCode==200){
						Swal.fire({
						  title: 'Good job!',
						  text: 'You have signed up successfully!',
						  icon: 'success',
						  confirmButtonColor: '#23fa5c',
						})
						$('#inputEmail').val('');
						$('#inputName').val('');
						$('#inputUsername').val('');
						$('#inputPassword').val(''); 						
					}
					else if(dataResult.statusCode==201){
						Swal.fire({
						  title: 'Error!',
						  text: 'Signing up failed',
						  icon: 'error',
						  confirmButtonText: 'Ok',
						  confirmButtonColor: "#d63630"
						})
					}
					else if(dataResult.statusCode==202){
						Swal.fire({
						  title: 'Error!',
						  text: 'Username or Email has already existed',
						  icon: 'error',
						  confirmButtonText: 'Ok',
						  confirmButtonColor: "#d63630"
						})
					}
					
				}
			});
		}
		else{
				alert('Please fill all the field !');
		}
	})
	$("#sign-in").click(function(){
		var username = $('#signUsername').val();
		var password = $('#signPassword').val();
		if(username!="" && password!=""){
			$.ajax({
				url: "sign-in.php",
				type: "POST",
				data: {
					signUsername: username,
					signPassword: password				
				},
				cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					console.log(dataResult);
					if(dataResult.statusCode==200){
						window.location.href = "./admin";
					}
					if(dataResult.statusCode==201){
						window.location.href = "./user/home.php";		
					}
					else if(dataResult.statusCode==202){
						Swal.fire({
						  title: 'Error!',
						  text: 'The username or password is invalid',
						  icon: 'error',
						  confirmButtonText: 'Ok',
						  confirmButtonColor: "#d63630"
						})
					}
					
				}
			});
		}
		else{
				alert('Please fill all the field !');
		}
	})