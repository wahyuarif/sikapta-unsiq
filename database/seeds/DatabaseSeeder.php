<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
//         $this->call(PengajuanTableSeeder::class);
//         $this->call(BimbinganTableSeeder::class);
         $this->call(ProdiTableSeeder::class);
         $this->call(MahasiswaTableSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(DosenTableSeeder::class);
         $this->call(SksTableSeeder::class);
//         $this->call(TransaksiTableSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
