<?php

namespace App\Http\Controllers;

use App\Models\IbadahRayaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class IbadahRayaController extends Controller
{
    public function listAcara()
    {
        $acara = IbadahRayaModel::where('gereja_id', Auth::user()->gereja_id)->get();
        return view('admin.acara.ibadah_raya.list_acara', compact('acara'));
    }

    public function view_raya(Request $request)
    {
        $gereja = $request->gereja;
        $raya = IbadahRayaModel::where('gereja_id', $gereja->id)->get();
        return view('view.acara.ibadah_raya', compact('raya'));
    }



    public function tambahAcara()
    {
        return view('admin.acara.ibadah_raya.tambah_acara');
    }

    public function insertIbadah(Request $request)
    {
        // Validasi input sesuai dengan form yang telah dibuat
        $validatedData = $request->validate([
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:22048',
            'judul' => 'required|string',
            'tema' => 'nullable|string',
            'ayat' => 'nullable|string',
            'hari' => 'nullable|string',
            'tanggal' => 'required|date',
            'waktu' => 'nullable|date_format:H:i',
            'lokasi' => 'nullable|string',
            'pengkothbah' => 'nullable|string',
            'detail_kegiatan' => 'nullable|string',
        ]);

        // Menyimpan data yang diterima dari form ke dalam database
        $ibadahRaya = new IbadahRayaModel();
        $ibadahRaya->judul = $validatedData['judul'];
        $ibadahRaya->tema = $validatedData['tema'];
        $ibadahRaya->ayat = $validatedData['ayat'];
        $ibadahRaya->hari = $validatedData['hari'];
        $ibadahRaya->tanggal = $validatedData['tanggal'];
        $ibadahRaya->waktu = $validatedData['waktu'];
        $ibadahRaya->lokasi = $validatedData['lokasi'];
        $ibadahRaya->pengkothbah = $validatedData['pengkothbah'];
        $ibadahRaya->detail_kegiatan = $validatedData['detail_kegiatan'];
        $ibadahRaya->gereja_id = Auth::user()->gereja->id;

        // Jika ada file gambar yang diunggah, simpan dan ambil path-nya
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('uploads', $imageName, 'public');
            $ibadahRaya->gambar = $imagePath;  // Update property 'gambar' of the model
        }

        $ibadahRaya->save();

        // Redirect atau response sesuai kebutuhan
        return redirect()->route('listAcara')->with('success', 'Data ibadah raya berhasil disimpan.');
    }

    public function ibadah_raya_single(Request $request)
    {
        $gereja = $request->gereja;
        $raya = IbadahRayaModel::where('gereja_id', $gereja->id)->get();
        return view('view.acara.ibadah_raya_single', compact('raya'));
    }
}