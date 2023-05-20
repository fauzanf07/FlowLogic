var page = 1;
$('#sign-out').click(function(){
	window.location.href = "./logout.php";
});

$('#loadRanksMore').click(function(){
	console.log("kskd");
	console.log(page);
	page = page+1;
});

function likeBtn(id){
	var userId = $(id).data('user');
	var liked = $(id).data('liked');
	var id = $(id).data('id');
	var likes = parseInt($('#likeAmount'+id).text());
	console.log(userId);
	$.ajax({
		url: "./user_trans/like_post.php",
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
			url: "./user_trans/comment_post.php",
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
