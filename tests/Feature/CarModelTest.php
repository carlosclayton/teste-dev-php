<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Car;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CarModelTest extends TestCase
{
    private $car;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $attr = [
            'model' => $this->faker->name,
            'year' => $this->faker->year,
            'description' => $this->faker->sentence,
            'brand_id' => Brand::factory()->create()->id->toString(),
        ];

        $this->car = Car::create($attr);
    }

    /**
     * @test
     * @testdox Adding Car
     */
    public function testNewCar()
    {
        $this->assertDatabaseHas('cars', $this->car->getAttributes());

    }

    /**
     * @test
     * @testdox Updating Car
     */
    public function testUpdateCar()
    {
        $this->car->description = null;
        $this->car->save();
        $this->assertNull($this->car->description);
        $this->assertDatabaseHas('cars', $this->car->getAttributes());
    }

    /**
     * @test
     * @testdox Showing Car
     */
    public function testShowCar()
    {
        self::assertDatabaseHas('cars', $this->car->getAttributes());
    }

    /**
     * @test
     * @testdox Removing Car
     */
    public function testDestroyCar()
    {
        $this->car->delete();
        $this->assertSoftDeleted('cars', $this->car->getAttributes());
    }
}
