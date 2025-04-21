<?php

namespace App\Http\Controllers\frontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class QuotesController extends Controller
{
    public function generateHttp()
    {
        return 'http://quetes.test/api';
    }
    public function index()
    {
        $baseUrl = $this->generateHttp();

        // Request ke API
        $response = Http::get($baseUrl . '/quote');
        $data = $response->json()['data'];
        // dd($data);


        return view('welcome', compact('data'));
    }

    public function store(Request $request)
    {
        $baseUrl = $this->generateHttp();
        $client = new \GuzzleHttp\Client();

        $request->validate([
            'text' => 'required',
            'author' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Siapkan multipart data
        $response = $client->request('POST', $baseUrl . '/generate', [
            'multipart' => [
                [
                    'name'     => 'text',
                    'contents' => $request->text
                ],
                [
                    'name'     => 'author',
                    'contents' => $request->author
                ],
                [
                    'name'     => 'image',
                    'contents' => fopen($request->file('image')->getPathname(), 'r'),
                    'filename' => $request->file('image')->getClientOriginalName()
                ]
            ]
        ]);

        if ($response->getStatusCode() != 200) {
            return redirect()->back()->with('alert', 'Gagal menambahkan quotes!');
        }

        return redirect()->route('home')->with('success', 'Quotes berhasil ditambahkan!');
    }
}
