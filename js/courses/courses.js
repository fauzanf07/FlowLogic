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
			$msg = "Untuk melanjutkan ke kelas berikutnya, klik tombol berikutnya di akhir halaman kelas terakhir anda pelajari";
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
	var reward = $(this).data("reward");
	getRewards(nextCourse,currCourse,username, reward);
});

function getRewards(nextCourse, currCourse, username, reward){
	if(nextCourse > currCourse && reward==0){
		$.ajax({
			url: "./course_trans/get_rewards.php",
			type: "POST",
			data: {
				currCourse : currCourse,
				username: username	
			},
			cache: false,
			success: function(dataResult){
				var dataResult = JSON.parse(dataResult);
				if(dataResult.statusCode==200){
					levelUp(nextCourse,currCourse,username);
					$('#next').data('reward',1);
				}
				if(dataResult.statusCode==201){
					console.log("There's something wrong with sql query");
				}
							
			}
		});
	}else{
		levelUp(nextCourse,currCourse,username);
	}
}
function levelUp(nextCourse,currCourse,username){
	$.ajax({
		url: "./course_trans/update_level.php",
		type: "POST",
		data: {
			username: username	
		},
		cache: false,
		success: function(dataResult){
			var dataResult = JSON.parse(dataResult);
			console.log(dataResult);
			if(dataResult.levelUp){
				$('.levelUp-desc').html("Hooraay!! Kamu telah mencapai Level "+dataResult.level+"!!")
				var myModal = new bootstrap.Modal(document.getElementById("exampleModal1"), {});
				myModal.show();
				playConfetti();
			}else if(dataResult.statusCode==201){
				console.log("There's something wrong with sql query");
			}else{
				
				getNextCourse(nextCourse,currCourse,username);
			}
		}
	});
}

function getNextCourse(nextCourse, currCourse, username){
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
			if(courseName!="" && nextCourse!=0){
				if(nextCourse > currCourse ){
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
}
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

function playConfetti(){
	tsParticles.load("tsparticles", {
		"fullScreen": {
		  "zIndex": 1051
		},
		"particles": {
		  "number": {
			"value": 0
		  },
		  "color": {
			"value": [
			  "#00FFFC",
			  "#FC00FF",
			  "#fffc00"
			]
		  },
		  "shape": {
			"type": [
			  "circle",
			  "square"
			],
			"options": {}
		  },
		  "opacity": {
			"value": 1,
			"animation": {
			  "enable": true,
			  "minimumValue": 0,
			  "speed": 2,
			  "startValue": "max",
			  "destroy": "min"
			}
		  },
		  "size": {
			"value": 4,
			"random": {
			  "enable": true,
			  "minimumValue": 2
			}
		  },
		  "links": {
			"enable": false
		  },
		  "life": {
			"duration": {
			  "sync": true,
			  "value": 5
			},
			"count": 1
		  },
		  "move": {
			"enable": true,
			"gravity": {
			  "enable": true,
			  "acceleration": 10
			},
			"speed": {
			  "min": 10,
			  "max": 20
			},
			"decay": 0.1,
			"direction": "none",
			"straight": false,
			"outModes": {
			  "default": "destroy",
			  "top": "none"
			}
		  },
		  "rotate": {
			"value": {
			  "min": 0,
			  "max": 360
			},
			"direction": "random",
			"move": true,
			"animation": {
			  "enable": true,
			  "speed": 60
			}
		  },
		  "tilt": {
			"direction": "random",
			"enable": true,
			"move": true,
			"value": {
			  "min": 0,
			  "max": 360
			},
			"animation": {
			  "enable": true,
			  "speed": 60
			}
		  },
		  "roll": {
			"darken": {
			  "enable": true,
			  "value": 25
			},
			"enable": true,
			"speed": {
			  "min": 15,
			  "max": 25
			}
		  },
		  "wobble": {
			"distance": 30,
			"enable": true,
			"move": true,
			"speed": {
			  "min": -15,
			  "max": 15
			}
		  }
		},
		"emitters": {
		  "life": {
			"count": 0,
			"duration": 0.1,
			"delay": 0.4
		  },
		  "rate": {
			"delay": 0.1,
			"quantity": 150
		  },
		  "size": {
			"width": 0,
			"height": 0
		  }
		}
	});
	const particles = tsParticles.domItem(0);
	particles.play();
}

$('.btn-close-levelUp').click(function(){
	const particles = tsParticles.domItem(0);
	particles.stop();
})