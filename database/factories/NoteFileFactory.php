<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NoteFile>
 */
class NoteFileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(asText: true),
            'path' => fake()->randomElement(['pdfs/pdf1.pdf', 'pdfs/pdf2.pdf', 'pdfs/pdf3.pdf']),
        ];
    }
}
