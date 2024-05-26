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
        //dd($reserveSettings);
        $reserveDate = ReserveSettings::get();
        //$reserveSettingUser = ReserveSettingUser::get();
        //dd($reserveSettingUser);
        $calendar = new CalendarView(time());
        return view('authenticated.calendar.general.calendar', compact('calendar', 'reserveDate'));
    }

    public function reserve(Request $request)
    {
        //dd($request);
        DB::beginTransaction();
        try {
            dd($request);
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
            //dd($request->all());

            $getDate = $request->input('getDate', []);
            $getPart = $request->input('getPart', []);

            // デバッグ用のダンプ
            dd($getDate, $getPart);
            $reserveDays = array_filter(array_combine($getDate, $getPart));
            foreach ($reserveDays as $key => $value) {
                $reserve_settings = ReserveSettings::where('setting_reserve', $key)->where('setting_part', $value)->first();
                $reserve_settings->increment('limit_users');
                $reserve_settings->users()->detach(Auth::id());
            }
        } catch (\Exception $e) {
            DB::rollback();
        }
        return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
    }
}
