<?php if(!defined('TL_ROOT')) {die('You cannot access this file directly!');}

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


class Lightbox4ward extends Frontend
{

	protected $arrData = array();

	public function __construct($arrData = array())
	{
		$this->arrData = $arrData;
		parent::__construct();
	}


	/**
	 * Set an object property
	 * @param string
	 * @param mixed
	 */
	public function __set($strKey, $varValue)
	{
		$this->arrData[$strKey] = $varValue;
	}


	/**
	 * Return an object property
	 * @param string
	 * @return mixed
	 */
	public function __get($strKey)
	{
		return $this->arrData[$strKey];
	}


	/**
	 * Check whether a property is set
	 * @param string
	 * @return boolean
	 */
	public function __isset($strKey)
	{
		return isset($this->arrData[$strKey]);
	}


	/**
	 * Generate content element
	 */
	public function compile(&$tpl)
	{
		$this->import('String');

		$embed = explode('%s', $this->embed);

		// Use an image instead of the title
		if ($this->useImage && strlen($this->singleSRC) && is_file(TL_ROOT . '/' . $this->singleSRC))
		{

			$objFile = new File($this->singleSRC);

			if ($objFile->isGdImage)
			{
				$size = deserialize($this->size);
				$src = $this->getImage($this->urlEncode($this->singleSRC), $size[0], $size[1], $size[2]);

				if (($imgSize = @getimagesize(TL_ROOT . '/' . $src)) !== false)
				{
					$tpl->imgSize = ' ' . $imgSize[3];
				}

				$tpl->imgWidth = $size[0];
				$tpl->imgHeight = $size[1];
				$tpl->src = $src;
				$tpl->alt = specialchars($this->alt);
				$tpl->title = specialchars($this->linkTitle);
				$tpl->caption = $this->caption;
			}
		}

		$tpl->href = '';
		$tpl->embed_pre = $embed[0];
		$tpl->embed_post = $embed[1];
		$tpl->link = $this->linkTitle;
		$tpl->title = specialchars($this->linkTitle);
		$tpl->target = (TL_MODE == 'BE') ? '' : ' onclick="lightbox4ward'.$this->id.'(this);return false;"';
		$tpl->lbType = $this->lightbox4ward_type;
		$tpl->lbSize = unserialize($this->lightbox4ward_size);

		// todo make this better
		$title = $this->lightbox4ward_caption.' '.$this->lightbox4ward_description;

		switch($this->lightbox4ward_type)
		{
			case 'Image':
				$tpl->js = $this->generateSingeSrcJS($this->lightbox4ward_imageSRC,'', $title);
				$tpl->href = $this->lightbox4ward_imageSRC;
			break;

			case 'Gallery':
				$tpl->js = $this->generateGalleryJS($this->lightbox4ward_gallerySRC);
				$src = unserialize($this->lightbox4ward_gallerySRC);
				$tpl->href = $src[0];
			break;

			case 'Extern':
				// rewrite youtube link
				if(preg_match("~youtube\.com/watch\?v=([^&/]+)~i",html_entity_decode($this->lightbox4ward_externURL),$erg))
				{
					$this->lightbox4ward_externURL = 'http://youtube.com/embed/'.$erg[1];
				}


				$tpl->js = $this->generateSingeSrcJS($this->lightbox4ward_externURL, $this->lightbox4ward_size, $title);
				$tpl->href = $this->lightbox4ward_externURL;
			break;

			case 'Article':
				$tpl->js = $this->generateSingeSrcJS('#mb_lightbox4wardContent'.$this->id,$this->lightbox4ward_size, $title);
				$tpl->href = $this->Environment->request.'#mb_lightbox4wardContent'.$this->id;

				$tpl->embed_post .= '<div style="display:none;"><div id="mb_lightbox4wardContent'.$this->id.'" class="lightbox4wardContent"><div class="lightbox4wardContentInside">';
				$tpl->embed_post .= $this->getArticle($this->articleAlias,false,true);
				$tpl->embed_post .= '</div></div></div>';
			break;

			case 'FLV':
				$this->lightbox4ward_flvSRC = deserialize($this->lightbox4ward_flvSRC,true);
				$tpl->js = $this->generateMediaJS($this->lightbox4ward_flvSRC, $this->lightbox4ward_size, $title);
				$tpl->href = $this->lightbox4ward_flvSRC[0];
			break;

			case 'Audio':
				$tpl->js = $this->generateMediaJS($this->lightbox4ward_mp3SRC,$this->lightbox4ward_size, $title, 'audio');
				$tpl->href = $this->lightbox4ward_mp3SRC;
			break;
		}
	}


