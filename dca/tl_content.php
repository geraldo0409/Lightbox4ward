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


require_once(TL_ROOT.'/system/modules/lightbox4ward/dca/lightbox4ward.php');

$GLOBALS['TL_DCA']['tl_content']['palettes']['ce_lightbox4ward'] = '{type_legend},type,headline;{lightbox4ward_link_legend},linkTitle,embed;useImage;{lightbox4ward_content_legend},lightbox4ward_type;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_content']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_content']['fields'],$arrFields);
$GLOBALS['TL_DCA']['tl_content']['palettes'] = array_merge($GLOBALS['TL_DCA']['tl_content']['palettes'],$arrPalettes);
$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'lightbox4ward_type';
foreach($arrPalettes as $k => $v)
{
	$GLOBALS['TL_DCA']['tl_content']['palettes']['ce_lightbox4ward'.$k] 		= '{type_legend},type,headline;'.$v.';{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
}