$(document).ready(function()
{
	function percentageAnimate(progresshash, percentage)
	{
		$("#"+progresshash).animate({
			width: percentage+"%"
		}, 2500);
		setTimeout(function(){
			$("#label-"+progresshash).empty();
			var label = 
				'<label '+
					'class="badge badge-success">'+
					'Completed'+
				'</label>';
				$("#label-"+progresshash).append(label);
		}, 2500);
	}

	function uploadFile(path, folder_id, droppedFiles)
	{
		var formData = new FormData();
		for(var i = 0; i < droppedFiles.length; i++)
		{
			var progresshash = droppedFiles[i].lastModified+'-'+i;
			formData.append('file', droppedFiles[i]);
			var param = '?path='+path+'&folder_id='+folder_id+'&progresshash='+progresshash;
			ajaxUploadFile(formData, param, progresshash);
		}
	}

	function trFileUpload(droppedFiles)
	{
		for(var i = 0; i < droppedFiles.length; i++)
		{
			var progresshash = droppedFiles[i].lastModified+'-'+i;
			var name = droppedFiles[i].name;
			var size = (droppedFiles[i].size / 1024)+' KB';
			var html = 
				'<tr>'+
					'<td>'+i+'</td>'+
					'<td>'+name+'</td>'+
					'<td>'+size+'</td>'+
					'<td>'+
						'<div class="progress">'+
							'<div '+
								'id="'+progresshash+'"'+
								'class="progress-bar bg-success"'+
								'role="progressbar"'+
								'aria-valuenow="25"'+
								'aria-valuemin="0"'+
								'aria-valuemax="100">'+
							'</div>'+
						'</div>'+
					'</td>'+
					'<td id="label-'+progresshash+'">'+
						'<label '+
							'class="badge badge-warning">'+
							'In progress'+
						'</label>'+
					'</td>'+
				'</tr>';
			$("#file-table-console").append(html);
		}
	}
	function listFileUpload(droppedFiles)
	{
		for(var i = 0; i < droppedFiles.length; i++)
		{
			var progresshash = droppedFiles[i].lastModified+'-'+i;
			var name = droppedFiles[i].name;
			var html = '<b>Dropped File </b>'+name+'<div class="progress"><div id="'+progresshash+'" class="progress-bar progress-bar-striped bg-success" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div></div>';
			$("#messages").append(html);
		}
	}

	function ajaxUploadFile(formData, param, progresshash) {
		$.ajax({
			url: base_url+'FileManagers/uploadFile'+param,
			dataType: 'text',
			type: 'post',
			data: formData,
			contentType: false,
			processData: false,
				success: function(response){
					var objJSON = JSON.parse(response);
					if (objJSON.ErrorCode === 200) {
						percentageAnimate(progresshash,100);
					}
				},
				error: function(response){
					console.log(response);
				}
		});
	}
	$("#dropFiles").on('dragenter', function(event)
	{
		// Entering drop area. Highlight area
		$("#dropFiles").addClass("highlightDropArea");
	});

	$("#dropFiles").on('dragleave', function(event)
	{
		// Going out of drop area. Remove Highlight
		$("#dropFiles").removeClass("highlightDropArea");
	});

	$("#dropFiles").on('drop', function(event)
	{
		var path = $(this).data('path');
		var folder_id = $(this).data('folder_id');
		event.preventDefault();
		event.stopPropagation();
		if(event.originalEvent.dataTransfer){
			if(event.originalEvent.dataTransfer.files.length) {
				var droppedFiles = event.originalEvent.dataTransfer.files;
				listFileUpload(droppedFiles);
				setTimeout(function(){
					uploadFile(path, folder_id, droppedFiles);
				}, 100);
			}
		}
		$("#dropFiles").removeClass("highlightDropArea");
			return false;
		});

		$("#dropFiles").on('dragover', function(event) {
			event.preventDefault();
		});
		
		var $fileInput = $('.file-input');
		var $droparea = $('.file-drop-area');
					// highlight drag area
		$fileInput.on('dragenter focus click', function() {
			$droparea.addClass('is-active');
		});

		// back to normal state
		$fileInput.on('dragleave blur drop', function() {
			$droparea.removeClass('is-active');
		});

		// change inner text
		$fileInput.on('change', function() {
			var path = $(this).data('path');
			var folder_id = $(this).data('folder_id');
			var files = $(this)[0].files;
			var filesCount = files.length;
			var $textContainer = $(this).prev();
			if (filesCount === 1) {
				var fileName = $(this).val().split('\\').pop();
				$textContainer.text(fileName);
			} else {
				$textContainer.text(filesCount + ' files selected');
			}
			trFileUpload(files);
//			listFileUpload(files);
			setTimeout(function(){
				uploadFile(path, folder_id, files);
			}, 100);
		});
	})