<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomsTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    //
    DB::table('rooms')->insert(['name' => '101', 'floor' => 1, 'description' => '101']);
    DB::table('rooms')->insert(['name' => '102', 'floor' => 1, 'description' => '102']);
    DB::table('rooms')->insert(['name' => '201', 'floor' => 2, 'description' => '201']);
    DB::table('rooms')->insert(['name' => '202', 'floor' => 2, 'description' => '202']);
  }
}
