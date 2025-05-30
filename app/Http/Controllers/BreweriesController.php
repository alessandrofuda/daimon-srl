<?php

namespace App\Http\Controllers;

use App\Domain\BreweriesApiCalls;
use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BreweriesController extends Controller
{
    /**
     * @throws Exception
     */
    public function index(Request $request) : View
    {
        $token = $request->get('token');
        $url = config('services.internal_endpoint.url');

        // authenticated api call towards laravel backend
        $breweriesApiCalls = new BreweriesApiCalls();
        $breweries = $breweriesApiCalls->authApiCall($token, $url);

        return view('breweries', ['breweries' => $breweries['breweries']]);
    }

}
