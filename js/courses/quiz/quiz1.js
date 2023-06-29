let kj_id = [2,5,5,4,3];
let xp = 0;
let points =0;
let benar=0;
let salah=0;
function updateAward(soal){
    $('#total-xp'+soal).html(xp);
    $('#total-points'+soal).html(points);
}
function startTimer(soal,time){
    updateAward(soal);
    $('#auto-refresher'+soal).autoRefresher({
        seconds: time,
        callback: function () {
            evaluasi(soal, time, true);
        },
        progressBarHeight: '7px',
        showControls: false,
        stopButtonClass: 'stopTimer',
        stopButtonInner: 'Stop',
        startButtonClass: 'startTimer',
        startButtonInner: 'Start',
        timeRemainingId: '#auto-refresher-time-remaining'+soal
    });
}

function choose(it){
$('.pilgan-box').removeClass('choose');
$(it).addClass('choose');
}

function popUp(){
$('.pop-up').addClass('isOn');
setTimeout(() => {
    $('.pop-up').removeClass('isOn');
  }, 2000);
}

function getXpAndPoint(min, max, time, soal){
    var range = max - min;
    var remainTime= parseInt($('#auto-refresher-time-remaining'+soal).html());
    var bonus = Math.floor(remainTime * range/time);
    return min + bonus;
}

function disabledPilgan(soal){
    for(let i=1; i<=5;i++){
        $('#pilgan'+soal+i).removeAttr('onclick');
    }
}
function evaluasi(soal, time, timesUp){
    let id = $('.choose').data('id') ;
    id = id == undefined ? -1 : id ;
    console.log(id);
    if(id!=-1 || timesUp){
        disabledPilgan(soal);
        $('#auto-refresher').trigger('stop');
        let check = id == kj_id[soal-1] ? 1 : 0;
        if(check==1){
            benar++;
            $('.choose').addClass('correct');
            let addXp = getXpAndPoint(20,60,time,soal);
            let addPoints = getXpAndPoint(5,20,time,soal);
            xp += addXp;
            points +=addPoints;
            $('#add-xp').html(addXp);
            $('#add-points').html(addPoints);
            console.log('hello');
            updateAward(soal);
            popUp();
        }else{
            salah++;
            $('.choose').addClass('wrong');
            $('#pilgan'+soal+kj_id[soal-1]).addClass('correct');
        }
        $('.stopTimer').trigger('click');
        $('#btnEval'+soal).css('display','none');
        $('#nextSoal'+soal).css('display','inline-block');
        $('.pilgan-box').removeClass('choose');
    }
}

function determineGrade(nilai) {
    if (nilai >= 90) {
      return "A";
    } else if (nilai >= 80) {
      return "B";
    } else if (nilai >= 70) {
      return "C";
    } else if (nilai >= 60) {
      return "C";
    } else {
      return "D";
    }
}

function result(jml, user){
    let nilai = Math.round((benar/jml)*100);
    let grade = determineGrade(nilai);
    let xpUser = parseInt($('#xpUser').html())+xp;
    let pointsUser = parseInt($('#pointsUser').html())+points;
    $('#rsltXP').html(xp);
    $('#rsltPoints').html(points);
    $('#rsltXP').html(xp);
    $('#jmlBnr').html(benar);
    $('#jmlSlh').html(salah);
    $('#totalResXP').html(xp);
    $('#totalResPoints').html(points);
    $('#totalNilai').html(nilai);
    $('#grade').html(grade);
    if(grade == 'A' || grade=='B'){
        $('.grade').css('color','#0cff00');
        $('.grade').css('border','2px solid #0cff00');
    }else if(grade == 'C'){
        $('.grade').css('color','yellow');
        $('.grade').css('border','2px solid yellow');
    }else{
        $('.grade').css('color','red');
        $('.grade').css('border','2px solid red');
    }

    updateHistory(user,2,xp,"Kamu telah menyelesaikan Quiz Singkat 1");
    updateHistory(user,4,points,"Kamu telah menyelesaikan Quiz Singkat 1");

    $.ajax({
        url: "./course_trans/insert_quiz.php",
        type: "POST",
        data: {
            idUser: user,
            benar: benar,
            salah: salah,
            xp: xp,
            points: points,
            nilai: nilai,
            grade: grade,
            quiz: 1,
            xpUser: xpUser,
            pointsUser: pointsUser
        },
        cache: false,
        success: function(dataResult){
            var dataResult = JSON.parse(dataResult);
            console.log(dataResult);
            for(i=0; i< dataResult.length; i++){
				$('#rank-table').append("<tr><th scope='row'>"+(i+1)+"</th><td>"+dataResult[i].name+"</td><td>"+dataResult[i].xp+"</td><td>"+dataResult[i].points+"</td></tr>");
			}
            $('#xpUser').html(xpUser+' XP');
            $('#pointsUser').html(pointsUser+' Points');

        }
});
}