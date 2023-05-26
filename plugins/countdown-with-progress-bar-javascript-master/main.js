function start_countdown(){
		var reverse_counter = 10;
var downloadTimer = setInterval(function(){
  document.getElementById("pbar").value = 10 - --reverse_counter;
  if(reverse_counter <= 0)
    clearInterval(downloadTimer);
	
	document.getElementById("counting").innerHTML= reverse_counter;
	


},1000);
}