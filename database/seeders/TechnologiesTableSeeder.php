<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = ["HTML", "CSS", "JS", "VUE", "VITE", "LARAVEL", "PHP", "MYSQL"];

        foreach ($technologies as $technology) {
            $newTechnology = new Technology();
            $newTechnology->name = $technology;
            // if ($type === "HTML" or $type === "CSS" or $type === "JS" or $type === "VUE") {
            //     $newType->field = "Front-End";
            // } elseif ($type === "PHP" or $type === "MySQL") {
            //     $newType->field = "Back-End";
            // } else {
            //     $newType->field = "Full-Stack";
            // }
            $newTechnology->save(); //
        }
    }
}