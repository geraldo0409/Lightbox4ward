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


// Lightbox4ward Fields
$arrFields['lightbox4ward_type'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_type'],
	'exclude'                 => true,
	'inputType'               => 'radio',
	'options'				  => array(
									'Image' 	=> &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_types']['image'],
									'Gallery'	=> &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_types']['gallery'],
									'FLV'		=> &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_types']['video'],
									'Audio'		=> &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_types']['audio'],
									'Article'	=> &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_types']['article'],
									'Extern'	=> &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_types']['extern']
								),
	'eval'                    => array('mandatory'=>true,'submitOnChange'=>true)
);

$arrFields['lightbox4ward_caption'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_caption'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50')
);
$arrFields['lightbox4ward_description'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_description'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50')
);
$arrFields['lightbox4ward_size'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_size'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'save_callback'			  => array(array('ce_lightbox4ward','normalizeSize')),
	'eval'                    => array('maxlength'=>100, 'multiple'=>true,'size'=>2, 'tl_class'=>'w50')
);
$arrFields['lightbox4ward_imageSRC'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_imageSRC'],
	'exclude'                 => true,
	'inputType'               => 'fileTree',
	'eval'                    => array('fieldType'=>'radio', 'files'=>true, 'filesOnly'=> true, 'extensions'=>'jpg,png,jpeg,tif,bmp,gif', 'mandatory'=>true, 'tl_class'=>'clr')
);
$arrFields['lightbox4ward_gallerySRC'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_gallerySRC'],
	'exclude'                 => true,
	'inputType'               => 'fileTree',
	'eval'                    => array('fieldType'=>'checkbox', 'files'=>true, 'extensions'=>'jpg,png,jpeg,tif,bmp,gif,flv,mov,mp4', 'mandatory'=>true, 'tl_class'=>'clr')
);
$arrFields['lightbox4ward_externURL'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_externURL'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'explanation'			  => 'lightbox4ward_externURL',
	'eval'                    => array('mandatory'=>true,'helpwizard'=>true, 'decodeEntities'=>true, 'tl_class'=>'long clr')
);
$arrFields['lightbox4ward_flvSRC'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_flvSRC'],
	'exclude'                 => true,
	'inputType'               => 'fileTree',
	'eval'                    => array('fieldType'=>'checkbox', 'files'=>true, 'filesOnly'=> true, 'extensions'=>'flv,mov,swf,mp4,f4v,m4v,webm,ogv', 'mandatory'=>true, 'tl_class'=>'clr')
);
$arrFields['lightbox4ward_mp3SRC'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_mp3SRC'],
	'exclude'                 => true,
	'inputType'               => 'fileTree',
	'eval'                    => array('fieldType'=>'radio', 'files'=>true, 'filesOnly'=> true, 'extensions'=>'mp3,aac', 'mandatory'=>true, 'tl_class'=>'clr')
);
$arrFields['lightbox4ward_closeOnEnd'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_closeOnEnd'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array('tl_class'=>'w50')
);



