<?php

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Candidate;
use Illuminate\Support\Facades\Storage;

class CaketosController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_kandidat' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:500',
            'visi_misi' => 'required|string|max:300',
            'base64_image' => 'required|string|base64', // Add base64 validation
        ]);

        try {
            $image = str_replace('data:image/png;base64,', '', $request->base64_image);
            $image = str_replace(' ', '+', $image);
            $data = base64_decode($image);

            $imageName = time() . '.' . 'png'; 
            Storage::disk('public')->put('uploads/' . $imageName, $data);

            Candidate::create([
                'nama_kandidat' => $request->nama_kandidat,
                'deskripsi' => $request->deskripsi,
                'visi_misi' => $request->visi_misi,
                'image_path' => 'uploads/' . $imageName, 
            ]);

            return response()->json([
                'message' => 'Product created successfully'
            ], 201);
        } 
        catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}