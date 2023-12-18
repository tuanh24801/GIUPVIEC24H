<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\ErrandWoker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Admin::factory(2)->create();
        \App\Models\Customer::factory(20)->create();
        \App\Models\ErrandWorker::factory(20)->create();

        $jobs = ['Giao gà', 'Giao hàng', 'Đi chợ', 'Livestream', 'Thay bóng đèn'];
        for ($i=0; $i < count($jobs ); $i++) {
            \App\Models\Job::factory(1)->create(['name' => $jobs[$i]]);
        }

        $type_rentals = ['Theo giờ', 'Theo ngày', 'Theo doanh số', 'Theo lần', 'Theo số km'];
        for ($i=0; $i < count($type_rentals ); $i++) {
            \App\Models\TypeRental::factory(1)->create(['name' => $type_rentals[$i]]);
        }

        // \App\Models\Admin::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'password' => Hash::make('1'),
        // ]);

        // $admin = new Admin();
        // $admin->name = 'test user';
        // $admin->email = 'test@example.com';
        // $admin->password = Hash::make('1');
        // $admin->save();




    }
}
