<?php

namespace Database\Factories;

use App\Models\Tugas;
use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TugasFactory extends Factory
{
    protected $model = Tugas::class;

    public function definition(): array
    {
        $deadline = $this->faker->dateTimeBetween(now()->subDays(10), now()->addDays(45));
        $statuses = ['Belum Selesai', 'Selesai'];

        return [
            'user_id'     => User::factory(),
            'course_id'   => Course::factory(),

            'judul'       => rtrim($this->faker->sentence(4), '.'),
            'description' => $this->faker->realText(120),
            'deadline'    => $deadline,
            'status'      => $this->faker->randomElement($statuses),
        ];
    }
}
