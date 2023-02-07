<?php

namespace Database\Factories;

use App\Models\Cms;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CmsFactory extends Factory
{
    protected $model = Cms::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name,
            'slug' => Str::slug($this->faker->name),
            'short_content' => $this->faker->text(160),
            'content' => $this->faker->realTextBetween(200,500),
        ];
    }
}
