<?php

function downloadFile($url, $savePath){
    $fileContent = file_get_contents($url);
    file_put_contents($savePath, $fileContent);
}

#Initializing new cURL session; returns cURL handle
$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, "http://juniortaskvaldabimbirule.id.lv/");

#Returns result as a string instead of directly outputting it
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

#Fetches the content from URL and stores it in the $output variable as a string
$output = curl_exec($curl);

curl_close($curl);

if($output === false){
    echo "Error fetching URL: " . curl_error($curl);
    exit;
}

//Save the HTML content to a local file
$file = 'copied_content.html';
file_put_contents($file, $output);

$dom = new DOMDocument;
@$dom->loadHTML($output);

//Download CSS files
$links = $dom->getElementsByTagName('link');
foreach ($links as $link) {
    $rel = $link->getAttribute('rel');
    if ($rel === 'stylesheet') {
        $cssUrl = $link->getAttribute('href');
        downloadFile($cssUrl, basename($cssUrl));
        echo "Downloaded CSS: " . basename($cssUrl) . "\n";
    }
}

?>