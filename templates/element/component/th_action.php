<?php
if (isset($features['index'])) :
	unset($features['index']);
endif;
if (isset($features['add'])) :
	unset($features['add']);
endif;
if (isset($features['view'])) :
	unset($features['view']);
endif;
// file
if (isset($features['uploadFile'])) :
	unset($features['uploadFile']);
endif;
if (isset($features['uploadFileProgress'])) :
	unset($features['uploadFileProgress']);
endif;
if (isset($features['createFolderIfNotExists'])) :
	unset($features['createFolderIfNotExists']);
endif;

if (!empty($features) &&
		(isset($features['edit']) && $features['edit'] == true) ||
		(isset($features['delete']) && $features['delete'] == true) ||
		(isset($features['permission']) && $features['permission'] == true) ||
		// File
		(isset($features['deleteFolder']) && $features['deleteFolder'] == true) ||
		(isset($features['renameFolder']) && $features['renameFolder'] == true) ||
		(isset($features['renameFile']) && $features['renameFile'] == true) ||
		(isset($features['deleteFile']) && $features['deleteFile'] == true) ||
		(isset($features['fileManager']) && $features['fileManager'] == true)
):
?>
<th>Actions</th>
<?php endif; ?>