<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    $this->call(UserTableSeeder::class);
    $this->call(RoomsTableSeeder::class);
    $this->call(ClientsTableSeeder::class);
  }
}
