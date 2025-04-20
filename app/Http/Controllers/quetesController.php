<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Quotes;
use Illuminate\Http\Request;

class quetesController extends Controller
{
    public function index()
    {
        $data = Quotes::all();
        return response([
            'status' => 'success',
            'data' => $data
        ]);
    }
}
