<?php

namespace Tests\Unit;

use App\Models\Car;
use PHPUnit\Framework\TestCase;

class CarTest extends TestCase
{
    public function testClassExist()
    {
        $car = new Car();
        $this->assertInstanceOf(Car::class, $car);
    }
    public function testFillable()
    {
        $car = new Car();
        $array = ['model','year','description', 'brand_id'];
        $this->assertEquals($array, $car->getFillable());
    }
    public function testNewInstance(){
        $attr = [
            'model' => $this->faker->name,
            'year' => $this->faker->year,
            'description' => $this->faker->sentence
        ];
        $car = new Car($attr);
        self::assertEquals($attr, $car->getAttributes());
    }

}
