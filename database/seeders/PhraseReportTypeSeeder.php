<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhraseReportTypeSeeder extends Seeder
{

    private $tableName = 'phrase_report_types';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $phraseReportTypes = [
            [
                'id'            => 1,
                'name'          => json_encode([
                    'en'        => 'Wrong spelling',
                    'id'        => 'Ejaan salah',
                    'vi'        => 'Sai chính tả'
                ]),
                'description'   => null,
            ],
            [
                'id'        => 2,
                'name'      => json_encode([
                    'en'    => 'Wrong translation',
                    'id'    => 'Terjemaah salah',
                    'vi'    => 'Bản dịch sai'
                ]),
                'description'   => null,
            ],
            [
                'id'            => 3,
                'name'          => json_encode([
                    'en'        => 'Other',
                    'id'        => 'Lainnya',
                    'vi'        => 'Khác'
                ]),
                'description'   => null,
            ],
        ];

        DB::table($this->tableName)->delete();
        DB::table($this->tableName)->insert($phraseReportTypes);
    }
}
