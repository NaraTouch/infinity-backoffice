$(document).ready(function(){
	
	function uploadFileProgress(progresshash) {
		var param = '?progresshash='+progresshash;
		$.ajax({
			url: base_url+'FileManagers/uploadFileProgress'+param,
			dataType: 'text',
			type: 'post',
			contentType: false,
			processData: false,
			statusCode: {
				200: function(responseObject, textStatus, jqXHR) {
					console.log(responseObject.Data);
				},
				404: function(responseObject, textStatus, jqXHR) {
					console.log(responseObject);
				},
				500: function(responseObject, textStatus, errorThrown) {
					console.log(responseObject);
				}
			}
		});
	}
	$("#dropFiles").on('dragenter', function(event) {
		// Entering drop area. Highlight area
		$("#dropFiles").addClass("highlightDropArea");
	});

	$("#dropFiles").on('dragleave', function(event) {
		// Going out of drop area. Remove Highlight
		$("#dropFiles").removeClass("highlightDropArea");
	});

	$("#dropFiles").on('drop', function(event) {
		var path = $(this).data('path');
		var folder_id = $(this).data('folder_id');
		event.preventDefault();
		event.stopPropagation();
		if(event.originalEvent.dataTransfer){
			if(event.originalEvent.dataTransfer.files.length) {
				var droppedFiles = event.originalEvent.dataTransfer.files;
				var formData = new FormData();
				for(var i = 0; i < droppedFiles.length; i++)
				{
					var id = droppedFiles[i].lastModified+'-'+i;
					formData.append('file', droppedFiles[i]);
					var param = '?path='+path+'&folder_id='+folder_id+'&progresshash='+id;
					$.ajax({
						url: base_url+'FileManagers/uploadFile'+param,
						dataType: 'text',
						type: 'post',
						data: formData,
						contentType: false,
						processData: false,
//						success: function(response){
//						},
					});
					uploadFileProgress(id);
	//				var id = droppedFiles[i].lastModified+'-'+i;
	//				var html = '<b>Dropped File </b>'+droppedFiles[i].name+'<div class="progress"><div id="'+id+'" class="progress-bar progress-bar-striped bg-success" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div></div>';
	//				$("#messages").append(html);
	//				$("#"+id).animate({
	//					width: "100%"
	//				}, 2500);
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