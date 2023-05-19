$(document).ready(function () {
    $('#table-user').DataTable();
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
	$('.content-2').css('display', 'none');
	$('.content-1').css('display','block');
	$("#postingan-menu").removeClass("current");
	$("#progress-menu").addClass("current");
});

$("#postingan-menu").click(function(){
	$('.content-1').css('display', 'none');
	$('.content-2').css('display','block');
	$("#progress-menu").removeClass("current");
	$("#postingan-menu").addClass("current");
});

const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Pengenalan Flowchart', 'Simbol-Simbol Flowchart', 'Pseudoode', 'Subrutin', 'Fungsi', 'Implementasi code'],
      datasets: [{
        label: '# of Rata-rata nilai',
        data: [90, 85, 83, 70, 75, 70],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
		  suggestedMin: 0,
		  suggestedMax: 100,
		  step: 20
        }
      }
    }
  });