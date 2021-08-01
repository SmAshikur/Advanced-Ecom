<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sectionRecords=[
            ['id'=>1,'name'=>'Men','status'=>1],
            ['id'=>2,'name'=>'Women','status'=>2],
            ['id'=>3,'name'=>'Kids','status'=>3]
        ];
        Section::insert($sectionRecords);
    }
}
