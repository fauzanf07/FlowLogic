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