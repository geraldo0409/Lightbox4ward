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


$GLOBALS['TL_LANG']['FFL']['lightbox4ward'] = array('Lightbox4ward','Displays a link or an article in the lightbox.');
$GLOBALS['TL_LANG']['FFL']['lightbox4ward_checkbox'] = array('Lightbox4ward checkbox','Displays an article in the lightbox aside a checkbox.');

$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_link_legend'] = 'Lightbox4ward - link';
$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_content_legend'] = 'Lightbox4ward - content';

$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_type']['0'] = "Contenttype";
$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_type']['1'] = "This kind of content would be displayed in the lightbox.";

$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_caption']['0'] = "Lightbox-title";
$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_caption']['1'] = "The title gets displayed in the lightbox below the content.";
$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_description']['0'] = "Description";
$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_description']['1'] = "The discription gets displayed under the title.";
$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_size']['0'] = "Lightbox-size";
$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_size']['1'] = "Choose the width and hight of the lightbox-window";
$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_imageSRC']['0'] = "Image";
$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_imageSRC']['1'] = "This image gets displayed in the lightbox.";
$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_externURL']['0'] = "Lightbox-URL";
$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_externURL']['1'] = "A URL to an remote content. It could be a image, a website or a social-video.";


$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_types']['image'] = 'Image';
$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_types']['text'] = 'Text';
$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_types']['article'] = 'Article';
$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_types']['extern'] = 'External page';

/**
 * ExternURL Explanation
 */
$GLOBALS['TL_LANG']['XPL']['lightbox4ward_externURL'] = array
(
	array('Image', 'The URL to an image gets displayed like a local one.'),
	array('Soicial video', 'Lightbox4ward supports external video-content like Facebook,Google,Youtube and much more. <a href="http://iaian7.com/webcode/mediaboxAdvanced#examples" onclick="window.open(this.href); return false;">More information</a>.'),
);
