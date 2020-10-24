<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Member; //要引用建立的Modal名稱
use Faker\Generator as Faker;

$factory->define(Member::class, function (Faker $faker) {
    return [
        'name' => $faker->name, //對照資料表的欄位名稱給屬性
        'ename' => $faker->username,
        'phone' => $faker->PhoneNumber,
        'email' => $faker->safeEmail,
        'sex'  => $faker->randomElement(['男', '女']),
        'city'  => $faker->city,
        'township'  => $faker->state,
        'postcode'  => $faker->postcode,
        'address' => $faker->streetAddress,
        'notes' => $faker->string = '',
        //
    ];
});

// 可以從這個路徑 \vendor\fzaninotto\faker\src\Faker\Generator.php 查看欄位屬性
