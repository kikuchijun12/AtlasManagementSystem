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
        //dd($id);
        // ReserveSettingUser モデルから指定されたIDのレコードを取得
        $reserveSettingUser = ReserveSettingUser::find($id);
        dd($reserveSettingUser);
        //$reserveSettingUser = ReserveSettingUser::where("id", $id)->first();

        // レコードが存在しない場合は警告を出力してリダイレクト
        if (!$reserveSettingUser) {
            return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
        }

        // レコードを削除
        $reserveSettingUser->delete();

        // 正常に削除された場合はリダイレクト
        return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
    }

    ///public function getReserveSettings(Request $request)
    //{
    // 予約設定を取得するロジックを記述する
    // 例えば、データベースから予約設定を取得して返す
    //$id = $request->id;
    //ddd($id);
    //$reserveDate = ReserveSettings::find($id)->setting_reserve;
    //$reservePart = ReserveSettings::find($id)->setting_part;
    // 仮の例です

    //SNS課題参考↓
    //$profile = User::where('id', $id)
    //->orderBy('created_at', 'desc')
    //->first();

    //$user_id = Auth::id();
    //$post_id = $request->post_id;

    //$like = new Like;

    //$like->like_user_id = $user_id;
    //$like->like_post_id = $post_id;
    //$like->save();

    //return response()->json(['setting_reserve' => $reserveDate, //'setting_part' => $reservePart]);
    //}
}
