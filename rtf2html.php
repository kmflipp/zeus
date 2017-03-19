<?php
function ProcessTags($tags, $line) {
	$html = "";
	global $color;
	global $size;
	global $bullets;
	// Remove spaces.
	$tags = trim($tags);
	// Found the beginning of the bulleted list.
	if(ereg("\\\pnindent", $tags)) {
	 $html .= "<ul><li>";
	 $bullets += $line;
	 $tags = ereg_replace("\\\par", "", $tags);
	 $tags = ereg_replace("\\\(tab)", "", $tags);
	}
	if($line - $bullets == 0) {
	 $tags = ereg_replace("\\\par", "", $tags);
	}
	elseif($line - $bullets == 1) {
	 if(ereg("\\\pntext", $tags)) {
	 $html .= "<li>";
	 $tags = ereg_replace("\\\par", "", $tags);
	 $tags = ereg_replace("\\\(tab)", "", $tags);
	 $bullets++;
	 }
	 else {
	 $html .= "</ul>";
	 $bullets = 0;
	 }
	}
	// Convert Bold.
	if(ereg("\\\b0", $tags)){ $html .= "</b>"; }
	elseif(ereg("\\\b", $tags)) { $html .= "<b>"; }
	// Convert Italic.
	if(ereg("\\\i0", $tags)){ $html .= "</i>"; }
	elseif(ereg("\\\i", $tags)) { $html .= "<i>"; }
	// Convert Underline.
	if(ereg("\\\ulnone", $tags)){ $html .= "</u>"; }
	elseif(ereg("\\\ul", $tags)){ $html .= "<u>"; }
	// Convert Alignments.
	if(ereg("\\\pard\\\qc", $tags)) { $html .= "<div align=center>"; }
	elseif(ereg("\\\pard\\\qr", $tags)) { $html .= "<div align=right>"; }
	elseif(ereg("\\\pard", $tags)){ $html .= "<div align=left>"; }
	// Remove \pard from the tags so it doesn't get confused with \par.
	$tags = ereg_replace("\\\pard", "", $tags);
	// Convert line breaks.
	if(ereg("\\\par", $tags)){ $html .= "<br>"; }
	// Use the color table to capture the font color changes.
	if(ereg("\\\cf[0-9]", $tags)) {
	 global $fcolor;
	 $numcolors = count($fcolor);
	 for($i = 0; $i < $numcolors; $i++) {
	 $test = "\\\cf" . ($i + 1);
	 if(ereg($test, $tags)) {
	$color = $fcolor[$i];
	 }
	 }
	}
	// Capture font size changes.
	if(ereg("\\\fs[0-9][0-9]", $tags, $temp)) {
	 $size = ereg_replace("\\\fs", "", $temp[0]);
	 $size /= 2;
	 if($size <= 10) { $size = 1; }
	 elseif($size <= 12) { $size = 2; }
	 elseif($size <= 14) { $size = 3; }
	 elseif($size <= 16) { $size = 4; }
	 elseif($size <= 18) { $size = 5; }
	 elseif($size <= 20) { $size = 6; }
	 elseif($size <= 22) { $size = 7; }
	 else{ $size = 8; }
	}
	// If there was a font color or size change, change the font tag now.
	if(ereg("(\\\cf[0-9])||(\\\fs[0-9][0-9])", $tags)) {
	 $html .= "</font><font size=$size color=$color>";
	}
	// Replace \tab with alternating spaces and nonbreakingwhitespaces.
	if(ereg("\\\(tab)", $tags)) { $html .= "        "; }
	return $html;
}

function ProcessWord($word) {
	// Replace \\ with \
	$word = ereg_replace("[\\]{2,}", "\\", $word);
	// Replace \{ with {
	$word = ereg_replace("[\\][\{]", "\{", $word);
	// Replace \} with }
	$word = ereg_replace("[\\][\}]", "\}", $word);
	// Replace 2 spaces with one space.
	$word = ereg_replace(" ", "  ", $word);
	return $word;
}


$color = "000000";
$size = 1;
$bullets = 0;
$userfile = "C:/wwwroot/zeus.rvasa.ch/upload/NMA 788       ENG    PROTECTION MAINTANCE CLAUSE.rtf";
// Read the uploaded file into an array.
$rtfile = file($userfile);
$fileLength = count($rtfile);

// Loop through the rest of the array
for($i = 1; $i < $fileLength; $i++) {
	/*
	** If the line contains "\colortbl" then we found the color table.
	** We'll have to split it up into each individual red, green, and blue
	** Convert it to hex and then put the red, green, and blue back together.
	** Then store each into an array called fcolor.
	*/
	if(ereg("^\{\\\colortbl", $rtfile[$i])) {
		// Split the line by the backslash.
		$colors = explode("\\", $rtfile[$i]);
		$numOfColors = count($colors);
		for($k = 2; $k < $numOfColors; $k++) {
			// Find out how many different colors there are.
			if(ereg("[0-9]+", $colors[$k], $matches)) {
				$match[] = $matches[0];
	 		}
	 	}
	 
		// For each color, convert it to hex.
		$numOfColors = count($match);
		for($k = 0; $k < $numOfColors; $k += 3) {
			$red = dechex($match[$k]);
			$red = $match[$k] < 16 ? "0$red" : $red;
			$green = dechex($match[$k + 1]);
			$green = $match[$k +1] < 16 ? "0$green" : $green;
			$blue = dechex($match[$k + 2]);
			$blue = $match[$k + 2] < 16 ? "0$blue" : $blue;
			$fcolor[] = "$red$green$blue";
		}
		$numOfColors = count($fcolor);
	}
	// Or else, we parse the line, pulling off words and tags.
	else {
		$token = "";
		$start = 0;
		$lineLength = strlen($rtfile[$i]);
		for($k = 0; $k < $lineLength; $k++) {
			if($rtfile[$i][$start] == "\\" && $rtfile[$i][$start + 1] != "\\") {
				// We are now dealing with a tag.
				$token .= $rtfile[$i][$k];
				if($rtfile[$i][$k] == " ") {
					$newFile[$i] .= ProcessTags($token, $i);
					$token = "";
					$start = $k + 1;
				}
				elseif($rtfile[$i][$k] == "\n") {
					$newFile[$i] .= ProcessTags($token, $i);
					$token = "";
				}
			}
			elseif($rtfile[$i][$start] == "{") {
				// We are now dealing with a tag.
				$token .= $rtfile[$i][$k];
				if($rtfile[$i][$k] == "}") {
					$newFile[$i] .= ProcessTags($token, $i);
					$token = "";
					$start = $k + 1;
				}
			} 
			else {
				// We are now dealing with a word.
				if($rtfile[$i][$k] == "\\" && $rtfile[$i][$k + 1] != "\\" && $rtfile[$i][$k - 1] != "\\") {
					$newFile[$i] .= ProcessWord($token);
					$token = $rtfile[$i][$k];
					$start = $k;
				}
				else {
					$token .= $rtfile[$i][$k];
				}
			}
		}
	}
}

$limit = sizeof($newFile);

for($i = 0; $i < $limit; $i++) {
	print("$newFile[$i]\n");
}
?>
