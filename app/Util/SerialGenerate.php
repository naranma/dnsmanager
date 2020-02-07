<?php

namespace App\Util;

class SerialGenerate
{
    public static function generator(String $serialOld)
    {
    	$dateSerialOld = substr($serialOld, 0, -2);
    	if ($dateSerialOld == date("Ymd")) {
    		$number = substr($serialOld, -2);
    		$number+=1;
    		if ($number < 10) {
    			return $dateSerialOld . '0' . $number;
    		} else {
    			return $dateSerialOld . $number;
    		}
    	} else {
    		return date("Ymd") . '01';
    	}
    }
}
