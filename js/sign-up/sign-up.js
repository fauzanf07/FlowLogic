$("#submit").click(function(){
    var email = $('#inputEmail').val();
    var username = $('#inputUsername').val();
    var name = $('#inputName').val();
    var kelas = $('#inputKelas').val();
    var password = $('#inputPassword').val();
    var konPassword = $('#inputKonPassword').val();
    if(email!="" && name!="" && username!="" && kelas!="" && password!=""&& konPassword!="" &&  $('#verif').is(":checked")){
        $('#spinner').css('display','inline-block');
        if(password!== konPassword){
            Swal.fire({
                title: 'Error!',
                text: 'Password tidak sesuai dengan Konfirmasi Password',
                icon: 'error',
                confirmButtonText: 'Ok',
                confirmButtonColor: "#d63630"
            });
            $('#spinner').css('display','none');	
        }
        else{
            $.ajax({
                url: "backend/sign-up.php",
                type: "POST",
                data: {
                    email: email,
                    name: name,
                    kelas:kelas,
                    username: username,
                    password: password				
                },
                cache: false,
                success: function(dataResult){
                    var dataResult = JSON.parse(dataResult);
                    console.log(dataResult)
                    if(dataResult.statusCode==200){
                        Swal.fire({
                          title: 'Good job!',
                          text: 'You have signed up successfully!',
                          icon: 'success',
                          confirmButtonColor: '#23fa5c',
                        })
                        $('#inputEmail').val('');
                        $('#inputName').val('');
                        $('#inputKelas').val('');
                        $('#inputUsername').val('');
                        $('#inputPassword').val(''); 
                        $('#inputKonPassword').val(''); 
                        $('#spinner').css('display','none');						
                    }
                    else if(dataResult.statusCode==201){
                        Swal.fire({
                          title: 'Error!',
                          text: 'Signing up failed',
                          icon: 'error',
                          confirmButtonText: 'Ok',
                          confirmButtonColor: "#d63630"
                        })
                        $('#spinner').css('display','none');
                    }
                    else if(dataResult.statusCode==202){
                        Swal.fire({
                          title: 'Error!',
                          text: 'Username or Email has already existed',
                          icon: 'error',
                          confirmButtonText: 'Ok',
                          confirmButtonColor: "#d63630"
                        })
                        $('#spinner').css('display','none');
                    }
                    
                }
            });
        }
    }
    else{
            alert('Please fill all the field !');
    }
})