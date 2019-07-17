<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientsTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    //
    DB::table('clients')->insert([
      'title' => 'Mr.',
      'name' => 'Jane',
      'last_name' => 'James',
      'address' => 'New York',
      'zip_code' => '12903',
      'city' => 'Rochester',
      'state' => 'New York',
      'email' => 'jame@example.com']);
  }
}
