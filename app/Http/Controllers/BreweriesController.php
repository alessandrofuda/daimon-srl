<?php

namespace App\Http\Controllers;

use App\Domain\BreweriesApiCalls;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class BreweriesController extends Controller
{
    /**
     * @throws Exception
     */
    public function index(Request $request) : View
    {
        try{
            $token = $request->get('token');
            $page = (int)$request->get('page', 1);
            $url = config('services.internal_endpoint.url'); // --> /api/get-breweries?page=n
            $breweries = (new BreweriesApiCalls())->ApiCall('get', $url, ['page' => $page], $token);

        }catch (Exception $e){
            $err= 'Error in '.__METHOD__.': '.$e->getMessage();
            Log::error($err);
            throw new Exception($err);
        }

        return view('breweries', ['breweries' => $breweries['breweries']]);
    }

}
