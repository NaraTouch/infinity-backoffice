$(document).ready(function(){
	function progressAnimate(progresshash, name) {
		var html = '<b>Dropped File </b>'+name+'<div class="progress"><div id="'+progresshash+'" class="progress-bar progress-bar-striped bg-success" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div></div>';
		$("#messages").append(html);
	}
	function percentageAnimate(progresshash, percentage) {
		$("#"+progresshash).animate({
			width: percentage+"%"
		}, 2500);
	}
	function uploadFileProgress(progresshash, name) {
		var param = '?progresshash='+progresshash;
		progressAnimate(progresshash, name);
		setTimeout(function(){
			$.ajax({
				url: base_url+'FileManagers/uploadFileProgress'+param,
				dataType: 'text',
				type: 'post',
				contentType: false,
				processData: false,
				statusCode: {
					200: function(responseObject, textStatus, jqXHR) {
						var objJSON = JSON.parse(responseObject);
						if (objJSON.Data && objJSON.Data.finished) {
							percentageAnimate(progresshash,100);
						} else {
							var percentage = (objJSON.Data.uploaded / objJSON.Data.total) * 100;
							percentageAnimate(progresshash,percentage);
						}
					},
					404: function(responseObject, textStatus, jqXHR) {
						uploadFileProgress(progresshash, name);
					},
					500: function(responseObject, textStatus, errorThrown) {
						uploadFileProgress(progresshash, name);
					}
				}
			});
		}, 500);
	}

	function uploadFile(formData,param, id, name) {
		setTimeout(function(){
			$.ajax({
				url: base_url+'FileManagers/uploadFile'+param,
				dataType: 'text',
				type: 'post',
				data: formData,
				contentType: false,
				processData: false,
				success: function(response){

				},
			});
			uploadFileProgress(id, name);
		}, 500);
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
					var name = droppedFiles[i].name;
					formData.append('file', droppedFiles[i]);
					var param = '?path='+path+'&folder_id='+folder_id+'&progresshash='+id;
					uploadFile(formData, param, id, name);
//					$.ajax({
//						url: base_url+'FileManagers/uploadFile'+param,
//						dataType: 'text',
//						type: 'post',
//						data: formData,
//						contentType: false,
//						processData: false,
////						success: function(response){
////						},
//					});
//					uploadFileProgress(id, name);
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