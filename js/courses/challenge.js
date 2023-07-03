var elements = document.querySelectorAll('.editor');

elements.forEach(function(element) {
    var editor = ace.edit(element);
    editor.setTheme("ace/theme/twilight");
    editor.session.setMode("ace/mode/c_cpp");
})

function getValue(index){
    let i=0;
    let value = "";
    elements.forEach(function(element) {
        var editor = ace.edit(element);
        if(i==index){
            value = editor.getValue();
        }
        i++;
    });
    return value;
}

$('.lang-list').on('change', function (e) {
    var optionSelected = $(".lang-list option:selected").val();
	var value = optionSelected.split(" ");
	const codeChoice = parseInt(value[0]);
	editor.session.setMode("ace/mode/"+value[1]);
	switch (codeChoice) {
		case 4:
			editor.setValue("/* Harus diawali dengan public class Progman{ ... } */");
			break;
		case 6:
			editor.setValue("//Tidak perlu memasukan preprocesor directive seperti #include<stdio.h>");
			break;
		case 7:
			editor.setValue("//Tidak perlu memasukan preprocesor directive seperti #include<stdio.h>");
			break;
	}
});

function run(idUser,index,out,point,xp){
	var optionSelected = $(".lang-list option:selected").val();
	var value = optionSelected.split(" ");
	var codeChoice = value[0];
	var code = getValue(index);
	console.log(codeChoice);
	$('#preview-code'+index).html('<span id="output">Running...</span>');
	const settings = {
		"async": true,
		"crossDomain": true,
		"url": "https://code-compiler.p.rapidapi.com/v2",
		"method": "POST",
		"headers": {
			"content-type": "application/x-www-form-urlencoded",
			"X-RapidAPI-Key": "7551b4305bmsh6ab4e93884d4a74p152950jsn675a3dc36544",
			"X-RapidAPI-Host": "code-compiler.p.rapidapi.com"
		},
		"data": {
			"LanguageChoice": codeChoice,
			"Program": code,
		}
	};
	
	$.ajax(settings).done(function (response) {
		$("#output").remove();
		var error = JSON.stringify(response.Errors);
		if(error === "null"){
			var output = JSON.stringify(response.Result);
			output = output.replace(/\"/g, "");
			output = output.replace(/\\n/g, "<br />");
			output = output.replace(/\\t/g, "&nbsp;&nbsp;&nbsp;&nbsp;");
			output = output.replace(/\\s/g, "&nbsp;");
			$('#preview-code'+index).html('<span id="output">'+output+'</span>');
            if(output === out){
                $('#button'+index).removeClass('btn-primary').addClass('btn-success');
                $('#button'+index).removeAttr('onclick');
                var pointsUser = parseInt($('#pointsUser').html());
                var xpUser = parseInt($('#xpUser').html());
                console.log(pointsUser+' '+xpUser+' '+xp+' '+point);
                $('#pointsUser').html(pointsUser+point);
                $('#xpUser').html(xpUser+xp);
                submit(idUser,(index+1),code,xp,point);
            }
		}else{
			error = error.replace(/\"/g, "");
			error = error.replace(/\\\\/g, "\\");
			$('#preview-code'+index).html('<span id="output" class="error">'+error+'</span>');
		}
		
	});
};


function submit(idUser, sk, code,xp, points){
    $.ajax({
        url: "./course_trans/insert_challenge_code.php",
        type: "POST",
        data: {
            idUser: idUser,
            sk: sk,
            code: code,
            xp: xp,
            points: points,
        },
        cache: false,
        success: function(dataResult){
            var dataResult = JSON.parse(dataResult);
            console.log(dataResult);
            updateHistory(idUser,2,xp,"Kamu telah menyelesaikan Studi Kasus "+sk);
             updateHistory(idUser,4,points,"Kamu telah menyelesaikan Studi Kasus "+sk);
			dataResult.listUser.forEach(function(user) {
				$('#rank-table'+(sk-1)).append("<tr><th scope='row'>"+(i+1)+"</th><td>"+user.name+"</td><td>"+user.submit_at+"</tr>");
			});
            $('#table'+(sk-1)).css('display','block');
			getBadge(idUser);
        }
});
}

function getBadge(idUser){
	$.ajax({
        url: "./course_trans/get_badge.php",
        type: "POST",
        data: {
            idUser: idUser,
            idChall: 6,
        },
        cache: false,
        success: function(dataResult){
            var dataResult = JSON.parse(dataResult);
            console.log(dataResult);
            if(dataResult.statusCode==201){
				$('#getBadge').css('display','block');
				updateHistory(idUser,3,0,"Kamu mendapatkan lencana Penakluk kode atas menyelesaikan semua studi kasus pada Challenge 3");
			}
        }
	});
}