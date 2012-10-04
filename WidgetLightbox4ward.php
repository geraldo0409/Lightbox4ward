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


class WidgetLightbox4ward extends Widget
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'form_lightbox4ward';


	/**
	 * Data
	 * @var array
	 */
	protected $arrData = array();

	/**
	 * Construct the Widget
	 *
	 * @param bool $arrAttributes
	 */
	public function __construct($arrAttributes=false)
	{
		$this->arrData = $arrAttributes;
		parent::__construct($arrAttributes);

		if(strlen($this->label)) {
			$this->strTemplate = 'form_widget';
		} else {
			$this->strTemplate = 'form_explanation';
		}
	}
	
	/**
	 * Do not validate
	 */
	public function validate()
	{
		return;
	}


	/**
	 * Generate the widget and return it as string
	 *
	 * @return string
	 */
	public function generate()
	{
		// Use an image instead of the title
		if ($this->useImage && strlen($this->singleSRC) && is_file(TL_ROOT . '/' . $this->singleSRC))
		{
			$objTpl = new FrontendTemplate('widget_lightbox4ward_image');
		}
		else
		{
			$objTpl = new FrontendTemplate('widget_lightbox4ward_article');
		}

		// Generate the lightbox
		$objLightbox4ward = new Lightbox4ward($this->arrData);
		$objLightbox4ward->compile($objTpl);

		return $objTpl->parse();
	}
}