// Lightbox4ward Addition Fields (image,alias)
$arrMoreFields['useImage'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['useImage'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array('submitOnChange'=>true)
);
$arrMoreFields['singleSRC'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['singleSRC'],
	'exclude'                 => true,
	'inputType'               => 'fileTree',
	'eval'                    => array('fieldType'=>'radio', 'files'=>true, 'mandatory'=>true, 'tl_class'=>'clr')
);
		
$arrMoreFields['alt'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['alt'],
	'exclude'                 => true,
	'search'                  => true,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'long')
);
$arrMoreFields['caption'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['caption'],
	'exclude'                 => true,
	'search'                  => true,
	'inputType'               => 'text',
	'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50')
);
$arrMoreFields['linkTitle'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['linkTitle'],
	'exclude'                 => true,
	'search'                  => true,
	'inputType'               => 'text',
	'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50')
);
$arrMoreFields['embed'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['embed'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array('maxlength'=>255, 'tl_class'=>'long clr')
);
$arrMoreFields['imgSize'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['size'],
	'exclude'                 => true,
	'inputType'               => 'imageSize',
	'options'                 => array('crop', 'proportional', 'box'),
	'reference'               => &$GLOBALS['TL_LANG']['MSC'],
	'eval'                    => array('rgxp'=>'digit', 'nospace'=>true, 'tl_class'=>'w50')
);
$arrMoreFields['articleAlias'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['articleAlias'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options_callback'        => array('ce_lightbox4ward', 'getArticleAlias'),
	'eval'                    => array('mandatory'=>true, 'submitOnChange'=>true, 'tl_class'=>'w50')
);


// Palettes
$arrPalettes['Image'] 			= '{lightbox4ward_link_legend},linkTitle,embed;{imglink_legend:hide},useImage;{lightbox4ward_content_legend},lightbox4ward_type;lightbox4ward_caption,lightbox4ward_description,lightbox4ward_imageSRC';
$arrPalettes['Gallery'] 	= '{lightbox4ward_link_legend},linkTitle,embed;{imglink_legend:hide},useImage;{lightbox4ward_content_legend},lightbox4ward_type;lightbox4ward_gallerySRC,sortBy';
$arrPalettes['Extern'] 		= '{lightbox4ward_link_legend},linkTitle,embed;{imglink_legend:hide},useImage;{lightbox4ward_content_legend},lightbox4ward_type;lightbox4ward_caption,lightbox4ward_description,lightbox4ward_size,lightbox4ward_externURL';
$arrPalettes['Article'] 	= '{lightbox4ward_link_legend},linkTitle,embed;{imglink_legend:hide},useImage;{lightbox4ward_content_legend},lightbox4ward_type;lightbox4ward_caption,lightbox4ward_description,lightbox4ward_size,articleAlias';
$arrPalettes['FLV'] 		= '{lightbox4ward_link_legend},linkTitle,embed;{imglink_legend:hide},useImage;{lightbox4ward_content_legend},lightbox4ward_type;lightbox4ward_caption,lightbox4ward_description,lightbox4ward_size,lightbox4ward_closeOnEnd,lightbox4ward_flvSRC';
$arrPalettes['Audio'] 		= '{lightbox4ward_link_legend},linkTitle,embed;{imglink_legend:hide},useImage;{lightbox4ward_content_legend},lightbox4ward_type;lightbox4ward_caption,lightbox4ward_description,lightbox4ward_size,lightbox4ward_closeOnEnd,lightbox4ward_mp3SRC';



class ce_lightbox4ward extends System
{
	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
		$this->import('Database');
	}

	/**
	 * Get all articles and return them as array (article alias)
	 * @param object
	 * @return array
	 */
	public function getArticleAlias()
	{
		$arrPids = array();
		$arrAlias = array();

		if (!$this->User->isAdmin)
		{
			foreach ($this->User->pagemounts as $id)
			{
				$arrPids[] = $id;
				$arrPids = array_merge($arrPids, $this->getChildRecords($id, 'tl_page', true));
			}

			if (empty($arrPids))
			{
				return $arrAlias;
			}

			$objAlias = $this->Database->prepare("SELECT a.id, a.title, a.inColumn, p.title AS parent FROM tl_article a LEFT JOIN tl_page p ON p.id=a.pid WHERE a.pid IN(". implode(',', array_map('intval', array_unique($arrPids))) .") ORDER BY parent, a.sorting")
									   ->execute();
		}
		else
		{
			$objAlias = $this->Database->prepare("SELECT a.id, a.title, a.inColumn, p.title AS parent FROM tl_article a LEFT JOIN tl_page p ON p.id=a.pid ORDER BY parent, a.sorting")
									   ->execute();
		}

		if ($objAlias->numRows)
		{
			$this->loadLanguageFile('tl_article');

			while ($objAlias->next())
			{
				$arrAlias[$objAlias->parent][$objAlias->id] = $objAlias->title . ' (' . (strlen($GLOBALS['TL_LANG']['tl_article'][$objAlias->inColumn]) ? $GLOBALS['TL_LANG']['tl_article'][$objAlias->inColumn] : $objAlias->inColumn) . ', ID ' . $objAlias->id . ')';
			}
		}

		return $arrAlias;
	}



	/**
	 * Size callback
	 * strips any non-numeric character expect of trailing %
	 * @param str $val serialized value
	 * @return string
	 */
	public function normalizeSize($val)
	{
		$val = unserialize($val);

		foreach($val as $k=>$v)
		{
			if(!preg_match("~^\d+%?$~",$v))
				$val[$k] = (int)$v;
		}

		return serialize($val);
	}
}