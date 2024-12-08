<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\GoogleBusinessService;
use Illuminate\Http\Request;

class GoogleBusinessController extends Controller
{
    protected $googleBusinessService;

    public function __construct(GoogleBusinessService $googleBusinessService)
    {
        $this->googleBusinessService = $googleBusinessService;
    }

    public function listProfiles()
    {
        try {
            $profiles = $this->googleBusinessService->fetchBusinessProfiles();
            // dd($profiles);
            return response()->json([
                'success' => true,
                'data' => $profiles,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
