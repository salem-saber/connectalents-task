<?php

namespace App\Services;

use App\Repositories\HotelsRepository;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class HotelsService
{
    private HotelsRepository $hotelsRepository;

    public function __construct()
    {
        $this->hotelsRepository = new HotelsRepository();
    }

    public function fetchHotels($request): JsonResponse
    {
        $hotels = $this->hotelsRepository->fetchHotels();
        $hotels = $this->filterHotels($hotels, $request);
        $hotels = $this->sortHotels($hotels, $request);
        $hotels = $hotels->values()->all();

        return response()->json($hotels);
    }

    public function filterHotels(Collection $hotels, $request)
    {
        if ($request->has('name')) {
            $hotels = $hotels->filter(function ($hotel) use ($request) {
                return str_contains(strtolower($hotel->name), strtolower($request->input('name')));
            });
        }

        if ($request->has('city')) {
            $hotels = $hotels->filter(function ($hotel) use ($request) {
                return str_contains(strtolower($hotel->city), strtolower($request->input('name')));
            });
        }

        if ($request->has('price_range')) {
            $priceRange = explode(':', $request->input('price_range'));
            $hotels = $hotels->filter(function ($hotel) use ($priceRange) {
                return $hotel->price >= $priceRange[0] && $hotel->price <= $priceRange[1];
            });
        }

        if ($request->has('date_range')) {
            $dateRange = explode(':', $request->input('date_range'));

            $hotels = $hotels->filter(function ($hotel) use ($dateRange) {
                $available = false;
                foreach ($hotel->availability as $availability) {
                    $from = Carbon::createFromFormat('d-m-Y', $availability->from);
                    $to = Carbon::createFromFormat('d-m-Y', $availability->to);
                    $checkIn = Carbon::createFromFormat('d-m-Y', $dateRange[0]);
                    $checkOut = Carbon::createFromFormat('d-m-Y', $dateRange[1]);

                    if ($checkIn->between($from, $to) && $checkOut->between($from, $to)) {
                        $available = true;
                        break;
                    }
                }

                return $available;
            });
        }


        return $hotels;
    }

    public function sortHotels(Collection $hotels, $request): Collection
    {
        if ($request->has('sort_by')) {
            $sortBy = $request->input('sort_by');
            $hotels = $hotels->sortBy($sortBy);
        }

        return $hotels;
    }
}
