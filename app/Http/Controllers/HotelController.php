<?php

namespace App\Http\Controllers;

use App\Services\HotelsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HotelController extends Controller
{

    private HotelsService $hotelsService;

    public function __construct()
    {
        $this->hotelsService = new HotelsService();
    }

    public function index(Request $request): JsonResponse
    {
        return $this->hotelsService->fetchHotels($request);
    }
}
