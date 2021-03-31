$(document).ready(function(){
	
	$("#dropFiles").on('dragenter', function(event) {
		// Entering drop area. Highlight area
		$("#dropFiles").addClass("highlightDropArea");
	});

	$("#dropFiles").on('dragleave', function(event) {
		// Going out of drop area. Remove Highlight
		$("#dropFiles").removeClass("highlightDropArea");
	});

	$("#dropFiles").on('drop', function(event) {
		event.preventDefault();
		event.stopPropagation();
//		$("#messages").empty();
		if(event.originalEvent.dataTransfer){
		if(event.originalEvent.dataTransfer.files.length) {
			var droppedFiles = event.originalEvent.dataTransfer.files;
			console.log(droppedFiles);
			for(var i = 0; i < droppedFiles.length; i++)
			{
				var id = droppedFiles[i].lastModified+'-'+i;
				var html = '<b>Dropped File </b>'+droppedFiles[i].name+'<div class="progress"><div id="'+id+'" class="progress-bar progress-bar-striped bg-success" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div></div>';
				$("#messages").append(html);
				$("#"+id).animate({
					width: "100%"
				}, 2500);
			}
		}
	}

	$("#dropFiles").removeClass("highlightDropArea");
		return false;
	});

	$("#dropFiles").on('dragover', function(event) {
		event.preventDefault();
	});
})