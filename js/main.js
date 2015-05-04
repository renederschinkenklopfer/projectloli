$( document ).ready(function() {
	$("#newThread").click(function() {
	  $('.navbar-collapse').collapse('hide');
	  $("#postThread").show( "fast", function() {
	  });
	});

	document.getElementById("uploadBtn").onchange = function () {  
		document.getElementById("uploadFile").value = this.value.replace(/^.*\\/, "");;
	};
});