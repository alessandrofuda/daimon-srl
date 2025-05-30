<?php

namespace App\Http\Controllers\Api;

use App\Domain\BreweriesApiCalls;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class BreweriesController extends Controller
{
    /**
     * @throws Exception
     */
    public function getBreweries() : JsonResponse
    {
        try{
            $breweries = (new BreweriesApiCalls())->publicApiCall(config('services.openbrewerydb.url'));

        }catch (Exception $e){
            $err= 'Error in '.__METHOD__.': '.$e->getMessage();
            Log::error($err);
            throw new Exception($err);
        }

        return response()->json(['breweries' => $breweries]);
    }
}
