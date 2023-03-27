<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use Illuminate\Database\Seeder;

class AcademicYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AcademicYear::create([
            'name' => '1º',
        ]);
        AcademicYear::create([
            'name' => '2º',
        ]);
        AcademicYear::create([
            'name' => '3º',
        ]);
        AcademicYear::create([
            'name' => '4º',
        ]);
    }
}
