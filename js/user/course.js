$('#continueClass').click(function(){
	const currCourse = $(this).data('course');
	const username = $(this).data('username');
	$.ajax({
		url: "./user_trans/continue_class.php",
		type: "POST",
		data: {
			currCourse: currCourse,
			username: username		
		},
		cache: false,
		success: function(dataResult){
			var dataResult = JSON.parse(dataResult);
			console.log(dataResult);
			window.location.href = "../courses/"+dataResult.course+".php";
		}
	});
});
$('#material1').click(function(){
	var myCollapse = document.getElementById('materialCollapse1');
	const bsCollapse = new bootstrap.Collapse(myCollapse, {
	  toggle: true
	});
});

$('#material2').click(function(){
	var myCollapse = document.getElementById('materialCollapse2');
	const bsCollapse = new bootstrap.Collapse(myCollapse, {
	  toggle: true
	});
});

$('#material3').click(function(){
	var myCollapse = document.getElementById('materialCollapse3');
	const bsCollapse = new bootstrap.Collapse(myCollapse, {
	  toggle: true
	});
});

$('#material4').click(function(){
	var myCollapse = document.getElementById('materialCollapse4');
	const bsCollapse = new bootstrap.Collapse(myCollapse, {
	  toggle: true
	});
});

$('#material5').click(function(){
	var myCollapse = document.getElementById('materialCollapse5');
	const bsCollapse = new bootstrap.Collapse(myCollapse, {
	  toggle: true
	});
});

$('#sign-out').click(function(){
	window.location.href = "./logout.php";
})
