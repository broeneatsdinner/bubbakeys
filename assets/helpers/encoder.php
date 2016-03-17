<?php

/**
 * You can run this baby from the command line with `php encoder.php` to see the
 * output generated from this file. Hardcode the name of the audio file into the
 * getEncodedString method call, and make sure the audio file is in the same
 * directory as the encoder.php file.
 * @param  [type] $type [description]
 * @param  [type] $file [description]
 * @return [type]       [description]
 */
function getEncodedString($type, $file) {
	return 'data:audio/' . $type . ';base64,' . base64_encode(file_get_contents($file));
}

$encodedString = getEncodedString('mp3','SWSKYQVOKXITNRYGWNRUGQRKZWOQSGKVSZMKMXXK.mp3');
//$encodedString = getEncodedString('ogg','SWSKYQVOKXITNRYGWNRUGQRKZWOQSGKVSZMKMXXK.ogg');

echo "\r\n";
echo "\r\n";
echo $encodedString;
echo "\r\n";
echo "\r\n";