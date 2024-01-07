<?php

namespace App\Calendars\General;

use App\Models\Calendars\ReserveSettings;
use Carbon\Carbon;
use Auth;

class CalendarWeekDay
{
  protected $carbon;

  function __construct($date)
  {
    $this->carbon = new Carbon($date);
  }

  function getClassName()
  {
    return "day-" . strtolower($this->carbon->format("D"));
  }

  function pastClassName()
  {
    return;
  }

  /**
   * @return
   */

  function render()
  {
    return '<p class="day">' . $this->carbon->format("j") . '日</p>';
  }

  function selectPart($ymd)
  {
    //今日の日付
    $toDay =
      Carbon::today();


    // 選択肢を非表示にする条件（$todayより前の日付）
    if (Carbon::parse($ymd)->isBefore($toDay)) {
      return '<p class="day" style="background-color: gray;">受付終了</p>';
    }


    // 以降は$todayより後の日付の場合の選択肢表示の処理
    $one_part_frame = ReserveSettings::where('setting_reserve', $ymd)->where('setting_part', '1')->first();
    $two_part_frame = ReserveSettings::where('setting_reserve', $ymd)->where('setting_part', '2')->first();
    $three_part_frame = ReserveSettings::where('setting_reserve', $ymd)->where('setting_part', '3')->first();

    // その日付と部に関連する残りの枠数が取得されることになります
    $one_part_frame = $one_part_frame ? $one_part_frame->limit_users : '0';
    $two_part_frame = $two_part_frame ? $two_part_frame->limit_users : '0';
    $three_part_frame = $three_part_frame ? $three_part_frame->limit_users : '0';

    // 残りの枠数を表示
    $html = [];
    $html[] = '<select name="getPart[]" class="border-primary" style="width:70px; border-radius:5px;" form="reserveParts">';
    $html[] = '<option value="" selected></option>';
    if ($one_part_frame === "0") {
      $html[] = '<option value="1" disabled>リモ1部(残り0枠)</option>';
    } else {
      $html[] = '<option value="1">リモ1部(残り' . $one_part_frame . '枠)</option>';
    }
    if ($two_part_frame === "0") {
      $html[] = '<option value="2" disabled>リモ2部(残り0枠)</option>';
    } else {
      $html[] = '<option value="2">リモ2部(残り' . $two_part_frame . '枠)</option>';
    }
    if ($three_part_frame === "0") {
      $html[] = '<option value="3" disabled>リモ3部(残り0枠)</option>';
    } else {
      $html[] = '<option value="3">リモ3部(残り' . $three_part_frame . '枠)</option>';
    }
    $html[] = '</select>';
    return implode('', $html);
  }
  function getDate()
  {
    return '<input type="hidden" value="' . $this->carbon->format('Y-m-d') . '" name="getData[]" form="reserveParts">';
  }

  function everyDay()
  {
    return $this->carbon->format('Y-m-d');
  }

  function authReserveDay()
  {
    return Auth::user()->reserveSettings->pluck('setting_reserve')->toArray();
  }

  function authReserveDate($reserveDate)
  {
    return Auth::user()->reserveSettings->where('setting_reserve', $reserveDate);
  }
}
