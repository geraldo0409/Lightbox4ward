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



// Palette
$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] = str_ireplace('{backend_legend}','{lightbox4ward_legend},lightbox4ward_displayOverlay,lightbox4ward_fixedPosition,lightbox4ward_preventScrolling,'
																						   .'lightbox4ward_addContentProtectionLayer,lightbox4ward_animation,lightbox4ward_theme,lightbox4ward_titleFormat;'
																						   .'{backend_legend}',$GLOBALS['TL_DCA']['tl_settings']['palettes']['default']);

// Fields
$GLOBALS['TL_DCA']['tl_settings']['fields']['lightbox4ward_displayOverlay'] = array
(
	'label'		=> &$GLOBALS['TL_LANG']['tl_settings']['lightbox4ward_displayOverlay'],
	'inputType'	=> 'checkbox',
	'default'	=> '1',
	'eval'		=> array('tl_class'=>'w50 m12')
);
$GLOBALS['TL_DCA']['tl_settings']['fields']['lightbox4ward_animation'] = array
(
	'label'		=> &$GLOBALS['TL_LANG']['tl_settings']['lightbox4ward_animation'],
	'inputType'	=> 'select',
	'options'	=> array('fade','ease'),
	'default'	=> 'ease',
	'eval'		=> array('tl_class'=>'w50')
);
$GLOBALS['TL_DCA']['tl_settings']['fields']['lightbox4ward_titleFormat'] = array
(
	'label'		=> &$GLOBALS['TL_LANG']['tl_settings']['lightbox4ward_titleFormat'],
	'inputType'	=> 'text',
	'default'	=> '<div class="number">{number} / {total}</div><div class="title">{title}</div>',
	'eval'		=> array('tl_class'=>'long', 'allowHtml'=>true, 'decodeEntities' => true)
);
$GLOBALS['TL_DCA']['tl_settings']['fields']['lightbox4ward_addContentProtectionLayer'] = array
(
	'label'		=> &$GLOBALS['TL_LANG']['tl_settings']['lightbox4ward_addContentProtectionLayer'],
	'inputType'	=> 'checkbox',
	'default'	=> '',
	'eval'		=> array('tl_class'=>'w50 m12')
);
$GLOBALS['TL_DCA']['tl_settings']['fields']['lightbox4ward_fixedPosition'] = array
(
	'label'		=> &$GLOBALS['TL_LANG']['tl_settings']['lightbox4ward_fixedPosition'],
	'inputType'	=> 'checkbox',
	'default'	=> '1',
	'eval'		=> array('tl_class'=>'w50 m12')
);
$GLOBALS['TL_DCA']['tl_settings']['fields']['lightbox4ward_preventScrolling'] = array
(
	'label'		=> &$GLOBALS['TL_LANG']['tl_settings']['lightbox4ward_preventScrolling'],
	'inputType'	=> 'checkbox',
	'default'	=> '1',
	'eval'		=> array('tl_class'=>'w50 m12')
);
$GLOBALS['TL_DCA']['tl_settings']['fields']['lightbox4ward_theme'] = array
(
	'label'		=> &$GLOBALS['TL_LANG']['tl_settings']['lightbox4ward_theme'],
	'inputType'	=> 'select',
	'options_callback'	=> array('tl_settings_lightbox4ward','getThemes'),
	'default'	=> 'standard',
	'eval'		=> array('tl_class'=>'w50')
);


class tl_settings_lightbox4ward extends System
{

	public function getThemes()
	{
		$files = scandir(TL_ROOT.'/system/modules/lightbox4ward/html/themes/');
		$arrThemes = array();
		foreach($files as $file)
		{
			if($file == '.' || $file == '..' || !is_dir(TL_ROOT.'/system/modules/lightbox4ward/html/themes/'.$file)) continue;
			$arrThemes[] = $file;
		}
		return $arrThemes;
	}
}