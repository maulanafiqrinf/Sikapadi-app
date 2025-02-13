<?php

namespace Database\Factories;

use App\Models\Testimoni;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestimoniFactory extends Factory
{
    protected $model = Testimoni::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'status' => 'published',
            // Sesuaikan dengan kolom lain jika ada
        ];
    }
}
