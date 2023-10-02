<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use App\Services\Olx\OlxScraperService;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Response;

    class OlxCrawlersController extends Controller
    {
        public function getProperties(): JsonResponse
        {
            $params = OlxScraperService::filters();
            $result = OlxScraperService::getResultSearch($params);

            if (empty($result)) {
                return response()->json(['message' => 'No properties found'], response::HTTP_NOT_FOUND);
            }
            return response()->json([$result, response::HTTP_OK]);
        }
    }
