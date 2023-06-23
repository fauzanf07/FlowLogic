
function allowDrop(ev) {
	ev.preventDefault();
}

function drag(ev) {
	ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
	ev.preventDefault();
	var data = ev.dataTransfer.getData("text");
	ev.target.appendChild(document.getElementById(data));
}

function check(idUser, game){
	const parent1 = $('#drop1');
	const imageElements1 = parent1.find('img');
	let benarLokal = 0;

	imageElements1.each(function() {
		const dataId = $(this).data('id');
		if( dataId == 3 || dataId == 4 || dataId == 5){
			benarLokal++;
		}
	});

	const parent2 = $('#drop2');
	const imageElements2 = parent2.find('img');
	let benarGlobal = 0;

	imageElements2.each(function() {
		const dataId = $(this).data('id');
		console.log(dataId);
		if(dataId == 1 || dataId == 2){
			benarGlobal++;
		}
	});
	console.log(benarGlobal+' '+benarLokal);
	if(benarLokal==3 && benarGlobal==2){
		let poin = parseInt($('#poin').html());
		let poinUser = parseInt($('#pointsUser').html());
		gameFinished(idUser,poin, game,poinUser);
	}else{
		let poin = parseInt($('#poin').html());
		$('#poin').html(poin-5);
		$('#result').removeClass('right-res').addClass('wrong-res');
		$('#result').html("Oops! Jawaban anda masih salah. Ayo coba lagi!")
	}
}


function gameFinished(idUser,points,game,poinUser){
	$.ajax({
		url: "./course_trans/insert_game.php",
		type: "POST",
		data: {
			idUser: idUser,
			points: points,
			game: game
		},
		cache: false,
		success: function(dataResult){
			var dataResult = JSON.parse(dataResult);
			console.log(dataResult);
			if(dataResult.statusCode == 200){
				$('#pointsUser').html(points+poinUser);
				$('#check').remove();
				$('#getPoin').remove();
				$('#result').removeClass('wrong-res').addClass('right-res');
				$('#result').html("Yeay, Anda benar dengan "+points+" poin yang didapatkan! Itu berarti anda sudah mengenal perbedaan antara variabel lokal dan global.");
				updateHistory(idUser,4,points,"Berhasil mengidentifikasi variabel lokal dan global")
			}
		}
	});
}