<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 * Copyright (C) 2005 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at http://www.gnu.org/licenses/.
 *
 * PHP version 5
 * @copyright  4ward.media 2010
 * @author     Christoph Wiechert <christoph.wiechert@4wardmedia.de>
 * @package    lightbox4ward
 * @license    LGPL 
 * @filesource
 */

class WidgetLightbox4wardCheckbox extends FormCheckBox
{

	public function __construct($arrAttributes=false)
	{
		parent::__construct($arrAttributes);

		$embed = explode('%s', $this->embed);

		$label = $embed[0];
		$label .= '<a href="'.$this->Environment->request.'#mb_lightbox4wardContent'.$this->id.'" title="" '.((TL_MODE == 'BE') ? '' : ' onclick="lightbox4ward'.$this->id.'();return false;"').'>';
		$label .= specialchars($this->linkTitle);
		$label .= '</a>';
		$label .= $embed[1];

		$this->arrOptions = array(array('value'=>'yes','label'=>$label));
	}

	/**
	 * Generate the widget and return it as string
	 * @return string
	 */
	public function generate()
	{
		// The "required" attribute only makes sense for single checkboxes
		if ($this->mandatory)
		{
				$this->arrAttributes['required'] = 'required';
		}

		$this->import('String');

		$post = $this->generateSingeSrcJS('#mb_lightbox4wardContent'.$this->id, $this->lightbox4ward_size, $this->lightbox4ward_caption.' '.$this->lightbox4ward_description);
		$post .= '<div style="display:none;"><div id="mb_lightbox4wardContent'.$this->id.'" class="lightbox4wardContent"><div class="lightbox4wardContentInside">';
		$post .= $this->getArticle($this->articleAlias,false,true);
		$$post .= '</div></div></div>';

		$strOptions = '';

		foreach ($this->arrOptions as $i=>$arrOption)
		{
			$strOptions .= sprintf('<span><input type="checkbox" name="%s" id="opt_%s" class="checkbox" value="%s"%s%s /> <label id="lbl_%s" for="opt_%s">%s</label></span>',
									$this->strName . ((count($this->arrOptions) > 1) ? '[]' : ''),
									$this->strId.'_'.$i,
									$arrOption['value'],
									$this->isChecked($arrOption),
									$this->getAttributes(),
									$this->strId.'_'.$i,
									$this->strId.'_'.$i,
									$arrOption['label']);
		}

		if ($this->strLabel != '')
		{
        	return sprintf('<fieldset id="ctrl_%s" class="lightbox4ward_checkbox checkbox_container%s"><legend>%s%s%s</legend>%s<input type="hidden" name="%s" value=""%s%s</fieldset>',
	        				$this->strId,
							(($this->strClass != '') ? ' ' . $this->strClass : ''),
							($this->required ? '<span class="invisible">'.$GLOBALS['TL_LANG']['MSC']['mandatory'].'</span> ' : ''),
							$this->strLabel,
							($this->required ? '<span class="mandatory">*</span>' : ''),
							$this->strError,
							$this->strName,
							$this->strTagEnding,
							$strOptions) . $this->addSubmit().$post;
		}
		else
		{
	        return sprintf('<fieldset id="ctrl_%s" class="lightbox4ward_checkbox checkbox_container%s">%s<input type="hidden" name="%s" value=""%s%s</fieldset>',
    	    				$this->strId,
							(($this->strClass != '') ? ' ' . $this->strClass : ''),
							$this->strError,
							$this->strName,
							$this->strTagEnding,
							$strOptions) . $this->addSubmit().$post;
		}
		
		
	}		
	
	/**
	 * Generate a gerneric javascript for a single file
	 *
	 * @param $src
	 * @param string $size
	 * @param string $title
	 * @return string
	 */
	protected function generateSingeSrcJS($src, $size='', $title='')
	{
		$src = str_replace('&#61;','=',$src); // Mediabox needs "=" instead of &#61; to explode the urls
		$title = str_replace("'","\\'",trim($title)); // ' have to be escaped

		$size = (strlen($size)>1) ? unserialize($size) : array('null','null');
		$displayTitle = (strlen($title)>1) ? 'true' : 'false';

return <<<JSSTR
<script type="text/javascript">
function lightbox4ward{$this->id}()
{
	var elems = [
		new Element('a',
		{
			href: '{$src}',
			title: '{$title}'
		})
	];
	var cb = new CeraBox(elems,{
		displayTitle: $displayTitle,
		width:{$size[0]},
		height:{$size[1]}
	});
	elems[0].fireEvent('click');
}
</script>
JSSTR;

	
	}


}