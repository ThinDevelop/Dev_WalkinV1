<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;
use Carbon\Carbon;

class Helper
{
    public static function dateDiff($t1,$t2){ // ส่งวันที่ที่ต้องการเปรียบเทียบ ในรูปแบบ มาตรฐาน 2006-03-27 21:39:12

        $t1Arr= self::splitTime($t1);
        $t2Arr= self::splitTime($t2);

        $Time1=mktime($t1Arr["h"], $t1Arr["m"], $t1Arr["s"], $t1Arr["M"], $t1Arr["D"], $t1Arr["Y"]);
        $Time2=mktime($t2Arr["h"], $t2Arr["m"], $t2Arr["s"], $t2Arr["M"], $t2Arr["D"], $t2Arr["Y"]);
        $TimeDiv=abs($Time2-$Time1);

        $Time["D"]=intval($TimeDiv/86400); // จำนวนวัน
        $Time["H"]=intval(($TimeDiv%86400)/3600); // จำนวน ชั่วโมง
        $Time["M"]=intval((($TimeDiv%86400)%3600)/60); // จำนวน นาที
        $Time["S"]=intval(((($TimeDiv%86400)%3600)%60)); // จำนวน วินาที

        if($Time["D"] != 0){
            return $Time["D"].' วัน '.$Time["H"].' ชม. '.$Time["M"].' นาที';
        }

        if($Time["D"] == 0 && $Time["H"] != 0){
            return $Time["H"].' ชม. '.$Time["M"].' นาที';
        }

        if($Time["D"] == 0 && $Time["H"] == 0){
            return $Time["M"].' นาที';
        }

    }

    public static function splitTime($time){ // เวลาในรูปแบบ มาตรฐาน 2006-03-27 21:39:12
        $timeArr["Y"]= substr($time,2,2);
        $timeArr["M"]= substr($time,5,2);
        $timeArr["D"]= substr($time,8,2);
        $timeArr["h"]= substr($time,11,2);
        $timeArr["m"]= substr($time,14,2);
        $timeArr["s"]= substr($time,17,2);
        return $timeArr;
    }
    
    // Return วินาที
    public static function DateAndSecond($date) {
        $second = Carbon::parse($date);
        $current = Carbon::now();
        $diff = $current->diffInSeconds($second);
    
        return (object) ['diff' => $diff, 'current' => $current->format('Y-m-d H:i:s')];
    }

    // Return 1 วัน 1 ซม. 1 นาที
    public static function SecondToTime($date) {
        $second = Carbon::parse($date);
        $current = Carbon::now();
        $diff = $current->diff($second);
    
        $result = "";
        if ($diff->days > 0) {
            $result .= $diff->days . " วัน ";
        }
        if ($diff->h > 0) {
            $result .= $diff->h . " ชั่วโมง ";
        }
        if ($diff->i > 0) {
            $result .= $diff->i . " นาที";
        }
    
        return $result;
    }
}
