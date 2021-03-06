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

		var width = $('#width').val();
		var height = $('#height').val();

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

	function getIframeURL(mode, input) {
		if (mode == 'googPDF'){
			return 'https://drive.google.com/file/d/{ID}/preview'.replace('{ID}', extractDocumentId(input));
		} 
		// if (mode == 'sharePDF') {
		// 	var pdfURL = 'https://www.sharelatex.com/project/{ID}/output/output.pdf?compileGroup=standard&pdfng=true'.replace('{ID}', extractDocumentId(input));
		// 	return 'https://docs.google.com/gview?url={URL}&embedded=true'.replace('{URL}', encodeURIComponent(pdfURL));
		// } 
		if (mode == 'otherPDF') {
			return 'https://docs.google.com/gview?url={URL}&embedded=true'.replace('{URL}', encodeURIComponent(input));
		}
		if (mode == 'overleafPDF') {
			var pdfURL = 'https://server.legoaces.org/canvas-plugins/overleaf-redirect.php?shared_url={URL}'.replace('{URL}', input);
			return 'https://docs.google.com/gview?url={URL}&embedded=true'.replace('{URL}', pdfURL);
		}
		if (mode == 'googSheet') {
			return 'https://docs.google.com/spreadsheets/d/{ID}/pubhtml?gid=0&amp;single=true&amp;widget=true&amp;headers=false'.replace('{ID}', extractDocumentId(input));
		}
		if (mode == 'googForm') {
			return 'https://docs.google.com/forms/d/e/{ID}/viewform?embedded=true'.replace('{ID}', extractDocumentId(input));
		}


		
	}

	function updateHelpText() {
		$('#warning').html(getHelpText($('#embedSource').val()));
	}

	function getHelpText(mode) {
		if (mode == 'googSheet'){
			return "Don't forget to publish the sheet through File...Publish to Web...Publish in order for the embed to succeed."
		}
		if (mode == 'sharePDF'){
			// NOTE: Because this procedure is such a pain, ShareLatex embedding is disabled currently.
			return "In order to update the published version, click \"Compile\" in a ShareLatex window while <i>not</i> signed in."
		}
		if (mode == 'overleafPDF'){
			return "Copy the URL from the read-only link (found under Share), NOT the editor page.<br>This embed will update automatically whenever any changes are made to the source document."
		}
		if (mode == 'googForm'){
			return "Be sure to copy the URL from the form preview or published form, not the editor."
		}
		return ""
	}

	$(document).ready(function() {
		updateHelpText();
		$('#embedSource').change(updateHelpText);
	})

	function extractDocumentId(input) {
		var result = input.match('[0-9a-zA-Z_-]{13,}'); 
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
	<option selected="selected" value="overleafPDF">Compiled Overleaf document</option>
	<option value="googSheet">Google Sheets (view only)</option>
	<option value="googForm">Google Form</option>
</select>
<br> 
<!-- <p>URL of Embedded Content:</p> -->

<input type="text" name="url" id="urlinput" placeholder="Content URL">

<button class="formfield" onclick="window.location = buildResponse()">Insert embedded view</button>

<div id="warning"></div>

<!-- <label for="width">Width</label> -->
<div class="additionalOptions">
<p>Additional options...</p>
	<select class="" id='width'>
		<option value="100%" selected="selected">100% width</option>
		<option value="50%">50% width</option>
		<option value="25%">25% width</option>
	</select>

	<!-- <label for="height">Height</label> -->
	<select class="" id='height'>
		<option value="150">short</option>
		<option value="350">medium</option>
		<option value="800" selected="selected">tall</option>
	</select>

	<br>
	<a style="size: 5pt;" onclick="$('#preview').text(buildResponse())" href="#">[test]</a>
</div>

<div id='preview'></div>

</body>
</html>