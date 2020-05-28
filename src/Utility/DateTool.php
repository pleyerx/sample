<?php 

namespace App\Utility;

class DateTool {
	
    public static function isDate($str){
		if(strlen($str) <> 10){
			return false;
		}
		$__y = substr($str, 0, 4);
		$__m = substr($str, 5, 2);
		$__d = substr($str, 8, 2);
		return checkdate($__m, $__d, $__y);
	}
}

