var page = 1;
$('#sign-out').click(function(){
	window.location.href = "./logout.php";
});

$('#loadRanksMore').click(function(){
	console.log("kskd");
	console.log(page);
	page = page+1;
})
