<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Lightbox4ward
 * A Lightbox extension for the Contao WebCMS
 *
 * PHP version 5
 * @copyright  4ward.media 2012 <http://www.4wardmedia.de>
 * @author     Christoph Wiechert <wio@psitrax.de>
 * @author     Joe Ray Gregory <http://www.may17.de>
 * @package    lightbox.4ward
 * @license    LGPL
 * @filesource
 */

 
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_link_legend'] = 'Lightbox4ward - Link';

$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_content_legend'] = 'Lightbox4ward - Content';

$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_type']['0'] = "contenttype";
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_type']['1'] = "Type of content shown in the lightbox.";

$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_caption']['0'] = "lightbox-headline";
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_caption']['1'] = "The headline is highlighted and positioned below the content.";
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_description']['0'] = "Description";
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_description']['1'] = "The description is shown inside the lightbox below the content.";
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_size']['0'] = "Lightbox-Size";
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_size']['1'] = "You can define width and height of the lightbox in pixels.";
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_imageSRC']['0'] = "image";
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_imageSRC']['1'] = "This image is shown in the lightbox.";
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_gallerySRC']['0'] = "Gallery-Images";
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_gallerySRC']['1'] = "Chose your images you want to show in the gallery.";
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_externURL']['0'] = "Lightbox-URL";
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_externURL']['1'] = "URL to an external opject. This can be an image, a social-vido-link or a website.";
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_flvSRC']['0'] = "Video (FLV/MOV/SWF/MP4/F4V/WebM/OGV) ";
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_flvSRC']['1'] = "Choose your Video in various formats to achieve the best compatbility.";
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_closeOnEnd']['0'] = "Close lightbox on video-end";
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_closeOnEnd']['1'] = "Closes the lightbox if the video reaches the end.";
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_mp3SRC']['0'] = "MP3/AAC Audio";
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_mp3SRC']['1'] = "Choose your audio file.";

$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_types']['image'] = 'image';
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_types']['gallery'] = 'gallery';
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_types']['video'] = 'video';
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_types']['article'] = 'articel';
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_types']['extern'] = 'external Site';
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_types']['audio'] = 'audio';

/**
 * ExternURL Explanation
 */
$GLOBALS['TL_LANG']['XPL']['lightbox4ward_externURL'] = array
(
	array('Bild', 'The URL of an image is shown as am image on the local website.'),
	array('Soicial Video', 'Lightbox4ward supports the integration of external Videosources as Facebook,Google,Youtube and many more. <a href="http://iaian7.com/webcode/mediaboxAdvanced#examples" onclick="window.open(this.href); return false;">Weitere Informationen</a>.'),
);

