var editor = ace.edit("editor");
editor.setTheme("ace/theme/twilight");
editor.session.setMode("ace/mode/csharp");

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

$("#run").click(function(){
	var optionSelected = $(".lang-list option:selected").val();
	var value = optionSelected.split(" ");
	var codeChoice = value[0];
	var code = editor.getValue();
	console.log(codeChoice);
	$('.preview-code').html('<span id="output">Running...</span>');
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
			$('.preview-code').html('<span id="output">'+output+'</span>');
		}else{
			error = error.replace(/\"/g, "");
			error = error.replace(/\\\\/g, "\\");
			$('.preview-code').html('<span id="output" class="error">'+error+'</span>');
		}
		
	});
});
