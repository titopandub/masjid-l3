<?php 

class AppHelper {

    public static function date($date, $format = 'Y-m-d',$today = true)
    {
    	if ($today === true) {
    		return (strtotime($date) <= -62170009632) ? date($format) : date($format, strtotime($date));
    	} else {
    		return (strtotime($date) <= -62170009632) ? '' : date($format, strtotime($date));
    	}
    }

	public static function range_month($datestr) {
		date_default_timezone_set(date_default_timezone_get());
		$dt = strtotime($datestr);
		$res['start'] = date('Y-m-d', strtotime('first day of this month', $dt));
		$res['end'] = date('Y-m-d', strtotime('last day of this month', $dt));
		return $res;
	}

	public static function range_week($datestr) {
		date_default_timezone_set(date_default_timezone_get());
		$dt = strtotime($datestr);
		$res['start'] = date('N', $dt)==5 ? date('Y-m-d', $dt) : date('Y-m-d', strtotime('last friday', $dt));
		$res['end'] = date('N', $dt)==4 ? date('Y-m-d', $dt) : date('Y-m-d', strtotime('next thursday', $dt));
		return $res;
	}

	public static function idr_format($value = 0)
	{
		return "Rp " . "<span class=\"pull-right\">" . number_format($value, 2, ',', '.') . "</span>";
	}
}