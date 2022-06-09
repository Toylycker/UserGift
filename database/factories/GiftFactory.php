<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Gift;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gift>
 */
class GiftFactory extends Factory
{

    public function configure()
    {
        return $this->afterMaking(function (Gift $gift) {
            //
        })->afterCreating(function (Gift $gift) {
            $rand = rand(0, 2);
            $parent_id = $rand?Gift::inRandomOrder()->first()->id:null;
            $gift->parent_id = $parent_id==$gift->id?null:$parent_id;
            $gift->update();
        });
    }
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = User::inRandomOrder()->first();
        $rand = rand(0, 1);
        return [
            'name' => $this->faker->word(),
            'user_id' => $user->id,
        ];
    }
}