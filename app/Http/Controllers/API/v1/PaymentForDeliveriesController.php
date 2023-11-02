<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Services\PaymentControlService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class PaymentForDeliveriesController extends Controller
{
    public function __construct(
        protected PaymentControlService $paymentControlService
    ) {
    }

    public function __invoke(): JsonResponse
    {
        $apiUrl = env('API_URL');

        try {
            $response = Http::get($apiUrl);

            if ($response->successful()) {
                $data = $response->json();

                $data_processed = $this->paymentControlService->process($data);

                return response()->json($data_processed, 200);
            } else {
                return response()->json(['error' => 'Failed to fetch data from the API'], 500);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching data from the API'], 500);
        }
    }
}
