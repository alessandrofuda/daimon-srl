<?php

namespace App\Domain;

use Exception;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BreweriesApiCalls
{
    /**
     * @throws Exception
     */
    public function authApiCall(string $apiToken, string $url)
    {
        try{
            $response = Http::withToken($apiToken)->acceptJson()->contentType('application/json')->get($url);

            // dump($response->status());
            // dd($response->json());
            //$response->body() : string;
            //$response->object() : object;
            //$response->successful() : bool;
            // $response->ok() : bool;

        }catch(Exception $e) {
            $err = 'Error in '.__METHOD__.': '.$e->getMessage();
            Log::error($err);
            throw new Exception($err);
        }

        return $response->json();
    }


    /**
     * @throws Exception
     */
    public function publicApiCall(string $url)
    {
        try{
            $currentPage = Paginator::resolveCurrentPage(); // 1;
            $perPage = 10;

            $response = Http::acceptJson()->contentType('application/json')->get($url);
            // $response = Http::acceptJson()->contentType('application/json')->get($url, ['page' => $currentPage, 'per_page' => $perPage]);

            // $breweriesData = $response->json(); // dati JSON
            // $items = Collection::make($breweriesData);
            $breweries = $response->json(); // new Paginator($items, $perPage, $currentPage, ['path' => $url]);

        }catch(Exception $e){
            $err = 'Error in '.__METHOD__.': '.$e->getMessage();
            Log::error($err);
            throw new Exception($err);
        }

        return $breweries;
    }

}
