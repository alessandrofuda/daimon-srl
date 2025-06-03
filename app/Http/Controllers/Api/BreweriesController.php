<?php

namespace App\Http\Controllers\Api;

use App\Domain\BreweriesApiCalls;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Log;

class BreweriesController extends Controller
{
    /**
     * @throws Exception
     */
    public function getBreweriesFromRemoteService(Request $request) : JsonResponse
    {
        try{
            $data = [
                'page' => $request->page ?? 1, // Paginator::resolveCurrentPage(),
                'per_page' => 10
            ];

            $breweries = (new BreweriesApiCalls())->ApiCall('get', config('services.openbrewerydb.url'), $data);
            return response()->json(['breweries' => $breweries]);

        }catch (Exception $e){
            $err= 'Error in '.__METHOD__.': '.$e->getMessage();
            Log::error($err);
            // throw new Exception($err);
            return response()->json(['error' => $err], $e->getCode());
        }


    }
}
