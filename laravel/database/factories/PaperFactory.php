<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paper>
 */
class PaperFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "title" => $this->faker->sentence(),
            "memo" => $this->faker->sentence(),
            "url" => $this->faker->url(),
            "author" => $this->faker->name(),
            "journal" => $this->faker->company(),
            "publisher" => $this->faker->sentence(),
            "volume" => $this->faker->numberBetween(),
            "number" => $this->faker->numberBetween(),
            "pages" => $this->faker->numberBetween() . '--' . $this->faker->numberBetween(),
            "year" => $this->faker->year(),
            "pdf_url" => config('filesystems.disks.s3.url') . '/'
                . config('filesystems.disks.s3.bucket') . '/test.pdf'
        ];
    }
}
