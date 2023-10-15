<?php

use Illuminate\Database\Seeder;
use App\Models\Users\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
$defaultBirthDay = date('Y-m-d', strtotime('2000-01-01'));

        DB::table('users')->insert([
        'over_name' => 'Atlas',
        'under_name' => '太郎',
        'over_name_kana' => 'アトラス',
        'under_name_kana' => 'タロウ',
        'mail_address' => 'Atlas@example.com',
        'sex' => '1',
        'birth_day' => $defaultBirthDay,
        'role' => '1',
        'password' => bcrypt('Atlasatlas') ,
        ]);

    }
}
