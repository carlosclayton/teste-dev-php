<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Car;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CarControllerTest extends TestCase
{
    private $car;
    private $attr;
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->attr = [
            'model' => $this->faker->name,
            'year' => $this->faker->year,
            'description' => $this->faker->sentence,
            'brand_id' => Brand::factory()->create()->id->toString(),
        ];

        $this->car = Car::create($this->attr);

    }

    /**
     * @test
     * @testdox Index controller
     * @group ignore
     */
    public function testIndex()
    {

        $response = $this->getJson('/api/cars');

        $response
            ->assertStatus(200)
            ->assertJson($response->json())
            ->assertSeeText($this->car->model)
            ->assertSeeText($this->car->year)
            ->assertSeeText($this->car->description);
    }

    public function testStore()
    {

        $response = $this->postJson( '/api/cars', $this->attr);

        $response
            ->assertStatus(201)
            ->assertJson($response->json())
            ->assertSeeText($this->attr['model'])
            ->assertSeeText($this->attr['year'])
            ->assertSeeText($this->attr['description']);
    }
    public function testStoreModelNotNull()
    {

        $response = $this->postJson( '/api/cars',[
            'model' => ''
        ]);
        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors(['model']);


    }

    public function testStoreValidationModelMax()
    {

        $response = $this->postJson( '/api/cars',[
            'model' => $this->faker->sentence(258)
        ]);
        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors(['model']);

    }



    public function testShow()
    {

        $response = $this->getJson('/api/cars/' . $this->car->id );
        $response
            ->assertStatus(200)
            ->assertJson($response->json())
            ->assertSeeText($this->car->model)
            ->assertSeeText($this->car->year)
            ->assertSeeText($this->car->description);

    }

    public function testUpdate()
    {

        $response = $this->putJson('/api/cars/'. $this->car->id, $this->attr);

        $response
            ->assertStatus(200)
            ->assertJson($response->json())
            ->assertSeeText($this->attr['model'])
            ->assertSeeText($this->attr['year'])
            ->assertSeeText($this->attr['description']);


    }

    public function testUpdateNameNotNull()
    {

        $response = $this->putJson('/api/cars/'. $this->car->id, [
            'model' => ''
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors(['model']);

    }

    public function testUpdateDescriptionNull()
    {

        $response = $this->putJson('/api/cars/'. $this->car->id, [
            'model' => $this->faker->name,
            'year' => $this->faker->year,
            'brand_id' => Brand::factory()->create()->id->toString(),
            'description' => null
        ]);

        $response->assertStatus(200);
        $this->assertNull($response->json('description'));

    }

    public function testDestroy()
    {

        $response = $this->deleteJson('/api/cars/' . $this->car->id);
        $response
            ->assertStatus(204)
            ->assertNoContent();

    }
}
