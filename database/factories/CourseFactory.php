<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition(): array
    {
        $names = [
            'Algoritma & Pemrograman', 'Pemrograman Web Lanjut', 'Sistem Basis Data',
            'Jaringan Komputer', 'Kecerdasan Buatan', 'Pengujian Perangkat Lunak',
            'Sistem Operasi', 'Interaksi Manusia & Komputer', 'Keamanan Jaringan',
        ];

        return [
           
            'user_id'        => User::factory(),
            'name'           => $this->faker->unique()->randomElement($names),
            'code'           => strtoupper($this->faker->bothify('IF??###')),
            'dosen_pengampu' => $this->faker->name(),
            'semester'       => $this->faker->numberBetween(1, 8),
        ];
    }
}
