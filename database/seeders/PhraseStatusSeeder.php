<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhraseStatusSeeder extends Seeder
{

    private $tableName = 'phrase_statuses';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $phraseStatuses = [
            [
                'id'        => 1,
                'name'      => 'Active'
            ],
            [
                'id'        => 2,
                'name'      => 'Inactive'
            ],
            [
                'id'        => 3,
                'name'      => 'Awaiting Approve'
            ],
            [
                'id'        => 4,
                'name'      => 'Invalid'
            ]
        ];

        DB::table($this->tableName)->delete();
        DB::table($this->tableName)->insert($phraseStatuses);
    }
}
