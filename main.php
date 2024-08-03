<?php

#Initializing new cURL session; returns cURL handle
$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, "http://example.com");

#Returns result as a string instead of directly outputting it
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

#Fetches the content from URL and stores it in the $output variable as a string
$output = curl_exec($curl);

curl_close($curl);

$dom = new DOMDocument;
@$dom->loadHTML($output);

$links = $dom->getElementsByTagName('a');

foreach ($links as $link) {
    echo $link->getAttribute('href') . " - " . $link->nodeValue . "\n";
}

?>