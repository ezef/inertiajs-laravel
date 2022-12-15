<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{

    protected $model = Patient::class;

    public function definition()
    {
        return [
            'name' => fake()->name(),
            'age' => fake()->randomNumber(2),
            'blood_type' => fake()->randomElement([
                'A+',
                'A-',
                '0+',
                '0-',
                'B+',
                'B-',
                'AB+',
                'AB-',
            ]),
            'birthdate' => fake()->dateTime(),
        ];
    }
}
