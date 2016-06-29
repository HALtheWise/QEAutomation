<!DOCTYPE html>
<html>
<body>

<?php
$return_url = $_REQUEST["launch_presentation_return_url"];
echo $return_url;
?>
<br>

<script type="text/javascript">
	'use strict'
	function buildResponse() {
		var return_url = <?php echo json_encode($return_url) ?>;

		var return_type = 'image_url';

		var width = '100%';
		var height = '800';

		var image_url = 'https://upload.wikimedia.org/wikipedia/en/thumb/8/80/Wikipedia-logo-v2.svg/1122px-Wikipedia-logo-v2.svg.png';

		var result = 	['return_type=' + encodeURIComponent(return_type),
					'url=' + encodeURIComponent(image_url),
					'alt=' + '',
					'width=' + encodeURIComponent(width),
					'height=' + encodeURIComponent(height)];

		result = return_url + '?' + result.join('&');
		
		result = result;

		return result
	}

	function extractDocumentId(str) {
		var result = str.match('[0-9a-zA-Z-]{40,}');
		if (result.length > 0) {
			return result[0];
		}
		return '';
	}

</script>

<div id='preview'>loading</div>
<script type="text/javascript">document.getElementById('preview').innerText = buildResponse()</script>

<button onclick="window.location = buildResponse()">Redirect</button>

</body>
</html>