$('#userFootprint').click(function(){
	const myModal = new bootstrap.Modal('#exampleModal', {
	  keyboard: false
	})
	const modalToggle = document.getElementById('exampleModal'); 
	myModal.show(modalToggle);
});