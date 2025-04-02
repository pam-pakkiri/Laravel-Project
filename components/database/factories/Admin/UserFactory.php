<?php

namespace Database\Factories\Admin;

use App\Models\Admin\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use DateTime;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fullname'       => $this->faker->name(),
            'email'          => $this->faker->unique()->safeEmail,
            'password'       => '$2b$10$WvrI8Ghrux3eaVTpOiuWR.zrzT0AdNZY.Y4xFGd0QSvGwhj2om2Bi',
            'remember_token' => new DateTime(),
        ];
    }
}
