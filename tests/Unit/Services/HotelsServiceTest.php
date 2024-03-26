<?php

namespace Services;

use App\Services\HotelsService;
use PHPUnit\Framework\TestCase;

class HotelsServiceTest extends TestCase
{
    public function testFilterHotels()
    {
        $hotelsService = new HotelsService();
        $hotels = collect([
            (object)['name' => 'Le Meridien', 'city' => 'Paris', 'price' => 100, 'availability' => [
                (object)['from' => '01-01-2021', 'to' => '01-02-2021'],
                (object)['from' => '01-03-2021', 'to' => '01-04-2021'],
            ]],
            (object)['name' => 'Hilton', 'city' => 'London', 'price' => 80, 'availability' => [
                (object)['from' => '01-01-2021', 'to' => '01-02-2021'],
                (object)['from' => '01-03-2021', 'to' => '01-04-2021'],
            ]],
        ]);
        $request = new \Illuminate\Http\Request();
        $request->merge(['name' => 'Le Meridien']);
        $filteredHotels = $hotelsService->filterHotels($hotels, $request);
        $this->assertCount(1, $filteredHotels);
        $this->assertEquals('Le Meridien', $filteredHotels->first()->name);
    }

    public function testSortHotels()
    {
        $hotelsService = new HotelsService();
        $hotels = collect([
            (object)['name' => 'Le Meridien', 'city' => 'Paris', 'price' => 100, 'availability' => [
                (object)['from' => '01-01-2021', 'to' => '01-02-2021'],
                (object)['from' => '01-03-2021', 'to' => '01-04-2021'],
            ]],
            (object)['name' => 'Hilton', 'city' => 'London', 'price' => 80, 'availability' => [
                (object)['from' => '01-01-2021', 'to' => '01-02-2021'],
                (object)['from' => '01-03-2021', 'to' => '01-04-2021'],
            ]],
        ]);
        $request = new \Illuminate\Http\Request();
        $request->merge(['sort_by' => 'name']);
        $sortedHotels = $hotelsService->sortHotels($hotels, $request);
        $this->assertEquals('Hilton', $sortedHotels->first()->name);
    }
}
