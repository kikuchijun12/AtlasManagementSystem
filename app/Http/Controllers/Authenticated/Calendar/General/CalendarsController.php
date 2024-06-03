<?php

namespace App\Http\Controllers\Authenticated\Calendar\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Calendars\General\CalendarView;
use App\Models\Calendars\ReserveSettings;
use App\Models\Calendars\ReserveSettingUser;
use App\Models\Calendars\Calendar;
use App\Models\USers\User;
use Auth;
use DB;

class CalendarsController extends Controller
{
    public function show($user_id)
    {
        $reserveDate = ReserveSettings::get();
        $calendar = new CalendarView(time());
        return view('authenticated.calendar.general.calendar', compact('calendar', 'reserveDate'));
    }

    public function reserve(Request $request)
    {
        DB::beginTransaction();
        try {
            $getPart = $request->getPart;
            $getDate = $request->getDate;
            //dd($getDate);
            $reserveDays = array_filter(array_combine($getDate, $getPart));
            foreach ($reserveDays as $key => $value) {
                $reserve_settings = ReserveSettings::where('setting_reserve', $key)->where('setting_part', $value)->first();
                $reserve_settings->decrement('limit_users');
                $reserve_settings->users()->attach(Auth::id());
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
        return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
    }
    public function delete(Request $request)
    {
        try {
            // input type="hidden"で送った値を取得
            $getDate = $request->input('reserve_date'); //修正
            $getPart = $request->input('reserve_part'); //修正
            $reserve_settings = ReserveSettings::where('setting_reserve', $getDate)->where('setting_part', $getPart)->first();
            $reserve_settings->increment('limit_users');
            $reserve_settings->users()->detach(Auth::id());
        } catch (\Exception $e) {
            DB::rollback();
        }
        return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
    }
}
