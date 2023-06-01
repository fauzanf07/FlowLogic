$(document).ready(function () {
    $('#table-user').DataTable();
	$('#table-chall').DataTable();
});
function controlPost(id,status){
	var idPost = $(id).data('id');
	$.ajax({
		url: "./backend/control-post.php",
		type: "POST",
		data: {
			id: idPost,
			status: status		
		},
		cache: false,
		success: function(dataResult){
			var dataResult = JSON.parse(dataResult);
			console.log(dataResult.statusCode);
			if(dataResult.statusCode == 201){
				$('#accept'+idPost).remove();
				$('#reject'+idPost).remove();
				if(status==1){
					$('#control'+idPost).append('<span class="accepted">Diterima &#10003;</span>');
				}else{
					$('#control'+idPost).append('<span class="rejected">Ditolak</span>');
				}
			}
		}
	});
}
function logout(){
	window.location.href = "./logout.php";
}

$("#progress-menu").click(function(){
	$('.content-2').css('display', 'none');
	$('.content-3').css('display', 'none');
	$('.content-1').css('display','block');
	$("#postingan-menu").removeClass("current");
	$("#challenge-menu").removeClass("current");
	$("#progress-menu").addClass("current");
});

$("#postingan-menu").click(function(){
	$('.content-1').css('display', 'none');
	$('.content-3').css('display', 'none');
	$('.content-2').css('display','block');
	$("#progress-menu").removeClass("current");
	$("#challenge-menu").removeClass("current");
	$("#postingan-menu").addClass("current");
});

$("#challenge-menu").click(function(){
	$('.content-1').css('display', 'none');
	$('.content-2').css('display','none');
	$('.content-3').css('display','block');
	$("#progress-menu").removeClass("current");
	$("#postingan-menu").removeClass("current");
	$("#challenge-menu").addClass("current");
});

const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Pengenalan Flowchart', 'Simbol-Simbol Flowchart', 'Pseudoode', 'Subrutin', 'Fungsi', 'Implementasi code'],
      datasets: [{
        label: '# of Rata-rata nilai',
        data: [90, 85, 83, 70, 75, 70],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
		  suggestedMin: 0,
		  suggestedMax: 100,
		  step: 20
        }
      }
    }
  });

  function updateHistory(idUser,challenge,idPost,idStatus){
	$.ajax({
		url: "./backend/update_history_challenge.php",
		type: "POST",
		data: {
			idUser: idUser,
			challenge: challenge
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
				$('#accepted'+idPost).css('display','none');
				$('#rejected'+idPost).css('display','none');
				$('#statusCol'+idPost).empty();
				if(idStatus == 1){
					$('#statusCol'+idPost).append('<span class="accepted">Diterima &#10003;</span>');
				}else{
					$('#statusCol'+idPost).append('<span class="rejected">Ditolak</span>');
				}
			}
		}
	});
}

function usersChallenge(id){
	var idPost = $(id).data('id');
	var idUser = $(id).data('user');
	var idChall = $(id).data('challenge');
	var idStatus = $(id).data('status');

	$.ajax({
		url: "./backend/challenge.php",
		type: "POST",
		data: {
			id: idPost,
			idUser: idUser,
			idChall: idChall,
			idStatus: idStatus
		},
		cache: false,
		success: function(dataResult){
			var dataResult = JSON.parse(dataResult);
			console.log(dataResult.statusCode);
			if(dataResult.statusCode == 201){
				updateHistory(idUser,idChall,idPost,idStatus)
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

