<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;
    protected $table = "information";
    public $imageFile = null;

    public function getOfficeDays()
    {
        $weekdays = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        $result = [];
        $startDay = "";
        $endDay = "";
        $foundIndex = -1;
        $arrWeekdays = str_split($this->weekdays);
        foreach ($arrWeekdays as $key => $value) {

            if ($value == '1' && $foundIndex == -1) {
                $startDay = $weekdays[$key];
                $foundIndex = $key;
            } else if ($value == '0' && $foundIndex != -1) {
                $endDay = $weekdays[$foundIndex];
                array_push($result, $endDay == $startDay ? $startDay : $startDay . ' - ' . $endDay);
                $foundIndex = -1;
                $startDay = "";
                $endDay = "";
            } else if ($value == '1' && $foundIndex + 1 == $key) {
                $foundIndex = $key;
            }

            if ($key + 1 == count($arrWeekdays)) {
                if($weekdays[$key] == $startDay) {
                    array_push($result, $weekdays[$key]);
                }else
                    array_push($result, $startDay . ' - ' .  $weekdays[$key]);
            }
        }
        return array_reduce($result, function ($first, $sec) {
            if ($first != '') {
                return $first . ', ' . $sec;
            } else {
                return $sec;
            }
        });
    }
    public function getOfficeHours()
    {
        return ltrim(date("h:i a",strtotime($this->office_start_time)), '0') .' - '.ltrim(date("h:i a",strtotime($this->office_end_time)), '0');
    }
}
