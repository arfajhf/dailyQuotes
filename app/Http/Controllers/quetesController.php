<?php

namespace App\Http\Controllers;

use App\Models\Quotes;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

    public function storeee(Request $request)
    {
        $request->validate([
            'text' => 'required',
            'author' => 'nullable',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = Str::uuid() . '_' . $file->getClientOriginalName();
            $file->move(public_path('image'), $fileName);
            $imagePath = 'image/' . $fileName;
        } else {
            return response([
                'status' => 'gagal',
                'message' => 'Gambar Belum Diisi'
            ]);
        }

        Quotes::create([
            'text' => $request->text,
            'author' => $request->author,
            'image' => $imagePath
        ]);

        return response([
            'status' => 'success',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required',
            'author' => 'nullable',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        try {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('image'), $fileName);
                $imagePath = 'image/' . $fileName;
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Image belum dipilih'
                ], 400);
            }

            Quotes::create([
                'text' => $request->text,
                'author' => $request->author,
                'image' => $imagePath
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Quotes berhasil ditambahkan'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
