<?php
	class WideImage_UnknownImageOperationException extends WideImage_Exception {}
	class WideImage_OperationFactory
	{
		static protected $cache = array();
		
		static function get($operationName)
		{
			$lcname = strtolower($operationName);
			if (!isset(self::$cache[$lcname]))
			{
				$opClassName = "WideImage_Operation_" . ucfirst($operationName);
				if (!class_exists($opClassName, false))
				{
					$fileName = WideImage::path() . 'Operation/' . ucfirst($operationName) . '.php';
					if (file_exists($fileName))
						require_once $fileName;
					elseif (!class_exists($opClassName))
						throw new WideImage_UnknownImageOperationException("Can't load '{$operationName}' operation.");
				}
				self::$cache[$lcname] = new $opClassName();
			}
			return self::$cache[$lcname];
		}
	}
