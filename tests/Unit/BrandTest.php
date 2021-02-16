<?php

namespace Tests\Unit;

use App\Models\Brand;
use PHPUnit\Framework\TestCase;

class BrandTest extends TestCase
{
    public function testClassExist()
    {
        $brand = new Brand();
        $this->assertInstanceOf(Brand::class, $brand);
    }
    public function testFillable()
    {
        $brand = new Brand();
        $array = ['name', 'description'];
        $this->assertEquals($array, $brand->getFillable());
    }
    public function testNewInstance(){
        $attr = [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence
        ];
        $brand = new Brand($attr);
        self::assertEquals($attr, $brand->getAttributes());
    }

}
