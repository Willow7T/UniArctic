<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Magazine;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MagazinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //DB::table('magazines')->truncate();

        $months = range(1, 12);
        shuffle($months);

        foreach ($months as $month) {
            Magazine::factory()->create(['month' => $month]);
        }
    }
}
