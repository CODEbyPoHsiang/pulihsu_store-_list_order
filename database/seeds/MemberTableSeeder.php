  
<?php

use Illuminate\Database\Seeder;
use App\Member; //要引用建立的Modal名稱
class MemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('member')->truncate();
        Member::unguard();
        factory(Member::class, 20)->create(); //要生成的假資料筆數
        Member::reguard();

        //
    }
}
