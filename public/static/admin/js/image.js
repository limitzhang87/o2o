$(function() {
    $("#file_upload").uploadify({
		'buttonText'	  	: '图片上传',
		'swf'             	: SCOPE.uploadify_swf,
		'uploader'        	: SCOPE.uploadify_uploader,
		'fileTypeDesc'		: 'Image files',
        'fileObjName'		: 'file',
        'fileTypeExts'		: '*.jpg;*.png;*.jpg',
        'onUploadSuccess' 	: function(file, data, response) {
            if(response){
                var data = JSON.parse(data);
                $('#upload_org_code_img').attr('src',data.msg);
                $('#upload_org_code_img').show();
                $('#file_upload_image').val(data.msg);
            }
        },
        'onUploadError' : function(file, errorCode, errorMsg, errorString) {
            alert('图片上传失败');
        }
    });

    $("#file_upload_other").uploadify({
        'buttonText'        : '图片上传',
        'swf'               : SCOPE.uploadify_swf,
        'uploader'          : SCOPE.uploadify_uploader,
        'fileTypeDesc'      : 'Image files',
        'fileObjName'       : 'file',
        'fileTypeExts'      : '*.jpg;*.png;*.jpg',
        'onUploadSuccess'   : function(file, data, response) {
            if(response){
                var data = JSON.parse(data);
                $('#upload_org_code_img_other').attr('src',data.msg);
                $('#upload_org_code_img_other').show();
                $('#file_upload_image_other').val(data.msg);
            }
        },
        'onUploadError' : function(file, errorCode, errorMsg, errorString) {
            alert('图片上传失败');
        }
    });
});