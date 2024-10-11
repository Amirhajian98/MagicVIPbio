<?php
	class WideImage_PaletteImage extends WideImage_Image
	{
		static function create($width, $height)
		{
			if ($width * $height <= 0 || $width < 0)
				throw new WideImage_InvalidImageDimensionException("Can't create an image with dimensions [$width, $height].");
			
			return new WideImage_PaletteImage(imagecreate($width, $height));
		}
		
		function doCreate($width, $height)
		{
			return self::create($width, $height);
		}
		function isTrueColor()
		{
			return false;
		}
		function asPalette($nColors = 255, $dither = null, $matchPalette = true)
		{
			return $this->copy();
		}

		protected function copyAsNew($trueColor = false)
		{
			$width = $this->getWidth();
			$height = $this->getHeight();
			
			if ($trueColor)
				$new = WideImage_TrueColorImage::create($width, $height);
			else
				$new = WideImage_PaletteImage::create($width, $height);
			
			// copy transparency of source to target
			if ($this->isTransparent())
			{
				$rgb = $this->getTransparentColorRGB();
				if (is_array($rgb))
				{
					$tci = $new->allocateColor($rgb['red'], $rgb['green'], $rgb['blue']);
					$new->fill(0, 0, $tci);
					$new->setTransparentColor($tci);
				}
			}
			
			imageCopy($new->getHandle(), $this->handle, 0, 0, 0, 0, $width, $height);
			return $new;
		}
		
		/**
		 * (non-PHPdoc)
		 * @see WideImage_Image#asTrueColor()
		 */
		function asTrueColor()
		{
			$width = $this->getWidth();
			$height = $this->getHeight();
			$new = WideImage::createTrueColorImage($width, $height);
			if ($this->isTransparent())
				$new->copyTransparencyFrom($this);
			if (!imageCopy($new->getHandle(), $this->handle, 0, 0, 0, 0, $width, $height))
				throw new WideImage_GDFunctionResultException("imagecopy() returned false");
			return $new;
		}
		
		/**
		 * (non-PHPdoc)
		 * @see WideImage_Image#getChannels()
		 */
		function getChannels()
		{
			$args = func_get_args();
			if (count($args) == 1 && is_array($args[0]))
				$args = $args[0];
			return WideImage_OperationFactory::get('CopyChannelsPalette')->execute($this, $args);
		}
		
		/**
		 * (non-PHPdoc)
		 * @see WideImage_Image#copyNoAlpha()
		 */
		function copyNoAlpha()
		{
			return WideImage_Image::loadFromString($this->asString('png'));
		}
	}
