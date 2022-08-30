$.ajax({
	url: "./course_trans/get_user.php",
	type: "GET",
	cache: false,
	success: function(dataResult){
		var dataResult = JSON.parse(dataResult);
		for(i=0; i< dataResult.length; i++){
			const totalUser = parseInt(dataResult[i].total_user);
			$('#userFootprintC'+dataResult[i].curr_course).css('display','inline-block');
			$('#userImgFootprintC'+dataResult[i].curr_course).attr('src',dataResult[i].photo_profile);
			if(totalUser > 1){
				$('#userImgFootprintC'+dataResult[i].curr_course).css('position','absolute');
				$('#totalUserC'+dataResult[i].curr_course).css('display','inline-block');
				$('#totalUserC'+dataResult[i].curr_course).html((totalUser-1) + "+");
			}
		}
		if(dataResult.statusCode==201){
			console.log("There's something wrong with sql query")
		}
					
	}
});

$('.material-name').click(function(){
	const course = $(this).data('course');
	const currCourse = $(this).data('curr');
	const diff = course -currCourse;
	if(diff==1 || diff>0){
		if(diff==1){
			$msg = "Untuk melanjutkan ke kelas berikutnya, klik tombol berikutnya di akhir halaman ini";
		}else{
			$msg = "Kelas ini masih terkunci, anda harus menyelesaikan kelas-kelas sebelumnya";
		}
		$('#msgToast').html($msg);
		const toastLiveExample = document.getElementById('liveToast');
		const toast = new bootstrap.Toast(toastLiveExample)

		toast.show()
	}else{
		$.ajax({
			url: "./course_trans/get_course_name.php",
			type: "POST",
			data: {
				course : course		
			},
			cache: false,
			success: function(dataResult){
				var dataResult = JSON.parse(dataResult);
				var courseName = dataResult.courseName;
				if(courseName!=""){
					window.location.href = "../courses/"+courseName+".php";
				}
				if(dataResult.statusCode==201){
					console.log("There's something wrong with sql query");
				}
							
			}
		});
	}
});


$('.user-footprint').click(function(){
	var idCourse = $(this).data("course");
	$.ajax({
		url: "./course_trans/get_users_on_course.php",
		type: "POST",
		data: {
			idCourse: idCourse		
		},
		cache: false,
		success: function(dataResult){
			var dataResult = JSON.parse(dataResult);
			$('.userList').remove();
			for(i=0; i< dataResult.length; i++){
				$('#usersOnTheCourse').append("<tr class='userList'><td><img src='"+dataResult[i].photo_profile+"' class='img-user'></td><td>"+dataResult[i].name+"</td></tr>");
			}
			const myModal = new bootstrap.Modal('#exampleModal', {
			  keyboard: false
			})
			const modalToggle = document.getElementById('exampleModal'); 
			myModal.show(modalToggle);

			if(dataResult.statusCode==201){
				console.log("There's something wrong with sql query")
			}
						
		}
	});
	
});

$('#next').click(function(){
	var nextCourse = $(this).data("next");
	var currCourse = $(this).data("curr");
	var username = $(this).data("username");
	$.ajax({
			url: "./course_trans/get_course_name.php",
			type: "POST",
			data: {
				course : nextCourse	
			},
			cache: false,
			success: function(dataResult){
				var dataResult = JSON.parse(dataResult);
				var courseName = dataResult.courseName;
				if(courseName!=""){
					if(nextCourse > currCourse){
						$.ajax({
							url: "./course_trans/update_course.php",
							type: "POST",
							data: {
								currCourse : currCourse,
								username: username	
							},
							cache: false,
							success: function(dataResult){
								var dataResult = JSON.parse(dataResult);
								if(dataResult.statusCode==200){
									window.location.href = "../courses/"+courseName+".php";
								}else{
									console.log("There's something wrong with sql query");
								}
							}
						});
					}else{
						window.location.href = "../courses/"+courseName+".php";
					}
				}
				if(dataResult.statusCode==201){
					console.log("There's something wrong with sql query");
				}
							
			}
	});
});
$('#previous').click(function(){
	var idCourse = $(this).data("prev");
	$.ajax({
			url: "./course_trans/get_course_name.php",
			type: "POST",
			data: {
				course : idCourse	
			},
			cache: false,
			success: function(dataResult){
				var dataResult = JSON.parse(dataResult);
				var courseName = dataResult.courseName;
				if(courseName!=""){
					window.location.href = "../courses/"+courseName+".php";
				}
				if(dataResult.statusCode==201){
					console.log("There's something wrong with sql query");
				}
							
			}
	});
});