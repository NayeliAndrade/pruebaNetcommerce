<?php

namespace Database\Factories;
use App\Models\Task;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Task::class;
     public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'user_id' => User::inRandomOrder()->first()->id,
            'is_completed' => $this->faker->boolean(),
            'start_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'expired_at' =>$this->faker->dateTimeBetween('now', '+1 year'),
            'company_id' => Company::inRandomOrder()->first()->id
        ];
    }
}
