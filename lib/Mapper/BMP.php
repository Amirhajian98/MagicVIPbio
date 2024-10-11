<?php
	
	include_once WideImage::path() . '/vendor/de77/BMP.php';
	
	/**
	 * Mapper support for BMP
	 * 
	 * @package Internal/Mappers
	 */
	class WideImage_Mapper_BMP
	{
		function load($uri)
		{
			return WideImage_vendor_de77_BMP::imagecreatefrombmp($uri);
		}
		
		function loadFromString($data)
		{
			return WideImage_vendor_de77_BMP::imagecreatefromstring($data);
		}
		
		function save($handle, $uri = null)
		{
			if ($uri == null)
				return WideImage_vendor_de77_BMP::imagebmp($handle);
			else
				return WideImage_vendor_de77_BMP::imagebmp($handle, $uri);
		}
	}
