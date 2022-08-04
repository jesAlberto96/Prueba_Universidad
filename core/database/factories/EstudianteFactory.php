<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Estudiante>
 */
class EstudianteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombres' => fake()->firstName(),
            'apellidos' => fake()->lastName(),
            'tipoDocumento' => "CC",
            "documento" => "123456" . fake()->numberBetween(1, 20),
            'genero' => "M",
            'fechaNacimiento' => "1996-10-10",
            'carrera' => fake()->name(),
        ];
    }
}
