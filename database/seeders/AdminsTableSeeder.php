<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Hash;
class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $password = Hash::make('17171');
      $adminRecords=[
        ['id'=>1,'name'=>'Admin','type'=>'admin','mobile'=>01773642744441,'email'=>'admin@gmail.com','password'=>$password,'image'=>'','status'=>1],
        // ['id'=>2,'name'=>'Tanvir','type'=>'subadmin','mobile'=>1817171717,'email'=>'tanvir@gmail.com','password'=>$password,'image'=>'','status'=>1],
        // ['id'=>3,'name'=>'Tagim','type'=>'subadmin','mobile'=>1917171717,'email'=>'tagim@gmail.com','password'=>$password,'image'=>'','status'=>1]

      ];
      Admin::insert($adminRecords);
    }
}
