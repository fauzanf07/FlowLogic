$("#sign-in").click(function(){
    var username = $('#signUsername').val();
    var password = $('#signPassword').val();
    if(username!="" && password!=""){
        $.ajax({
            url: "backend/sign-in.php",
            type: "POST",
            data: {
                signUsername: username,
                signPassword: password				
            },
            cache: false,
            success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                console.log(dataResult);
                if(dataResult.statusCode==200){
                    window.location.href = "../admin";
                }
                if(dataResult.statusCode==201){
                    window.location.href = "../user/home.php";		
                }
                else if(dataResult.statusCode==202){
                    Swal.fire({
                      title: 'Error!',
                      text: 'The username or password is invalid',
                      icon: 'error',
                      confirmButtonText: 'Ok',
                      confirmButtonColor: "#d63630"
                    })
                }
                
            }
        });
    }
    else{
            alert('Please fill all the field !');
    }
})