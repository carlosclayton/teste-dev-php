<?php

namespace Tests\Browser;

use App\Models\Brand;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CarBrowserTest extends DuskTestCase
{

    /**
     * @test
     * @testdox Index of car
     */
    public function testIndexOfCar()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/cars')
                ->assertSee('Cars')
                ->assertPathIs('/cars');
        });
    }

    /**
     * @test
     * @testdox Adding new car
     */
    public function testNewCar()
    {

        $this->browse(function (Browser $browser) {
            $browser->visit('/cars')
                ->press('Add')
                ->whenAvailable('.modal', function($modal){
                    $modal->type('model', $this->faker->name);
                    $modal->type('year', $this->faker->year);
//                    $modal->selected('brand_id', '1');
                    $modal->press('Save');
                })
                ->assertPathIs('/cars');


        });
    }
}
