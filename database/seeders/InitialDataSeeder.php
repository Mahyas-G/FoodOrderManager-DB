<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Support\Facades\Hash;

class InitialDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email'=>'admin@example.com'],
            ['name'=>'Admin','password'=>Hash::make('password'),'role'=>'admin']
        );

        $cats = ['ایرانی','فست‌فود','سالاد','نوشیدنی'];
        foreach ($cats as $c) Category::firstOrCreate(['name'=>$c]);

        $c1 = Category::where('name','ایرانی')->first();
        Menu::firstOrCreate(['name'=>'قرمه‌سبزی','category_id'=>$c1->id],[
            'price'=>180000,'stock'=>100,'description'=>'قرمه‌سبزی خانگی'
        ]);
    }
}
