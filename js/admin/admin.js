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
	$('.content').css('display', 'none');
	$('.content-1').css('display','block');
	$(".menu").removeClass("current");
	$("#progress-menu").addClass("current");
});

$("#postingan-menu").click(function(){
	$('.content').css('display', 'none');
	$('.content-2').css('display','block');
	$(".menu").removeClass("current");
	$("#postingan-menu").addClass("current");
});

$("#challenge-menu").click(function(){
	$('.content').css('display', 'none');
	$('.content-3').css('display','block');
	$(".menu").removeClass("current");
	$("#challenge-menu").addClass("current");
});
$("#point-menu").click(function(){
	$('.content').css('display', 'none');
	$('.content-4').css('display','block');
	$(".menu").removeClass("current");
	$("#point-menu").addClass("current");
});
$("#rank-menu").click(function(){
	$('.content').css('display', 'none');
	$('.content-5').css('display','block');
	$(".menu").removeClass("current");
	$("#rank-menu").addClass("current");
});

const ctx = document.getElementById('myChart');
var quiz1 = document.cookie
  .split('; ')
  .find(row => row.startsWith('quiz1='))
  .split('=')[1];
var quiz2 = document.cookie
  .split('; ')
  .find(row => row.startsWith('quiz2='))
  .split('=')[1];
var quiz3 = document.cookie
  .split('; ')
  .find(row => row.startsWith('quiz3='))
  .split('=')[1];
console.log(quiz1+' '+quiz2+' '+quiz3);

var c1_a = document.cookie
		.split('; ')
		.find(row => row.startsWith('1_a='))
		.split('=')[1];
var c1_b = document.cookie
		.split('; ')
		.find(row => row.startsWith('1_b='))
		.split('=')[1];
var c1_c = document.cookie
		.split('; ')
		.find(row => row.startsWith('1_c='))
		.split('=')[1];
var c2_a = document.cookie
		.split('; ')
		.find(row => row.startsWith('2_a='))
		.split('=')[1];
var c2_b = document.cookie
		.split('; ')
		.find(row => row.startsWith('2_b='))
		.split('=')[1];
var c2_c = document.cookie
		.split('; ')
		.find(row => row.startsWith('2_c='))
		.split('=')[1];

new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Quiz 1', 'Quiz 2', 'Quiz 3'],
      datasets: [{
        label: '# of Rata-rata nilai Quiz',
        data: [quiz1,quiz2,quiz3],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
		x:{
			stacked: true,
		},
        y: {
          beginAtZero: true,
		  suggestedMin: 0,
		  suggestedMax: 100,
		  step: 20
        }
      }
    }
});
const ctx1 = document.getElementById('myChart1');
new Chart(ctx1, {
    type: 'bar',
    data: {
      labels: ['Challenge 1 (A)', 'Challenge 1 (B)','Challenge 1 (C)','Challenge 2 (A)','Challenge 2 (B)', 'Challenge 2 (C)'],
      datasets: [{
        label: '# of Jumlah Siswa',
        data: [c1_a,c1_b,c1_c,c2_a,c2_b,c2_c],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
		x:{
			stacked: true,
		},
        y: {
          beginAtZero: true,
		  suggestedMin: 0,
		  suggestedMax: 40,
		  step: 10
        }
      }
    }
});

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

$("#kirim").click(function(){
	var idUser =  $("#studentsName option:selected").val();
	var jmlPoin = $('#jmlPoin').val();
	var desc = $('#desc').val();
	$.ajax({
		url: "./backend/bonus-poin.php",
		type: "POST",
		data: {
			idUser: idUser,
			jmlPoin: jmlPoin,
			desc: desc,	
		},
		cache: false,
		success: function(dataResult){
			var dataResult = JSON.parse(dataResult);
			console.log(dataResult.statusCode);
			if(dataResult.statusCode==200){
				Swal.fire({
					title: 'Good job!',
					text: 'Berhasil dilakukan!',
					icon: 'success'
				});
			}else{
				Swal.fire({
					title: 'Error!',
					text: 'Theres something wrong with server',
					icon: 'error',
				});
			}
		}
	});
});