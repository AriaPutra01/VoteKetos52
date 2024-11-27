<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\CaketosServiceController;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CaketosController extends CaketosServiceController
{
    public function storeCaketos(Request $request)
    {
        $user = self::authUser();

        if ($user->roles->name !== 'admin') {
            return response()->json([
                'error' => 'Unauthorized. Only admins can add candidates.'
            ], 403);
        }

        // Validasi data input
        $request->validate([
            'nama_kandidat' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:500',
            'visi_misi' => 'required|string|max:300',
            'foto' => 'required|image|max:5120',
            'student_id' => 'required|digit_between:1,10'
        ], [
            'nama_kandidat.required' => 'Nama kandiditat tidak boleh kosong',
            'deskripsi.required' => 'Deskripsi tidak bolej kosong',
            'visi_misi.required' => 'Visi & misi tidak boleh kosong',
            'foto.required' => 'Gambar wajib upload',
            'student_id.required' => 'siswa wajib dipilih'
        ]);

        try {

            $doc = Carbon::now()->format('Y-m-d_H:i:s') . '.' . $request->base64_image->extension();
            $request->file('base64_image')->move(public_path('upload/'), $doc);

            $data = [
                'nama_kandidat' => $request->nama_kandidat,
                'deskripsi' => $request->deskripsi,
                'visi_misi' => $request->visi_misi,
                'image_path' => url('/upload/') . $doc,
            ];

            self::store($data);

            return response()->json([
                'message' => 'Candidate added successfully'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
