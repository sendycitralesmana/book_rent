<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=UserSeeder
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();

        User::insert([
            'username' => 'admin', 
            'password' => '$2y$10$HJ13LmImm3vjw1J6Nu7uuePIM9EiIdSD87eFIN6UUk7qf9SYY4SKm', 
            'role_id' => 1, 
            'phone' => "",  
            'address' => 'toko buku', 
            'status' => 'active'
        ]);
    }
}
