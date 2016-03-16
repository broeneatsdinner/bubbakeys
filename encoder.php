<?php

function getEncodedString($type, $file) {
	return 'data:audio/' . $type . ';base64,' . base64_encode(file_get_contents($file));
}

//$encodedString = getEncodedString('mp3','SWSKYQVOKXITNRYGWNRUGQRKZWOQSGKVSZMKMXXK.mp3');
$encodedString = getEncodedString('ogg','SWSKYQVOKXITNRYGWNRUGQRKZWOQSGKVSZMKMXXK.ogg');

echo "\r\n";
echo "\r\n";
echo $encodedString;
echo "\r\n";
echo "\r\n";