<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 *
 * PHP version 5
 * @copyright  4ward.media 2012
 * @author     Christoph Wiechert <christoph.wiechert@4wardmedia.de>
 * @package    lightbox4ward
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
	 * Generate content element
	 */
	protected function compile()
	{
		$this->import('String');

		$embed = explode('%s', $this->embed);

		// Use an image instead of the title
		if ($this->useImage && strlen($this->singleSRC) && is_file(TL_ROOT . '/' . $this->singleSRC))
		{
			$this->strTemplate = 'ce_lightbox4ward_image';
			$this->Template = new FrontendTemplate($this->strTemplate);

			$objFile = new File($this->singleSRC);

			if ($objFile->isGdImage)
			{
				$size = deserialize($this->size);
				$src = $this->getImage($this->urlEncode($this->singleSRC), $size[0], $size[1], $size[2]);

				if (($imgSize = @getimagesize(TL_ROOT . '/' . $src)) !== false)
				{
					$this->Template->imgSize = ' ' . $imgSize[3];
				}

				$this->Template->imgWidth = $size[0];
				$this->Template->imgHeight = $size[1];
				$this->Template->src = $src;
				$this->Template->alt = specialchars($this->alt);
				$this->Template->title = specialchars($this->linkTitle);
				$this->Template->caption = $this->caption;
			}
		}

		$this->Template->href = '';
		$this->Template->embed_pre = $embed[0];
		$this->Template->embed_post = $embed[1];
		$this->Template->link = $this->linkTitle;
		$this->Template->title = specialchars($this->linkTitle);
		$this->Template->target = (TL_MODE == 'BE') ? '' : ' onclick="lightbox4ward'.$this->id.'();return false;"';
		$this->Template->lbType = $this->lightbox4ward_type;
		$this->Template->lbSize = unserialize($this->lightbox4ward_size);

		// todo make this better
		$title = $this->lightbox4ward_caption.' '.$this->lightbox4ward_description;

		switch($this->lightbox4ward_type)
		{
			case 'Image':
				$this->Template->js = $this->generateSingeSrcJS($this->lightbox4ward_imageSRC,'', $title);
				$this->Template->href = $this->lightbox4ward_imageSRC;
			break;
			
			case 'Gallery':
				$this->Template->js = $this->generateGalleryJS($this->lightbox4ward_gallerySRC);
				$src = unserialize($this->lightbox4ward_gallerySRC);
				$this->Template->href = $src[0];
			break;
			
			case 'Extern':
				$this->Template->js = $this->generateSingeSrcJS($this->lightbox4ward_externURL, $this->lightbox4ward_size, $title);
				$this->Template->href = $this->lightbox4ward_externURL;
			break;
			
			case 'Article':
				$this->Template->js = $this->generateSingeSrcJS('#mb_lightbox4wardContent'.$this->id,$this->lightbox4ward_size, $title);
				$this->Template->href = $this->Environment->request.'#mb_lightbox4wardContent'.$this->id;
				
				$this->Template->embed_post .= '<div style="display:none;"><div id="mb_lightbox4wardContent'.$this->id.'" class="lightbox4wardContent"><div class="lightbox4wardContentInside">';
				$this->Template->embed_post .= $this->getArticle($this->articleAlias,false,true);
				$this->Template->embed_post .= '</div></div></div>';
			break;
			
			case 'FLV':
				$this->lightbox4ward_flvSRC = deserialize($this->lightbox4ward_flvSRC,true);
				$this->Template->js = $this->generateMediaJS($this->lightbox4ward_flvSRC, $this->lightbox4ward_size, $title);
				$this->Template->href = $this->lightbox4ward_flvSRC[0];
			break;
			
			case 'Audio':
				$this->Template->js = $this->generateMediaJS($this->lightbox4ward_mp3SRC,$this->lightbox4ward_size, $title, 'audio');
				$this->Template->href = $this->lightbox4ward_mp3SRC;
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
	protected function generateMediaJS($src, $size='', $title='', $media = 'video')
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
function lightbox4ward{$this->id}()
{
	var elems = [
		new Element('a',
		{
			href: '#\$lb4wdHtml5Var{$this->id}',
			title: '{$title}',
           'class': 'lb4ward'
		})
	];

	// dont use lightbox at mobile devices for video-playback
	if(Browser.Platform.android || Browser.Platform.ios)
	{
		document.location.href = document.id('lb4wdHtml5{$this->id}').getElement('source[type=video/mp4]').get('src');
		return;
	}

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
	protected function generateGalleryJS($multpileSRC)
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
			$str .= "new Element('a',{href:'{$meta['src']}', title:'{$meta['alt']}', 'class': 'lb4wardgallery' }),\n";
		}
		$str = substr($str,0,-2);
		
return <<<JSSTR
<script type="text/javascript">
function lightbox4ward{$this->id}()
{

	var elems = [$str];

	document.body.adopt(elems);

	var cb = new CeraBox(elems, {
	    events: {
	        onClose: function() {
	            elems.destroy();
	        }
	    }
	});
	elems[0].fireEvent('click',window.event);
}
</script>
JSSTR;
	}
}

?>