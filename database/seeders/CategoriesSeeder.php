<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // slug yang muncul di-url setiap ganti page
    public function run(): void
    {
        $categories = [
            "Teknologi",
            "Bisnis",
            "Pendidikan",
            "Kesenian Budaya",
            "Olahraga Gen Z",
        ]; //array ini dilooping dengan foreach biar gk nulis satu-satu

        foreach ($categories as $key => $value) {
            Categories::create([
                'name' => $value,
                'slug' => Str::slug($value),
            ]);
        }
    }
}
