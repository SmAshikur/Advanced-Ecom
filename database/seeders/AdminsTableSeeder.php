<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        $adminRecords=[
          [
              'id'=>1,
              'name'=>'admin',
              'type'=>'admin',
              'mobile'=>143453453,
              'email'=>'admin@gmail.com',
              'password'=>'$2y$10$qsVufnjM1FIbRupAHg0qre4lEN5F9MNVqgR/h9XQZ6ZEGRDbNtTei',
              'image'=>'',
              'status'=>1
          ],
            [
                'id'=>2,
                'name'=>'ashik',
                'type'=>'admin',
                'mobile'=>143453453,
                'email'=>'admin2@gmail.com',
                'password'=>'$2y$10$qsVufnjM1FIbRupAHg0qre4lEN5F9MNVqgR/h9XQZ6ZEGRDbNtTei',
                'image'=>'',
                'status'=>1
            ],
            [
                'id'=>3,
                'name'=>'sohel',
                'type'=>'sub-admin',
                'mobile'=>143453453,
                'email'=>'admin3@gmail.com',
                'password'=>'$2y$10$qsVufnjM1FIbRupAHg0qre4lEN5F9MNVqgR/h9XQZ6ZEGRDbNtTei',
                'image'=>'',
                'status'=>1
            ],
            [
                'id'=>4,
                'name'=>'kumar',
                'type'=>'sub-admin',
                'mobile'=>143453453,
                'email'=>'admin4@gmail.com',
                'password'=>'$2y$10$qsVufnjM1FIbRupAHg0qre4lEN5F9MNVqgR/h9XQZ6ZEGRDbNtTei',
                'image'=>'',
                'status'=>1
            ],
        ];
        DB::table('admins')->insert($adminRecords);

       /* foreach ($adminRecords as $key =>$record){
            Admin::create($record);
        }*/
    }
}
