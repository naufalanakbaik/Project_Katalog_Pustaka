<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Buku>
 */
class BukuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'judul' => $this->faker->sentence(4),
            'pengarang' => $this->faker->name,
            'cover' => '',
            'tahun_terbit' => $this->faker->year,
            'deskripsi' => $this->faker->paragraph(5),
            // 'kategori_id' => $this->faker->randomElement([1,3,5,6]), untuk random id bisa menggunakan randomElement
            'kategori_id' => $this->faker->numberBetween(1,5),
            // 'penerbit_id' => $this->faker->randomElement([1,3,4,5]), untuk random id bisa menggunakan randomElement
            'penerbit_id' => $this->faker->numberBetween(1,5),
        ];
    }
}
