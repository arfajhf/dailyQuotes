<?php

namespace App\Http\Controllers\frontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class QuotesController extends Controller
{
    public function generateHttp(){
        return 'http://quetes.test/api';
    }
    public function index(){
        $baseUrl = $this->generateHttp();

        // Request ke API
        $response = Http::get($baseUrl . '/quote');
        $data = $response->json()['data'];
        // dd($data);


        return view('welcome', compact('data'));
    }

}
