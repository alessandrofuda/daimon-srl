<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Laravel\Sanctum\PersonalAccessToken;

class DashboardController extends Controller
{
    /**
     * @throws Exception
     */
    public function index(Request $request) : View
    {
        try{
            // Get token from flash memory
            $flashedToken = $request->session()->get('api_token');

            return view('dashboard', ['token' => $flashedToken ?? null]);

        }catch(Exception $e) {

            throw new Exception($e->getMessage());
        }
    }
}
