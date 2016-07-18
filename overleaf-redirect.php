<?php 
	$shared_url = $_REQUEST["shared_url"];

	// echo $shared_url;

	$xml = file_get_contents($shared_url);

	// echo substr($xml, 2, 10);

	$match = preg_match_all("/https:\/\/preview.overleaf.com:443\/public\/[^\.]+\.pdf/", $xml, $output_array, PREG_SET_ORDER);

	$firstlink = $output_array[0][0];
 // 	echo "<br>";
	// echo $firstlink;

	// echo "<br>";

	header( 'Location: ' . $firstlink ) ;
?>