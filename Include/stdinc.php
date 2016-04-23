<?php

/**
* Defines application-wide constants
*/
class Constants
{
	public static $SITE_TITLE = "Interprog Travel";
}

class DJsonHelper
{
	/*
	 * NOTE: This should be temporary.
	 * Very quick and dirty self-rolled JSON encoder,
	 * because UTS does not support PHP JSON.

	 * At the very least, this should support more than
	 * boolean and string types, and probably shouldn't
	 * assume that the object is a 1D array.
	 */
	public static function json_encode($array)
	{
		$result = "{";

		$i = 0;
		foreach($array as $key => $value)
		{
			if($i != 0)
				$result .= ", ";

			$result .= '"' . $key . '": ';

			if(is_string($value))
				$result .= '"' . $value . '"';
			else if (is_bool($value))
				$result .= $value? "true" : "false";

			$i++;
		}

		$result .= "}";

		return $result;
	}
}
?>