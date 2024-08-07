<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Users\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\RegisterRequest;
use Carbon\Carbon;

use DB;

use App\Models\Users\Subjects;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function registerView()
    {
        $subjects = Subjects::all();
        return view('auth.register.register', compact('subjects'));
    }

    public function registerPost(RegisterRequest $request)
    {
        //トランザクションを自分で開始し、ロールバックとコミットを完全にコントロールしたい場合
        //dd($request);
        DB::beginTransaction();
        try {
            $format = '%04d-%02d-%02d';
            //$format = 'Y-m-d';
            $old_year = $request->old_year;
            $old_month = $request->old_month;
            $old_day = $request->old_day;
            //くっつけてからバリデーション←ルールの前に行う
            $birth_day = sprintf($format, $old_year, $old_month, $old_day);
            //dd($birth_day);
            $subjects = $request->subject;

            $user_get = User::create([
                'over_name' => $request->over_name,
                'under_name' => $request->under_name,
                'over_name_kana' => $request->over_name_kana,
                'under_name_kana' => $request->under_name_kana,
                'mail_address' => $request->mail_address,
                'sex' => $request->sex,
                'birth_day' => $birth_day,
                'role' => $request->role,
                'password' => bcrypt($request->password)
            ]);
            //\Debugbar::info($user_get);
            $user = User::findOrFail($user_get->id);
            //dd($user);
            //役割を一つ結び付ける
            $user->subjects()->attach($subjects); //エラー発生 多対多
            DB::commit(); //トランクザクション処理確定
            return view('auth.login.login');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('loginView');
        }
    }
}
