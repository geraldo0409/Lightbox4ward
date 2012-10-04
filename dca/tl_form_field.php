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

$this->loadLanguageFile('tl_content');

require_once(TL_ROOT.'/system/modules/lightbox4ward/dca/lightbox4ward.php');

$GLOBALS['TL_DCA']['tl_form_field']['palettes']['lightbox4ward'] = '{type_legend},type;{lightbox4ward_link_legend},linkTitle,embed;useImage;{lightbox4ward_content_legend},lightbox4ward_type';
$GLOBALS['TL_DCA']['tl_form_field']['palettes']['lightbox4ward_checkbox'] = '{type_legend},type,name,label;{lightbox4ward_link_legend},linkTitle,embed;{fconfig_legend},mandatory;{lightbox4ward_content_legend},lightbox4ward_caption,lightbox4ward_description,lightbox4ward_size,articleAlias';
$GLOBALS['TL_DCA']['tl_form_field']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_form_field']['fields'],$arrFields);
$GLOBALS['TL_DCA']['tl_form_field']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_form_field']['fields'],$arrMoreFields);
$GLOBALS['TL_DCA']['tl_form_field']['palettes']['__selector__'][] = 'lightbox4ward_type';
$GLOBALS['TL_DCA']['tl_form_field']['palettes']['__selector__'][] = 'useImage';
foreach($arrPalettes as $k => $v)
{
	$GLOBALS['TL_DCA']['tl_form_field']['palettes']['lightbox4ward'.$k] 		= '{type_legend},type;'.$v;
}