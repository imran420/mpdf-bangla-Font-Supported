Installation
============
    * Download the .zip file and unzip it
    * Create a folder e.g. /mpdf on your server
    * Upload all of the files to the server, maintaining the folders as they are
    * Ensure that you have write permissions set (CHMOD 6xx or 7xx) for the following folders:
	 /ttfontdata/ - used to cache font data; improves performance a lot
	 /tmp/ - used for some images and ProgressBar
	 /graph_cache/ - if you are using JpGraph in conjunction with mPDF

To test the installation, point your browser to the basic example file : [path_to_mpdf_folder]/mpdf/examples/example01_basic.php

If you wish to define a different folder for temporary files rather than /tmp/ see the note on 'Folder for temporary files' in 
 the section on Installation & Setup in the manual (http://mpdf1.com/manual/).

If you have problems, please read the section on troubleshooting in the manual.


Fonts
=====
Let us refer to font names in 2 ways:
"CSS font-family name" - mPDF is designed primarily to read HTML and CSS. This is the name used in CSS e.g.
	<p style="font-family: 'Trebuchet MS';">

"mPDF font-family name" - the name used internally to process fonts. This could be anything you like,
	but by default mPDF will convert CSS font-family names by removing any spaces and changing
	to lowercase. Reading the name above, mPDF will look for a "mPDF font-family name" of
	'trebuchetms'.

The configurable values referred to below are set in the config_fonts.php file

When parsing HTML/CSS, mPDF will read the CSS font-family name (e.g. 'Trebuchet MS') and convert 
by removing any spaces and changing to lowercase, to look for a mPDF font-family name (trebuchetms). 

Next it will look for a translation (if set) in config_font.php e.g.:
$this->fonttrans = array(
	'trebuchetms' => 'trebuchet'
)

Now the mPDF font-family name to be used is 'trebuchet'

If you wish to make this font available, you need to specify the Truetype .ttf font files for each variant.
These should be defined in config_font.php in the array:
$this->fontdata = array(
	"trebuchet" => array(
		'R' => "trebuc.ttf",
		'B' => "trebucbd.ttf",
		'I' => "trebucit.ttf",
		'BI' => "trebucbi.ttf",
		)
)

This is the array which determines whether a font is available to mPDF. Each font-family must have a
Regular ['R'] file defined - the others (bold, italic, bold-italic) are optional.

mPDF will try to load the font-file. If you have defined _MPDF_SYSTEM_TTFONTS at the top of the 
config_fonts.php file, it will first look for the font-file there. This is useful if you are running 
mPDF on a computer which already has a folder with TTF fonts in (e.g. on Windows)

If the font-file is not there, or _MPDF_SYSTEM_TTFONTS is not defined, mPDF will look in the folder
/[your_path_to_mpdf]/ttfonts/

Example:

<?php
include("mpdf/mpdf.php");


$mpdf=new mPDF('',[ 210 , 297],20,'nikosh');
// $mpdf = new \Mpdf\Mpdf();
$mpdf->Addpage('O');

$bdate = "আমাদের গ্রামের নাম রোদডুবি | গ্রামটি হুগলি জেলার সরস্বতী নদীর ভীরে অবস্থিত |";
//Date
$mpdf->SetFont('nikosh', '', 16);
$mpdf->SetY(5);
$mpdf->SetX(10);
$mpdf->WriteCell(35, 0, $bdate, 0, 0, 'L');
$filename="exp.pdf";
$mpdf->Output($filename,'D');


?>


