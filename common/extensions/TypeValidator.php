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
}

?>