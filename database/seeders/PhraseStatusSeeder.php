<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhraseStatusSeeder extends Seeder
{

    private $tableName = 'phrase_statuses';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $phraseStatusesSeeder = [
            [
                'id'            => 1,
                'name'          => json_encode([
                    'en'        => 'Active',
                    'id'        => 'Aktif',
                    'vi'        => '?'
                ]),
                'description'   => null,
            ],
            [
                'id'            => 2,
                'name'          => json_encode([
                    'en'        => 'Inactive',
                    'id'        => 'Tidak Aktif',
                    'vi'        => '?'
                ]),
                'description'   => null,
            ],
            [
                'id'            => 3,
                'name'          => json_encode([
                    'en'        => 'Awaiting Approve',
                    'id'        => 'Menunggu Persetujuan',
                    'vi'        => '?'
                ]),
                'description'   => null,
            ],
            [
                'id'            => 4,
                'name'          => json_encode([
                    'en'        => 'Invalid',
                    'id'        => 'Tidak Valid',
                    'vi'        => '?'
                ]),
                'description'   => null,
            ],
        ];

        DB::table($this->tableName)->delete();
        DB::table($this->tableName)->insert($phraseStatusesSeeder);
    }
}
