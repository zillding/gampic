<?php

// self define a helper class with some utility functions

/**
* Helper class
*/
class Helper
{
	
	// print a array in the html format
	public static function print_arr($array)
	{
		print "<pre>".dump($array)."</pre>";
		die();
	}
}

?>