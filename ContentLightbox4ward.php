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


class ContentLightbox4ward extends ContentElement
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_lightbox4ward_article';


	/**
	 * Set the template and generate the element
	 *
	 * @return string|void
	 */
	public function generate()
	{
		if ($this->useImage && strlen($this->singleSRC) && is_file(TL_ROOT . '/' . $this->singleSRC))
		{
			$this->strTemplate = 'ce_lightbox4ward_image';
		}

		return parent::generate();
	}


	/**
	 * Compile it
	 */
	public function compile()
	{
		$objLightbox4ward = new Lightbox4ward($this->arrData);
		$objLightbox4ward->compile($this->Template);

	}

}
