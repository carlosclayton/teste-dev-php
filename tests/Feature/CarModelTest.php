<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Car;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CarModelTest extends TestCase
{

    /**
     * @test
     * @testdox Adding Car
     */
    public function testNewCar()
    {
        $attr = [
            'model' => $this->faker->name,
            'year' => $this->faker->year,
            'description' => $this->faker->sentence,
            'brand_id' => Brand::factory()->create()->id->toString(),
        ];

        $car = Car::create($attr);

        self::assertDatabaseHas('cars', $attr);

    }

    /**
     * @test
     * @testdox Updating Car
     */
    public function testUpdateCar()
    {

        $attr = [
            'model' => $this->faker->name,
            'year' => $this->faker->year,
            'description' => $this->faker->sentence,
            'brand_id' => Brand::factory()->create()->id->toString(),
        ];


        $car = Car::create($attr);
        $car->description = null;

        $car->save();
        $this->assertNull($car->description);
        self::assertDatabaseHas('cars', $car->getAttributes());
    }

    /**
     * @test
     * @testdox Showing Car
     */
    public function testShowCar()
    {

        $attr = [
            'model' => $this->faker->name,
            'year' => $this->faker->year,
            'description' => $this->faker->sentence,
            'brand_id' => Brand::factory()->create()->id->toString(),
        ];

        $car = Car::create($attr);
        $last = Car::latest()->first();
        self::assertDatabaseHas('cars', $last->getAttributes());
    }

    /**
     * @test
     * @testdox Removing Car
     */
    public function testDestroyCar()
    {

        $attr = [
            'model' => $this->faker->name,
            'year' => $this->faker->year,
            'description' => $this->faker->sentence,
            'brand_id' => Brand::factory()->create()->id->toString(),
        ];

        $car = Car::create($attr);

        $car->delete();
        self::assertSoftDeleted('cars', $car->getAttributes());
    }
}
