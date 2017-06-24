<?php 
	$shared_url = $_REQUEST["shared_url"];

	echo $shared_url;

	// $xml = file_get_contents($shared_url);

	// echo substr($xml, 2, 10);

	$match = preg_match_all("([\d\w]{12})", $shared_url, $output_array, PREG_SET_ORDER);

	$id = $output_array[0][0];
 	echo "<br>";
	echo $id;

	// echo "<br>";

	header( 'Location: ' . 'https://www.overleaf.com/docs/' . $id . '/pdf.pdf' ) ;
?>
