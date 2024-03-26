<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HotelControllerTest extends TestCase
{
    /**
     * Test searching hotels by name.
     *
     * @return void
     */
    public function testSearchByName()
    {
        $response = $this->get('/api/hotels?name=Le Meridien');
        $response->assertStatus(200);
    }

    /**
     * Test filtering hotels by price range.
     *
     * @return void
     */
    public function testFilterByPriceRange()
    {
        $response = $this->get('/api/hotels?price_range=80:100');
        $response->assertStatus(200);
    }

    /**
     * Test sorting hotels by name.
     *
     * @return void
     */
    public function testSortByName()
    {
        $response = $this->get('/api/hotels?sort_by=name');
        $response->assertStatus(200);
    }

    /**
     * Test sorting hotels by price.
     *
     * @return void
     */
    public function testSortByPrice()
    {
        $response = $this->get('/api/hotels?sort_by=price');
        $response->assertStatus(200);
    }
}
