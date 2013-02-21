<?php

// self define a helper class with some utility functions

/**
* TypeValidator class
**/
class TypeValidator
{
	/**
	 * check whether a string is an int 
	 * @param  string $value the string representation of the input
	 * @return boolean        whether the input is an int
	 */
	public static function isInt($value)
	{
		if (is_numeric($value) && (intval($value) == floatval($value))) {
			return true;
		} else {
			return false;
		}
		
	}

	/**
	 * check wether a stirng is an empty string
	 * @param  stirng  $str input string
	 * @return boolean whether the string is empty (all white spaces considered empty)
	 */
	public static function isEmpty($str)
	{
		return ctype_space($str) || empty($str);
	}
}

?>