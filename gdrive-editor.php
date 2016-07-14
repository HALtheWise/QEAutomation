<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<script type="text/javascript">
	'use strict'
	function buildResponse() {
		var return_url = <?php echo json_encode($_REQUEST["launch_presentation_return_url"]) ?>;

		var return_type = 'iframe';

		var width = '100%';
		var height = '700';

		var iframe_url = getIframeURL($('#embedSource').val(), $('#urlinput').val());

		console.log(iframe_url)

		var result = 	['return_type=' + encodeURIComponent(return_type),
					'url=' + encodeURIComponent(iframe_url),
					'width=' + encodeURIComponent(width),
					'height=' + encodeURIComponent(height)];

		result = return_url + '?' + result.join('&');
		
		result = result;

		return result
	}

	function getIframeURL(type, input) {
		if (type == 'googPDF' || type == 'googSheet'){
			return 'https://drive.google.com/file/d/~ID~/preview'.replace('~ID~', extractDocumentId(input));
		} 
		// if (type == 'sharePDF') {
		// 	var pdfURL = 'https://www.sharelatex.com/project/~ID~/output/output.pdf?compileGroup=standard&pdfng=true'.replace('~ID~', extractDocumentId(input));
		// 	return 'https://docs.google.com/gview?url=~URL~&embedded=true'.replace('~URL~', encodeURIComponent(pdfURL));
		// } 
		if (type == 'otherPDF') {
			return 'https://docs.google.com/gview?url=~URL~&embedded=true'.replace('~URL~', encodeURIComponent(input));
		}
		if (type == 'googSheet') {
			return 'https://docs.google.com/spreadsheets/d/~ID~/pubhtml?gid=0&amp;single=true&amp;widget=true&amp;headers=false'.replace('~ID~', extractDocumentId(input));
		}

		
	}

	function extractDocumentId(input) {
		var result = input.match('[0-9a-zA-Z-]{16,}'); 
		if (result) {
			return result[0];
		}
		return ''; 
	}

</script>

<select class="formfield" id='embedSource'>
	<option value="googPDF">PDF from Google Drive</option>
	<!-- <option value="sharePDF">PDF from ShareLatex</option> -->
	<option value="otherPDF">PDF from another source</option>
	<option value="googSheet">Google Sheets (view only)</option>
</select>

<!-- <p>URL of Embedded Content:</p> -->

<input type="text" name="url" id="urlinput" placeholder="Content URL">

<button class="formfield" onclick="window.location = buildResponse()">Insert embedded view</button>
<button class="formfield" onclick="$('#preview').text(buildResponse())">[test]</button>

Width:
<select class="formfield" id='width'>
	<option>100%</option>
	<option>50%</option>
	<option>25%</option>
</select>
<br>
Height:
<select class="formfield" id='height'>
	<option value="150">small</option>
	<option value="350">medium</option>
	<option value="800">large</option>
</select>

<div id='preview'></div>

</body>
</html>