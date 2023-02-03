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
$('#summernote').summernote({
    placeholder: 'Bagikan pengetahuan anda mengenai materi yang telah dipelajari disini. Ini akan membantu teman anda yang mengalami kesulitan dalam memahami materi.',
    tabsize: 2,
    height: 100
});