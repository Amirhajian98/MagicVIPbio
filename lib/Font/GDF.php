<?php
	class WideImage_Font_GDF
	{
		protected $font;
		protected $color;
		
		function __construct($face, $color)
		{
			if (is_int($face) && $face >= 1 && $face <= 5)
				$this->font = $face;
			else
				$this->font = imageloadfont($face);
			$this->color = $color;
		}
		
		function writeText($image, $x, $y, $text)
		{
			imagestring($image->getHandle(), $this->font, $x, $y, $text, $this->color);
		}
	}