	/**
	 * Generate the javascripts for a HTML5 Video with usage of mediaelementjs
	 *
	 * @param $src
	 * @param string $size
	 * @param string $title
	 * @param string $media video or audio
	 * @return string
	 */
	public function generateMediaJS($src, $size='', $title='', $media = 'video')
	{
		$title = str_replace("'","\\'",trim($title)); // ' have to be escaped

		if(strlen($size)>1){
			$size = unserialize($size);
		}

		$displayTitle = (strlen($title)>1) ? 'true' : 'false';

		$closeOnEndJS = '';
		if($this->lightbox4ward_closeOnEnd)
		{
			$closeOnEndJS = "this.addEvent('ended',function(){CeraBoxWindow.close();});";
		}

		// support multiple formats
		if(!is_array($src)) $src = array($src);
		$strSources = '';
		foreach($src as $file)
		{
			$type = substr($file,strrpos($file,'.')+1);
			if($type == 'ogv') $type = 'ogg';

			$strSources .= '<source type="'.$media.'/'.$type.'" src="'.$file.'">';
		}

		$strInlineVar = 'var lb4wdHtml5Var'.$this->id.' = \'<'.$media.' id="lb4wdHtml5'.$this->id.'" width="'.$size[0].'" height="'.$size[1].'" controls="controls" preload="auto" class="video-js vjs-default-skin">'.$strSources.'</'.$media.'>\';';

return <<<JSSTR
<script type="text/javascript">
$strInlineVar
function lightbox4ward{$this->id}(link)
{
	// dont use lightbox at mobile devices for video-playback
	if(Browser.Platform.android || Browser.Platform.ios)
	{
		document.location.href = document.id('lb4wdHtml5{$this->id}').getElement('source[type=video/mp4]').get('src');
		return;
	}

	var elems = [
		new Element('a',
		{
			href: '#\$lb4wdHtml5Var{$this->id}',
			title: '{$title}',
           'class': 'lb4ward'
		})
	];
	document.id(link).adopt(elems, 'after');

	var cb = new CeraBox(elems,
	{
		displayTitle: $displayTitle,
		width: {$size[0]},
		height: {$size[1]},
		events:
		{
			onAnimationEnd: function(currentItem)
			{
				var myPlayer = _V_('lb4wdHtml5{$this->id}',{},function()
				{
					$closeOnEndJS
					this.play();
				});
				// myPlayer.addEvent('error',function(e){console.log('VideoJS error', e);});
			},
 			onClose: function() {
	            $$(elems).destroy();
	        }
		}

	});
	elems[0].fireEvent('click',window.event);
}
</script>
JSSTR;

	}


	/**
	 * Generate a gerneric javascript for a single file
	 *
	 * @param $src
	 * @param string $size
	 * @param string $title
	 * @return string
	 */
	public function generateSingeSrcJS($src, $size='', $title='')
	{
		$src = str_replace('&#61;','=',$src); // Mediabox needs "=" instead of &#61; to explode the urls
		$title = str_replace("'","\\'",trim($title)); // ' have to be escaped

		$size = (strlen($size)>1) ? unserialize($size) : array('null','null');
		$displayTitle = (strlen($title)>1) ? 'true' : 'false';

return <<<JSSTR
<script type="text/javascript">
function lightbox4ward{$this->id}(link)
{
	var elems = [
		new Element('a',
		{
			href: '{$src}',
			title: '{$title}'
		})
	];
	document.id(link).adopt(elems, 'after');

	var cb = new CeraBox(elems,{
		displayTitle: $displayTitle,
		width:{$size[0]},
		height:{$size[1]},
		events: {
	        onClose: function() {
	            $$(elems).destroy();
	        }
	    }
	});
	elems[0].fireEvent('click',window.event);
}
</script>
JSSTR;

	}


