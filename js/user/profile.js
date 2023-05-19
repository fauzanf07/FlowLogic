$('#profile-pic').click(function(){
	$( ".change-pic-pop-up" ).css( "display", "block" );
})
	
$("#close").click(function(){
	$(".change-pic-pop-up").css("display","none");
});

$('#sign-out').click(function(){
	window.location.href = "./logout.php";
})

$('#inputGroupFile02').change(function(){
    var input = this;
    var url = $(this).val();
    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) 
     {
        var reader = new FileReader();

        reader.onload = function (e) {
           $('#change-img').attr('src', e.target.result);
        }
       reader.readAsDataURL(input.files[0]);
    }
    else
    {
      $('#change-img').attr('src', '/assets/no_preview.png');
    }
});
$("#change-pic").click(function(){
    var fd = new FormData();
    var files = $('#inputGroupFile02')[0].files;
        
        // Check file selected or not
    if(files.length > 0 ){
        fd.append('file',files[0]);

        $.ajax({
              url: "change-img.php",
              type: "POST",
              data: fd,
              contentType: false,
              processData: false,
              success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
				console.log(dataResult)
				if(dataResult.statusCode==200){
					Swal.fire({
						title: 'Good job!',
						text: 'Changed photo profile successfully!',
						icon: 'success',
						confirmButtonColor: '#23fa5c',
					}).then((result) =>{
						if(result.isConfirmed){
							location.reload();
						}
					});				
				}
              },
        });
    }else{
        alert("Please select a file.");
    }
});
var editor = new FroalaEditor('#shareBox',{ 
    imageUploadURL: 'user_trans/upload_image.php',
    
    imageUploadParams: {
        id: 'my_editor'
    },
    imageTextNear: false
});

function share(id){
    var content = editor.html.get();
    var username = $(id).data('username');
    $.ajax({
        url: "user_trans/post_status.php",
        type: "POST",
        data: {
            content: content,
            username: username	
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
                  confirmButtonColor: "#d63630"
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
					$('#comments'+id).append('<div class="comment"><div class="image-profile"><img src="'+photoProfile+'" class="avatar"></div><div class="com-sect"><b><span>'+username+'</span></b><span>&nbsp;&nbsp;'+dateTime+'</span><br><p class="isi-comment">'+comment+'</p></div></div>');
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
		url: "./user_trans/likers.php",
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