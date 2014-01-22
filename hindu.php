<?php

/*************************************/
# Author : Giriraj
# DOC : 22-jan-2014
# License	: Free
# Description:	Read todays-paper content from hindu.com as text format
# web : http://ngiriraj.com
# Requirements :
# mbstring()

# Download 
# XAMPP : (http://jaist.dl.sourceforge.net/project/xampp/XAMPP%20Windows/1.8.2/xampp-win32-1.8.2-3-VC9-installer.exe)
# simple_html_dom.php : http://kaz.dl.sourceforge.net/project/simplehtmldom/simplehtmldom/1.5/simplehtmldom_1_5.zip
/*************************************/


// Include the library
include('simple_html_dom.php');
 
// Retrieve the hindu news paper links
$html = file_get_html('http://www.thehindu.com/todays-paper/');

// Find all links
foreach($html->find('a') as $e) {

	// Filter links contains ".ece"
	if (strpos($e->href,'.ece') !== false) {
		
		// Retrieve the DOM from a given URL
		$html_inner = file_get_html($e->href);

		// Retrieve the Heading
		foreach($html_inner->find('h1') as $ece){
			echo "<h1>".$ece->innertext . '</h1>';
		}

		// Retrieve the content from "p.body"
		// some cases need to get from "div.article-text
		foreach($html_inner->find('p.body') as $ece){
			echo $ece->innertext . '<br><br>';
		}

		// Full Article path
		echo "Source URL :".$e->href . '<br><BR><hr>';
	}
}

?>
