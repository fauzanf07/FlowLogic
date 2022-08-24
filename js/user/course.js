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
