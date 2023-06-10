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
	var idUser = $(this).data("user");
	var nextCourse = $(this).data("next");
	var currCourse = $(this).data("curr");
	var username = $(this).data("username");
	var reward = $(this).data("reward");
	var desc = "Kamu telah menyelesaikan materi " + $(this).data("materi");
	var artikel = $(this).data('artikel');
	getRewards(nextCourse,currCourse,username, reward);
	if(artikel!=0){
		updateHistory(idUser,2,100,desc);
	}
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
			username: username,
			currCourse: (nextCourse-1)
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


var editor = new FroalaEditor('#shareBox',{ 
    imageUploadURL: '../user/user_trans/upload_image.php',
    
    imageUploadParams: {
        id: 'my_editor'
    },
    imageTextNear: false
});

function share(id){
    var content = editor.html.get();
    var username = $(id).data('username');
    $.ajax({
        url: "../user/user_trans/post_status.php",
        type: "POST",
        data: {
            content: content,
            username: username,
			challenge: 1,	
        },
        cache: false,
        success: function(dataResult){
            var dataResult = JSON.parse(dataResult);
            console.log(dataResult);
            if(dataResult.statusCode==200){
                Swal.fire({
                    title: 'Good job!',
                    text: 'Berhasil dibagikan!',
                    icon: 'success',
                    confirmButtonColor: '#23fa5c',
					allowOutsideClick: false,
                }).then((result) =>{
                    if(result.isConfirmed){
                        location.reload();
                    }
                });	
            }
            else if(dataResult.statusCode==201){
                Swal.fire({
                  title: 'Error!',
                  text: 'There is something wrong with server',
                  icon: 'error',
                  confirmButtonText: 'Ok',
                  confirmButtonColor: "#d63630",
				  allowOutsideClick: false,
                })
            }
            
        }
    });
    
}

function likeBtn(id){
	var userId = $(id).data('user');
	var liked = $(id).data('liked');
	var id = $(id).data('id');
	var likes = parseInt($('#likeAmount'+id).text());
	console.log(userId);
	$.ajax({
		url: "../user/user_trans/like_post.php",
		type: "POST",
		data: {
			userId: userId,
			postId: id,
			mode: liked,	
		},
		cache: false,
		success: function(dataResult){
			var dataResult = JSON.parse(dataResult);
			if(dataResult.statusCode==200){
				if(liked==0){
					likes++;
					$('#like'+id).css('color','#f00');
					$('#likeAmount'+id).text(likes);
					$('#like'+id).data('liked','1');
				}else{
					likes--;
					$('#like'+id).css('color','#adadad');
					$('#likeAmount'+id).text(likes);
					$('#like'+id).data('liked','0');
				}
			}
		}
	});
}

function onInput(ini){
	var id = $(ini).data('id');
	
	console.log(id);
	if(ini.value==''){
		$('#send'+id).css('color','#adadad');
	}else{
		$('#send'+id).css('color','#fff');
	}
}
function commBtn(id){
	var clicked = $(id).data('show');
	var id = $(id).data('id');
	if(clicked == 0){
		$('#comSect'+id).css('display','block');
		$('#comment'+id).css('color','#000');
		$('#comment'+id).data('show','1');
	}else{
		$('#comSect'+id).css('display','none');
		$('#comment'+id).css('color','#ADADAD');
		$('#comment'+id).data('show','0');
	}
	
}


const formatTglID = (tgl) => new Date(tgl).toLocaleString('id-ID', {
    timeZone: 'Asia/Jakarta',
    year: 'numeric',
    month: '2-digit',
    day: '2-digit',
    hour: '2-digit',
    minute: '2-digit',
    second: '2-digit',
}).replace(/\./g, ':');

function sendComment(id){
	var userId = $(id).data('user');
	var username = $(id).data('username');
	var photoProfile = $(id).data('profile');
	var id = $(id).data('id');
	var comment = $('#commentBox'+id).val();
	var comments = parseInt($('#commAmount'+id).text());
	let date = formatTglID(new Date()).slice(0,10).replace(/\//g,"-");
	let time = formatTglID(new Date()).slice(12, 20);
	let dateTime = date+ " "+time;
	if(comment!=''){
		comments++;
		$.ajax({
			url: "../user/user_trans/comment_post.php",
			type: "POST",
			data: {
				userId: userId,
				postId: id,
				comment: comment,	
			},
			cache: false,
			success: function(dataResult){
				var dataResult = JSON.parse(dataResult);
				if(dataResult.statusCode==200){
					$('#comments'+id).append('<div class="comment"><div class="image-profile"><img src="'+photoProfile+'" class="avatar"></div><div class="com-sect"><b><span><a class="no-undr" href="./profile.php?user='+username+'">'+username+'</a></span></b><span>&nbsp;&nbsp;'+dateTime+'</span><br><p class="isi-comment">'+comment+'</p></div></div>');
					$('#commentBox'+id).val('');
					$('#commAmount'+id).text(comments);
					$('#commentAmount'+id).text(comments);
					$('#send'+id).css('color','#adadad');
				}
			}
		});
	}
}



$('.likes').click(function(){
	var idPost = $(this).data("id");
	$.ajax({
		url: "../user/user_trans/likers.php",
		type: "POST",
		data: {
			idPost: idPost		
		},
		cache: false,
		success: function(dataResult){
			var dataResult = JSON.parse(dataResult);
			$('.userList').remove();
			for(i=0; i< dataResult.length; i++){
				$('#likers').append("<tr class='userList'><td><img src='"+dataResult[i].photo_profile+"' class='img-user'></td><td>"+dataResult[i].name+"</td></tr>");
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

var rankPage = 1;
function getRanks(loadMore,btnRanks){
	if(btnRanks){
		rankPage = 1;
		$('#loadRanksMore').css("display","block");
	}
	var offset = 5 * (rankPage-1);
	$.ajax({
		url: "./course_trans/get_ranks.php",
		type: "POST",
		data: {
			offset: offset,
			rankPage: rankPage
		},
		cache: false,
		success: function(dataResult){
			var dataResult = JSON.parse(dataResult);
			console.log(dataResult);
			if(!loadMore){
				$('.userList').remove();
			}
			for(i=0; i< dataResult.arr.length; i++){
					$('#tableRanks').append("<tr class='userList'><th scope='row'>"+(i+1+offset)+"</th><td>"+dataResult.arr[i].name+"</td><td>"+dataResult.arr[i].point+"</td><td>"+dataResult.arr[i].xp+"</td></tr>");
			}
			rankPage++;
			if(dataResult.max==1){
				$('#loadRanksMore').css("display","none");
			}
		}
	});
};
$('#closeRanks').click(function(){
	rankPage = 1;
	$('#loadRanksMore').css("display","inline-block");
});

function updateHistory(idUser,type,earns,desc){
	$.ajax({
		url: "./course_trans/update_history.php",
		type: "POST",
		data: {
			idUser: idUser,
			type: type,
			earns: earns,
			desc: desc
		},
		cache: false,
		success: function(dataResult){
			var dataResult = JSON.parse(dataResult);
			console.log(dataResult);
		}
	});
}