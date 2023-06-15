
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
			url: "./backend/comment_post.php",
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

function updateHistory(idUser,challenge,points){
	$.ajax({
		url: "./backend/update_history_challenge.php",
		type: "POST",
		data: {
			idUser: idUser,
			challenge: challenge,
			points: points
		},
		cache: false,
		success: function(dataResult){
			var dataResult = JSON.parse(dataResult);
			console.log(dataResult);
			if(dataResult.statusCode==200){
				Swal.fire({
					title: 'Good job!',
					text: 'Berhasil dilakukan!',
					icon: 'success',
					confirmButtonColor: '#23fa5c',
					allowOutsideClick: false,
				});
				$('#accepted').css('display','none');
				$('#rejected').css('display','none');
				$('.form-nilai').css('display','none');
			}
		}
	});
}

function usersChallenge(id){
	let idPost = $(id).data('id');
	let idUser = $(id).data('user');
	let idChall = $(id).data('challenge');
	let idStatus = $(id).data('status');
	let nilai = idStatus==1 ? $('#nilai').find(":selected").val() : '-';
	let points = 0;
	if(nilai == 'A'){
		points = 300;
	}else if(nilai=='B'){
		points = 200;
	}else{
		points = 100;
	}

	$.ajax({
		url: "./backend/challenge.php",
		type: "POST",
		data: {
			id: idPost,
			idUser: idUser,
			idChall: idChall,
			idStatus: idStatus,
			nilai: nilai,
			points: points
		},
		cache: false,
		success: function(dataResult){
			var dataResult = JSON.parse(dataResult);
			console.log(dataResult.statusCode);
			if(dataResult.statusCode == 201){
				if(idStatus == 1){
					updateHistory(idUser,idChall,points);
				}else{
					Swal.fire({
						title: 'Good job!',
						text: 'Berhasil dilakukan!',
						icon: 'success',
						confirmButtonColor: '#23fa5c',
						allowOutsideClick: false,
					});
				}
			}
		}
	});
}