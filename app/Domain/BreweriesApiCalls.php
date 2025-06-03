<?php

namespace App\Domain;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BreweriesApiCalls
{
    /**
     * @throws Exception
     */
    public function ApiCall(string $method, string $url, ?array $data = [], ?string $token = null)
    {
        try{
            $client = Http::acceptJson()->contentType('application/json');

            if ($token) {
                $client->withToken($token);
            }

            $response = $client->$method($url, $data);
            return $response->json();

            // dump($client->status());
            // dd($client->json());
            // $client->body() : string;
            // $client->successful() : bool;
            // $client->ok() : bool;

        }catch(Exception $e){
            $err = 'Error in '.__METHOD__.': '.$e->getMessage();
            Log::error($err);
            throw new Exception($err);
        }
    }
}
