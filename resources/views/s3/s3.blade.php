<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Aws S3 Direct File Uploader</title>
<style type="text/css">
.upload-wrap{width: 450px;margin: 60px auto;padding: 30px;background-color: #F3F3F3;overflow: hidden;border: 1px solid #ddd;text-align: center;}
</style>
</head>
<body>
<div class="upload-wrap">
	<form action="http://<?= $my_bucket ?>.s3.amazonaws.com/" method="post" enctype="multipart/form-data">
	<input type="hidden" name="key" value="${filename}" />
	<input type="hidden" name="acl" value="public-read" />
	<input type="hidden" name="X-Amz-Credential" value="<?= $access_key; ?>/<?= $short_date; ?>/<?= $region; ?>/s3/aws4_request" />
	<input type="hidden" name="X-Amz-Algorithm" value="AWS4-HMAC-SHA256" />
	<input type="hidden" name="X-Amz-Date" value="<?=$iso_date ; ?>" />
	<input type="hidden" name="Policy" value="<?=base64_encode($policy); ?>" />
	<input type="hidden" name="X-Amz-Signature" value="<?=$signature ?>" />
	<input type="hidden" name="success_action_redirect" value="<?= $success_redirect ?>" /> 
	<input type="file" name="file" />
	<input type="submit" value="Upload File" />
	</form>
	<?php //After success redirection from AWS S3
	if(isset($_GET["key"])){
		$filename = $_GET["key"];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if(in_array($ext, array("jpg", "png", "gif", "jpeg"))){
			echo '<hr />Image File Uploaded : <br /><img src="http://'.$my_bucket.'.s3.amazonaws.com/'.$_GET["key"].'" style="width:100%;" />';
		}else{
			echo '<hr />File Uploaded : <br /><a href="http://'.$my_bucket.'.s3.amazonaws.com/'.$_GET["key"].'">'.$filename.'</a>';
		}
	}
?>
</div>
</body>
</html>