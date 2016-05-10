<?php

/**
 * You can run this baby from the command line with `php helper.php` to see the
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

function getFilesWithExtension($extension) {
	$filesArray = glob("*");
	$filesArray =  preg_grep("/\.{$extension}$/i", $filesArray);
	return array_values($filesArray);
}

function abortMission() {
	echo "\n";
	echo "Exiting. No changes were made.\n";
	echo "Run 'php helper.php' again, and choose a valid option next time!\n";
	echo "\n";
	exit;
}

function waitForNumericInput() {
	$handle = fopen ("php://stdin","r");
	$input = fgets($handle);
	$input = trim($input);
	fclose($handle);

	if (!is_numeric($input)) {
		abortMission();
	}

	return $input;
}

echo "\n";
echo "1: MP3 files\n";
echo "2: OGG files\n";
echo "Type the number corresponding to the filetype that you want to convert: ";
$input = waitForNumericInput();

switch ($input) {
	case "1":
		echo "\n";
		echo "You chose MP3 files.\n";
		$extension = "mp3";
		break;
	case "2":
		echo "\n";
		echo "You chose OGG files.\n";
		$extension = "ogg";
		break;
	default:
		abortMission();
}

$filesArray = getFilesWithExtension($extension);

if (count($filesArray) < 1) {
	$extension = strtoupper($extension);
	echo "Sorry, no $extension files were found.\n";
	echo <<<EOD
Try again by placing your $extension files in the same directory as this script,
and run 'php helper.php' once they're there.
\n
EOD;
	exit;
}

echo "Choose a file:\n";
$i = 0;
foreach ($filesArray as $file) {
	$i++;
	echo "$i: " . $file . "\n";
}

echo "Type the number corresponding to the file you want to convert: ";
$input = waitForNumericInput();

$indexOfFileChosen = (int)$input - 1;
$file = $filesArray[$indexOfFileChosen];

if (!$file || !file_get_contents($file)) {
	abortMission();
}

echo "\n";
echo "Thank you, you chose: $file\n";
echo "\n";
echo "1: Output to screen\n";
echo "2: Output to file\n";
echo "Type the number corresponding to the output that you'd like: ";
$input = waitForNumericInput();

switch ($input) {
	case "1":
		echo "\n";
		echo "You chose to output to screen.\n";
		$output = "screen";
		break;
	case "2":
		echo "\n";
		echo "You chose to output to a file.\n";
		$output = "file";
		break;
	default:
		abortMission();
}

$encodedString = getEncodedString($extension, $file);

if ($output == "screen") {
	echo "\r\n";
	echo "\r\n";
	echo $encodedString;
	echo "\r\n";
	echo "\r\n";
	exit;
}

if ($output == "file") {
	$filePathParts = pathinfo($file);
	$outputFile = $filePathParts['basename'] . ".txt";
	file_put_contents($outputFile, $encodedString);
	echo "Outputted the encoded string to $outputFile\n";
	exit;
}
