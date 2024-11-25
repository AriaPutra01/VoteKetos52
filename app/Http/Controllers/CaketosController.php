<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use Illuminate\Support\Facades\Storage;

class CaketosController extends Controller
{
    public function __construct()
    {
     
        $this->middleware('auth:api'); 
    }

    public function store(Request $request)
    {
        // Validasi peran pengguna
        if (auth()->user()->role !== 'admin') {
            return response()->json([
                'error' => 'Unauthorized. Only admins can add candidates.'
            ], 403);
        }

        // Validasi data input
        $request->validate([
            'nama_kandidat' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:500',
            'visi_misi' => 'required|string|max:300',
            'base64_image' => 'required|string|base64',
        ]);

        try {
            $image = str_replace('data:image/png;base64,', '', $request->base64_image);
            $image = str_replace(' ', '+', $image);
            $data = base64_decode($image);

            $imageName = time() . '.png'; 
            Storage::disk('public')->put('uploads/' . $imageName, $data);

            Candidate::create([
                'nama_kandidat' => $request->nama_kandidat,
                'deskripsi' => $request->deskripsi,
                'visi_misi' => $request->visi_misi,
                'image_path' => 'uploads/' . $imageName, 
            ]);

            return response()->json([
                'message' => 'Candidate added successfully'
            ], 201);
        } 
        catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
