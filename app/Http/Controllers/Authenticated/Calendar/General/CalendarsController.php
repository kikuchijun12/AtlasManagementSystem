<?php

namespace App\Http\Controllers\Authenticated\Calendar\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Calendars\General\CalendarView;
use App\Models\Calendars\ReserveSettings;
use App\Models\Calendars\Calendar;
use App\Models\USers\User;
use Auth;
use DB;

class CalendarsController extends Controller
{
    public function show()
    {
        $reserveSettings = $this->fetchReserveSettings();
        $calendar = new CalendarView(time());
        return view('authenticated.calendar.general.calendar', compact('calendar', 'reserveSettings'));
    }

    public function reserve(Request $request)
    {
        DB::beginTransaction();
        try {
            $getPart = $request->getPart;
            $getDate = $request->getData;
            //dd($getPart);
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

    public function delete($id)
    {
        $reserve_settings = ReserveSettingUser::findOrFail($id);
        $reserve_settings->delete();
        //reserve_setting_users::findOrFail($id)->delete();

        return redirect('/calendar');
    }

    public function fetchReserveSettings()
    {
        // 予約設定を取得するロジックを記述する
        // 例えば、データベースから予約設定を取得して返す
        return ReserveSettings::all(); // 仮の例です
    }
}
