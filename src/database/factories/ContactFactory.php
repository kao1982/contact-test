<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //  実際のカラム名に完全対応させたランダム生成ルール
            'category_id' => \App\Models\Category::inRandomOrder()->first()->id ?? 1,
            'first_name'  => $this->faker->firstName(),
            'last_name'   => $this->faker->lastName(),
            'gender'      => $this->faker->randomElement([1, 2, 3]), // 1:男性, 2:女性, 3:その他
            'email'       => $this->faker->unique()->safeEmail(),
            'tel'         => $this->faker->phoneNumber(),
            'address'     => $this->faker->address(),
            'building'    => $this->faker->secondaryAddress(), // マンション名など
            'detail'      => $this->faker->realText(50),       // お問い合わせ内容（50文字）
            'created_at'  => now(),
            'updated_at'  => now(),
        ];
    }
}