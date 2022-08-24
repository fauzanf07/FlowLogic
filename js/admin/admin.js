$(document).ready(function () {
    $('#table-user').DataTable();
});

function changeAdmin(btn){
	var id = btn.getAttribute("data-id");
	Swal.fire({
	  title: 'Are you sure?',
	  text: "You're gonna change the status of this user!",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Yes, Change it!'
	}).then((result) => {
	  if (result.isConfirmed) {
	    $.ajax({
					url: "admin-trans.php",
					type: "POST",
					data: {
						id: id,				
					},
					cache: false,
					success: function(dataResult){
						var dataResult = JSON.parse(dataResult);
						console.log(dataResult)
						if(dataResult.statusCode==200){
							Swal.fire({
							  title: 'Good job!',
							  text: 'Changed status successfully!',
							  icon: 'success',
							  confirmButtonColor: '#23fa5c',
							}).then((result) =>{
								if(result.isConfirmed){
									location.reload();
								}
							});
						}
						else if(dataResult.statusCode==201){
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
	  }
	});
}

function deleteUser(btn){
	var id = btn.getAttribute("data-id");
	Swal.fire({
	  title: 'Are you sure?',
	  text: "You won't be able to revert this!",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Yes, Delete it!'
	}).then((result) => {
	  if (result.isConfirmed) {
	    $.ajax({
					url: "delete-trans.php",
					type: "POST",
					data: {
						id: id,				
					},
					cache: false,
					success: function(dataResult){
						var dataResult = JSON.parse(dataResult);
						console.log(dataResult)
						if(dataResult.statusCode==200){
							Swal.fire({
							  title: 'Good job!',
							  text: 'Delete User successfully!',
							  icon: 'success',
							  confirmButtonColor: '#23fa5c',
							}).then((result) =>{
								if(result.isConfirmed){
									location.reload();
								}
							})		
						}
						else if(dataResult.statusCode==201){
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
	  }
	});
}

function logout(){
	window.location.href = "./logout.php";
}

$("#user-menu").click(function(){
	$("#user-menu").addClass("current");
	$("#assignments-menu").removeClass("current");
	$("#achievements-menu").removeClass("current");
	$("#user-title").css("display","block");
	$("#user-list").css("display","block");
	$("#assign-title").css("display","none");
	$("#assignments").css("display","none");
	$("#achv-title").css("display","none");
	$("#achievements").css("display","none");
});

$("#assignments-menu").click(function(){
	$("#user-menu").removeClass("current");
	$("#assignments-menu").addClass("current");
	$("#achievements-menu").removeClass("current");
	$("#user-title").css("display","none");
	$("#user-list").css("display","none");
	$("#assign-title").css("display","block");
	$("#assignments").css("display","block");
	$("#achv-title").css("display","none");
	$("#achievements").css("display","none");
});

$("#achievements-menu").click(function(){
	$("#user-menu").removeClass("current");
	$("#assignments-menu").removeClass("current");
	$("#achievements-menu").addClass("current");
	$("#user-title").css("display","none");
	$("#user-list").css("display","none");
	$("#assign-title").css("display","none");
	$("#assignments").css("display","none");
	$("#achv-title").css("display","block");
	$("#achievements").css("display","block");
});