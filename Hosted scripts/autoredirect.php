<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php 
	$return_url = $_REQUEST["launch_presentation_return_url"]; 
?>
<br>

<script type="text/javascript">
	'use strict'
	function buildResponse() {
		var return_url = <?php echo json_encode($return_url) ?>;

		var return_type = 'iframe';

		var width = '100%';
		var height = '700';

		var iframe_url = 'https://drive.google.com/file/d/~ID~/preview'.replace('~ID~', extractDocumentId($('#urlinput').val()));

		var result = 	['return_type=' + encodeURIComponent(return_type),
					'url=' + encodeURIComponent(iframe_url),
					'width=' + encodeURIComponent(width),
					'height=' + encodeURIComponent(height)];

		result = return_url + '?' + result.join('&');
		
		result = result;

		return result
	}

	function extractDocumentId(input) {
		var result = input.match('[0-9a-zA-Z-]{16,}'); 
		if (result) {
			return result[0];
		}
		return ''; 
	}

</script>

<div id='preview'>loading</div>
<script type="text/javascript">document.getElementById('preview').innerText = buildResponse()</script>

<p>URL of Embedded Content:</p>

<input type="text" name="url" id="urlinput">

<button class="button" onclick="window.location = buildResponse()">Insert embedded view</button>

</body>
</html>