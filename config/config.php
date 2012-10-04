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


// CONTENT ELEMENTS
$GLOBALS['TL_CTE']['links']['ce_lightbox4ward'] 			= 'ContentLightbox4ward';

// WIDGET
$GLOBALS['TL_FFL']['lightbox4ward'] = 'WidgetLightbox4ward';
$GLOBALS['TL_FFL']['lightbox4ward_checkbox'] = 'WidgetLightbox4wardCheckbox';

// support storeable field for EFG
$GLOBALS['EFG']['storable_fields'][] = 'lightbox4ward_checkbox';
