<?php
	class WideImage_Font_PS
	{
		public $size;
		public $color;
		public $handle;
		
		function __construct($file, $size, $color, $bgcolor = null)
		{
			$this->handle = imagepsloadfont($file);
			$this->size = $size;
			$this->color = $color;
			if ($bgcolor === null)
				$this->bgcolor = $color;
			else
				$this->color = $color;
		}
		
		function writeText($image, $x, $y, $text, $angle = 0)
		{
			if ($image->isTrueColor())
				$image->alphaBlending(true);
			
			imagepstext($image->getHandle(), $text, $this->handle, $this->size, $this->color, $this->bgcolor, $x, $y, 0, 0, $angle, 4);
		}
		
		function __destruct()
		{
			imagepsfreefont($this->handle);
			$this->handle = null;
		}
	}