	/**
	 * Generate a gallery of multiple files
	 *
	 * @param $multpileSRC
	 * @return string
	 */
	public function generateGalleryJS($multpileSRC)
	{
		$src = unserialize($multpileSRC);
		$images = array();
		$auxDate = array();

		// Get all images
		foreach ($src as $file)
		{
			if (isset($images[$file]) || !file_exists(TL_ROOT . '/' . $file))
			{
				continue;
			}

			// Single files
			if (is_file(TL_ROOT . '/' . $file))
			{
				$objFile = new File($file);
				$this->parseMetaFile(dirname($file));

				if ($objFile->isGdImage)
				{
					$images[$file] = array
					(
						'name' => $objFile->basename,
						'src' => $this->Environment->path.'/'.$file,
						'alt' => (strlen($this->arrMeta[$objFile->basename][0]) ? $this->arrMeta[$objFile->basename][0] : ucfirst(str_replace('_', ' ', preg_replace('/^[0-9]+_/', '', $objFile->filename)))),
						'link' => (strlen($this->arrMeta[$objFile->basename][1]) ? $this->arrMeta[$objFile->basename][1] : ''),
						'caption' => (strlen($this->arrMeta[$objFile->basename][2]) ? $this->arrMeta[$objFile->basename][2] : '')
					);

					$auxDate[] = $objFile->mtime;
				} else {
					$images[$file] = array (
						'name' => $objFile->basename,
						'src'  => $this->Environment->path.'/'.$file,
						'alt' => (strlen($this->arrMeta[$objFile->basename][0]) ? $this->arrMeta[$objFile->basename][0] : ucfirst(str_replace('_', ' ', preg_replace('/^[0-9]+_/', '', $objFile->filename)))),
						'link' => (strlen($this->arrMeta[$objFile->basename][1]) ? $this->arrMeta[$objFile->basename][1] : ''),
						'caption' => (strlen($this->arrMeta[$objFile->basename][2]) ? $this->arrMeta[$objFile->basename][2] : '')
					);
				}

				continue;
			}

			$subfiles = scan(TL_ROOT . '/' . $file);
			$this->parseMetaFile($file);

			// Folders
			foreach ($subfiles as $subfile)
			{
				if (is_dir(TL_ROOT . '/' . $file . '/' . $subfile))
				{
					continue;
				}

				$objFile = new File($file . '/' . $subfile);

				if ($objFile->isGdImage)
				{
					$images[$file . '/' . $subfile] = array
					(
						'name' => $objFile->basename,
						'src' => $this->Environment->path.'/'.$file . '/' . $subfile,
						'alt' => (strlen($this->arrMeta[$subfile][0]) ? $this->arrMeta[$subfile][0] : ucfirst(str_replace('_', ' ', preg_replace('/^[0-9]+_/', '', $objFile->filename)))),
						'link' => (strlen($this->arrMeta[$subfile][1]) ? $this->arrMeta[$subfile][1] : ''),
						'caption' => (strlen($this->arrMeta[$subfile][2]) ? $this->arrMeta[$subfile][2] : '')
					);

					$auxDate[] = $objFile->mtime;
				}
			}
		}

		// Sort array
		switch ($this->sortBy)
		{
			default:
			case 'name_asc':
				uksort($images, 'basename_natcasecmp');
				break;

			case 'name_desc':
				uksort($images, 'basename_natcasercmp');
				break;

			case 'date_asc':
				array_multisort($images, SORT_NUMERIC, $auxDate, SORT_ASC);
				break;

			case 'date_desc':
				array_multisort($images, SORT_NUMERIC, $auxDate, SORT_DESC);
				break;

			case 'meta':
				$arrImages = array();
				foreach ($this->arrAux as $k)
				{
					if (strlen($k) && array_key_exists($k,$images))
					{
						$arrImages[] = $images[$k];
					}
				}
				$images = $arrImages;
				break;
		}


		$str = "\n";
		foreach($images AS $meta)
		{
			$str .= "new Element('a',{href:'{$meta['src']}', title:'{$meta['alt']}', 'class': 'lightbox4wardDummyLink', styles: { 'overflow': 'hidden', 'height': '0px' } }),\n";
		}
		$str = substr($str,0,-2);

return <<<JSSTR
<script type="text/javascript">
function lightbox4ward{$this->id}(link)
{
	var elems = [$str];

	document.id(link).adopt(elems, 'after');

	var cb = new CeraBox(elems, {
	    events: {
	        onClose: function() {
	            $$(elems).destroy();
	        }
	    }
	});
	elems[0].fireEvent('click',window.event);
}
</script>
JSSTR;
	}

}